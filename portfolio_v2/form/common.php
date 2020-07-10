<?php


	// sanitize section
	function sanitize($beforeData){
		foreach ($beforeData as $key => $value) {
			$afterData[$key] = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
		}

		return $afterData;
	}


?>