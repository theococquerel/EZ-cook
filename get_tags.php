<?php
require_once __DIR__ . '/DataBase.php';

$pdo = DataBase::getConnection();

// récupérer tous les tags
$tags = DataBase::chargerTable($pdo, "tag");

// renvoyer en JSON
header('Content-Type: application/json');
echo json_encode($tags);