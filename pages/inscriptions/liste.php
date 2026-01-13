<?php
require_once '../../config/database.php';
require_once '../../functions/inscription_functions.php';

$inscriptions = getAllInscriptions();
$pageTitle = "Liste des inscriptions";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des inscriptions</h1>
        <a href="ajouter.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Inscrire un étudiant
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Étudiant</th>
                            <th>Cours</th>
                            <th>Date Inscription</th>
                            <th>Statut</th>
                            <th>Note</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscriptions as $insc) { ?>
                            <tr>
                                <td>
                                    <div class="fw-bold">
                                        <?= htmlspecialchars($insc['etudiant_nom'] . ' ' . $insc['etudiant_prenom']); ?>
                                    </div>
                                    <small class="text-muted">
                                        <?= htmlspecialchars($insc['cne']); ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold">
                                        <?= htmlspecialchars($insc['cours_intitule']); ?>
                                    </div>
                                    <small class="text-muted">
                                        <?= htmlspecialchars($insc['cours_code']); ?>
                                    </small>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($insc['dateInscription'])); ?>
                                </td>
                                <td>
                                    <?php
                                    $badgeClass = match ($insc['statut']) {
                                        'INSCRIT' => 'bg-info',
                                        'TERMINE' => 'bg-success',
                                        'ANNULE' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= $insc['statut'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $insc['note'] !== null ? $insc['note'] : '-' ?>
                                </td>
                                <td>
                                    <a href="modifier.php?id=<?= $insc['id']; ?>"
                                        class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="supprimer.php?id=<?= $insc['id']; ?>"
                                        class="btn btn-sm btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>