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

		$darkmode_logo_id = get_theme_mod( 'darkmode_logo' );
		$darkmode_logo = wp_get_attachment_image_src( $darkmode_logo_id );
		if ( $darkmode_logo ) {
			$darkmode_icon = $darkmode_logo[0];
		}
		else {
			$darkmode_icon = $icon;
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
    <link id="favicon" rel="shortcut icon" href="<?php echo $icon ?>" />
	<link id="favicon" rel="icon" href="<?php echo $icon ?>" />

	<script id="misitheme-favicon-js" type="text/javascript">
		document.addEventListener('DOMContentLoaded', () => {
			const favicon = document.getElementById('favicon');
			const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
			
			function updateFavicon() {
				if (darkModeMediaQuery.matches) {
					favicon.href = "<?php echo $darkmode_icon; ?>";
				} else {
					favicon.href = "<?php echo $icon; ?>";
				}
			}

			updateFavicon();

			darkModeMediaQuery.addEventListener('change', updateFavicon);
		});
	</script>

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