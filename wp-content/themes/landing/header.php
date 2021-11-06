<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Landing
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">

		<header>
			<div class="container">

				<div class="brand-logo">
					<!-- Here Logo -->
				</div>

				<input type="checkbox" id="toggle-btn">
				<label for="toggle-btn" class="show-menu-btn"><i class="fas fa-bars"></i></label>

				<nav>
					<ul class="navigation">
						<li><a href="#" class="active">Home</a></li>
						<li><a href="#"> SOLUTIONS</a></li>
						<li><a href="#"> ABOUT</a></li>
						<li><a href="#">RESOURCES</a></li>
						<li><a href="#"> CONTACT</a></li>
						<label for="toggle-btn" class="hide-menu-btn"><i class="fas fa-times"></i></label>
					</ul>
				</nav>
			</div>

		</header>