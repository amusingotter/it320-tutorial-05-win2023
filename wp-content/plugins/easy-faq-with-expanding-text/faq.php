<?php
/*
Plugin Name: Easy FAQ with Expanding Text
Description: Easily create a Frequently Asked Questions page with answers that slide down when the questions are clicked...or a non-FAQ page with the same effect. No need for a shortcode, HTML coding, or javascript tweaking.
Version: 3.2.8.3.1
Author: bgentry
Author URI: http://bryangentry.us
Plugin URI: http://bryangentry.us/easy-faq-page-with-expanding-text-wordpress-plugin/
*/

add_action( 'wp', 'determine_is_faq');

//this function determines whether the page or post being viewed, or one of the posts returned by the current query, should receive the animation effects.
function determine_is_faq() {
	global $wp_query;
	$loadfaq = 0; // set this at 0 to make sure it wasn't just hanging out with a value of 1 before
	//now let's go through each post in the query and see whether it needs the animations
	foreach ($wp_query->posts as $eachpost) {
		$id = $eachpost->ID;
		$faq_checkbox=get_post_meta($id, 'make_faq_page', true); //see whether the "make faq" check box was checked on this post
		$faq_shortcode_checkbox=get_post_meta($id, 'make_faq_shortcode', true);
		$posa = false; // make sure these variables weren't hanging out with a value already
		$pos = false;
		$title = $eachpost->post_name; //test the post name for faq
		$pos = strpos($title, 'faq' );
		$posa = strpos($title, 'frequently-asked-questions' );
		if (is_int($pos) || $posa!==false || $faq_checkbox=='yes' || $faq_shortcode_checkbox == 'yes') //if this post needs the faq animations,
		$loadfaq = 1;												//set this variable so we can add the animations
	}
if ( $loadfaq == 1 ) {
			//if the current post, page, or one of the posts returned by the current query needs the animations....
			wp_enqueue_script('faqmaker', plugins_url( 'faqmaker.js' , __FILE__ ), array('jquery'));
			wp_enqueue_style( 'faqstyle', plugins_url( 'faqstyle.css' , __FILE__ ));
			add_filter( 'the_content', 'faq_filter',1 );
			add_action('wp_head', 'faq_css_output');	
	}
}

//output the styles for an FAQ page
	function faq_css_output() {
	
	$faqoptions = get_option('bg_faq_options');
	
	if ( is_single() || is_page() ) {
		global $post;
		$visualCue = get_post_meta( $post->ID, 'bgFAQvisualCue', true);
		if( $visualCue == false || $visualCue == 'default' ) {
			
			$visualCue = $faqoptions['visualcue'];
		}
	} else { //this is not a single page or post, so use the default option
			
			$visualCue = $faqoptions['visualcue'];
	}
	
	if( $visualCue == 'plusminus' ) {
		$closedimg = plugins_url( 'plussign.png', __FILE__ );
		$openedimg = plugins_url( 'minussign.png', __FILE__ );
		}
	elseif ( $visualCue == 'updown' ) {
		$closedimg = plugins_url( 'downarrow.png', __FILE__ );
		$openedimg = plugins_url( 'uparrow.png', __FILE__ );	
		}	
	elseif ( $visualCue == 'updownWhite' ) {
		$closedimg = plugins_url( 'downarrowWhite.png', __FILE__ );
		$openedimg = plugins_url( 'uparrowWhite.png', __FILE__ );	
	}
	elseif ( $visualCue == 'plusminusWhite' ) {
		$closedimg = plugins_url( 'plussignWhite.png', __FILE__ );
		$openedimg = plugins_url( 'minussignWhite.png', __FILE__ );	
	}
		if( isset( $closedimg ) ) {
		//if the user set up images to show...
			echo '
			<style type="text/css">
			.bg_faq_opened {
background-image: url("'.$openedimg.'");
padding-left:25px;
background-repeat: no-repeat;
}

.bg_faq_closed {
background-image: url("'.$closedimg.'");
padding-left:25px;
background-repeat: no-repeat;
} </style>';
		}
		$hsixstyle = ""; //make sure this variable is empty  before we start evaluating whether to use it
	if ( $faqoptions['hsixsize'] )
		$hsixstyle = 'font-size:'.$faqoptions['hsixsize'].'!important;';
	if ( $faqoptions['hsixfont'] )
		$hsixstyle .= 'font-family:'.$faqoptions['hsixfont'].'!important;';
	if ( $faqoptions['hsixcolor'] )
		$hsixstyle .= 'color:'.$faqoptions['hsixcolor'].'!important;';
	if ( $hsixstyle !== "") {
			//display the styles for h6
			echo '<style type="text/css">h6 { '.$hsixstyle.'}</style>';
		}
	
	}


	
	//add the .bg_faq_content_section div around the countent
