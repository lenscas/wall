<?php
function checkNewUserData($userData){
	$result=array("valid"=>true);
	if($userData['firstName']!=null and $userData['lastName']!=null and $userData["mail"]!=null and $userData["password"]!=null){
		open();
		$userExist=checkValidMail($userData["mail"]);
		if(gettype($userExist)=="array"){
			$reslut['valid']=false;
			$result['message']="email is already in use";
		}
	}else{
		$result['valid']=false;
		$result['message']="not everything has a value";
	}
	return $result;
}

?>