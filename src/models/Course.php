<?php
require_once 'connection.php';

class Course
{
    private $id;
    private $titre;
    private $description;
    private $contenu;
    private $type_contenu;
    private $id_categorie;
    private $id_enseignant;
    private $statut;

    public function __construct($titre, $description, $contenu, $type_contenu, $id_categorie, $id_enseignant, $statut)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->type_contenu = $type_contenu;
        $this->id_categorie = $id_categorie;
        $this->id_enseignant = $id_enseignant;
        $this->statut = $statut;
    }

    public function create()
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) VALUES (:titre, :description, :contenu, :type_contenu, :id_categorie, :id_enseignant, :statut)");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':contenu', $this->contenu);
        $stmt->bindParam(':type_contenu', $this->type_contenu);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':id_enseignant', $this->id_enseignant);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    public function update($titre, $description, $contenu, $type_contenu, $id_categorie, $statut)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE cours SET titre = :titre, description = :description, contenu = :contenu, type_contenu = :type_contenu, id_categorie = :id_categorie, statut = :statut WHERE id = :id");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':type_contenu', $type_contenu);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function delete()
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function getCourseById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($course) {
            $courseObject = new Course(
                $course['titre'],
                $course['description'],
                $course['contenu'],
                $course['type_contenu'],
                $course['id_categorie'],
                $course['id_enseignant'],
                $course['statut']
            );
            $courseObject->id = $course['id'];
            return $courseObject;
        }
        return null;
    }

    public static function getAllCourses()
    {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM cours");
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $courseObjects = [];
        foreach ($courses as $course) {
            $courseObject = new Course(
                $course['titre'],
                $course['description'],
                $course['contenu'],
                $course['type_contenu'],
                $course['id_categorie'],
                $course['id_enseignant'],
                $course['statut']
            );
            $courseObject->id = $course['id'];
            $courseObjects[] = $courseObject;
        }
        return $courseObjects;
    }
}