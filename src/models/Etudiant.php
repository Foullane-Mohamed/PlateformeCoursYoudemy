<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Inscription.php';

class Etudiant extends User
{
    public function __construct($nom = null, $email = null, $password = null, $role = null, $status = null)
    {
        parent::__construct($nom, $email, $password, $role, $status);
    }


    public function getMesCours($idEtudiant)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
    
      
            $stmt = $conn->prepare("
                SELECT c.*, i.date_inscription 
                FROM inscriptions i
                JOIN cours c ON i.id_cours = c.id
                WHERE i.id_etudiant = :id_etudiant
            ");
            $stmt->bindParam(':id_etudiant', $idEtudiant);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
  
    public function inscriptionCours($idEtudiant, $idCours)
{
    $inscription = new Inscription($idEtudiant, $idCours);
    return $inscription->inscriptionCours();
}
public function getCourseAllStatus($courseId)
{
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $query = "
        SELECT 
            c.*,
            cat.nom as category_name,
            u.nom as enseignant_nom,
            COUNT(DISTINCT i.id_etudiant) as nombre_etudiants,
            GROUP_CONCAT(DISTINCT t.nom) as tags
        FROM cours c
        LEFT JOIN categories cat ON c.id_categorie = cat.id_categorie
        LEFT JOIN utilisateurs u ON c.id_enseignant = u.id
        LEFT JOIN inscriptions i ON c.id = i.id_cours
        LEFT JOIN cours_tags ct ON c.id = ct.id_cours
        LEFT JOIN tags t ON ct.id_tag = t.id_tag
        WHERE c.id = :course_id
        GROUP BY c.id ";
        // WHERE c.status = 'actif'";
    

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':course_id', $courseId);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}