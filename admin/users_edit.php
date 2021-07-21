<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){

		$name = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";
		$addressValidation = "/^[A-Za-z0-9'\.\-\s\,]+$/";

		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email address';
			header('location: officers.php');
			exit();	
		}



		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: officers.php');
			exit();	
		}

		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: officers.php');
			exit();	
		}
		if(!empty($password))
		{
			if(strlen($password) < 8){
				$_SESSION['error'] = 'Password is too Short';
				header('location: officers.php');
				exit();	
			}
			else
			{
				$password = $password;
			}
		}
		else
		{
			$password = $user['password'];
		}


		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM officer WHERE staffNumber=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['password']){
			$password = $row['password'];
		}
		else{
			$password = $password;
		}

		try{
			$stmt = $conn->prepare("UPDATE officer SET email=:email, password=:password, firstname=:firstname, lastname=:lastname WHERE staffNumber=:id");
			$stmt->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'id'=>$id]);
			$_SESSION['success'] = 'Officer updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit officer form first';
	}

	header('location: officers.php');

?>