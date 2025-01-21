<?php
require_once __DIR__ . '/../config/connection.php';
require_once 'User.php';

class Admin extends User
{
    public function __construct($nom, $email, $password, $role, $status)
    {
        parent::__construct($nom, $email, $password, $role, $status);
    }

    public function validateTeacher($userId)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $checkStmt = $conn->prepare("SELECT role, status FROM utilisateurs WHERE id = :userId");
            $checkStmt->bindParam(':userId', $userId);
            $checkStmt->execute();
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return ['success' => false, 'message' => 'Utilisateur non trouvé'];
            }

            if ($user['role'] !== 'enseignant') {
                return ['success' => false, 'message' => 'L\'utilisateur n\'est pas un enseignant'];
            }

            $stmt = $conn->prepare("UPDATE utilisateurs SET status = 'actif' WHERE id = :userId AND role = 'enseignant'");
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            return ['success' => true, 'message' => 'Enseignant validé avec succès'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la validation: ' . $e->getMessage()];
        }
    }

    public function suspendUser($userId)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $checkStmt = $conn->prepare("SELECT id, status FROM utilisateurs WHERE id = :userId");
            $checkStmt->bindParam(':userId', $userId);
            $checkStmt->execute();

            if (!$checkStmt->fetch()) {
                return ['success' => false, 'message' => 'Utilisateur non trouvé'];
            }

            $stmt = $conn->prepare("UPDATE utilisateurs SET status = 'inactif' WHERE id = :userId");
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $this->handleInactiveTeacher($userId);

            return ['success' => true, 'message' => 'Utilisateur suspendu avec succès'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la suspension: ' . $e->getMessage()];
        }
    }

    private function handleInactiveTeacher($teacherId)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("
                SELECT DISTINCT u.email
                FROM utilisateurs u
                JOIN inscriptions i ON u.id = i.id_etudiant
                JOIN cours c ON i.id_cours = c.id
                WHERE c.id_enseignant = :teacherId
            ");
            $stmt->bindParam(':teacherId', $teacherId);
            $stmt->execute();
            $studentEmails = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $stmt = $conn->prepare("
                UPDATE cours
                SET status = 'suspendu'
                WHERE id_enseignant = :teacherId
            ");
            $stmt->bindParam(':teacherId', $teacherId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            error_log('Error handling inactive teacher: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteUser($userId)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $conn->beginTransaction();

            $checkStmt = $conn->prepare("SELECT role FROM utilisateurs WHERE id = :userId");
            $checkStmt->bindParam(':userId', $userId);
            $checkStmt->execute();
            $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return ['success' => false, 'message' => 'Utilisateur non trouvé'];
            }

            if ($user['role'] === 'enseignant') {
                $stmt = $conn->prepare("UPDATE cours SET status = 'supprimé' WHERE id_enseignant = :userId");
                $stmt->bindParam(':userId', $userId);
                $stmt->execute();
            }

            $tables = ['inscriptions', 'evaluations', 'commentaires'];
            foreach ($tables as $table) {
                $stmt = $conn->prepare("DELETE FROM {$table} WHERE id_utilisateur = :userId");
                $stmt->bindParam(':userId', $userId);
                $stmt->execute();
            }

            $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = :userId");
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $conn->commit();
            return ['success' => true, 'message' => 'Utilisateur supprimé avec succès'];
        } catch (PDOException $e) {
            $conn->rollBack();
            return ['success' => false, 'message' => 'Erreur lors de la suppression: ' . $e->getMessage()];
        }
    }

    public function getAllUsers()
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("
                SELECT * FROM utilisateurs
                WHERE NOT (role = 'enseignant' AND status = 'inactif')
                ORDER BY FIELD(role, 'admin', 'enseignant', 'etudiant'),
                         FIELD(status, 'actif', 'en_attente', 'inactif'),
                         nom
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la récupération des utilisateurs: ' . $e->getMessage()];
        }
    }
}