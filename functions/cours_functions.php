<?php
// CRUD Functions for Cours

function getAllCours()
{
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT cours.*, professeur.nom as prof_nom, professeur.prenom as prof_prenom 
                             FROM cours 
                             LEFT JOIN professeur ON cours.professeur_id = professeur.id
                             ORDER BY cours.intitule");
        return $stmt->fetchAll();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function getCoursById($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM cours WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function addCours($code, $intitule, $description, $dureeHeures, $prix, $professeur_id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO cours (code, intitule, description, dureeHeures, prix, professeur_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$code, $intitule, $description, $dureeHeures, $prix, $professeur_id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function updateCours($id, $code, $intitule, $description, $dureeHeures, $prix, $professeur_id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE cours SET code = ?, intitule = ?, description = ?, dureeHeures = ?, prix = ?, professeur_id = ? WHERE id = ?");
        return $stmt->execute([$code, $intitule, $description, $dureeHeures, $prix, $professeur_id, $id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function deleteCours($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM cours WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}
?>