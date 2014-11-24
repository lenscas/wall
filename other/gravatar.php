<?php
	function getPicture($email){
		global $picture;
		$email = $email;
		$size = 40;
		$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $picture ) . "&s=" . $size;
		return $grav_url;
	}
?>