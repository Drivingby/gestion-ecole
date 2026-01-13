<?php
require_once '../../config/database.php';
require_once '../../functions/cours_functions.php';
require_once '../../functions/professeur_functions.php';
require_once '../../functions/stats_functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: liste.php');
    exit;
}

$cours = getCoursById($id);
if (!$cours) {
    header('Location: liste.php');
    exit;
}

$professeur = null;
if ($cours['professeur_id']) {
    $professeur = getProfesseurById($cours['professeur_id']);
}

$students = getCoursStudents($id);
$studentCount = getCoursStudentCount($id);

$pageTitle = "Détails du cours";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails du cours</h1>
        <a href="liste.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <!-- Course Info -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-book me-2"></i>Informations du Cours</h5>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">
                        <?= htmlspecialchars($cours['intitule']) ?>
                    </h3>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Code:</strong>
                            <span class="badge bg-secondary">
                                <?= htmlspecialchars($cours['code']) ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <strong>Description:</strong>
                            <p class="text-muted mt-2 small mb-0">
                                <?= nl2br(htmlspecialchars($cours['description'] ?: 'Aucune description disponible.')) ?>
                            </p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Durée:</strong>
                            <span>
                                <?= htmlspecialchars($cours['dureeHeures']) ?> Heures
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Prix:</strong>
                            <span class="fw-bold text-success">
                                <?= number_format($cours['prix'], 2) ?> DHS
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Professeur:</strong>
                            <?php if ($professeur) { ?>
                                <a href="../professeurs/details.php?id=<?= $professeur['id'] ?>"
                                    class="text-decoration-none">
                                    <i class="bi bi-person-fill"></i>
                                    <?= htmlspecialchars($professeur['nom'] . ' ' . $professeur['prenom']) ?>
                                </a>
                            <?php } else { ?>
                                <span class="text-muted fst-italic">Non assigné</span>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Enrolled Students -->
        <div class="col-md-7 mb-4">
            <div class="card border-0 shadow-sm mb-4 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Étudiants Inscrits</h6>
                            <h2 class="my-2 display-6 fw-bold">
                                <?= $studentCount ?>
                            </h2>
                            <small>Nombre total d'inscriptions</small>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary"><i class="bi bi-people-fill me-2"></i>Liste des Étudiants</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>CNE</th>
                                <th>Nom Complet</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($students)) { ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="bi bi-person-x fs-4 d-block mb-2"></i>
                                        Aucun étudiant inscrit à ce cours.
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($students as $s) { ?>
                                    <tr>
                                        <td><span class="small text-muted">
                                                <?= htmlspecialchars($s['cne']) ?>
                                            </span></td>
                                        <td class="fw-bold">
                                            <?= htmlspecialchars($s['nom'] . ' ' . $s['prenom']) ?>
                                        </td>
                                        <td class="small">
                                            <?= htmlspecialchars($s['email']) ?>
                                        </td>
                                        <td>
                                            <?php
                                            $badgeClass = 'bg-secondary';
                                            if ($s['statut'] === 'INSCRIT')
                                                $badgeClass = 'bg-primary';
                                            if ($s['statut'] === 'TERMINE')
                                                $badgeClass = 'bg-success';
                                            if ($s['statut'] === 'ANNULE')
                                                $badgeClass = 'bg-danger';
                                            ?>
                                            <span class="badge <?= $badgeClass ?>">
                                                <?= htmlspecialchars($s['statut'] ?? 'N/A') ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="../etudiants/details.php?id=<?= $s['id'] ?>"
                                                class="btn btn-sm btn-outline-info" title="Voir détails">
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