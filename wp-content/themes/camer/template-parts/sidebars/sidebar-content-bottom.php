<?php
/**
 * Content Bottom sidebars 
 * @package Camer
*/

if (   ! is_active_sidebar( 'cbottom1'  )
	&& ! is_active_sidebar( 'cbottom2' )
	&& ! is_active_sidebar( 'cbottom3'  )		
	&& ! is_active_sidebar( 'cbottom4'  )	
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<aside id="content-bottom-sidebar">
    <div class="widget-area container">

        <div class="row">
            <?php if ( is_active_sidebar( 'cbottom1' ) ) : ?>
            <div id="cbottom1" <?php camer_cbottom_group(); ?>>
                <?php dynamic_sidebar( 'cbottom1' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'cbottom2' ) ) : ?>
            <div id="cbottom2" <?php camer_cbottom_group(); ?>>
                <?php dynamic_sidebar( 'cbottom2' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'cbottom3' ) ) : ?>
            <div id="cbottom3" <?php camer_cbottom_group(); ?>>
                <?php dynamic_sidebar( 'cbottom3' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'cbottom4' ) ) : ?>
            <div id="cbottom4" <?php camer_cbottom_group(); ?>>
                <?php dynamic_sidebar( 'cbottom4' ); ?>
            </div>
            <?php endif; ?>

        </div>
</aside>
