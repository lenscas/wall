<?php
	function check(...$needCheck){
		$valid=true;
		foreach ($needCheck as $value) {
			if $value==null{
				$valid=false;
				break;
			}
		}
		return $valid;
	}
?>