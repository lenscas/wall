<?php
	

	//laat alle posts zien
	function showWall($tpl){
		global $pictures;
		$tpl->newBlock("table");
		$tpl->assign("ID",$_SESSION['id']);
		open();
		$results=getAllPosts();
	
		foreach($results as $row)
		{
			
			//haalt alle html tags weg
			foreach ($row as $key => $value){
				$row[$key]=removeeviltags($value);
			}
			open();
			$likes= getAmountLikes($row['postId'],"post");
			//haalt avatar op van gravatr
			$grav_url=getPicture($row['email']);
			//assignd alle benodigde waardes
			$tpl->newBlock("row");
    		$tpl->assign("LINK",$grav_url);
    		$tpl->assign("ID",$row['gebruikerId']);
			$tpl->assign("POSTID",$row['postId']);
	    	$tpl->assign("CONTENT",$row['content']);
	    	$tpl->assign("DATE", date("M d Y H:i:s",$row['datum']));
	    	$tpl->assign("USER", $row['voornaam']." ".$row['achternaam']);
			$tpl->assign("LIKES",$likes);
	    
			if($row['gebruikerId']==$_SESSION['id']or$_SESSION['group']==2){
	    		$tpl->newBlock("edit");
	    		$tpl->assign("ID",$row['postId']);
	    	}
	    	//haalt alle comments op uit de database voor deze post
			open();
			$comments=getComments('post',$row['postId']);

	    	//alle comments laden onder een post
	    	if(gettype($comments)!='boolean'){
				foreach ($comments as $key) {
					open();
					$likes= getAmountLikes($key['commentId'],"comment");
					$saneText=  removeeviltags($key['content']);
					$grav_url=getPicture($key['email']);
					$tpl->newBlock("comment");
					$tpl->assign("LINK",$grav_url);
					$tpl->assign("POSTID",$key['id']);
					$tpl->assign("CONTENT",$saneText);
					$tpl->assign("DATE", date("M d Y H:i:s",$key['datum']));
					$tpl->assign("USER", $key['voornaam']." ".$key['achternaam']);
					$tpl->assign("COMMENTID",$key['commentId']);
					$tpl->assign("LIKES",$likes);
					//bepaalt of de user mag editten/deleten
					if($row['gebruikerId']==$_SESSION['id']or$_SESSION['group']==2){
						$tpl->newBlock("editComment");
						$tpl->assign("ID",$key['postId']);
					}
					//laad de comments op comments		
					open();
					$comment2=getComments('comment',$key['commentId']);
					//alle comments laden onder een comment
					if(gettype($comment2)!='boolean'){
						foreach ($comment2 as $key) {
							open();
							$likes2= getAmountLikes($key['commentId'],"comment");
							$saneText=  removeeviltags($key['content']);
							$grav_url=getPicture($key['email']);
							$tpl->newBlock("comment2");
							$tpl->assign("LINK",$grav_url);
							$tpl->assign("POSTID",$key['id']);
							$tpl->assign("CONTENT",$saneText);
							$tpl->assign("DATE", date("M d Y H:i:s",$key['datum']));
							$tpl->assign("USER", $key['voornaam']." ".$key['achternaam']);
							$tpl->assign("LIKES",$likes2);
							if($row['gebruikerId']==$_SESSION['id']or$_SESSION['group']==2){
								$tpl->newBlock("editComment2");
								$tpl->assign("ID",$key['commentId']);
							}
						}
					}		
				}
			}
			$comments=null;
		}
    	$tpl->printToScreen();
	}
	function postCreate($postData){
		if(!isset($_SESSION['id'])){
			header("location:index.php");
		}
		open();
		$saneText= removeeviltags($postData['post']);
		//$saneText= $postData['post'];
		newPost($saneText,$_SESSION['id']);
		header("location:index.php");
	}
	function editPostForm($tpl,$id){
		open();
		$maker=getMakeroffPost($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			header('location:index.php');
		} else{
			$tpl->newBlock("editPost");
			open();
			$result=getPostContent($id);
			$saneText=removeEviltags($result['content']);
			$tpl->assign("CONTENT",$saneText);
			$tpl->assign("ID",$id);
			$tpl->printToScreen();
		}

	}
	function editPost($postData,$id){
		open();
		$maker=getMakeroffPost($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			header('location:index.php');
		} else{
			$data=removeEviltagArray($postData);
			$id=removeeviltags($id);
			open();
			changePost($id,$data['post']);
		}
	}
	function deletePost($id){
		open();
		$maker=getMakeroffPost($id);
		if($maker['gebruiker_id']!=$_SESSION['id'] and $_SESSION['group']!=2){
			header('location:index.php');
		} else{
			open();
			shutPostOff($id);
		}	
		header("location:index.php");
	}