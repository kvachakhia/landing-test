<?php

/**
 * Landing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Landing
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('landing_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function landing_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Landing, use a find and replace
		 * to change 'landing' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('landing', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'landing'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'landing_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'landing_setup');

/**
 * Enqueue scripts and styles.
 */
function landing_scripts()
{
	wp_enqueue_style('landing-style', get_stylesheet_uri(), array(), _S_VERSION);
}
add_action('wp_enqueue_scripts', 'landing_scripts');



add_action('wp_ajax_send_message', 'send_message');
add_action('wp_ajax_nopriv_send_message', 'send_message');
add_filter('wp_mail_content_type', 'mail_content_type');


function send_message()
{
	if (isset($_POST)) {

		if (empty($_POST['fname'])) {
			$_SESSION['errors']['fname'] = 'Name is missing';
		}

		if (empty($_POST['title'])) {
			$_SESSION['errors']['title'] = 'Title is missing';
		}

		if (empty($_POST['company'])) {
			$_SESSION['errors']['company'] = 'Company is missing';
		}

		if (empty($_POST['email'])) {
			$_SESSION['errors']['email'] = 'Email is missing';
		}

		if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$_SESSION['errors']['email'] = 'is not a valid email address';
		}

		if (count($_SESSION['errors']) > 0) {
			//This is for ajax requests:
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				echo json_encode($_SESSION['errors']);
				exit;
			}
			//This is when Javascript is turned off:
			echo '<ul>';
			foreach ($_SESSION['errors'] as $key => $value) {
				echo '<li>' . $value . '</li>';
			}
			echo '</ul>';
			exit;
		} else {

			$to = get_option('admin_email');
			$headers = 'From: ' . $_POST['fname'] . ' <"' . $_POST['email'] . '">';
			$subject = "New Message from " . $_POST['fname'];

			ob_start();

			echo 'Title:' . $_POST['title'] . '<br>' . 'Name:' . $_POST['fname'] . '<br>' . 'Company:' . $_POST['company'] . '<br>' . 'Email:' . $_POST['email'];

			$message = ob_get_contents();

			ob_end_clean();


			$mail = wp_mail($to, $subject, $message, $headers);

			if ($mail) {
				echo 'success';
			}
		}
	}



	exit();
}

function mail_content_type()
{
	return "text/html";
}
