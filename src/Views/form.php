<?php

global $wp_query;
$wp_query->is_home = false;

// Lets load the header of the site
get_header();
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!-- content here -->
			<h1>Test Form</h1>
			<form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
				
				<label>My first field</label>
				<input type="text" name="stuff">
				<input type="hidden" name="action" value="contact_form">
				<input type="submit" name="submit">

			</form>
			<br />
			<?php if (!empty($_GET['stuff'])): ?>
			<div>
				Value was successfully posted: <?= $_GET['stuff'] ?>
			</div>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
// Load the footer
get_footer();
?>