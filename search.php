<?php
require_once "DataBase.php";

header('Content-Type: application/json');

$pdo = DataBase::getConnection();

$q = $_GET['q'] ?? '';
$tags = $_GET['tags'] ?? '';
$tags = array_filter(explode(',', $tags));

// appel unique à la BDD
$result = DataBase::recherche($q, $tags, $pdo);

echo json_encode($result);