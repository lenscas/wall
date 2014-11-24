<?php
	include_once "config.php";
	function open(){
		global $db;
			global $dbname;
			global $host;
			global $password;
		global $username;
		 $db = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	}
	function close(){
		global $db;
		$db=null;

	}
	function newUser ($mail,$pasword,$groep_id,$persoon_id){
		global $db;
		$sql = " INSERT INTO gebruiker (email, pasword, groep_id,persoon_id) VALUES (:email,:pasword,:groep_id,:persoon_id)";
    	$stmt = $db->prepare($sql);
  		$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
   		$stmt->bindParam(':pasword', $pasword, PDO::PARAM_STR);
   		$stmt->bindParam(':groep_id', $groep_id, PDO::PARAM_INT);
   		$stmt->bindParam(':persoon_id', $persoon_id, PDO::PARAM_INT);
  		$stmt->execute(); 
  		close();
  	}
		function newPerson ($voornaam,$achternaam,$geboorte,$adres,$postcode,$woonplaats,$telefoon,$mobiel){
		global $db;
		$sql = " INSERT INTO persoon(voornaam, achternaam,geboortedatum, adres,postcode,woonplaats,telefoon,mobiel) VALUES (:voornaam,:achternaam,:geboortedatum,:adres,:postcode,:woonplaats,:telefoon,:mobiel)";
    
    	$stmt = $db->prepare($sql);
  		$stmt->bindParam(':voornaam',$voornaam, PDO::PARAM_STR);
   		$stmt->bindParam(':achternaam', $achternaam, PDO::PARAM_STR);
   		$stmt->bindParam(':geboortedatum', $geboorte, PDO::PARAM_STR);
   		$stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
   		$stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
   		$stmt->bindParam(':woonplaats', $woonplaats, PDO::PARAM_STR);
   		$stmt->bindParam(':telefoon', $telefoon, PDO::PARAM_STR);
   		$stmt->bindParam(':mobiel', $mobiel, PDO::PARAM_STR);
  		$stmt->execute(); 
  		$lastId = $db->lastInsertId();
		close();
		return $lastId;
	}
	function getPostContent($id){
		global $db;
		$sql="select content from post where id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		close();
		return $result;		
	}
		function getPostsOfUser($userId){
		global $db;
		$sql ="SELECT post.content,post.id as postId,post.datum,post.gebruiker_id, persoon.*, gebruiker.id as gebruikerId,gebruiker.email, gebruiker.persoon_id,gebruiker.pasword FROM post LEFT JOIN gebruiker on post.gebruiker_id=gebruiker.id LEFT JOIN persoon on gebruiker.persoon_id=persoon.id where post.gebruiker_id=$userId and status =1 ORDER BY post.datum desc";
		$results = $db->query($sql);
		return $results;
		close();

	}
	function changePost($id,$content){
		global $db;
		$sql="UPDATE `post` SET content=:content WHERE id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':content', $content, PDO::PARAM_STR);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
	}
	function getMakeroffPost($id){
		global $db;
		$sql="select id,gebruiker_id from post where id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		$result=$stmt->fetch(PDO::FETCH_ASSOC);		
		close();
		return $result;		
	}
	function getMakeroffComment($id){
		global $db;
		$sql="select id,gebruiker_id from comment where id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		$result=$stmt->fetch(PDO::FETCH_ASSOC);		
		close();
		return $result;		
	}
	function shutPostOff($id){
		global $db;
		$sql="UPDATE `post` SET status=0 WHERE id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		close();
	}
	function getAllPosts (){
		global $db;
		$sql ="SELECT post.content,post.id as postId,post.datum,post.gebruiker_id, persoon.*, gebruiker.id as gebruikerId,gebruiker.email, gebruiker.persoon_id FROM post INNER JOIN gebruiker on post.gebruiker_id=gebruiker.id INNER JOIN persoon on gebruiker.persoon_id=persoon.id where status=1 ORDER BY post.datum desc";
		$results = $db->query($sql);
		return $results;
		close();
	}
		function newPost ($post,$user){
		global $db;
		$sql = " INSERT INTO post(content,datum,gebruiker_id) VALUES (:content,:datum,:gebruiker_id)";
    	$time=time();
    	$stmt = $db->prepare($sql);
  		$stmt->bindParam(':content',$post, PDO::PARAM_STR);
   		$stmt->bindParam(':datum', $time, PDO::PARAM_INT);
   		$stmt->bindParam(':gebruiker_id',$user, PDO::PARAM_INT);
  		$stmt->execute(); 
		close();
	}
	function insertComment($onWhat,$onId,$content,$user){
		if($onWhat=="post"){
			$postId=$onId;
			$parentId=null;
		}
		elseif($onWhat=="comment"){
			$parentId=$onId;
			$postId=null;
		}
		global $db;
		$sql = "INSERT INTO comment(content,datum,gebruiker_id,parent_id,post_id) VALUES (:content,:datum,:gebruiker_id,:parent_id,:post_id)";
    	$time=time();
    	$stmt = $db->prepare($sql);
  		$stmt->bindParam(':content',$content, PDO::PARAM_STR);
   		$stmt->bindParam(':datum', $time, PDO::PARAM_INT);
   		$stmt->bindParam(':gebruiker_id',$user, PDO::PARAM_INT);
		$stmt->bindParam(':parent_id',$parentId, PDO::PARAM_INT);
		$stmt->bindParam(':post_id',$postId, PDO::PARAM_INT);
  		$stmt->execute(); 
		close();
	}
	function shutCommentOff($id){
		global $db;
		$sql="UPDATE `comment` SET status=0 WHERE id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		close();
	}
	function getCommentContent($id){
		global $db;
		$sql="select content from comment where id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		close();
		return $result;		
	}
	function changeComment($id,$content){
		global $db;
		$sql="UPDATE `comment` SET content=:content WHERE id=:id";
		$stmt = $db->prepare($sql);
   		$stmt->bindParam(':content', $content, PDO::PARAM_STR);
   		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
   		$stmt->execute(); 
	}
		function getComments($forWhat,$id){
		if($forWhat=='post'){
			$on='post_id';
		}else{
			$on='parent_id';
		}
		global $db;
		$testSql="SELECT comment.content,comment.id as commentId,comment.datum,comment.gebruiker_id,comment.parent_id as parentId,comment.post_id as postId, persoon.*, gebruiker.id as gebruikerId,gebruiker.email, gebruiker.persoon_id FROM comment INNER JOIN gebruiker on comment.gebruiker_id=gebruiker.id INNER JOIN persoon on gebruiker.persoon_id=persoon.id where comment.$on=$id and comment.status=1 ORDER BY comment.datum desc";
		$results = $db->query($testSql);
		return $results;
		close();
	}
	function checkUser($mail,$password){
		global $db;
		$sql ="SELECT * FROM gebruiker WHERE pasword=:password AND email=:mail";
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':password',$password, PDO::PARAM_STR);
   		$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
		$stmt->execute(); 
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
		close();
	}
	function getPersondata($userId){
		global $db;
		$sql ="SELECT * FROM gebruiker  INNER JOIN persoon ON persoon.id=gebruiker.persoon_id where gebruiker.id=:id";
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':id',$userId, PDO::PARAM_INT);
		$stmt->execute(); 
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
		close();
	}
	function getPersonId($userId){
		global $db;
		$sql="select persoon_id from gebruiker where id= :id";
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':id',$userId, PDO::PARAM_INT);
  		$stmt->execute();
  		$id=$stmt->fetch(PDO::FETCH_ASSOC);
		close();
		return $id;
	}
	function editUser($userId,$mail,$password,$groep_id){
		global $db;
		$sql="UPDATE `gebruiker` SET `email`=:email,`pasword`=:pasword,`groep_id`=:groep_id WHERE id=:id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
   		$stmt->bindParam(':pasword', $password, PDO::PARAM_STR);
   		$stmt->bindParam(':groep_id', $groep_id, PDO::PARAM_INT);
   		$stmt->bindParam(':id', $userId, PDO::PARAM_INT);
   		$stmt->execute(); 
		close();
	}
	function editPerson ($voornaam,$achternaam,$geboorte,$adres,$postcode,$woonplaats,$telefoon,$mobiel,$person_id){
		global $db;
		$sql="UPDATE `persoon` SET `voornaam`=:voornaam,`achternaam`=:achternaam,`geboortedatum`=:geboortedatum,`adres`=:adres,`postcode`=:postcode,`woonplaats`=:woonplaats,`telefoon`=:telefoon,`mobiel`=:mobiel WHERE id=:id";
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':voornaam',$voornaam, PDO::PARAM_STR);
   		$stmt->bindParam(':achternaam', $achternaam, PDO::PARAM_STR);
   		$stmt->bindParam(':geboortedatum', $geboorte, PDO::PARAM_INT);
   		$stmt->bindParam(':id', $person_id, PDO::PARAM_INT);
   		$stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
   		$stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
   		$stmt->bindParam(':woonplaats', $woonplaats, PDO::PARAM_STR);
   		$stmt->bindParam(':telefoon', $telefoon, PDO::PARAM_STR);
   		$stmt->bindParam(':mobiel', $mobiel, PDO::PARAM_STR);
  		$stmt->execute(); 
		close();
	}
	function insertLike($maker,$id,$onWhat){
		global $db;
		$sql="INSERT INTO `like`(`gerbuiker_id`, `post_id`, `type`, `datum`) VALUES (:gebruiker_id,:post_id,:type,:datum)";
		$time=time();
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':gebruiker_id',$maker, PDO::PARAM_INT);
		$stmt->bindParam(':post_id',$id, PDO::PARAM_INT);
		$stmt->bindParam(':type',$onWhat, PDO::PARAM_STR);
		$stmt->bindParam(':datum',$time, PDO::PARAM_INT);
		$stmt->execute(); 
		close();
	}
	function getAmountLikes($id,$onWhat){
		global $db;
		$sql="SELECT count(*) FROM `like` WHERE post_id=:id and type=:type";
		$stmt = $db->prepare($sql);
  		$stmt->bindParam(':id',$id, PDO::PARAM_INT);
		$stmt->bindParam(':type',$onWhat, PDO::PARAM_STR);
		$stmt->execute(); 
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		close();
		return $result['count(*)'];
	}
?>