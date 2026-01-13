<?php
require_once '../../config/database.php';
require_once '../../functions/inscription_functions.php';
require_once '../../functions/etudiant_functions.php';
require_once '../../functions/cours_functions.php';

$etudiants = getAllEtudiants();
$cours = getAllCours();

$pageTitle = "Nouvelle Inscription";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $etudiant_id = $_POST['etudiant_id'];
    $cours_id = $_POST['cours_id'];
    $dateInscription = $_POST['dateInscription'];

    if (addInscription($etudiant_id, $cours_id, $dateInscription)) {
        header('Location: liste.php');
        exit;
    } else {
        $error = "Erreur : Cet étudiant est peut-être déjà inscrit à ce cours.";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Nouvelle Inscription</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="etudiant_id" class="form-label">Étudiant</label>
                            <select name="etudiant_id" class="form-select" required>
                                <option value="">Choisir un étudiant...</option>
                                <?php foreach ($etudiants as $etd) { ?>
                                    <option value="<?= $etd['id'] ?>">
                                        <?= htmlspecialchars($etd['nom'] . ' ' . $etd['prenom'] . ' (' . $etd['cne'] . ')') ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cours_id" class="form-label">Cours</label>
                            <select name="cours_id" class="form-select" required>
                                <option value="">Choisir un cours...</option>
                                <?php foreach ($cours as $c) { ?>
                                    <option value="<?= $c['id'] ?>">
                                        <?= htmlspecialchars($c['intitule'] . ' (' . $c['code'] . ')') ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dateInscription" class="form-label">Date d'inscription</label>
                            <input type="date" name="dateInscription" class="form-control" id="dateInscription"
                                value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="liste.php" class="btn btn-secondary me-md-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>