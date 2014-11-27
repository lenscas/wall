<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./posts/style.css">
		<title>{TITLE}</title>
		<meta charset="utp-8">
	</head>
	<body>
		<!-- START BLOCK : editPost -->
			<form method="POST" action="index.php?actie=editPost&id={ID}">
				<p>
					<label>content</label>
					<textarea name='post' id="post">{CONTENT}</textarea>
				</p>
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>
		<!-- END BLOCK : editPost -->
		<!-- START BLOCK : editCommentForm -->
			<form method="POST" action="index.php?actie=editComment&id={ID}">
				<p>
					<label>content</label>
					<textarea name='post' id="post">{CONTENT}</textarea>
				</p>
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>
		<!-- END BLOCK : editCommentForm -->
		<!-- START BLOCK : table -->
			<p><a href="index.php?actie=profile&id={ID}">your profile</a></p>
			<form method="POST" action="index.php?actie=newPost">
				<p>
					<label>content</label>
					<textarea name='post' id="post"></textarea>
				</p>
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>
			<a href="index.php?actie=logout">log-out</a>
			<table border="2px">
			<div>
			<!-- START BLOCK : row -->
				<div class="post">
					<div class="name">
						<img src="{LINK}">
						<p><a href="index.php?actie=profile&id={ID}">{USER}</a></p>
		    		</div>	
		    		<div class="content">
		    			<pre>{CONTENT}</pre>
		    		</div>
		    		<div>
		    			<p>{DATE}</p>
						<p><a href="index.php?actie=likeAdd&id={POSTID}&on=post">{LIKES}</a></p>
					</div>
						<!-- START BLOCK : edit -->
							<a href="index.php?actie=delete&id={ID}">delete</a>
							<a href="index.php?actie=editPost&id={ID}">edit</a>
						<!-- END BLOCK : edit -->
						<!-- START BLOCK : comment -->
							<div class="comment">
								<div class="name">
									<img src="{LINK}">
									<p><a href="index.php?actie=profile&id={PROFILEID}"> {NAME} </a></p>
								</div>
								<div class="content">
									<pre>{CONTENT}</pre>
									<p>{DATE}</p>
									<p><a href="index.php?actie=likeAdd&id={PROFILEID}&on=comment">{LIKES}</a></p>
								</div>
									<!-- START BLOCK : editComment -->
										<a href="index.php?actie=deleteComment&id={ID}">delete</a>
										<a href="index.php?actie=editComment&id={ID}">edit</a>
									<!-- END BLOCK : editComment -->
								<form method="POST" action="index.php?actie=newComment&id={COMMENTID}">
									<p>

										<label>comment</label>
										<textarea name='comment' id="post"></textarea>
										<input type="hidden" name='on' value="comment">
										<input type="submit" name='submit' value="submit">
									</p>
								</form>
								<!-- START BLOCK : comment2 -->
									<div class="comment2">
										<div class="name2">
											<img src="{LINK}">
											<p><a href="index.php?actie=profile&id={PROFILEID}">{NAME}</a></p>
										</div>
										<div class="content2">
											<pre>{CONTENT}</pre>
											<p>{DATE}</p>
											<p><a href="index.php?actie=likeAdd&id={ID}&on=comment">{LIKES}</a></p>
										</div>
									</div>
									<!-- START BLOCK : editComment2 -->
										<a href="index.php?actie=deleteComment&id={ID}">delete</a>
										<a href="index.php?actie=editComment&id={ID}">edit</a>
									<!-- END BLOCK : editComment2 -->
								<!-- END BLOCK : comment2 -->
							</div>
						<!-- END BLOCK : comment -->
					<div>
						<form method="POST" action="index.php?actie=newComment&id={POSTID}">
							<p>
								<label>comment</label>
								<textarea name='comment' id="post"></textarea>
								<input type="hidden" name='on' value="post">
								<input type="submit" name='submit' value="submit">
							</p>
						</form>
					</div>
	    		</div>

	    	<!-- END BLOCK : row -->
	    	</div>
		<!-- END BLOCK : table -->
	</body>
</html>