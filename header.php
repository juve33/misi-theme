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
		if ( $logo ) {
			$icon = get_site_icon_url( 100, $logo[0] );
		}
		else {
			$icon = $logo;
		}

	}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
						'items_wrap' => '<ul class="navigation">%3$s</ul>',
						'fallback_cb' => 'misitheme_empty_navigation',
						'depth' => 2
					)
				);

			?>
			<div class="perspective"></div>
			<div class="page-title">
				<?php

					echo get_the_title();

				?>
			</div>
		</div>
	</nav>

	<main>