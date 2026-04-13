<?php
require 'config.php';

$id = $_GET['id'];

$pdo->prepare("DELETE FROM etudiants WHERE id=?")->execute([$id]);

header("Location: index.php");
?>