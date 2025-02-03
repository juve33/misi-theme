    </main>

    <footer>

        <?php

            dynamic_sidebar( 'footer-widget' ); 
        
        ?>

        <div class="theme-info">
            <?php
                $theme = wp_get_theme();
                $author = $theme->get( 'Author' );
                $authorURI = $theme->get( 'AuthorURI' );

                if ( $author ) {
                    if ( $authorURI ) {
                        echo 'Wordpress Theme by <a href="' . $authorURI . '" target="_blank">' . $author . '</a>';
                    }
                    else {
                        echo 'Wordpress Theme by ' . $author;
                    }
                }
            ?>
        </div>
    </footer>

    <?php
        wp_footer();
    ?>

</body>
</html>