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

		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cellnumber = $_POST['cellnumber'];
        $address = $_POST['address'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM driver WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already exist';
			exit();
		}

	
		else{
			$password = $password;
			$filename = $_FILES['photo']['name'];
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO `driver` (`staffNumber`, `created_at`, `updated_at`, `firstname`, `lastname`, `email`,`cellnumber`,`password`, `one_time_pin`) VALUES (NULL, NOW(), NOW(), :firstname, :lastname, :email, :cellnumber, :password, :one_time_pin)");
				$stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email,'cellnumber'=>$cellnumber, 'password'=>$password, 'one_time_pin'=>$rand]);
				$_SESSION['success'] = 'Officer added successfully';

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

	header('location: officers.php');

?>