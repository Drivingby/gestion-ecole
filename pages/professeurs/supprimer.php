<?php
require_once '../../config/database.php';
require_once '../../functions/professeur_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$prof = getProfesseurById($id);
if (!$prof) {
    die("Professeur introuvable.");
}

$pageTitle = "Supprimer un professeur";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (deleteProfesseur($id)) {
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
                        Êtes-vous sûr de vouloir supprimer le professeur <strong>
                            <?= htmlspecialchars($prof['nom']) . ' ' . htmlspecialchars($prof['prenom']) ?>
                        </strong> ?
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