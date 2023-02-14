/**
 * Customizer Live Preview
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Camer
 */

( function( $ ) {

	// Site Title textfield.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title' ).text( to );
		} );
	} );

	// Site Description textfield.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).text( to );
		} );
	} );
	
	// Show site title checkbox.
	wp.customize( 'camer_show_site_title', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#site-title' );
			} else {
				showElement( '#site-title' );
			}
		} );
	} );
	
	// Show site tagline checkbox.
	wp.customize( 'camer_show_site_description', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#site-description' );
			} else {
				showElement( '#site-description' );
			}
		} );
	} );
	
	// Show slide title checkbox.
	wp.customize( 'camer_display_slide_title', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-title' );
			} else {
				showElement( '.slide-title' );
			}
		} );
	} );	
	
	// Show slide excerpt checkbox.
	wp.customize( 'camer_display_slide_excerpt', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-excerpt' );
			} else {
				showElement( '.slide-excerpt' );
			}
		} );
	} );		
	
	// Show slide read more checkbox.
	wp.customize( 'camer_display_slide_readmore', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.slide-readmore' );
			} else {
				showElement( '.slide-readmore' );
			}
		} );
	} );
	
	// Show regular post featured image checkbox.
	wp.customize( 'show_post_single_featured_image', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single .post-image' );
			} else {
				showElement( '.single .post-image' );
			}
		} );
	} );
	
	// Show regular page featured image checkbox.
	wp.customize( 'show_page_featured_image', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.page .post-image' );
			} else {
				showElement( '.page .post-image' );
			}
		} );
	} );	
	
	// Show full post meta info checkbox.
	wp.customize( 'camer_meta_info', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single .post-details' );
			} else {
				showElement( '.single .post-details' );
			}
		} );
	} );		
	
	// Show post categories checkbox.
	wp.customize( 'camer_meta_category', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#footer-posted-in' );
				hideElement( '.post-categories' );
			} else {
				showElement( '#footer-posted-in' );
				showElement( '.post-categories' );
			}
		} );
	} );	
	
	// Show post tags checkbox.
	wp.customize( 'camer_meta_tags', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#footer-tagged-with' );
				hideElement( '#entry-tags' );
			} else {
				showElement( '#footer-tagged-with' );
				showElement( '#entry-tags' );
			}
		} );
	} );		
	
	// Show related posts checkbox.
	wp.customize( 'camer_show_related_posts', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#related-posts-wrapper' );
			} else {
				showElement( '#related-posts-wrapper' );
			}
		} );
	} );		
	
	// Show full post nav checkbox.
	wp.customize( 'camer_post_navigation', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single .post-navigation' );
			} else {
				showElement( '.single .post-navigation' );
			}
		} );
	} );		
	
	// Author Avatar checkbox.
	wp.customize( 'camer_display_author_avatar', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.byline .avatar' );
			} else {
				showElement( '.byline .avatar' );
			}
		} );
	} );	



	// Site Title Colour
	wp.customize('camer_sitetitle_colour',function(value) {
		value.bind( function( to ) {
			$('#site-title a').css('color',to);
		} );
	} );

	// Site Tagline Colour
	wp.customize('camer_tagline_colour',function(value) {
		value.bind( function( to ) {
			$('#site-description').css('color',to);
		} );
	} );
	
	// First colour
	wp.customize(
		'camer_first_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'camer_first_colour', to );
				}
			);
		}
	);	
	
	// Second colour
	wp.customize(
		'camer_second_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'camer_second_colour', to );
				}
			);
		}
	);	
	
	// Third colour
	wp.customize(
		'camer_third_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'camer_third_colour', to );
				}
			);
		}
	);	
	
	// Fourth colour
	wp.customize(
		'camer_fourth_colour', function( value ) {
			value.bind(
				function( to ) {
					changeInlineCSS( 'camer_fourth_colour', to );
				}
			);
		}
	);	
	
	// Page width 
	wp.customize('camer_page_width',function(value) {
		value.bind( function( to ) {
			$('#page').css('max-width',to+'px');
		} );
	} );		
	
	// Banner width 
	wp.customize('camer_banner_width',function(value) {
		value.bind( function( to ) {
			$('#banner-sidebar').css('max-width',to+'px');
		} );
	} );		

	// Featured box section width 
	wp.customize('camer_featured_boxes_width',function(value) {
		value.bind( function( to ) {
			$('#featured-boxes.container').css('max-width',to+'px');
		} );
	} );
	
	// Copyright textfield.
	wp.customize( 'camer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright-name' ).text( to );
		} );
	} );
	
	// Show footer credit checkbox.
	wp.customize( 'camer_show_design_by', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '#footer-credit' );
			} else {
				showElement( '#footer-credit' );
			}
		} );
	} );	
	
	// Show featured label checkbox.
	wp.customize( 'camer_show_featured_label', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.featured-post' );
			} else {
				showElement( '.featured-post' );
			}
		} );
	} );	
	
	// Read More textfield.
	wp.customize( 'camer_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( 'a.more-link' ).text( to );
		} );
	} );	
	
	
	// show and hide elements base
	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

} )( jQuery );
