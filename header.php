<!DOCTYPE html>
<!--
<?php
	$theme = wp_get_theme();
	if ( $theme ) {
		echo $theme->get( 'Name' ) . ' Theme Version ' . $theme->get( 'Version' );
	}
?>
-->
<!--
	Released under MIT License by Julian Velling
-->
<html lang="<?php echo get_bloginfo( 'language' ) ?>">
<?php

	if( function_exists( 'the_custom_logo' ) ) {

		//the_custom_logo();
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = wp_get_attachment_image_src( $custom_logo_id );
		$icon = get_site_icon_url( 100, $logo[0] );

	}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		
		if ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {

			$page_title_seperator = get_theme_mod( 'page_title_seperator' );
			$page_title = get_bloginfo( 'name' );

			if ( !is_front_page() ) {

				if ( $page_title_seperator ) {

					$page_title = get_the_title() . ' ' . esc_attr( $page_title_seperator ) . ' ' . $page_title;

				}
				else {

					$page_title = get_the_title() . ' - ' . $page_title;

				}

			}

			echo '<title>' . $page_title . '</title>';

		}
	?> 
	<meta name="theme-color" content=
		"<?php
			$primary_color = get_theme_mod( 'primary_color' );
			if ( $primary_color ) {
				echo esc_attr( $primary_color );
			} 
		?>"
	/>
    <link rel="shortcut icon" href="<?php echo $icon ?>" />
	<link rel="icon" href="<?php echo $icon ?>" />

	<?php
		if ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {

			echo '<meta property="og:title" content="' . $page_title . '" />';
			echo '<meta property="og:type" content="website" />';
			echo '<meta property="og:url" content="' . get_site_url( null, '', 'https' ) . '" />';

		}
	?>

	<?php
		wp_head();
	?>

</head> 

<body>

	<nav class="main-nav">
		<div class="nav-wrapper">
			<a href="/" class="logo">
				<img src=
					"<?php
						if ( $logo ) {
							echo $logo[0];
						}
					?>"
				alt="Logo" />
			</a>

			<?php

				wp_nav_menu(
					array(
						'menu' => 'primary',
						'container' => '',
						'theme_location' => 'primary',
						'items_wrap' => '<ul class="navigation"><li class="menu-item hamburger-icon"><i class="fa-sharp fa-solid fa-bars" tabindex="0"></i></li>%3$s</ul>',
						'fallback_cb' => 'misitheme_empty_navigation',
						'depth' => 2
					)
				);

				wp_nav_menu(
					array(
						'menu' => 'primary',
						'container' => '',
						'theme_location' => 'primary',
						'items_wrap' => '<ul class="hamburger-menu">%3$s</ul>',
						'after' => '<i class="fa-solid fa-chevron-down"></i>',
						'fallback_cb' => 'misitheme_empty_navigation',
						'depth' => 2
					)
				);

			?>
		</div>
	</nav>

	<main>