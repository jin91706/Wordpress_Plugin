<?php

global $wp_query;
$wp_query->is_home = false;
// Some place to store our markup
$html = '';
// Set our current page for pagination
$custom_plugin_current_page = get_query_var('email_page_paged') > 0 ? get_query_var('email_page_paged') : 1;
// Instatiate our Custom Plugin Public Class
//$custom_plugin_obj = new Wordpress_Custom_Plugin_Public('wordpress-custom-plugin', '1.0.0');
$custom_plugin_obj = new Models\Cars();

// Lets get the listings needed for this "page"
$vehicle_listings = $custom_plugin_obj->get_vehicle_listings(10, $custom_plugin_current_page);
// Lets load the header of the site
get_header();

?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		    <h1>WordPress Custom Plugin</h1>
		    <p>This will show off pagination.</p>


<?php
// Pagination
$html .= '<ul>';

foreach ($vehicle_listings['vehicles'] as $vehicle) {
    $html .= '<li><a href="/email_page/'.$vehicle->vin.'">'.$vehicle->year.' '.$vehicle->make.' '.$vehicle->model.'</a></li>';
}
$html .= '</ul>';
$html .= $custom_plugin_obj->generatePagination($vehicle_listings['page_count'], $custom_plugin_current_page);

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