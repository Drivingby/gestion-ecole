<?php
require_once '../../config/database.php';
require_once '../../functions/etudiant_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$etudiant = getEtudiantById($id);
if (!$etudiant) {
    die("Étudiant introuvable.");
}

$pageTitle = "Supprimer un étudiant";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (deleteEtudiant($id)) {
        header('Location: liste.php');
        exit;
    } else {
        $error = "Erreur lors de la suppression.";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Confirmer la suppression</h5>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">
                        Êtes-vous sûr de vouloir supprimer l'étudiant
                        <strong><?= htmlspecialchars($etudiant['nom']) . ' ' . htmlspecialchars($etudiant['prenom']) ?></strong>
                        ?
                        <br>
                        <small class="text-danger">Cette action est irréversible.</small>
                    </p>

                    <form method="POST">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="liste.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>