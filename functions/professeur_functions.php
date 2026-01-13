<?php
// CRUD Functions for Professeur

function getAllProfesseurs()
{
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM professeur ORDER BY nom, prenom");
        return $stmt->fetchAll();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function getProfesseurById($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM professeur WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function addProfesseur($matricule, $nom, $prenom, $email, $telephone, $specialite)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO professeur (matricule, nom, prenom, email, telephone, specialite) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$matricule, $nom, $prenom, $email, $telephone, $specialite]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function updateProfesseur($id, $matricule, $nom, $prenom, $email, $telephone, $specialite)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE professeur SET matricule = ?, nom = ?, prenom = ?, email = ?, telephone = ?, specialite = ? WHERE id = ?");
        return $stmt->execute([$matricule, $nom, $prenom, $email, $telephone, $specialite, $id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function deleteProfesseur($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM professeur WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}
?>