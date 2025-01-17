<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/Category.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Course.php';
require_once __DIR__ . '/Tag.php';

class Enseignant extends User
{
    protected $id; 
    public function __construct($id){
      $this->id = $id;
    }


    public function getId()
    {
        return $this->id;
    }

    public function ajouterCours($titre, $description, $contenu, $type_contenu, $id_categorie, $tags)
    {
        $cours = new Course($titre, $description, $contenu, $type_contenu, $id_categorie, $this->id, 'actif');
        $coursId = $cours->create();

        foreach ($tags as $tagName) {
            $tag = Tag::getTagByName($tagName);
            if (!$tag) {
                $tag = new Tag($tagName);
                $tag->create();
            }
            $this->ajouterTagACours($coursId, $tag->id);
        }

        return $coursId;
    }

    private function ajouterTagACours($idCours, $idTag)
    {
        if (is_null($idTag)) {
            throw new Exception('Tag ID cannot be null');
        }

        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO cours_tags (id_cours, id_tag) VALUES (:id_cours, :id_tag)");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->bindParam(':id_tag', $idTag);
        $stmt->execute();
    }

    public function modifierCours($idCours, $titre, $description, $contenu, $type_contenu, $id_categorie, $tags)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("UPDATE cours SET titre = :titre, description = :description, contenu = :contenu, type_contenu = :type_contenu, id_categorie = :id_categorie WHERE id = :id");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':type_contenu', $type_contenu);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':id', $idCours);
        $stmt->execute();

        $this->supprimerTagsDeCours($idCours);
        foreach ($tags as $tagName) {
            $tag = Tag::getTagByName($tagName);
            if (!$tag) {
                $tag = new Tag($tagName);
                $tag->create();
            }
            $this->ajouterTagACours($idCours, $tag->id);
        }
    }

    private function supprimerTagsDeCours($idCours)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM cours_tags WHERE id_cours = :id_cours");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
    }

    public function supprimerCours($idCours)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("DELETE FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $idCours);
        $stmt->execute();
    }

    public function consulterInscriptions($idCours)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT u.nom, u.email, i.date_inscription
                              FROM inscriptions i
                              JOIN utilisateurs u ON i.id_etudiant = u.id
                              WHERE i.id_cours = :id_cours");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalStudents($enseignantId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT COUNT(DISTINCT i.id_etudiant) AS total_students
                               FROM inscriptions i
                               JOIN cours c ON i.id_cours = c.id
                               WHERE c.id_enseignant = :enseignantId");
        $stmt->bindParam(':enseignantId', $enseignantId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_students'];
    }

    public function getActiveCourses($enseignantId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS active_courses
                               FROM cours
                               WHERE id_enseignant = :enseignantId AND statut = 'actif'");
        $stmt->bindParam(':enseignantId', $enseignantId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['active_courses'];
    }

    public function getDraftCourses($enseignantId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT COUNT(*) AS draft_courses
                               FROM cours
                               WHERE id_enseignant = :enseignantId AND statut = 'brouillon'");
        $stmt->bindParam(':enseignantId', $enseignantId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['draft_courses'];
    }

  

    public function getCoursePerformance($enseignantId)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT c.titre, COUNT(i.id_etudiant) AS nombre_etudiants
                               FROM cours c
                               LEFT JOIN inscriptions i ON c.id = i.id_cours
                               WHERE c.id_enseignant = :enseignantId
                               GROUP BY c.id");
        $stmt->bindParam(':enseignantId', $enseignantId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
