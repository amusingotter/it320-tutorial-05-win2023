<?php
   /*
   Plugin Name: My Second WP Custom Plugin
   Description: WP custom plugin to deomstrate PHP Classes and object interation - GUTENBERG COMPATIABLE
   Version: 5.0
   Author: Michael X. Chase
   File: my_secondwp_custom_plugin.php
   SQL Import File: n/a
   Folder to create: my-second-wp-custom-plugin
   Short code: [my-second-wp-plugin-shortcode]
   License: GPL2
   */
   
  add_shortcode( 'my-second-wp-plugin-shortcode', 'my_second_wp_plugin_entry_point' );


function my_second_wp_plugin_entry_point ( $attributes ) {
	
	global $wpdb;
	
	$output = "";
 
 	class person {
 	    public $name;
    	public $age;

		function set_name($new_name) {
			$this->name = $new_name;
		}
		function set_age($new_age) {
			$this->age = $new_age;
		}
		function get_name() {
			return $this->name;
		}
		function get_age() {
			return $this->age;
		}

	}
	
    $person1 = new person(); 
    $person1->set_name("Stephan G. Mischhok");
	$person1->set_age(49); 

	$person2 = new person(); 
	$person2->set_name("Mike X Chase");
	$person2->set_age(60); 
	
	$person3 = new person(); 
	$person3->set_name("Bill Obenson");
	$person3->set_age(42); 

 	//Create the array variable
 	$personArray = array();

	//Use array_push to add person ojcts to the array
	//
	array_push( $personArray, $person1, $person2, $person3 );

	//Echo a statis text HTML Table Header
	//
	$output .=  '<TABLE border="2" align="left" >';

	$output .=  "<TR>";
	$output .=  '<TH align="left">' . "Name" . "</TH>";
	$output .=  "<TH>" . "Age" .  "</TH>";
	$output .=  "</TR>";
	
	//Iterate through the person object array
	//
	foreach($personArray as $obj)
	{
   	    $output .=  "<TR>";
   		//Access the object's memebr data using the get method
   		//
   		$output .=  "<TD>" .  $obj->get_name()   . "</TD>";
   		$output .=  "<TD>" .  $obj->get_age()    . "</TD>";
   		$output .=  "</TR>";
	}

	$output .=  "</TABLE>";
	
	return $output;
}
?>