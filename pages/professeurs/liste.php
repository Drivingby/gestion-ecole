<?php
require_once '../../config/database.php';
require_once '../../functions/professeur_functions.php';

$professeurs = getAllProfesseurs();
$pageTitle = "Liste des professeurs";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des professeurs</h1>
        <a href="ajouter.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un professeur
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Spécialité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($professeurs as $prof) { ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($prof['matricule']); ?>
                                </td>
                                <td class="fw-bold">
                                    <?= htmlspecialchars($prof['nom']); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($prof['prenom']); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($prof['email']); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($prof['telephone']); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($prof['specialite']); ?>
                                </td>
                                <td>
                                    <a href="details.php?id=<?= $prof['id']; ?>" class="btn btn-sm btn-info text-white"
                                        title="Voir détails"><i class="bi bi-eye"></i> Détails</a>
                                    <a href="modifier.php?id=<?= $prof['id']; ?>"
                                        class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="supprimer.php?id=<?= $prof['id']; ?>"
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