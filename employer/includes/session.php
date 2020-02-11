<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['employer']) || trim($_SESSION['employer']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM employer WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['employer']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>