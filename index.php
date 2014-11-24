<?php 
	error_reporting(E_ALL ^ E_DEPRECATED );
	session_start();
	include("template_power/class.TemplatePower.inc.php");
	include("database.php");
	require("users/users.php");
	require("posts/post.php");
	require("profiles/profile.php");
	require("other/makeSane.php");
	require('comments/comment.php');
	require("other/gravatar.php");
	require("other/timeStuff.php");
	require("other/like.php");

	$actie=null;
	if(isset($_GET['actie'])){
		$actie=$_GET['actie'];
	}
	elseif(!isset($_SESSION['id'])){
		$actie="login";
	}
	switch($actie){
		case "delete" :
			if(isset($_GET['id'])){
				deletePost($_GET['id']);
			}else{header("location:index.php");}
			break;
		case "profile":
			$tpl = new TemplatePower("./profiles/profileTemplate.tpl");
			$tpl->prepare();
			profileShow($tpl,$_GET['id']);
			break;
		case "editProfile":
				$tpl = new TemplatePower("./profiles/profileTemplate.tpl");
				$tpl->prepare();
				editProfile($tpl,$_GET['id']);
			break;
		case "userEdit":
				changeProfile($_POST,$_GET['id']);
			break;
		case "register":
			if(!isset($_POST['submit'])){
				$tpl = new TemplatePower("./users/userTemplate.tpl");
				$tpl->prepare();
				usersNew($tpl);
			} else{
				usersCreateAccount($_POST);
				header("location:index.php");
			}
			break;
		case "logout":
			usersLogout();
			break;
		case 'login':
			if(!isset($_POST['submit'])){
				$tpl = new TemplatePower("./users/userTemplate.tpl");
				$tpl->prepare();
				loginForm($tpl);
			}else{
				usersCheck($_POST);
			}
			break;
		case 'newPost':
    		postCreate($_POST);
    		break;
 		case 'editPost':
 			if(isset($_POST['submit'])){
 				editPost($_POST,$_GET['id']);
 			}else{
 				$tpl = new TemplatePower("./posts/postTemplate.tpl");
				$tpl->prepare();
 				editPostForm($tpl,$_GET['id']);
 			}
    		break;
		case 'editComment':
 			if(isset($_POST['submit'])){
 				editComment($_POST,$_GET['id']);
 			}else{
 				$tpl = new TemplatePower("./posts/postTemplate.tpl");
				$tpl->prepare();
 				editCommentForm($tpl,$_GET['id']);
 			}
    		break;
		case 'newComment':
			commentCreate($_POST,$_GET['id']);
			break;
		case "deleteComment" :
			if(isset($_GET['id'])){
				deleteComment($_GET['id']);
			}else{header("location:index.php");}
			break;
		case 'likeAdd':
			addLike($_GET['id'],$_GET['on']);
		break;
		default:
			$tpl = new TemplatePower("./posts/postTemplate.tpl");
			$tpl->prepare();
			showWall($tpl);
	}
?>