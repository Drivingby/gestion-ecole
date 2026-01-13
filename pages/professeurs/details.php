<?php
require_once '../../config/database.php';
require_once '../../functions/professeur_functions.php';
require_once '../../functions/stats_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$professeur = getProfesseurById($id);
if (!$professeur) {
    header('Location: liste.php');
    exit;
}

$courses = getProfesseurCourses($id);

$pageTitle = "Détails du professeur";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails du professeur</h1>
        <a href="liste.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <!-- Professor Info -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="bi bi-person-video3 me-2"></i>Informations Personnelles</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-circle bg-light text-dark rounded-circle d-flex align-items-center justify-content-center mx-auto"
                            style="width: 100px; height: 100px; font-size: 2.5rem;">
                            <?= strtoupper(substr($professeur['nom'], 0, 1) . substr($professeur['prenom'], 0, 1)) ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Nom Complet:</strong>
                            <span>
                                <?= htmlspecialchars($professeur['nom'] . ' ' . $professeur['prenom']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Matricule:</strong>
                            <code><?= htmlspecialchars($professeur['matricule']) ?></code>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Spécialité:</strong>
                            <span class="badge bg-info text-dark">
                                <?= htmlspecialchars($professeur['specialite']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong>
                            <span class="text-truncate" style="max-width: 150px;">
                                <?= htmlspecialchars($professeur['email']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Téléphone:</strong>
                            <span>
                                <?= htmlspecialchars($professeur['telephone']) ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Taught Courses -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm mb-4 bg-info text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Cours Enseignés</h6>
                            <h2 class="my-2 display-6 fw-bold">
                                <?= count($courses) ?>
                            </h2>
                            <small>Cours totaux</small>
                        </div>
                        <i class="bi bi-easel fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary"><i class="bi bi-book-half me-2"></i>Liste des Cours</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Intitulé</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($courses)) { ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-journal-x fs-4 d-block mb-2"></i>
                                        Ce professeur n'enseigne aucun cours pour le moment.
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($courses as $c) { ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border">
                                                <?= htmlspecialchars($c['code']) ?>
                                            </span></td>
                                        <td class="fw-bold">
                                            <?= htmlspecialchars($c['intitule']) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($c['dureeHeures']) ?> h
                                        </td>
                                        <td>
                                            <?= number_format($c['prix'], 2) ?> DHS
                                        </td>
                                        <td class="text-end">
                                            <a href="../cours/details.php?id=<?= $c['id'] ?>"
                                                class="btn btn-sm btn-outline-primary" title="Voir cours">
                                                <i class="bi bi-eye"></i> Détails
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>