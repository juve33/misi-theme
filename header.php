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
	WordPress Theme made by Julian Velling
-->
<html <?php language_attributes(); ?>>
<?php

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

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link id="favicon" rel="shortcut icon" href="<?php echo $icon ?>" />
	<link id="favicon" rel="icon" href="<?php echo $icon ?>" />

	<script id="misitheme-favicon-js" type="text/javascript">
		document.addEventListener('DOMContentLoaded', () => {
			const favicon = document.getElementById('favicon');
			const logo = document.getElementById('logo');
			const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
			
			function updateFavicon() {
				if (darkModeMediaQuery.matches) {
					favicon.href = "<?php echo $darkmode_icon; ?>";
					logo.src = "<?php echo $darkmode_icon; ?>";
				} else {
					favicon.href = "<?php echo $icon; ?>";
					logo.src = "<?php echo $icon; ?>";
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

<body <?php body_class(); ?>>

	<?php
		wp_body_open();
	?>

	<nav class="main-nav">
		<div class="nav-wrapper">
			<a href="/" class="logo">
				<img src=
					"<?php
						if ( $logo ) {
							echo $logo[0];
						}
					?>"
				alt="Logo"
				id="logo" />
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

					if (get_the_title()) {
						echo get_the_title();
					}
					else
					{
						echo 'Error 404';
					}

				?>
			</div>
		</div>
	</nav>

	<main>