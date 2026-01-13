<?php
// Determine path prefix if not set
if (!isset($path_prefix)) {
    $path_prefix = "../../"; // Default for pages in sub-subfolders
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="<?= $path_prefix ?>index.php">
            <i class="bi bi-mortarboard-fill"></i> GestionÉcole
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path_prefix ?>index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path_prefix ?>pages/etudiants/liste.php">Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path_prefix ?>pages/professeurs/liste.php">Professeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path_prefix ?>pages/cours/liste.php">Cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path_prefix ?>pages/inscriptions/liste.php">Inscriptions</a>
                </li>
            </ul>
        </div>
    </div>
</nav>