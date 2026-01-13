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

$pageTitle = "Modifier un étudiant";
$path_prefix = "../../";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cne = $_POST['cne'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $dateInscription = $_POST['dateInscription'];

    if (updateEtudiant($id, $cne, $nom, $prenom, $email, $telephone, $dateInscription)) {
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
                    <h5 class="mb-0">Modifier l'étudiant</h5>
                </div>
                <div class="card-body">


                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="cne" class="form-label">CNE</label>
                            <input type="text" name="cne" class="form-control" id="cne"
                                value="<?= htmlspecialchars($etudiant['cne']) ?>" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" id="nom"
                                    value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" id="prenom"
                                    value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="<?= htmlspecialchars($etudiant['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" id="telephone"
                                value="<?= htmlspecialchars($etudiant['telephone']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="dateInscription" class="form-label">Date d'inscription</label>
                            <input type="date" name="dateInscription" class="form-control" id="dateInscription"
                                value="<?= htmlspecialchars($etudiant['dateInscription']) ?>" required>
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