<?php 
/** 
	* Plugin Name: Form Filter
*/
include 'FormFilterSettings.php';

class FormFilter {
	public function __construct() {
		add_action( 'the_content', array($this, 'say_hello' ) );
	}
	public function say_hello() {
		echo '<h1>Hello!!!</h1>';
	}
}

new FormFilter();

?>