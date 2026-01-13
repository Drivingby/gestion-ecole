<?php
require_once '../../config/database.php';
require_once '../../functions/etudiant_functions.php';
require_once '../../functions/stats_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$etudiant = getEtudiantById($id);
if (!$etudiant) {
    header('Location: liste.php');
    exit;
}

$courses = getEtudiantCourses($id);
$totalFrais = getEtudiantTotalFrais($id);

$pageTitle = "Détails de l'étudiant";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails de l'étudiant</h1>
        <a href="liste.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <!-- Student Info -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Informations Personnelles</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-circle bg-light text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                            style="width: 100px; height: 100px; font-size: 2.5rem;">
                            <?= strtoupper(substr($etudiant['nom'], 0, 1) . substr($etudiant['prenom'], 0, 1)) ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Nom Complet:</strong>
                            <span>
                                <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>CNE:</strong>
                            <span>
                                <?= htmlspecialchars($etudiant['cne']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong>
                            <span class="text-truncate" style="max-width: 150px;">
                                <?= htmlspecialchars($etudiant['email']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Téléphone:</strong>
                            <span>
                                <?= htmlspecialchars($etudiant['telephone']) ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Inscrit le:</strong>
                            <span>
                                <?= htmlspecialchars($etudiant['dateInscription']) ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats & Courses -->
        <div class="col-md-8 mb-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Total Frais</h6>
                                    <h2 class="my-2 display-6 fw-bold">
                                        <?= number_format($totalFrais, 2) ?> DHS
                                    </h2>
                                    <small>Cumul des cours inscrits</small>
                                </div>
                                <i class="bi bi-wallet2 fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Cours Inscrits</h6>
                                    <h2 class="my-2 display-6 fw-bold">
                                        <?= count($courses) ?>
                                    </h2>
                                    <small>Nombre de formations</small>
                                </div>
                                <i class="bi bi-book fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Table -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary"><i class="bi bi-journal-check me-2"></i>Liste des Cours</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Code</th>
                                <th>Intitulé</th>
                                <th>Date Inscription</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th class="text-end">Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($courses)) { ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                        Aucun cours inscrit pour le moment.
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
                                            <?= htmlspecialchars($c['date_inscription']) ?>
                                        </td>
                                        <td>
                                            <?php
                                            // Handle potentially undefined or different Status names if enum changed, 
                                            // but based on valid enums 'INSCRIT', 'ANNULE', 'TERMINE'
                                            $badgeClass = 'bg-secondary';
                                            if ($c['statut'] === 'INSCRIT')
                                                $badgeClass = 'bg-primary';
                                            if ($c['statut'] === 'TERMINE')
                                                $badgeClass = 'bg-success';
                                            if ($c['statut'] === 'ANNULE')
                                                $badgeClass = 'bg-danger';
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= htmlspecialchars($c['statut'] ?? 'N/A') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($c['note'] !== null) { ?>
                                                <span class="fw-bold <?= $c['note'] >= 10 ? 'text-success' : 'text-danger' ?>">
                                                    <?= number_format($c['note'], 2) ?>/20
                                                </span>
                                            <?php } else { ?>
                                                <span class="text-muted">-</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-end fw-bold">
                                            <?= number_format($c['prix'], 2) ?> DHS
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold text-success">
                                    <?= number_format($totalFrais, 2) ?> DHS
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>