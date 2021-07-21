<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		
		
		$id = $_POST['id'];
		$licenceCode = $_POST['licence-code'];
		$prdp = $_POST['prdp'];
		$issueDate = date('Y-m-d', strtotime($_POST['dateIssued']));
		$expiryDate = date('Y-m-d', strtotime($_POST['expiryDate']));
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM licence WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Licence for this driver already Exist';
			exit();
		}

	
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO `licence` (`id`, `licenceCode`, `PrDP`, `dateIssued`, `expiryDate`) VALUES (:id, :licenceCode, :PrDP, :dateIssued, :expiryDate)");
				$stmt->execute(['id'=>$id, 'licenceCode'=>$licenceCode, 'PrDP'=>$prdp,'dateIssued'=>$issueDate, 'expiryDate'=>$expiryDate]);
				$_SESSION['success'] = 'Licence added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up officer form first';
	}

	header('location: licence.php');

?>