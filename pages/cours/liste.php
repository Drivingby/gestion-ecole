<?php
require_once '../../config/database.php';
require_once '../../functions/cours_functions.php';

$cours = getAllCours();
$pageTitle = "Liste des cours";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des cours</h1>
        <a href="ajouter.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un cours
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Intitulé</th>
                            <th>Professeur</th>
                            <th>Durée (h)</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cours as $c) { ?>
                            <tr>
                                <td><?= htmlspecialchars($c['code']); ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($c['intitule']); ?></td>
                                <td>
                                    <?php if ($c['professeur_id']) { ?>
                                        <?= htmlspecialchars($c['prof_nom'] . ' ' . $c['prof_prenom']); ?>
                                    <?php } else { ?>
                                        <span class="text-muted">Non assigné</span>
                                    <?php } ?>
                                </td>
                                <td><?= htmlspecialchars($c['dureeHeures']); ?> h</td>
                                <td><?= htmlspecialchars($c['prix']); ?> DHS</td>
                                <td>
                                    <a href="details.php?id=<?= $c['id']; ?>" class="btn btn-sm btn-info text-white"
                                        title="Voir détails"><i class="bi bi-eye"></i> Détails</a>
                                    <a href="modifier.php?id=<?= $c['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="supprimer.php?id=<?= $c['id']; ?>" class="btn btn-sm btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>