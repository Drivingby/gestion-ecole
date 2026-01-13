<?php
require_once '../../config/database.php';
require_once '../../functions/inscription_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$inscription = getInscriptionById($id);
if (!$inscription) {
    die("Inscription introuvable.");
}

$pageTitle = "Supprimer Inscription";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (deleteInscription($id)) {
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
                        Voulez-vous supprimer l'inscription de
                        <strong>
                            <?= htmlspecialchars($inscription['etudiant_nom']) ?>
                        </strong>
                        au cours
                        <strong>
                            <?= htmlspecialchars($inscription['cours_intitule']) ?>
                        </strong> ?
                    </p>
                    <form method="POST">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="liste.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>