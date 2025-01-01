<?php

function misitheme_theme_support() {

    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'block-patterns' );

    remove_theme_support('core-block-patterns');

}

add_action('after_setup_theme', 'misitheme_theme_support');



function misitheme_empty_navigation() {

    echo '<ul class="navigation"></ul>';

}



function misitheme_custom_mime_types( $mimes ) {
	
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'misitheme_custom_mime_types' );



function misitheme_customize_register( $wp_customize ) {

    $wp_customize->add_setting(
        'page_title_separator',
        array(
            'default' => "-"
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'page_title_separator',
            array(
                'label' => 'Page Title Seperator',
                'description' => 
                                'Symbol that is placed between the page title and the blog name. This is visible at the title of your browser tab or when you send the link of a page to someone on social media<br/>
                                Can be a string of symbols; can also include emojis and such things<br/>
                                Spaces are not required as they are automatically added on both sides of the symbol',
                'section' => 'title_tagline',
                'settings' => 'page_title_separator',
            )
        )
    );

}

add_action('customize_register', 'misitheme_customize_register');



function misitheme_custom_css_properties() {

    echo '<style type="text/css" id="misitheme-variables">:root { ';

    echo '}</style>';

}

add_action( 'wp_head', 'misitheme_custom_css_properties');



function misitheme_menus() {

    $location = array(
        'primary' => "Main Navigation",
    );
    register_nav_menus($location);
    
}

add_action('init', 'misitheme_menus');



function misitheme_footer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'misi' ),
		'id'            => 'footer-widget',
		'description'   => esc_html__( 'Space for legal notices', 'misi' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'misitheme_footer_widgets_init' );



function misitheme_allowed_block_types( $allowed_block_types, $block_editor_context ) {

	$allowed_block_types = array(
        'core/block',
        'core/button',
        'core/buttons',
        'core/code',
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
        'core/post-title',
        'core/quote',
        'core/separator',
        'core/shortcode',
        'core/site-tagline',
        'core/site-title',
        'core/spacer',
        'core/table',
        'core/video',
        'tablepress/table',
        'yoast/faq-block',
        'yoast/how-to-block',
        'lupus-plugin/header',
        'lupus-plugin/horizontal-scroll',
        'lupus-plugin/section',
        'lupus-plugin/subtitle'
	);

	return $allowed_block_types;

}

add_filter( 'allowed_block_types_all', 'misitheme_allowed_block_types', 10, 2 );



function misitheme_add_custom_separator ( $currentSeparators ) {

    $addSeparator = [];

	$page_title_separator = get_theme_mod( 'page_title_separator' );

    array_push( $addSeparator, esc_attr( $page_title_separator ) );

    $newSeparators = array_unique( array_merge( $currentSeparators, $addSeparator ));
    return $newSeparators;

}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
    add_filter( 'wpseo_separator_options', 'misitheme_add_custom_separator', 10 , 1 );
}



function misitheme_register_styles() {

    $version = wp_get_theme()->get( 'Version' );
    
    $stylesheets = array(
        array( 'main', 'main.css' ),
        array( 'variables', 'variables.css' ),
        array( 'nav', 'nav.css' ),
        array( 'blocks', 'blocks.css' ),
        array( 'footer', 'footer.css' ),
    );

    foreach ( $stylesheets as $stylesheet ) :
        wp_enqueue_style( 'misitheme-' . $stylesheet[0], get_template_directory_uri() . '/assets/css/' . $stylesheet[1], array(), $version, 'all' );
    endforeach;

    wp_enqueue_style( 'misitheme-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), '6.6.0', 'all' );



    if ( ! function_exists( 'is_plugin_active' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    
    $plugin_stylesheets = array(
        array( 'lupus-plugin', 'lupus-plugin.css', 'lupus-plugin/lupus-plugin.php' ),
        array( 'tablepress', 'tablepress.css', 'tablepress/tablepress.php' ),
        array( 'translatepress', 'translatepress.css', 'translatepress-multilingual/index.php' ),
        array( 'yoast', 'yoast.css', 'wordpress-seo/wp-seo.php' ),
    );

    foreach ( $plugin_stylesheets as $plugin_stylesheet ) :
        if ( is_plugin_active( $plugin_stylesheet[2] ) ) {
            wp_enqueue_style( 'misitheme-' . $plugin_stylesheet[0], get_template_directory_uri() . '/assets/css/' . $plugin_stylesheet[1], array(), $version, 'all' );
        }
    endforeach;

}

add_action('wp_enqueue_scripts', 'misitheme_register_styles');



function misitheme_register_scripts() {

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script( 'misitheme-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true );

    $scripts = array(
        array( 'main', 'main.js' ),
    );

    foreach ( $scripts as $script ) :
        wp_enqueue_script( 'misitheme-' . $script[0], get_template_directory_uri() . '/assets/js/' . $script[1], array(), $version, true );
    endforeach;

}

add_action('wp_enqueue_scripts', 'misitheme_register_scripts');


?>