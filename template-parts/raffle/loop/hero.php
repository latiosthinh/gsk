<?php
if ( is_single() ) :

    the_post_thumbnail( 'full' );

else :

    the_post_thumbnail( 'thumb-385' );

endif;
?>