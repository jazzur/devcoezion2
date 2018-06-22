<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
            /* translators: %s: Name of current post */
            the_content(
                sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '' ),
                    get_the_title()
                )
            );
        ?>
    </div>
</article>
