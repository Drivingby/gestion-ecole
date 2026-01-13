<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'gestion-formation';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuration of options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // En production, il vaut mieux loguer l'erreur plutôt que de l'afficher
    die("Erreur de connexion : " . $e->getMessage());
}
?>