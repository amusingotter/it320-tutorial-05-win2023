<?php
/**
 * Template part for the content top sidebars
 * @package Camer
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (   ! is_active_sidebar( 'ctop1'  )
	&& ! is_active_sidebar( 'ctop2' )
	&& ! is_active_sidebar( 'ctop3'  )		
	&& ! is_active_sidebar( 'ctop4'  )	
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>


<aside id="content-top-sidebars" class="widget-area row">
    <?php if ( is_active_sidebar( 'ctop1' ) ) : ?>
    <div id="ctop1" <?php camer_ctop_group(); ?>>
        <?php dynamic_sidebar( 'ctop1' ); ?>
    </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'ctop2' ) ) : ?>
    <div id="ctop2" <?php camer_ctop_group(); ?>>
        <?php dynamic_sidebar( 'ctop2' ); ?>
    </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'ctop3' ) ) : ?>
    <div id="ctop3" <?php camer_ctop_group(); ?>>
        <?php dynamic_sidebar( 'ctop3' ); ?>
    </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'ctop4' ) ) : ?>
    <div id="ctop4" <?php camer_ctop_group(); ?>>
        <?php dynamic_sidebar( 'ctop4' ); ?>
    </div>
    <?php endif; ?>
</aside>
