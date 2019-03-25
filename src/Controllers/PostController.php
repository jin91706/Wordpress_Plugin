<?php

/**
 * PostController
 * 
 * Add hooks to capture post requests and methods to handle them.
 *
 * @author     James Sedillo <jin91706@yahoo.com>
 */

namespace Controllers;


class PostController {

	/**
	 * Add action hooks to handle post request.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action('admin_post_nopriv_contact_form', array($this, 'post_handler') );
		add_action('admin_post_contact_form', array($this, 'post_handler') );
	}

	/**
	 * Handler for post requests.
	 *
	 * @since 1.0.0
	 */
	public function post_handler() {

		header("Location: ".home_url()."/email_page/form/?". http_build_query($_POST));
		exit;
	}
}