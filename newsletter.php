<?php


	// Security	
	if(!defined('ABSPATH')){
		exit;
	}

	// Call translate file
	include('translate.php');

?>

<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8"> <!-- encoding -->
	</head>

	<body>

		<main>
			
			<h3 class="administration"><?= $json_lang->newsletter ?></h3> <!-- Title section -->


			<section class="col-left"> <!-- Section shortcode list LEFT -->

				<div class="shortcode"> <!-- shortcode aggregate -->
					<p class="description"><?= $json_lang->subscribe_newsletter ?></p>
					<p class="module">[adelya module="suscribe_newsletter"]</p>
					
				</div>


				<div class="shortcode"> <!-- shortcode giftcard -->
					<p class="description"><?= $json_lang->unsubscribe_newsletter ?></p>
					<p class="module">[adelya module="unsuscribe_newsletter"]</p>
				</div>


			</section> <!-- End section LEFT-->


			<section class="col-right"> <!-- Section ABOUT SHORTOCODE -->
					<table class="about">
						<tr><td><h3><?= $json_lang->newsletter_title ?></h3></td></tr>
						<tr><td><p><?= $json_lang->newsletter_text ?></p><td></tr>
					</table>
			</section> <!-- End section ABOUT -->

			<hr class="clear">
		</main>

	</body>
</html>