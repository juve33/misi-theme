<?php

function misi_theme_support() {

    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'block-patterns' );

    remove_theme_support('core-block-patterns');

}

add_action('after_setup_theme', 'misi_theme_support');



function misi_theme_update($transient) {
    if (!is_object($transient)) {
        $transient = new stdClass();
    }

    $theme_slug = 'misi';
    $current_version = wp_get_theme($theme_slug)->get('Version');
    
    $response = wp_remote_get('https://juve33.github.io/wp-theme-updater/misi.json');

    if (!is_wp_error($response)) {
        $body = json_decode(wp_remote_retrieve_body($response));
        if (($body != NULL) && (version_compare($current_version, $body->version, '<'))) {
            $transient->response[$theme_slug] = array(
                'theme'       => $theme_slug,
                'new_version' => $body->version,
                'url' => 'https://github.com/juve33/misi-theme',
                'package'     => $body->download_url
            );
        }
    }
    return $transient;
}

add_filter('site_transient_update_themes', 'misi_theme_update');



function misi_media_sizes() {

    update_option( 'medium_size_h', 500 );
    update_option( 'medium_size_w', 500 );
    update_option( 'medium_large_size_w', 500 );
    update_option( 'medium_large_size_h', 500 );

}

add_action('after_setup_theme', 'misi_media_sizes');



function misi_empty_navigation() {

    echo '<ul class="navigation"></ul>';

}



function misi_custom_mime_types( $mimes ) {
	
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'misi_custom_mime_types' );



function misi_customize_register( $wp_customize ) {

    $wp_customize->add_setting(
        'darkmode_logo',
        array()
    );
    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'darkmode_logo',
            array(
                'label' => __( 'Dark Mode Logo', 'misi' ),
                'description' => __( 'Logo that replaces the main logo in browser tabs in dark mode', 'misi' ),
                'section' => 'title_tagline',
                'settings' => 'darkmode_logo',
                'mime_type' => 'image'
            )
        )
    );

}

add_action('customize_register', 'misi_customize_register');



function misi_menus() {

    $location = array(
        'primary' => __( 'Main Navigation', 'misi' ),
    );
    register_nav_menus($location);
    
}

add_action('init', 'misi_menus');



function misi_footer_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'misi' ),
		'id'            => 'footer-widget',
		'description'   => __( 'Space for legal notices', 'misi' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'misi_footer_widgets_init' );



function misi_allowed_block_types( $allowed_block_types, $block_editor_context ) {

	$allowed_block_types = array(
        'core/block',
        'core/button',
        'core/buttons',
        'core/column',
        'core/columns',
        'core/cover',
        'core/details',
        'core/embed',
        'core/file',
        'core/gallery',
        'core/group',
        'core/heading',
        'core/html',
        'core/image',
        'core/list',
        'core/list-item',
        'core/media-text',
        'core/missing',
        'core/paragraph',
        'core/separator',
        'core/shortcode',
        'core/table',
        'core/video',
        'yoast/faq-block',
        'yoast/how-to-block',
	);

	return $allowed_block_types;

}

add_filter( 'allowed_block_types_all', 'misi_allowed_block_types', 10, 2 );



function misi_register_styles() {

    $version = wp_get_theme()->get( 'Version' );
    
    $stylesheets = array(
        'main',
        'variables',
        'nav',
        'blocks',
        'footer',
    );

    foreach ( $stylesheets as $stylesheet ) :
        wp_enqueue_style( 'misi-' . $stylesheet, get_template_directory_uri() . '/assets/css/' . $stylesheet . '.css', array(), $version, 'all' );
    endforeach;

    wp_enqueue_style( 'misi-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), '6.6.0', 'all' );



    if ( ! function_exists( 'is_plugin_active' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    
    $plugin_stylesheets = array(
        array( 'translatepress', 'translatepress-multilingual/index.php' ),
        array( 'yoast', 'wordpress-seo/wp-seo.php' ),
    );

    foreach ( $plugin_stylesheets as $plugin_stylesheet ) :
        if ( is_plugin_active( $plugin_stylesheet[1] ) ) {
            wp_enqueue_style( 'misi-' . $plugin_stylesheet[0], get_template_directory_uri() . '/assets/css/' . $plugin_stylesheet[0] . '.css', array(), $version, 'all' );
        }
    endforeach;

}

add_action('wp_enqueue_scripts', 'misi_register_styles');



function misi_register_scripts() {

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script( 'misi-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true );

    $scripts = array(
        'main',
        'navigation',
    );

    foreach ( $scripts as $script ) :
        wp_enqueue_script( 'misi-' . $script, get_template_directory_uri() . '/assets/js/' . $script . '.js', array(), $version, true );
    endforeach;

}

add_action('wp_enqueue_scripts', 'misi_register_scripts');


?>