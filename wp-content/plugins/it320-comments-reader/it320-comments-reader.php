<?php
   /*
   Plugin Name: IT320 Comments Reader 
   Description: plugin to read the MySQL DB comments table - WP 5.x COMPATIBLE
   Version: 1.0
   Shortcode: [it320_comments_shortcode]
   Folder: it320-comments-reader
   Author: Mr. Chase
   License: GPL2
   */
   
  add_shortcode( 'it320_comments_shortcode', 'it320_comments_reader' );

function it320_comments_reader( $attributes ) {
	
	global $wpdb;
	
	$output = "";  //The output string
	
	//
	// PLEASE NOTE
	//    comments, the is the database table name without the prefix
	//    *** YOU MUST add the prefix before the table name***
	//    ***  We will use the $wpdb object prefix value ***
	//   
	
	$tableName =   $wpdb->prefix . "comments"; 
	 
	$result = $wpdb->get_results( "SELECT * FROM $tableName");  //<-- USE WPDB PREFIX 

	$output .=  "<table border=\"1\">";
	$output .= "<tr>";
	$output .=  "<th>"  . "Comment Post ID"        . "</th>" 
		. "<th>" . "Comment Author"    . "</th>" 
		. "<th>" . "Comment Date" . "</th>" 
		. "<th>" . "Comment Content"     . "</th>";
	$output .=  "</tr>";

	foreach($result as $row)  {
	  $output .=  "<tr>";
	 
	   $output .=   "<td>" . $row->comment_post_ID . "</td>"
		  . "<td>" . $row->comment_author . "</td>"
		  . "<td>" . $row->comment_date . "</td>"
		  . "<td>" . $row->comment_content  . "</td>";
		  
	   $output .=  "</tr>";
	}

	$output .=  "</table>";
	
	return $output;
}
?>