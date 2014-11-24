<?php
	function setTimeSelecters($tpl){
	   for ($day = 1; $day < 32; $day++) { 
		   $tpl->newBlock("day");
		   $tpl->assign("DAY", $day);
		  }

		  for($iM = 1;$iM<=12;$iM++) {
		   $month = strftime('%B', strtotime("$iM/12/10"));
		   $tpl->newBlock("month");
			$tpl->assign("MONTH", $month);
			$tpl->assign('VALUE', $iM);
		   }

		   for ($year = 2014; $year >= 1905; $year--) { 
		   $tpl->newBlock("year");
		   $tpl->assign("YEAR", $year);
	   }
	}
?>