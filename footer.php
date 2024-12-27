    </main>

    <?php

        if(function_exists('the_custom_logo')) {

            //the_custom_logo();
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id);

        }

    ?>

    <footer>
        <div class="logo">
            <img src="<?php echo $logo[0] ?>" alt="Logo" />
        </div>
        <div class="footer-wrapper">

            <?php

                wp_nav_menu(
                    array(
                        'menu' => 'footer',
                        'container' => '',
                        'theme_location' => 'footer',
                        'items_wrap' => '<ul class="footer-navigation">%3$s</ul>',
                        'fallback_cb' => '',
                        'depth' => 2
                    )
                );

                dynamic_sidebar( 'footer-widget' ); 
            
            ?>

        </div>
    </footer>

    <?php
        wp_footer();
    ?>

</body>
</html>