function faq_filter($content) {
	//first, we need to check again whether the current page needs the animation, so that the animation is not given unnecessarily to posts on an archive / index page
	global $post, $wp;
		$title = strtolower(get_the_title($post->ID));
		$posa = false; // make sure these variables start at false
		$pos = false;
		$pos = strpos($title, 'faq' );
		$posa = strpos($title, 'frequently asked questions' );
		$faq_checkbox=get_post_meta($post->ID, 'make_faq_page', true); //see whether the "make faq" check box was checked on this post
		$faq_shortcode_checkbox=get_post_meta($post->ID, 'make_faq_shortcode', true);
		
		if ( ($pos!==false || $posa!==false ||  $faq_checkbox=='yes' ) && $faq_shortcode_checkbox!=='yes' ) {
		
					$foldupOptions = get_post_meta($post->ID, 'bgFAQfoldup', true);
		if ( $foldupOptions == 'default' || $foldupOptions == false ) {
			$faqoptions = get_option('bg_faq_options');
		
		if ( is_array ( $faqoptions ) ) {
			if ( array_key_exists('foldup',$faqoptions) ) {
				$foldup = $faqoptions['foldup'];
			} else {
				$foldup = 'no';
			}
		} else {
			$foldup = 'no';
		}
		}
		else {
			$foldup = $foldupOptions;
		}
		//this code adds a script to call our javascript function with arguments set on the admin page
	$content = '<div data-foldup="'.$foldup.'" class="bg_faq_content_section">'.$content;
		$content.='</div>';
		}
		return $content;
	}

//output the javascript to launch the animation at the bottom of a list of posts
function faq_footer() {
	$faqoptions = get_option('bg_faq_options');
		if ( is_array ( $faqoptions ) ) {
			if ( array_key_exists('foldup',$faqoptions) ) {
				$foldup = $faqoptions['foldup'];
			} else {
				$foldup = 'no';
			}
		} else {
			$foldup = 'no';
		}
	echo '<script>if ( typeof faqStarted == "undefined" ) {
	faqStarted = true;	
	bgfaq("'.$foldup.'")}</script>';
	}

//output the javascript to launch the animation at the bottom of a single post or page
function faq_function_call( $content ) {
	global $post;
	$foldupOptions = get_post_meta($post->ID, 'bgFAQfoldup', true);
	if ( $foldupOptions == 'default' || $foldupOptions == false ) {
			$faqoptions = get_option('bg_faq_options');
		if ( is_array ( $faqoptions ) ) {
			if ( array_key_exists('foldup',$faqoptions) ) {
				$foldup = $faqoptions['foldup'];
			} else {
				$foldup = 'no';
			}
		} else {
			$foldup = 'no';
		}
	}
	else {
		$foldup = $foldupOptions;
	}
	
	$content .= '<script>if ( typeof faqStarted == "undefined" ) {';
	$content .= 'faqStarted = true;';
	$content .= 'bgfaq("'.$foldup.'"); }</script>';
	return $content;
}
	
//and, let's set up that admin page now:
add_action('admin_menu', 'faq_admin_page');

function faq_admin_page() {
	add_menu_page('FAQ Admin Page', 'FAQ Admin Page',  'manage_options', 'faq_options_page', 'faq_options_page');
}

