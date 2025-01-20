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
}