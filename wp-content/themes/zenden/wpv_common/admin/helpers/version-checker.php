<?php

/*
 * very basic class that checks if the theme is the latest version
 * also gathers php/server version statisticts
 */

class Version_Checker {
	public $remote;
	public $interval;
	public $notice;
	
	public function __construct() {
		$this->remote = 'http://'.THEME_SLUG.'.vamtam.com/version.php';
		$this->interval = 2*3600;
		
		if(!isset($_GET['import']) && (!isset($_GET['step']) || (int)$_GET['step'] != 2) ) {
			add_action('admin_notices', array(&$this, 'has_new_version'));
		}
	}
	
	private function check_version() {
		$theme_data = get_theme_data(WPV_DIR . 'style.css');
		$local_version = $theme_data['Version'];
		$key = $local_version;
		
		if ( false === ($response = get_transient('wpv_ver_'.$key)) ) {
			global $wp_version;
			
			$data = array(
				'body'			=> array( 
					'theme_version' => $local_version,
					'php_version' => phpversion(),
					'server' => $_SERVER['SERVER_SOFTWARE'],
				),
				'user-agent'	=> 'WordPress/' . $wp_version . '; ' . home_url().'; ',
			);
			
			$response = wp_remote_post($this->remote, $data);
			
			set_transient( 'wpv_ver_' . $key, $response, $this->interval ); // cache
		}

		return $response;
	}
	
	public function has_new_version() {
		$response = $this->check_version();
		
		if(is_array($response) && isset($response['body'])) {
			$response = explode('\n', $response['body']);
			
			if(!empty($response[0])) {
				echo '<div id="message" class="updated fade"><p>'. $response[0]. '</p></div>';
			}
		}
	}
	
}

new Version_Checker();
