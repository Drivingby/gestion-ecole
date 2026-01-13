<?php
$pageTitle = "Accueil - Gestion École";
$path_prefix = "./";
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary">Bienvenue sur GestionÉcole</h1>
            <p class="lead text-muted">Plateforme de gestion complète pour votre établissement.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Card Étudiants -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 transition-hover">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="bi bi-people fs-2 text-primary"></i>
                    </div>
                    <h5 class="card-title">Étudiants</h5>
                    <p class="card-text small text-muted">Gestion des dossiers étudiants.</p>
                    <a href="pages/etudiants/liste.php" class="btn btn-sm btn-outline-primary stretched-link">Gérer</a>
                </div>
            </div>
        </div>

        <!-- Card Professeurs -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 transition-hover">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="bi bi-person-badge fs-2 text-warning"></i>
                    </div>
                    <h5 class="card-title">Professeurs</h5>
                    <p class="card-text small text-muted">Gestion du corps enseignant.</p>
                    <a href="pages/professeurs/liste.php"
                        class="btn btn-sm btn-outline-warning stretched-link">Gérer</a>
                </div>
            </div>
        </div>

        <!-- Card Cours -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 transition-hover">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="bi bi-book fs-2 text-success"></i>
                    </div>
                    <h5 class="card-title">Cours</h5>
                    <p class="card-text small text-muted">Gestion des formations et cours.</p>
                    <a href="pages/cours/liste.php" class="btn btn-sm btn-outline-success stretched-link">Gérer</a>
                </div>
            </div>
        </div>

        <!-- Card Inscriptions -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 transition-hover">
                <div class="card-body text-center p-4">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="bi bi-clipboard-check fs-2 text-info"></i>
                    </div>
                    <h5 class="card-title">Inscriptions</h5>
                    <p class="card-text small text-muted">Inscriptions et suivi des notes.</p>
                    <a href="pages/inscriptions/liste.php" class="btn btn-sm btn-outline-info stretched-link">Gérer</a>
                </div>
            </div>
        </div>
    </div>
</div>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">