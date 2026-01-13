<?php
require_once '../../config/database.php';
require_once '../../functions/etudiant_functions.php';

$etudiants = getAllEtudiants();
$pageTitle = "Liste des étudiants";
$path_prefix = "../../";

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des étudiants</h1>
        <a href="ajouter.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un étudiant
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>CNE</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($etudiants as $etudiant) { ?>
                            <tr>
                                <td><?= htmlspecialchars($etudiant['cne']); ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($etudiant['nom']); ?></td>
                                <td><?= htmlspecialchars($etudiant['prenom']); ?></td>
                                <td><?= htmlspecialchars($etudiant['email']); ?></td>
                                <td><?= htmlspecialchars($etudiant['telephone']); ?></td>
                                <td><?= date('d/m/Y', strtotime($etudiant['dateInscription'])); ?></td>
                                <td>
                                    <a href="details.php?id=<?= $etudiant['id']; ?>" class="btn btn-sm btn-info text-white"
                                        title="Voir détails">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                    <a href="modifier.php?id=<?= $etudiant['id']; ?>" class="btn btn-sm btn-warning">
                                        Modifier
                                    </a>
                                    <a href="supprimer.php?id=<?= $etudiant['id']; ?>" class="btn btn-sm btn-danger">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>