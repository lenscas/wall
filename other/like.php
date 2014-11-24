<?php 
	function addLike($id,$onWhat){	
	echo "<pre>";
	echo $id;
	echo $onWhat;
		open();
		if($onWhat=="post"){
			$maker=getMakeroffPost($id);
		} elseif($onWhat=="comment"){
			echo"test";
			$maker=getMakeroffComment($id);
		}else{ 
		
			header("location:index.php");
		}
		if($maker!=$_SESSION['id']){
			echo "test2";
			open();
			print_r($maker);
			insertLike($maker['gebruiker_id'],$id,$onWhat);
		}
		header("location:index.php");
	}
?>