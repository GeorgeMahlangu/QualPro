<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){

		function generateRandomString($length = 6) {
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		$rand = generateRandomString();

		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$cellnumber = $_POST['cellnumber'];
        $address = $_POST['address'];
        $licenceCode = $_POST['licence-code'];
        $PrDP = $_POST['prdp'];
        $dateIssued = date('Y-m-d', strtotime($_POST['dateIssued']));
        $expiryDate = date('Y-m-d', strtotime($_POST['expiryDate']));
        $vehicleOwner = $_POST['owner'];
        $vehicleAddress = $_POST['vehicle-address'];
        $vehicleType = $_POST['type'];
        $vehicleModel = $_POST['model'];
        $licenceDisk = $_POST['licence-number'];
        $vehicleColour = $_POST['vehicle-color'];
        $chargeCode = $_POST['charge-code'];
        $chargeType = '';
        $penalty = '';




		
		$conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * FROM charge WHERE chargeCode=:code");
		$stmt->execute(['code'=>$chargeCode]);
		$row = $stmt->fetch();	

        $chargeType = $row['chargeType'];
        $penalty = $row['penelty'];

		$now = date('Y-m-d');
		try{
				$stmt = $conn->prepare("INSERT INTO `ticket` (`id`, `refference`, `firstname`, `lastname`, `address`, `licenceCode`, `PrDP`, `cellnumber`, `email`, `licenceDisk`, `vehicleType`, `model`, `vehicleColour`, `vehicleOwner`, `vehicleRegisteredAddress`, `chargeCode`, `chargeType`, `penalty`, `dateIssued`, `expiryDate`, `staffNumber`, `lastPaymentDate`, `created_at`) VALUES (:id, NULL, :firstname, :lastname, , :address, :licenceCode, :PrDP, :cellnumber, :email, :licenceDisk, :vehicleType, :model , :vehicleColour, :vehicleOwner, :vehicleRegisteredAddress, :chargeCode, :chargeType, :penalty, :dateIssued, :expiryDate, 'ADMIN', NOW() + INTERVAL 1 YEAR , NOW())");
				$stmt->execute(['id'=>$id, 'firstname'=>$firstname, 'lastname'=>$lastname, 'address'=>$address, 'licenceCode'=>$licenceCode, 'PrDP'=>$PrDP, 'cellnumber'=>$cellnumber ,'email'=>$email,'licenceDisk'=>$licenceDisk, 'vehicleType'=>$vehicleType, 'model'=>$vehicleModel, 'vehicleColour'=>$vehicleColour, 'vehicleOwner'=>$vehicleOwner, 'vehicleRegisteredAddress'=>$vehicleAddress, 'chargeCode'=>$chargeCode, 'chargeType'=>$chargeType, 'penalty'=>$penalty, 'dateIssued'=>$dateIssued, 'expiryDate'=>$expiryDate]);
				$_SESSION['success'] = 'Ticket added successfully';

		}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up officer form first';
	}

	header('location: tickets.php');

?>