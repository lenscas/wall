	<?php
		function profileShow($tpl,$id){
			if($_SESSION['id']==$id or $_SESSION['group']==2){
				$mayEdit=true;
			}else{
				$mayEdit=false;
			}
			if(!isset($_GET['id'])){
				header("location:index.php");
			}
			elseif($_GET['id']==null){
				header("location:index.php");
			}
			else{
				$tpl->newBlock("profile");
				open();			
		
				$personData=getPersondata($_GET['id']);
				//kijkt of er een geboorte datum is
				$needDate=true;
				if(gettype($personData['geboortedatum'])=="NULL"){$needDate=false;}
				//haalt alle evil tags uit alle waardes in de array
				foreach ($personData as $key => $value){
					$personData[$key]=removeeviltags($value);
				}
				//assignd alle waardes voor tpl
				$tpl->assign("NAAM",$personData['voornaam']);
				$tpl->assign("ACHTERNAAM", $personData['achternaam']);
				$tpl->assign("ADRES",$personData['adres']);
				//zorgt dat het alleen een datum doet als het er is
				if($needDate){
					$tpl->assign("GEBOORTEDATUM", date("M d Y H:i:s",$personData['geboortedatum']));
				}
				$tpl->assign("MOBIEL", $personData['mobiel']);
				$tpl->assign("TELEFOON", $personData['telefoon']);
				$tpl->assign("WOONPLAATS",$personData['woonplaats']);
				if($mayEdit){
					$tpl->newBlock("edit");
					$tpl->assign("ID", $_GET['id']);
				}
				$results=getPostsOfUser($_GET['id']);
				foreach($results as $row)
				{
					//haalt alle html tags weg
					foreach ($row as $key => $value){
						$row[$key]=removeeviltags($value);
					}
					$grav_url=getPicture($row['email']);
					//assignd alle benodigde waardes
					$tpl->newBlock("row");
					$tpl->assign("PASSWORD",$row['pasword']);
					$tpl->assign("LINK",$grav_url);
					$tpl->assign("ID",$row['gebruikerId']);
					$tpl->assign("POSTID",$row['postId']);
					$tpl->assign("CONTENT",$row['content']);
					$tpl->assign("DATE", date("M d Y H:i:s",$row['datum']));
					$tpl->assign("USER", $row['voornaam']." ".$row['achternaam']);
				}
				$tpl->printToScreen();
			}
		}
		function changeProfile($profileData,$id){
			$birthdate=null;
			if($profileData['birthdayDay']!=0 and $profileData['birthdayMonth']!=0 and $profileData['birthdayYear'] !=0 ){
				$birthdate= mktime(0,0,0,$profileData['birthdayMonth'],$profileData['birthdayDay'],$profileData['birthdayYear']);
			}
			//remove all bad tags and alike
			foreach ($profileData as $key => $value){
				$profileData[$key]=removeeviltags($value);
			}
			open();
			editUser($id,$profileData["mail"], $profileData["password"], 1);
			open();
			$personid=getPersonId($_SESSION['id']);
			open();
			editPerson($profileData['firstName'], $profileData['lastName'], $birthdate, $profileData['address'], $profileData['postalcode'], $profileData['residence'], $profileData['telephone'], $profileData['mobiel'],$personid['persoon_id']);
			header("location:index.php");
		}
		function editProfile($tpl,$id){
			open();
			$tpl->newBlock("userEdit");
			open();
			$personData=getPersondata($id);
			if($personData['geboortedatum']==0){
				$date=null;
			}else{
				$date=date("M d Y H:i:s",$personData['geboortedatum']);
			}
			$tpl->assign("ID",$id);
			$tpl->assign("MAIL",$personData['email']);
			$tpl->assign("NAAM",$personData['voornaam']);
			$tpl->assign("ACHTERNAAM", $personData['achternaam']);
			$tpl->assign("ADRES",$personData['adres']);
			setTimeSelecters($tpl);
			$tpl->assign("MOBIEL", $personData['mobiel']);
			$tpl->assign("TELEFOON", $personData['telefoon']);
			$tpl->assign("POSTCODE", $personData['postcode']);
			$tpl->assign("WOONPLAATS",$personData['woonplaats']);
			$tpl->printToScreen();
		}