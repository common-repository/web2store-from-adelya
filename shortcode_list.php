<?php


	// Security	
	if(!defined('ABSPATH')){
		exit;
	}

	// Call translate file
	include('translate.php');

	// Call variables
	global $wpdb, $table_prefix;
	$table_name = ($wpdb->prefix).'options';

	// Recovery Result Catalog Reference
	$i = 1;
	$references = [];
	while(count(
	$wpdb->get_row(
			"SELECT option_value FROM $table_name WHERE option_name = 'catalogue_$i' ")
		) != 0 ) {
			$references = array_merge($references, array("catalogue_$i" => $wpdb->get_row(
			"SELECT option_value FROM $table_name WHERE option_name = 'catalogue_$i' ")));
			$i++;
		}


?>

<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8"> <!-- encoding -->
	</head>

	<body>

		<main>
			
			<h3 class="administration"><?= $json_lang->shortcode ?></h3> <!-- Title section -->


			<section class="col-left"> <!-- Section shortcode list LEFT -->

				<div class="shortcode"> <!-- shortcode aggregate -->
					<p class="description"><?= $json_lang->shortcode_1 ?></p>
					<p class="module">[adelya module="aggregate"]</p>
					
				</div>

				<div class="shortcode"> <!-- shortcode login -->
					<p class="description"><?= $json_lang->shortcode_2 ?></p>
					<p class="module">[adelya module="login"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode logout -->
					<p class="description"><?= $json_lang->shortcode_13 ?></p>
					<p class="module">[adelya module="logout"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode signup -->
					<p class="description"><?= $json_lang->shortcode_3 ?></p>
					<p class="module">[adelya module="signup"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode loyalty -->
					<p class="description"><?= $json_lang->shortcode_4 ?></p>
					<p class="module">[adelya module="loyalty"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode account -->
					<p class="description"><?= $json_lang->shortcode_5 ?></p>
					<p class="module">[adelya module="account"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode history -->
					<p class="description"><?= $json_lang->shortcode_6 ?></p>
					<p class="module">[adelya module="histo"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode storelocator -->
					<p class="description"><?= $json_lang->shortcode_8 ?></p>
					<p class="module">[adelya module="storelocator"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode store -->
					<p class="description"><?= $json_lang->shortcode_9 ?></p>
					<p class="module">[adelya module="store"]</p>
				</div>


				<div class="shortcode"> <!-- shortcode deals -->
					<p class="description"><?= $json_lang->shortcode_11 ?></p>
					<p class="module">[adelya module="deals"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode giftcard -->
					<p class="description"><?= $json_lang->shortcode_12 ?></p>
					<p class="module">[adelya module="giftcard"]</p>
				</div>

				<div class="shortcode"> <!-- shortcode catalog -->
					<?php $i=1; foreach($references as $keys => $reference) : ?>
						<p class="description"><?= $json_lang->shortcode_10." ".$i ?></p>
						<p class="module">[adelya module="catalog" ref="<?= $reference->option_value ?>"]</p>
					<?php $i++; endforeach; ?>
				</div>
			</section> <!-- End section LEFT-->


			<section class="col-right"> <!-- Section ABOUT SHORTOCODE -->
					<table class="about">
						<tr><td><h3><?= $json_lang->shortcode_title ?></h3></td></tr>
						<tr><td><p><?= $json_lang->shortcode_text ?></p><td></tr>
					</table>
			</section> <!-- End section ABOUT -->

			<hr class="clear">
		</main>

	</body>
</html>