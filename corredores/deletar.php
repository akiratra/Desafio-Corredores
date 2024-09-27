<?php
require 'db.php';
session_start();

if (!isset($_SESSION['corredor_id'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: corredores.php');
    exit();
}

$id = $_GET['id'];

// Deletar os logs relacionados ao corredor
$stmt_log = $pdo->prepare("DELETE FROM log WHERE usuario_id = ?");
$stmt_log->execute([$id]);

// Deletar o corredor
$stmt = $pdo->prepare("DELETE FROM corredores WHERE id = ?");
$stmt->execute([$id]);

header('Location: corredores.php');
exit();
?>
