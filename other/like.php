<?php 
	function addLike($id,$onWhat){	
		open();
		if($onWhat=="post"){
			$maker=getMakeroffPost($id);
		} elseif($onWhat=="comment"){
			$maker=getMakeroffComment($id);
		}else{ 
			header("location:index.php");
		}
		echo $_SESSION['id'];
		if($maker['gebruiker_id']!=$_SESSION['id']){
			open();

			insertLike($maker['gebruiker_id'],$id,$onWhat);
		}
		header("location:index.php");
	}
?>