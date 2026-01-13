<?php
require_once '../../config/database.php';
require_once '../../functions/cours_functions.php';
require_once '../../functions/professeur_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$cours = getCoursById($id);
if (!$cours) {
    die("Cours introuvable.");
}

$professeurs = getAllProfesseurs();
$pageTitle = "Modifier un cours";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $intitule = $_POST['intitule'];
    $description = $_POST['description'];
    $dureeHeures = $_POST['dureeHeures'];
    $prix = $_POST['prix'];
    $professeur_id = !empty($_POST['professeur_id']) ? $_POST['professeur_id'] : null;

    if (updateCours($id, $code, $intitule, $description, $dureeHeures, $prix, $professeur_id)) {
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
                    <h5 class="mb-0">Modifier le cours</h5>
                </div>
                <div class="card-body">


                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" id="code"
                                value="<?= htmlspecialchars($cours['code']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="intitule" class="form-label">Intitulé</label>
                            <input type="text" name="intitule" class="form-control" id="intitule"
                                value="<?= htmlspecialchars($cours['intitule']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description"
                                rows="3"><?= htmlspecialchars($cours['description']) ?></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dureeHeures" class="form-label">Durée (Heures)</label>
                                <input type="number" name="dureeHeures" class="form-control" id="dureeHeures"
                                    value="<?= htmlspecialchars($cours['dureeHeures']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="prix" class="form-label">Prix</label>
                                <input type="number" step="0.01" name="prix" class="form-control" id="prix"
                                    value="<?= htmlspecialchars($cours['prix']) ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="professeur_id" class="form-label">Professeur</label>
                            <select name="professeur_id" class="form-select">
                                <option value="">Choisir un professeur...</option>
                                <?php foreach ($professeurs as $prof) { ?>
                                    <option value="<?= $prof['id'] ?>" <?= $prof['id'] == $cours['professeur_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($prof['nom'] . ' ' . $prof['prenom']) ?>
                                    </option>
                                <?php } ?>
                            </select>
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