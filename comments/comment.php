<?php 
	function commentCreate($postData,$id){
		if(!isset($_SESSION['id'])){
			header("location:index.php");
		}
		open();
		$saneText= removeeviltags($postData['comment']);
		//$saneText= $postData['post'];
		insertComment($postData['on'],$id,$saneText,$_SESSION['id']);
		header("location:index.php");
	}
	function editCommentForm($tpl,$id){
		open();
		$maker=getMakeroffComment($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			header('location:index.php');
		} else{
			echo "test";
			
			$tpl->newBlock("editCommentForm");
			open();
			$result=getCommentContent($id);
			$saneText=removeEviltags($result['content']);
			$tpl->assign("CONTENT",$saneText);
			$tpl->assign("ID",$id);
			$tpl->printToScreen();
		}

	}
	function editComment($postData,$id){
		open();
		$maker=getMakeroffComment($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			//header('location:index.php');
		} else{
			$data=removeEviltagArray($postData);
			$id=removeeviltags($id);
			open();
			changeComment($id,$data['post']);
		}
	}
	function deleteComment($id){
		open();
		$maker=getMakeroffComment($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			header('location:index.php');
		} else{
			open();
			shutCommentOff($id);
		}	
		header("location:index.php");
	}
?>