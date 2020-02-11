<?php

	include 'includes/session.php';

	if(isset($_POST['signup'])){

		$name = "/^[a-zA-Z ]+$/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";


		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $companyName = $_POST['companyName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
				

		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: signup_employer.php');
			exit();	
		}
		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: signup_employer.php');
			exit();	
		}
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email Please Enter correct Email';
			header('location: signup_employer.php');
			exit();	
		}
		if(!preg_match($name,$companyName)){
			$_SESSION['error'] = 'Invalid Company Name Format';
			header('location: signup_employer.php');
			exit();	
		}
		if(strlen($password) < 8){
			$_SESSION['error'] = 'Password is too Short';
			header('location: signup_employer.php');
			exit();	
		}

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup_employer.php');
			exit();	
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM employer WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: signup_employer.php');
				exit();	
			}
			else{
				$now = date('Y-m-d');
				
				try{
					$stmt = $conn->prepare("INSERT INTO employer (firstname, lastname, companyName, email, password, date_created) VALUES (:firstname, :lastname, :companyName, :email, :password, :now)");
					$stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'companyName'=>$companyName, 'email'=>$email, 'password'=>$password, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					$_SESSION['success'] = 'Account created. Proceed to Login';
					header('location: signup_employer.php');

					
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: signup_employer.php');
				}

				$pdo->close();

			}

		
        }
    }
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup_employer.php');
    }



?>