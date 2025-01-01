    </main>

    <footer>

        <?php

            dynamic_sidebar( 'footer-widget' ); 
        
        ?>

        <div class="theme-info">
            <?php
                $theme = wp_get_theme();
            ?>
            Wordpress Theme: <?php echo $theme->get( 'Name' ); ?> by <?php echo $theme->get( 'Author' ); ?>
        </div>
    </footer>

    <?php
        wp_footer();
    ?>

</body>
</html>