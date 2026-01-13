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

$pageTitle = "Modifier Inscription";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statut = $_POST['statut'];
    $note = !empty($_POST['note']) ? $_POST['note'] : null;

    if (updateInscription($id, $statut, $note)) {
        header('Location: liste.php');
        exit;
    } else {
        $error = "Erreur lors de la modification.";
    }
}

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Gérer l'inscription</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-light border">
                        <strong>Étudiant :</strong>
                        <?= htmlspecialchars($inscription['etudiant_nom'] . ' ' . $inscription['etudiant_prenom']) ?><br>
                        <strong>Cours :</strong>
                        <?= htmlspecialchars($inscription['cours_intitule']) ?>
                    </div>



                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select name="statut" class="form-select" required>
                                <option value="INSCRIT" <?= $inscription['statut'] == 'INSCRIT' ? 'selected' : '' ?>>
                                    INSCRIT</option>
                                <option value="TERMINE" <?= $inscription['statut'] == 'TERMINE' ? 'selected' : '' ?>>
                                    TERMINE</option>
                                <option value="ANNULE" <?= $inscription['statut'] == 'ANNULE' ? 'selected' : '' ?>>ANNULE
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note (Optionnel)</label>
                            <input type="number" step="0.01" min="0" max="20" name="note" class="form-control" id="note"
                                value="<?= $inscription['note'] ?>">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="liste.php" class="btn btn-secondary me-md-2">Annuler</a>
                            <button type="submit" class="btn btn-warning">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>