<?php


	// Security	
	if(!defined('ABSPATH')){
		exit;
	}

	// Call processing page
	$json_content = file_get_contents(plugins_url('lang.json', __FILE__));
	
	
	// Function for decode json file
	if ($json_content) {
  		$tab_content = json_decode($json_content);
	}


	// Function for recovery values keys
	if (get_locale() == 'fr_FR') { 
		$json_lang = $tab_content->{'fr_FR'}; // french translate
	}else{
		$json_lang = $tab_content->{'en_EN'}; // english translate
	}
?>