<?php

	include 'includes/session.php';

	if(isset($_POST['signup'])){

		$name = "/^[a-zA-Z- ]+$/";
		$name1 = "/^[a-zA-Z0-9-_]+$/";
		$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
		$number = "/^[0-9]+$/";

		$gender = $_POST['gender'];
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		$_SESSION['username'] = $username;

		
		

		if(!preg_match($name1,$username)){
			$_SESSION['error'] = 'Invalid Username Format';
			header('location: signup.php');
			exit();	
		}

		if(!preg_match($name,$firstname)){
			$_SESSION['error'] = 'Invalid First Name Format';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($name,$lastname)){
			$_SESSION['error'] = 'Invalid Last Name Format';
			header('location: signup.php');
			exit();	
		}
		if(!preg_match($emailValidation,$email)){
			$_SESSION['error'] = 'Invalid Email Please Enter correct Email';
			header('location: signup.php');
			exit();	
		}
		
		if(strlen($password) < 8){
			$_SESSION['error'] = 'Password must be atleast 8 characters';
			header('location: signup.php');
			exit();	
		}

		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
			exit();	
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM user WHERE username=:username");
			$stmt->execute(['username'=>$username]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Username already taken';
				header('location: signup.php');
				exit();	
			}
			else{
				$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM user WHERE email=:email");
				$stmt->execute(['email'=>$email]);
				$row = $stmt->fetch();
				if($row['numrows'] > 0){
					$_SESSION['error'] = 'Email already Used';
					header('location: signup.php');
					exit();	
				}
				$now = date('Y-m-d');
				
				try{
					$deactivated = "No";
					$stmt = $conn->prepare("INSERT INTO user (username, firstname, lastname, gender, email, password, date_created, account_deactivated) VALUES (:username, :firstname, :lastname, :gender, :email, :password, :now, :deactivated)");
					$stmt->execute(['username'=>$username, 'firstname'=>$firstname, 'lastname'=>$lastname, 'gender'=>$gender, 'email'=>$email, 'password'=>$password, 'now'=>$now, 'deactivated'=>$deactivated]);
					$userid = $conn->lastInsertId();

					$message = "
						<h2>Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Password: ".$_POST['password']."</p>
						<p>Please click the link below to proceed to the login page</p>
						<a href='http://localhost/Qualification comparison system/login.php>Login to your Account</a>
					";

					$_SESSION['success'] = 'Account created. Proceed to Login';
					header('location: signup.php');

					
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: signup.php');
				}

				$pdo->close();

			}

		
        }
    }
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: signup.php');
    }



?>