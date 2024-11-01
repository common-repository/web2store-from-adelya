<?php


	// Security
	if(!defined('ABSPATH')){
		exit;
	}

	// Call translate file
	include('translate.php');


	// Call $ Wordpress
	global $wpdb, $table_prefix;


	// Recovery of form values
	if ( isset( $_POST['resize'] )){

   		$valid_values = array(
                       '0',
                       '1',
   		);

    	$resize = sanitize_text_field( $_POST['resize'] );

    	if( in_array( $resize, $valid_values ) ) {

	        update_post_meta( $post->ID, 'resize', $resize );

	    }

	}


	// Redirection of the page to the administration
	$url = admin_url()."options-general.php?page=adminAdelya";


	// Call Data Base Table
	$table_name = ($wpdb->prefix).'options';



	// Inserting or changing values in the Database Table
		$wpdb->replace(
		    $table_name,
		    array(
		        'option_name' => 'Resize_Web2Store',
		        'option_value' => $resize
		    )
		);


	// Finished process
		if(isset($resize)){
		    $success=1;
		}
	?>


	<!DOCTYPE html>
	<head>
		<meta charset="utf-8"> <!-- encoding -->
	</head>
<html>
	<body>

		<section>
			<h3 class="administration"><?= $json_lang->resize ?></h3> <!-- Title Section -->

			<div class="col-left">
				<form method="post" action=''> <!-- Form resize -->
					<select name="resize">
						<option value="0" <? if($_POST['resize'] == "0" ) { echo "selected='selected'"; } ?> <?= $json_lang->yes ?></option>
						<option value="1" <? if($_POST['resize'] == "1" ) { echo "selected='selected'"; } ?><?= $json_lang->no ?></option>
					</select>
					<input class=" button button-primary" type="submit" value="<?= $json_lang->save ?>" />
				</form> <!-- End form -->
			</div>

	   		<div class="col-right">
	   			<table class="about">
					<tr><td><h3><?= $json_lang->resize_title ?></h3></td></tr>
					<tr><td><p><?= $json_lang->resize_text ?></p></td></tr>
				</table>
		   </div> 
		</section>
		
	</body>
</html>