<?php
// CRUD Functions for Etudiant

function getAllEtudiants()
{
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM etudiant ORDER BY nom, prenom");
        return $stmt->fetchAll();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function getEtudiantById($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function addEtudiant($cne, $nom, $prenom, $email, $telephone, $dateInscription)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO etudiant (cne, nom, prenom, email, telephone, dateInscription) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$cne, $nom, $prenom, $email, $telephone, $dateInscription]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function updateEtudiant($id, $cne, $nom, $prenom, $email, $telephone, $dateInscription)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE etudiant SET cne = ?, nom = ?, prenom = ?, email = ?, telephone = ?, dateInscription = ? WHERE id = ?");
        return $stmt->execute([$cne, $nom, $prenom, $email, $telephone, $dateInscription, $id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function deleteEtudiant($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM etudiant WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}
?>