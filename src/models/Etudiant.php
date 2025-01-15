<?php
require_once 'connection.php';
require_once 'User.php';

class Etudiant extends User
{
    public function inscriptionCours($idCours)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO inscriptions (id_etudiant, id_cours, date_inscription) VALUES (:id_etudiant, :id_cours, NOW())");
        $stmt->bindParam(':id_etudiant', $this->id);
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
    }

    public function getMesCours()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT c.* 
                              FROM inscriptions i
                              JOIN cours c ON i.id_cours = c.id
                              WHERE i.id_etudiant = :id_etudiant");
        $stmt->bindParam(':id_etudiant', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvaluationsCours($idCours)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM evaluations WHERE id_etudiant = :id_etudiant AND id_cours = :id_cours");
        $stmt->bindParam(':id_etudiant', $this->id);
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterEvaluation($idCours, $note, $commentaire)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO evaluations (id_cours, id_etudiant, note, commentaire) VALUES (:id_cours, :id_etudiant, :note, :commentaire)");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->bindParam(':id_etudiant', $this->id);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->execute();
    }

    public function obtenirCertificat($idCours)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO certificats (id_etudiant, id_cours, date_obtention) VALUES (:id_etudiant, :id_cours, NOW())");
        $stmt->bindParam(':id_etudiant', $this->id);
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
    }
}