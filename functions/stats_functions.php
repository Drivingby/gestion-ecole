<?php

/**
 * Récupère la liste des cours suivis par un étudiant
 *
 * @param int $etudiantId
 * @return array
 */
function getEtudiantCourses($etudiantId)
{
    global $pdo;
    $sql = "SELECT c.*, i.dateInscription as date_inscription, i.statut, i.note 
            FROM cours c 
            JOIN inscription i ON c.id = i.cours_id 
            WHERE i.etudiant_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$etudiantId]);
    return $stmt->fetchAll();
}

/**
 * Calcule le montant total des frais pour les cours d'un étudiant
 *
 * @param int $etudiantId
 * @return float
 */
function getEtudiantTotalFrais($etudiantId)
{
    global $pdo;
    $sql = "SELECT SUM(c.prix) as total_frais 
            FROM cours c 
            JOIN inscription i ON c.id = i.cours_id 
            WHERE i.etudiant_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$etudiantId]);
    $result = $stmt->fetch();
    return $result['total_frais'] ?: 0.00;
}

/**
 * Récupère la liste des étudiants inscrits à un cours
 *
 * @param int $coursId
 * @return array
 */
function getCoursStudents($coursId)
{
    global $pdo;
    $sql = "SELECT e.*, i.dateInscription as date_inscription, i.statut, i.note 
            FROM etudiant e 
            JOIN inscription i ON e.id = i.etudiant_id 
            WHERE i.cours_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$coursId]);
    return $stmt->fetchAll();
}

/**
 * Compte le nombre d'étudiants inscrits à un cours
 *
 * @param int $coursId
 * @return int
 */
function getCoursStudentCount($coursId)
{
    global $pdo;
    $sql = "SELECT COUNT(*) as count 
            FROM inscription 
            WHERE cours_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$coursId]);
    $result = $stmt->fetch();
    return $result['count'];
}

/**
 * Récupère la liste des cours enseignés par un professeur
 *
 * @param int $profId
 * @return array
 */
function getProfesseurCourses($profId)
{
    global $pdo;
    $sql = "SELECT * FROM cours WHERE professeur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$profId]);
    return $stmt->fetchAll();
}
