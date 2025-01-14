<?php
namespace App\Models;

class Admin extends User {
    public function getPendingTeachers() {
        $stmt = $this->db->prepare("
            SELECT * FROM utilisateurs 
            WHERE role = 'enseignant' AND status = 'en_attente'
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGlobalStatistics() {
        // Total users by role
        $userStats = $this->db->query("
            SELECT role, COUNT(*) as count 
            FROM utilisateurs 
            GROUP BY role
        ")->fetchAll();

        // Course statistics
        $courseStats = $this->db->query("
            SELECT 
                COUNT(*) as total_courses,
                COUNT(DISTINCT id_enseignant) as total_teachers,
                AVG(
                    SELECT COUNT(*) 
                    FROM inscriptions 
                    WHERE inscriptions.id_cours = cours.id
                ) as avg_students_per_course
            FROM cours
        ")->fetch();

        // Most popular courses
        $popularCourses = $this->db->query("
            SELECT c.*, 
                   COUNT(i.id_etudiant) as student_count,
                   u.nom as teacher_name
            FROM cours c
            JOIN utilisateurs u ON c.id_enseignant = u.id
            LEFT JOIN inscriptions i ON c.id = i.id_cours
            GROUP BY c.id
            ORDER BY student_count DESC
            LIMIT 5
        ")->fetchAll();

        // Top rated teachers
        $topTeachers = $this->db->query("
            SELECT u.id, u.nom,
                   COUNT(DISTINCT c.id) as course_count,
                   AVG(e.note) as average_rating
            FROM utilisateurs u
            JOIN cours c ON u.id = c.id_enseignant
            LEFT JOIN evaluations e ON c.id = e.id_cours
            WHERE u.role = 'enseignant'
            GROUP BY u.id
            HAVING COUNT(DISTINCT c.id) > 0
            ORDER BY average_rating DESC
            LIMIT 3
        ")->fetchAll();

        return [
            'user_stats' => $userStats,
            'course_stats' => $courseStats,
            'popular_courses' => $popularCourses,
            'top_teachers' => $topTeachers
        ];
    }

    public function getSystemLogs($limit = 100) {
        // Assuming you have a system_logs table
        $stmt = $this->db->prepare("
            SELECT * FROM system_logs 
            ORDER BY created_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function validateTeacher($teacherId) {
        $stmt = $this->db->prepare("
            UPDATE utilisateurs 
            SET status = 'actif' 
            WHERE id = ? AND role = 'enseignant'
        ");
        return $stmt->execute([$teacherId]);
    }

    public function manageTags($action, $data) {
        switch($action) {
            case 'create':
                $stmt = $this->db->prepare("INSERT INTO tags (nom) VALUES (?)");
                return $stmt->execute([$data['nom']]);
            
            case 'update':
                $stmt = $this->db->prepare("UPDATE tags SET nom = ? WHERE id_tag = ?");
                return $stmt->execute([$data['nom'], $data['id']]);
            
            case 'delete':
                $stmt = $this->db->prepare("DELETE FROM tags WHERE id_tag = ?");
                return $stmt->execute([$data['id']]);
            
            case 'bulk_create':
                $success = true;
                $this->db->beginTransaction();
                try {
                    foreach ($data['tags'] as $tag) {
                        $stmt = $this->db->prepare("INSERT INTO tags (nom) VALUES (?)");
                        $success = $success && $stmt->execute([$tag]);
                    }
                    $this->db->commit();
                    return $success;
                } catch (\Exception $e) {
                    $this->db->rollBack();
                    return false;
                }
        }
    }
}