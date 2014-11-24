<?php
	

	// laat login form zien
	function loginForm($tpl){
		
		$tpl->newBlock("login");
		$tpl->printToScreen();
	}
	function usersCheck($userData){		
		open();
		//echo $_POST['username'];
		$data=checkUser($userData['username'],$userData['password']);
		echo gettype($data);
		print_r($data);
		if($data){
			$_SESSION['id']=$data['id'];
			$_SESSION['group']=$data['groep_id'];
		}
		header("location:index.php");
	}
	function usersLogout(){	
		session_start();
		$_SESSION['id']=null;
		header("location:index.php");
	}
	//show form where users can register
	function usersNew($tpl){
		$tpl->newBlock("userCreate");
		setTimeSelecters($tpl);
		$tpl->printToScreen();
	}
	// create new account(person+user)
	function usersCreateAccount($userData){
		open();
		foreach ($userData as $key => $value){
			$userData[$key]=removeeviltags($value);
		}
		$birthdate=null;
		if($profileData['birthdayDay']!=0 and$profileData['birthdayMonth']!=0 and $profileData['birthdayYear'] !=0 ){
			$birthdate= mktime(0,0,0,$profileData['birthdayMonth'],$profileData['birthdayDay'],$profileData['birthdayYear']);
		}
		$personId=newPerson( $userData['firstName'], $userData['lastName'], $birthdate, $userData['address'], $userData['postalcode'], $userData['residence'], $userData['telephone'], $userData['mobiel']);
		open();
		newUser($userData["mail"], $userData["password"], 1,$personId);
	}