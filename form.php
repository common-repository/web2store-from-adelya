<?php

	// Security
	if(!defined('ABSPATH')){
		exit;
	}

	// Call translate file
	include('translate.php');

	// Verification post form
	if(current_user_can('administrator')){
		wp_verify_nonce($_POST['access_verif'], 'inscription_web2store');
	}

	// Verification post Reference Catalog
	if(current_user_can('administrator')){
		wp_verify_nonce($_POST['access_verif'], 'catalogue_reference' );
	}

	// Call files wordpress
	global $wpdb, $table_prefix;


	// Redirection of the page to the administration
    $url = admin_url()."options-general.php?page=adminAdelya";


	// If no value is entered, redirect to the form with an error message
    $pattern = "/([^A-Za-z0-9])/"; //Search for special characters other than [A-Za-z] ou [0-9]s


	// Recovery of form values
		$codeGroup = $_POST['codeGroup'];
		$server = $_POST['server'];


    // post done --> process
    if (isset($server) && isset($codeGroup)){

	    if (empty($server)) { //ServerCode is missing
	        $success=2;
	    } elseif (empty($codeGroup)) { //GroupCode is missing
	    	$success=0;
	    } elseif (preg_match($pattern, $codeGroup)) { // GroupCode with special characters
	    	$success=3;
	    }elseif (!empty($server) && ($server !== 'qa.adelya.com' && $server !== 'asp.adelya.com' && $server !== 'demo.adelya.com')) { //ServerCode is wrong
	    	$success=4;
	    } else {

			// Call Data Base Table : $table_name -> Database Table Name
			$table_name = ($wpdb->prefix).'options';


			// Inserting or changing values in the Database Table

			/* Insertion Group Code if not special characters */
			$wpdb->replace(
				$table_name,
				array(
					'option_name' => 'AdelyaCodeGroup',
					'option_value' => $codeGroup
					)
			);

	        $wpdb->replace(
	            $table_name,
	             array(
	                'option_name' => 'AdelyaServeur',
	                'option_value' => $server
	            )
	        );

			// Finished process, data validation message

		    $success = 1;
		}
		}
	

	// Call files wordpress
	global $wpdb, $table_prefix;

	// Call Data Base Table : $table_name -> Database Table Name
	$table_name = ($wpdb->prefix).'options';

	// Recovery Result CodeGroup
	$resultCodeGroup = $wpdb->get_results(
	"
	SELECT option_value
	FROM $table_name
	WHERE option_name = 'AdelyaCodeGroup'
	"
	);

	// Recovery Result Server
	$resultServer = $wpdb->get_results(
	"
	SELECT option_value
	FROM $table_name
	WHERE option_name = 'AdelyaServeur'
	"
	);


	// Référence Catalogue

	if (!empty($_POST["refCatalog$i"])){
		if( count($_POST["refCatalog$i"]) == 1){
			$references = array( "catalogue_1" => array_pop($_POST["refCatalog$i"]));
		} else {
			$references = [];
			foreach ($_POST['refCatalog'] as $keys => $reference){
				$references = array_merge($references, array("catalogue_".($keys +1) => $reference));
			}
		}	
	}
	

	
	// Ref Catalog --> process
	if (isset($references)){
		// Call Data Base Table : $table_name -> Database Table Name
		$table_name = ($wpdb->prefix).'options';
	
		foreach ($references as $keys => $reference) {
			$wpdb->replace(
				$table_name,
					array(
						'option_name' => $keys,
						'option_value' => $reference
					)
				);
		}
		
		var_dump($keys);
	}

	// Delete Catalog Reference
	if (isset($_POST["ref"])){
	$wpdb->delete(
		$table_name,
		array (
			'option_value' => $_POST["ref"]
		)
		);
	}

	// Recovery Result Catalog Reference
	$i = 1;
	$references = [];
	while(count(
	$wpdb->get_results(
 		"SELECT option_value FROM $table_name WHERE option_name = 'catalogue_$i' ")
 	) != 0 ) {
 		$references = array_merge($references, array("catalogue_$i" => $wpdb->get_results(
			"SELECT option_value FROM $table_name WHERE option_name = 'catalogue_$i' ") [0])); 
			$i++;
	 }