function faq_options_page() {
//lots of great admin stuff

if (  $_POST['removedonationlink'] === 'true') {

	if ( check_admin_referer( 'remove_donation_link','bg_faq_remove_donation_link' ) ) {
		delete_option( 'bgfaqdonated' );
		add_option( 'bgfaqdonated', true, '', 'no' );
	}
}


?>
<h1>Create an animated FAQ page with the Easy FAQ with Expanding Text plugin.</h1>
<p>This plugin turns a standard WordPress page&#8212;or part of a page&#8212;into a dynamic animated page that reveals and hides content when readers click headings.</p>
<p>Set options for the plugin below, or read <a href="#instructions">instructions for using the plugin</a> below.</p>
<div style="clear:both;"></div>

<?php

$donationmade = get_option( 'bgfaqdonated' );
if ( $donationmade == false ) {

?>
<div style="float:right; width:35%; margin: 0px 2% 0px 2%; padding:10px; background-color:#c6ece8; border-radius:20px;">
<h1>Donate</h1>
<p>Has this plugin helped you make your website better? Was it easy to use?</p>
<p>Please consider supporting the development of this plugin and other upcoming plugins by making a donation here.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YF26W5P9QYPWG">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<p>Also, I would appreciate your support by <a href="http://wordpress.org/extend/plugins/easy-faq-with-expanding-text/" target="_blank" title="Plugin Page on WordPress.org">rating the plugin on WordPress.org</a> or reviewing / featuring it on your blog. Contact me at bryangentry@gmail.com with questions.</p>
<p>If you'd like to work with me on a project or have me do some freelance programming for you, e-mail me at the above address.</p>
</div>
<?php } ?>

<div style="border-radius: 20px; background-color: #ecd5c6; padding:10px; margin: 0px 2% 0px 50px; width: 53%;">
<form action='options.php' method='post'>
<?php
settings_fields('faq_settings');
do_settings_sections('faq_section');?>
<input name='submit' type='submit' value='Save FAQ Settings' class="button" style="background-color:#c6ece8; padding:10px; height:40px;"/>
</form>
</div>
<a name="troubleshooting"></a>
<div style="float:left; width:35%; margin: 20px 2% 0px 50px; padding:10px; background-color:#c6ece8; border-radius:20px;">
<h1>Troubleshooting / How to</h1>
<p>(First, make sure you have read the <a href="#instructions">instructions</a>.)</p>
<h2>I want to...</h2>
<h3>Make nested sections of drop down text</h3>
<p>Starting with version 3.2 of this plugin, you can create nested sections of drop down text. In other words, you can have a heading that, when clicked, drops down a section of other headings that can be clicked to reveal additional content.</p>
<p>View instructions <a href="http://bryangentry.us/how-to-make-nested-drop-down-text-sections-with-easy-faq-plugin/">here on my website</a></p>
<h3>Have have a "buy now" button at the bottom of my FAQ list</h3>
<p>The easiest way to do this is to format the button as a Heading 6. Insert the button using the WordPress editor. Highlight it, then choose Heading 6 from the drop-down formatting menu. Alternately, you can use the methods described below for applying the effect to only parts of the page.</p>
<h3>Have some sections of the page that don't receive the animated effects</h3>
<p>This is helpful if you want to divide the page into sections on different topics, or if you want some "closing paragraphs" at the end. If you are applying the drop down text effect to the whole page, just put in one line that is formatted as a Heading 6. Everything that appears after this line will not receive the animated effects, until you start a new set with the animated effects by having another line that is another heading, such as heading 1.</p>
<p>If you chose to have the drop down effect applied only to certain sections of your content, just wrap each section of content that you want to have the effect with the shortcodes [bg_faq_start] and [bg_faq_end].</p>
<h3>Change the way heading 6 looks</h3>
<p>If you don't like the way heading6 appears in your theme, you can try overriding the styles using the Heading 6 Styles options lised in the options box above</p>
</div>

<div style="border-radius: 20px; background-color: #ecd5c6; padding:10px; margin: 20px 2% 15px; width: 50%; float:right;">
<h1>About the plugin author</h1>
<p>My name is <a href="http://bryangentry.us">Bryan Gentry</a>. I'm a writer by day and a web designer and programmer by night.</p>
<p>I covered business for a local newspaper for four years after college, then I ran the blog and wrote marketing materials for a private liberal arts college. I have written copy for various websites, including websites I was designing.</p>
<p>I design websites with WordPress and I enjoy making them work better and look better, too. </p>
<p>I balance all this work with family life. My wife is one of my best web design critics. My son is too young to critique my work, but he provides great motivation to do good work, and lots of it!</p>
<h2>Contact Me:</h2>
<p>For support on this plugin, ask me a question, or to work with me on a project, <a href="http://bryangentry.us/contact-me">visit my contact page</a>.</p>
</div>
<div style="border-radius: 20px; background-color: #c6ece8; padding:10px; margin: 0px 2% 20px; width: 50%; float:right;">
<h2>If the plugin is not working...</h2>
<h3>Ensure that you are assigning the animation features to your page correctly</h3>
<p>The plugin will only activate on pages and posts for which it is activated. Double check that you have checked one of the checkboxes in the "Make Animated FAQ Page" box that appears on each post / page / custom post type editing screen.</p>
<h3>Make sure javascript is working and loading</h3>
<p>This plugin requires browsers to have javascript turned on. If javascript is disabled in the browser, the page will display with all content displayed and will have no animations.</p>
<p>If javascript is enabled on the browser and the plugin isn't working correctly, view the page's source and look to see whether faqmaker.js is loaded. If not, then you need to double check that you are assigning the animation features to the page. (See previous troubleshooting tip.)
</div>
<div style="clear:both;"></div>
<a name="instructions"></a>
<h1>How to use this plugin</h1>
<p>There are two ways to use this plugin: applying the drop down text effect to an entire page or post, or only to specific sections on the page.</p>
<img src="<?php echo plugins_url( 'faq_checkbox.png' , __FILE__ ); ?>" style="float:right; margin: 0 20px; border:1px solid #aaa; width:250px;"/>
<p><strong style="font-size:20px;">First</strong>, for either of these two methods, start creating a new post or page (or edit an existing page.) Find the box on the editing screen wtih the heading "Make Animated Dropdown Text." Check the first check box to apply the effect to the entire page. Check the second checkbox to apply the effect only to certain portions of your content.</p>
<img src="<?php echo plugins_url( 'faq_heading.png' , __FILE__ ); ?>" style="float:left; margin: 5px 10px; border:1px solid #aaa; width:125px;"/>
<p><strong style="font-size:20px;">Second</strong>, type your questions and answers.</p>
<p>Use the built-in formatting to indicate questions and answers. Any heading (other than heading 6) will be turned into a clickable heading. Paragraphs, lists, videos, and photos placed between the headings will be hidden when the page loads, but will drop down when the heading above them is clicked.</p>
<p>If you checked the box for <strong>applying these effects to the entire page</strong>, then this is all you need to do. Just save your post and it should be good to go.</p>
<p>If you clicked the second checkbox to <strong>apply these effects only to certain portions of the page</strong>, you need to enter some shortcodes around your content. Type [bg_faq_start] in the post editor before the content that you want to have the effect, and [bg_faq_end] after the content.</p>
<p>Note: Heading 6 is reserved to allow you to "break" the effect and have some content beneath your questions that is not hidden.</p>
<p><strong style="font-size:20px;">Third</strong>, save the page, then view it.</p>
<h2>See the <a href="#troubleshooting">troubleshooting</a> section above for tips and problem solving.</h2>

<?php

if ( $donationmade == false ) { ?>

<form action="" method="post">
<?php wp_nonce_field( 'remove_donation_link','bg_faq_remove_donation_link' ); ?>
	<input type="checkbox" value="true" name="removedonationlink" /> If you have made a donation to support Easy FAQ With Expanding Text, check this box and click "Remove". Please only use this if you have made a donation to support the plugin.<br/>
	<button class="button-primary">Remove</button>
</form>

<?php
	}
}
	
