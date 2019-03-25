<?php

/**
 * EmailPageBootstrapper
 * 
 * Bootstraps entire application. Handles activation and deactivation. Handles page redirects
 * and query vars.
 *
 * @author     James Sedillo <jin91706@yahoo.com>
 */

namespace Bootstrap;


class EmailPageBootstrapper {

	/**
	 * This variable holds the value of the main plugin file.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      __FILE__    $plugin    The main plugin file.
	 */
	private $plugin;

	/**
	 * Loads activation and deactivation hooks. Adds actions and filters for query vars and redirects.
	 *
	 * @since    1.0.0
	 */
	public function __construct($plugin = '') {
		
		$this->plugin = $plugin;
		
		register_activation_hook( $plugin, array($this, 'activate_plugin') );
		register_deactivation_hook( $plugin, array($this, 'deactivate_plugin') );

		add_filter( 'query_vars', array($this, 'register_query_values') );
		add_action( 'template_redirect', array($this, 'email_page_register_redirect' ) );

	}

	/**
	 * Add rewrite rules for plugin functionality.
	 *
	 * @since 1.0.0
	 */
	public function activate_plugin() {

		$url_slug = 'email_page';
		
		add_rewrite_rule( $url_slug . '/?$', 'index.php?email_page=index', 'top' );
		add_rewrite_rule( $url_slug . '/page/([0-9]{1,})/?$', 'index.php?email_page=items&email_page_paged=$matches[1]', 'top' );
		add_rewrite_rule( $url_slug . '/form/?.*$', 'index.php?email_page=index&email_page_form=index', 'top');
		add_rewrite_rule( $url_slug . '/([a-zA-Z0-9\-]{1,})/?$', 'index.php?email_page=detail&email_page_vehicle=$matches[1]', 'top' );

		flush_rewrite_rules();

	}

	/**
	 * Removes rewrite rules added by this plugin.
	 *
	 * @since 1.0.0
	 */
	public function deactivate_plugin() {

		add_filter( 'rewrite_rules_array', function ( $rules ) {
		  		foreach ( $rules as $rule => $rewrite ) {
		    		if ( preg_match( '/email_page\//', $rule ) ) {
		      			unset( $rules[$rule] );
		    		}
		  		}
		  		return $rules;
			}
		);

		flush_rewrite_rules();
	}

	/**
	 * Add query vars to inform plugin on what page template to load.
	 *
	 * @since 1.0.0
	 */
	public function register_query_values($vars) {
        
		$vars[] = 'email_page';
		$vars[] = 'email_page_paged';
        $vars[] = 'email_page_vehicle';
        $vars[] = 'email_page_form';

        return $vars;
	}

	/**
	 * Determines what template to load based on query vars.
	 *
	 * @since 1.0.0
	 */
	public function email_page_register_redirect() {
        
        if (get_query_var('email_page')) {
            add_filter('template_include', function () {
                return plugin_dir_path($this->plugin) . 'src/Views/index.php';
            });
		}
		
        if (get_query_var('email_page') && get_query_var('email_page_vehicle')) {
            add_filter('template_include', function () {
                return plugin_dir_path($this->plugin) . 'src/Views/detail.php';
            });
        }

        if (get_query_var('email_page') && get_query_var('email_page_form')) {
            add_filter('template_include', function () {
                return plugin_dir_path($this->plugin) . 'src/Views/form.php';
            });
        }
	}

}
