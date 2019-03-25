<?php

global $wp_query;
$wp_query->is_home = false;
// Some place to store our markup
$html = '';
// Lets grab the vehicle we're trying to show
$vehicle_vin = get_query_var('email_page_vehicle');
// Instatiate our Custom Plugin Public Class
$custom_plugin_obj = new Models\Cars();
// Lets get the listings needed for this "page"
$vehicle = $custom_plugin_obj->get_vehicle_by_vin($vehicle_vin);
// Lets load the header of the site
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <h2>Details Page</h2>
<?php
// We'll buid out the markup for the custom page
$html .= '<h1>VIN: '.$vehicle->vin.'</h1>';
$html .= '
    <ul>
        <li>Year: '.$vehicle->year.'</li>
        <li>Make: '.$vehicle->make.'</li>
        <li>Model: '.$vehicle->model.'</li>
        <li>Color: '.$vehicle->color.'</li>
    </ul>
    <a href="/email_page">&laquo; Back to VIN Listings</a>
';
// Lets render out our html
echo($html);
?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
// Load the footer
get_footer();
?>