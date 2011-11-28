<?php
	function stripSpecial($rawInput){
		$specialArray = array("'", ".", ",", "!", "@", "+"); //If there is a special char I didn't think of, add it here.
		$final = str_replace($specialArray, "", $rawInput);
		return $final;
	}
?>