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
	function usersNew($tpl,$oldValues=null){
		$tpl->newBlock("userCreate");
		$tpl->assign("MAIL",$oldValues['mail']);
		$tpl->assign("NAAM",$oldValues['firstName']);
		$tpl->assign("ACHTERNAAM", $oldValues['lastName']);
		$tpl->assign("ADRES",$oldValues['address']);
		setTimeSelecters($tpl);
		$tpl->assign("MOBIEL", $oldValues['mobiel']);
		$tpl->assign("TELEFOON", $oldValues['telephone']);
		$tpl->assign("POSTCODE", $oldValues['postalcode']);
		$tpl->assign("WOONPLAATS",$oldValues['residence']);
		setTimeSelecters($tpl);
		$tpl->printToScreen();
	}
	// create new account(person+user)
	function usersCreateAccount($userData){
		open();
		foreach ($userData as $key => $value){
			$userData[$key]=removeeviltags($value);
		}
		;
		if($userData['firstName']!=null and $userData['lastName']!=null and $userData["mail"]!=null and $userData["password"]!=null){
			$birthdate=null;
			if($userData['birthdayDay']!=0 and$userData['birthdayMonth']!=0 and $userData['birthdayYear'] !=0 ){
				$birthdate= mktime(0,0,0,$profileData['birthdayMonth'],$profileData['birthdayDay'],$profileData['birthdayYear']);
			}
			$personId=newPerson( $userData['firstName'], $userData['lastName'], $birthdate, $userData['address'], $userData['postalcode'], $userData['residence'], $userData['telephone'], $userData['mobiel']);
			open();
			newUser($userData["mail"], $userData["password"], 1,$personId);
			header("location:index.php");
		}else{
			$tpl = new TemplatePower("./users/userTemplate.tpl");
			$tpl->prepare();
			usersnew($tpl,$userData);
		}
	}