?>
<html>
	<head>
		<meta charset="utf-8"> <!-- encoding -->
	</head>

	<body>

		<div class="logo"> <!-- title admin page -->
			<img src="<?= plugins_url('asset/logo.png', __FILE__); ?>" alt="" class="img-responsive">
			<h1><?= $json_lang->welcome ?></h1>
		</div>

		<section>
			<h3 class="admin_first"><?= $json_lang->form ?></h3> <!-- Title section -->

			<?php
			// Result form values
			if(isset($success)) {
				if ($success == "0"){
					echo '<div class="wrap">';
					echo '<p class="success">'.$json_lang->warning1.'</p>';
					echo '</div>';
				}elseif($success == "2"){
					echo '<div class="wrap">';
					echo '<p class="success">'.$json_lang->warning2.'</p>';
					echo '</div>';
				}elseif($success == "3"){
					echo '<div class="wrap">';
					echo '<p class="success">'.$json_lang->warning3.'</p>';
					echo '</div>';
				}elseif($success == "4"){
					echo '<div class="wrap">';
					echo '<p class="success">'.$json_lang->warning4.'</p>';
					echo '</div>';
				}else{
					echo '<div class="wrap">';
					echo '<p class="success1">'.$json_lang->success.'</p>';
					echo '</div>';
				}
			}
			?>

			<!-- Form to save te entered data -->
			<div class="col-left">

				<form action='' method="post">

					<table align="left" border="0" style="float: none;">

						<tr>
							<td><?= $json_lang->codegroup ?></td>
							<td><input type="text" name="codeGroup" value="<?php foreach ($resultCodeGroup as $resultCodeGroup){echo $resultCodeGroup->option_value;} ?>"></td>
						</tr>

						<tr>
							<td><?= $json_lang->server ?></td>
							<td><input type="text" name="server" value="<?php foreach ($resultServer as $resultServer){echo $resultServer->option_value;} ?>"></td>
						</tr>

						<tr>
							<td colspan="2"><input class="button button-primary" type="submit" name="save" value="<?= $json_lang->save ?>"></td> <!-- SAVE -->
						</tr>

					</table>

					<?php wp_nonce_field('inscription_web2store', 'access_verif'); ?> <!-- verification post form -->
				</form>

			</div><!-- End Form -->

			<div class="col-right"><!-- Section ABOUT -->
				<table class="about">
					<tr><td><h3><?= $json_lang->form_title ?></h3></td></tr>
					<tr><td><p><?= $json_lang->form_text ?></p><td></tr>
				</table>
			</div><!-- End section ABOUT -->
		</section>

		<hr class="clear">

		<section>
			<h3 class="admin_first"><?= $json_lang->catalog ?></h3> <!-- Title section -->
			<div class="col-left">
				<form id="saveForm" action='' method="post"></form>
				<form id="deleteForm" action='' method="post"></form>

				<table align="left" border="0" style="float: none;">

		 			<?php $i=1; foreach ($references as $reference): ?>
					
					<tr>
						<td><?= $json_lang->refCatalog?> <?= $i ?></td>
						<td><input type="text" name="refCatalog[<?php $i ?>]" value="<?= $reference->option_value ?>" form="saveForm"></td>
						<input type="hidden" name="ref" value="<?= $reference->option_value ?>" form="deleteForm">
						<td><input type="submit" class="button button-alert" name="delete" value="<?= $json_lang->delete ?>" form="deleteForm"></td>
					</tr>
					<?php $i++; endforeach ?>

					<tr>
						<td><?= $json_lang->refCatalog ?></td>
						<td><input type="text" name="refCatalog[<?php $i ?>]" value="" form="saveForm"></td>
						<td colspan="2"><input class="button button-primary" type="submit" name="ok" value="<?= $json_lang->add ?>" form="saveForm"></td><!-- SAVE -->
					</tr> 
				</table>
				<?php wp_nonce_field('catalogue_reference', 'access_verif'); ?> <!-- verification post form -->
			</div>

			<div class="col-right"><!-- Section ABOUT CATALOG -->
				<table class="about">
					<tr><td><h3><?= $json_lang->catalog_title ?></h3></td></tr>
					<tr><td><p><?= $json_lang->catalog_text ?></p><td></tr>
				</table>
			</div><!-- End section ABOUT CATALOG -->
		</section>

		<hr class="clear">

	</body>
</html>
