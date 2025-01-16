<?php
require_once __DIR__ . '/../config/Connection.php';

require_once __DIR__ . '/Category.php'; 
require_once __DIR__ . '/User.php'; 
require_once __DIR__ . '/Course.php'; 
require_once __DIR__ . '/Tags.php'; 


class Enseignant extends User
{
    public function ajouterCours($titre, $description, $contenu, $type_contenu, $id_categorie, $tags)
    {
        $cours = new Course($titre, $description, $contenu, $type_contenu, $id_categorie, $this->id, 'actif');
        $cours->create();

        foreach ($tags as $tagName) {
            $tag = Tag::getTagByName($tagName);
            if (!$tag) {
                $tag = new Tag($tagName);
                $tag->create();
            }
            $this->ajouterTagACours($cours->id, $tag->id);
        }
    }

    private function ajouterTagACours($idCours, $idTag)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO cours_tags (id_cours, id_tag) VALUES (:id_cours, :id_tag)");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->bindParam(':id_tag', $idTag);
        $stmt->execute();
    }

    public function modifierCours($idCours, $titre, $description, $contenu, $type_contenu, $id_categorie, $tags)
    {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE cours SET titre = :titre, description = :description, contenu = :contenu, type_contenu = :type_contenu, id_categorie = :id_categorie WHERE id = :id");
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
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM cours_tags WHERE id_cours = :id_cours");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
    }

    public function supprimerCours($idCours)
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM cours WHERE id = :id");
        $stmt->bindParam(':id', $idCours);
        $stmt->execute();
    }

    public function consulterInscriptions($idCours)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT u.nom, u.email, i.date_inscription 
                              FROM inscriptions i
                              JOIN utilisateurs u ON i.id_etudiant = u.id
                              WHERE i.id_cours = :id_cours");
        $stmt->bindParam(':id_cours', $idCours);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}