add_action('admin_init', 'faq_admin_init');
function faq_admin_init(){
	register_setting( 'faq_settings', 'bg_faq_options');
	add_settings_section('faq_settings_section', 'FAQ Plugin Settings', 'faq_get_content_div_class', 'faq_section');
}

function faq_get_content_div_class() {
$faqoptions = get_option('bg_faq_options');

echo '<p><label><strong>One answer open at a time?</strong>';
if($faqoptions['foldup'] == "yes")
	echo "<input name='bg_faq_options[foldup]' type='checkbox' value='yes' checked /> When users open one question, do you want all other opened answers to disappear as the new answer appears? Check here for yes.";
else
	echo "<input name='bg_faq_options[foldup]' type='checkbox' value='yes' /> When users open one question, do you want all other opened answers to disappear as the new answer appears? Check here for yes.";
echo '</label></p>';
echo '<h3>Visual Cues</h3>';
echo '<p>The plugin can place a visual cue next to the questions so your readers can know to click on them. Choose a visual cue:</p>';
$visualCues = array( array('plusminus', 'Plus Sign and Minus Sign', 'plusminus.png'), array('updown', 'Up Arrow and Down Arrow', 'arrows.png'),array('plusminusWhite', 'White Plus Minus Sign', 'plusminusWhite.png'), array('updownWhite', 'White Up and Down Arrows', 'arrowsWhite.png'), array('none', 'None', 'none.png'));
foreach ( $visualCues as $cue ) {
$checked = ( $faqoptions['visualcue'] == $cue[0] ) ? ' checked="checked"' : '';
	$imgfile = plugins_url( $cue[2], __FILE__ );
	echo '<label><input type="radio" name="bg_faq_options[visualcue]" value="'.$cue[0].'" '.$checked.'>'.$cue[1].'</input><img src="'.$imgfile.'" /></label><br/>'; 
}
echo '<h3>H6 Styles</h3><p>Heading 6 is the only heading that does not receive the animated effects. Use these if you want to override the way heading 6 appear in your theme. Use valid CSS, but don not end with a semicolon!</p>';
echo '<label><input type="text" name="bg_faq_options[hsixsize]" value="'.$faqoptions['hsixsize'].'"></input>Font size. <strong>Example:</strong> 20px or 2em</label><br/>';
echo '<label><input type="text" name="bg_faq_options[hsixfont]" value="'.$faqoptions['hsixfont'].'"></input>Font family. <strong>Example:</strong> "Times New Roman",Georgia,Serif</label><br/>';
echo '<label><input type="text" name="bg_faq_options[hsixcolor]" value="'.$faqoptions['hsixcolor'].'"></input>Font Color. <strong>Example:</strong> #aaffee</label><br/>';
 }
	
