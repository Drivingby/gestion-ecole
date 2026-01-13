<?php
// CRUD Functions for Inscription

function getAllInscriptions()
{
    global $pdo;
    try {
        $sql = "SELECT i.*, 
                       e.nom as etudiant_nom, e.prenom as etudiant_prenom, e.cne,
                       c.intitule as cours_intitule, c.code as cours_code
                FROM inscription i
                JOIN etudiant e ON i.etudiant_id = e.id
                JOIN cours c ON i.cours_id = c.id
                ORDER BY i.dateInscription DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function getInscriptionById($id)
{
    global $pdo;
    try {
        $sql = "SELECT i.*, 
                       e.nom as etudiant_nom, e.prenom as etudiant_prenom,
                       c.intitule as cours_intitule
                FROM inscription i
                JOIN etudiant e ON i.etudiant_id = e.id
                JOIN cours c ON i.cours_id = c.id
                WHERE i.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function addInscription($etudiant_id, $cours_id, $dateInscription, $statut = 'INSCRIT')
{
    global $pdo;
    try {
        // Prevent duplicate enrollment
        $check = $pdo->prepare("SELECT id FROM inscription WHERE etudiant_id = ? AND cours_id = ?");
        $check->execute([$etudiant_id, $cours_id]);
        if ($check->rowCount() > 0) {
            return false;
        }

        $stmt = $pdo->prepare("INSERT INTO inscription (etudiant_id, cours_id, dateInscription, statut) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$etudiant_id, $cours_id, $dateInscription, $statut]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function updateInscription($id, $statut, $note = null)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE inscription SET statut = ?, note = ? WHERE id = ?");
        return $stmt->execute([$statut, $note, $id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}

function deleteInscription($id)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM inscription WHERE id = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $error) {
        die("Erreur : " . $error->getMessage());
    }
}
?>