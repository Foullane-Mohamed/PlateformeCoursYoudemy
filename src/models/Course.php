<?php
require_once __DIR__ . '/../config/connection.php';

class Course
{
    protected $id;
    protected $titre;
    protected $description;
    protected $contenu;
    protected $type_contenu;
    protected $id_categorie;
    protected $id_enseignant;
    protected $statut;

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
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) VALUES (:titre, :description, :contenu, :type_contenu, :id_categorie, :id_enseignant, :statut)");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':contenu', $this->contenu);
        $stmt->bindParam(':type_contenu', $this->type_contenu);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':id_enseignant', $this->id_enseignant);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->execute();

        return $conn->lastInsertId();
    }

    public function getAllCategories()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id_categorie, nom FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseWithDetails($courseId)
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
        GROUP BY c.id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':course_id', $courseId);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function isEnrolled($userId, $courseId)
{
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("
        SELECT COUNT(*) as count 
        FROM inscriptions 
        WHERE id_etudiant = :user_id 
        AND id_cours = :course_id
    ");
    
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':course_id', $courseId);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}
    public function getAllCoursesWithDetails($categoryId = null, $search = null)
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
        WHERE c.statut = 'actif'";

    $params = [];

    if ($categoryId) {
        $query .= " AND c.id_categorie = :category_id";
        $params[':category_id'] = $categoryId;
    }

    if ($search) {
        $query .= " AND (c.titre LIKE :search OR c.description LIKE :search OR t.nom LIKE :search)";
        $params[':search'] = "%$search%";
    }

    $query .= " GROUP BY c.id ORDER BY c.id DESC";

    $stmt = $conn->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAllTags()
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id_tag, nom FROM tags");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