add_action('do_meta_boxes', 'add_faq_check_boxes');

function add_faq_check_boxes() {
$post_types=get_post_types();
foreach ($post_types as $type) {
	add_meta_box( 'faqcheck', 'Make Animated Drop Down Text', 'make_faq_check_box', $type, 'side', 'core', 1 );
}
}

function make_faq_check_box($post) {
	wp_nonce_field( 'faq_nonce_action', 'faq_nonce_name' );
	$checked=get_post_meta($post->ID, 'make_faq_page', true);
	$checked = ($checked=='yes') ? 'checked="checked"' : '';
	$faq_shortcode_checkbox=get_post_meta($post->ID, 'make_faq_shortcode', true);
	$checked_shortcode = ( $faq_shortcode_checkbox=='yes' ) ? 'checked="checked"' : ''; 
	$foldup = get_post_meta( $post->ID, 'bgFAQfoldup', true);
	$faqoptions = get_option('bg_faq_options');
	//find out the current state of the fold up options
	if ( $foldup == 'yes' ) {
		$foldupYesChecked = ' checked';
		$foldupNoChecked = '';
		$foldupDefaultChecked = '';
	
	} elseif ($foldup == 'no') {
		$foldupYesChecked = '';
		$foldupNoChecked = ' checked';
		$foldupDefaultChecked = '';
	} else {
		if ( is_array ( $faqoptions ) ) {
			if ( array_key_exists('foldup',$faqoptions) ) {
				$foldup = $faqoptions['foldup'];
			} else {
				$foldup = 'no';
			}
		} else {
			$foldup = 'no';
		}
		$foldupYesChecked = '';
		$foldupNoChecked = '';
		$foldupDefaultChecked = ' checked';
	}
	
	//find out the current state of the visual cues options
	$visualCuesOption = get_post_meta( $post->ID, 'bgFAQvisualCue', true);
	$visualCuesOption = ( $visualCuesOption == false ) ? 'default' : $visualCuesOption;
	
	?>
	<p>If you would like to give this page an accordian-style drop-down text effect, where users click headings to reveal additional content, select one of the options below:</p>
	<p><input name="make_faq_page" type="checkbox" value="yes" <?php echo $checked; ?> ></input>Check this box if you want to apply the drop-down effect to the entire page.</p>
	<p><input name="make_faq_shortcode" type="checkbox" value="yes" <?php echo $checked_shortcode; ?> ></input> Check this box to apply the drop-down effect only to sections on the page wrapped in the shortcodes [bg_faq_start] and [bg_faq_end]</p>
	<p>Only one question open at a time? When users open one question on this page, do you want all other opened answers to disappear as the new answer appears?</p>
	<li><label><input type="radio" name="bgFAQfoldup" value="yes" <?php echo $foldupYesChecked; ?>>Yes</label><label><input type="radio" name="bgFAQfoldup" value="no" <?php echo $foldupNoChecked; ?>>No</label><label><input type="radio" name="bgFAQfoldup" value="default" <?php echo $foldupDefaultChecked; ?>>Default from plugin settings</label></li>
	<p>Do you want a visual cue on the questions on this page?</p>
	<?php  $visualCues = array( array('plusminus', 'Plus Sign / Minus Sign', 'plusminus.png'), array('updown', 'Up Arrow / Down Arrow', 'arrows.png'), array('plusminusWhite', 'White Plus Minus Sign', 'plusminusWhite.png'), array('updownWhite', 'White Up and Down Arrows', 'arrowsWhite.png'), array('none', 'None', 'none.png'), array('default', 'Default from plugin settings', 'none.png') );
	foreach ( $visualCues as $cue ) {
		$checked = ( $visualCuesOption == $cue[0] ) ? ' checked="checked"' : '';
		$imgfile = plugins_url( $cue[2], __FILE__ );
		echo '<label><input type="radio" name="bgFAQvisualCue" value="'.$cue[0].'" '.$checked.'>'.$cue[1].'</input><img src="'.$imgfile.'" /></label><br/>'; 
	}

?>	
	<?php
	
}
add_action('save_post', 'save_faq_check_box');

function save_faq_check_box($post_id) {
// verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['faq_nonce_name'], 'faq_nonce_action' ) )
      return;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data



  $faq = $_POST['make_faq_page'];
  update_post_meta( $post_id, 'make_faq_page', $faq);
  $faq_shortcode = ( isset( $_POST['make_faq_shortcode'] ) ) ? $_POST['make_faq_shortcode'] : "";
  update_post_meta( $post_id, 'make_faq_shortcode', $faq_shortcode);
  if ( isset ($_POST['bgFAQfoldup']) ) {
	update_post_meta( $post_id, 'bgFAQfoldup', $_POST['bgFAQfoldup']);
  }
  if ( isset($_POST['bgFAQvisualCue']) ) {
	update_post_meta( $post_id, 'bgFAQvisualCue', $_POST['bgFAQvisualCue']);
  }
}

add_shortcode( 'bg_faq_start' , 'bg_faq_shortcode_start' );
add_shortcode( 'bg_faq_end' , 'bg_faq_shortcode_end' );

function bg_faq_shortcode_start() {
	$foldupOptions = get_post_meta(get_the_ID(), 'bgFAQfoldup', true);
	if ( $foldupOptions == 'default' || $foldupOptions == false ) {
		$faqoptions = get_option('bg_faq_options');
		if ( is_array ( $faqoptions ) ) {
			if ( array_key_exists('foldup',$faqoptions) ) {
				$foldup = $faqoptions['foldup'];
			} else {
				$foldup = 'no';
			}
		} else {
			$foldup = 'no';
		}
	}
		else {
			$foldup = $foldupOptions;
		}
		
	return '<div data-foldup="'.$foldup.'" class="bg_faq_content_section">';
}

function bg_faq_shortcode_end() {
	return '</div>';
}



	
?>