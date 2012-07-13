<?php

define('DEBUG_CSS', true);

// Custom class for CSS combine, improving performance and stats 
class CSS_Combine {

	public $css_files = array(
		'../../../cache/gfonts',
		'boilerplate',
		'960',
		'base',
		'wpvslider',
		'slider_styles',
		'jplayer/blue_monday/style',
		'layout',
		'default',
		'colorbox/colorbox',
		'typography',
		'wp',
		'ie',
		'../../../cache/configurable',
	);
	
	private $cdir;
	
	public function __construct() {
		$this->cdir = dirname(__FILE__).'/';
		
		if(isset($_GET['f'])) {
			
			// check if the user has the most recent version cached

			$f = (int)$_GET['f'];
  			$last_modified = gmdate('D, d M Y H:i:s', $f).' GMT';
			
			if(	(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $last_modified) ||
			    (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $f)
			   ) {
					header($_SERVER['SERVER_PROTOCOL'].' 304 Not Modified');
					exit;
			}
			   
			$css_cache = $this->cdir . '../../cache/css/'.$this->newest().'.css';
			
			$css = '';
			
			// if we have a cache of the minified css - output it
			
			if(file_exists($css_cache)) {
				$css = file_get_contents($css_cache);
			}
			
			// otherwise minify it
			else {
				require  $this->cdir . '../../wpv_common/functions/cssmin.php';
				ob_start();
				
				foreach($this->css_files as $file) {
					$fpath = $this->cdir.$file.'.css';
					if(file_exists($fpath)) {
						echo CssMin::minify(file_get_contents($this->cdir.$file.'.css'), array(
								'ConvertLevel3Properties' => true
						));
					}
				}
				
				$new_css = ob_get_clean();
				
				$this->clear_cache();
				
				file_put_contents($css_cache, $new_css); // cache the minified css
				
				$css = $new_css;
			}
			
			header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31356000).' GMT'); // 1 year from now
			header('Content-Type: text/css');
			header('Content-Length: '.strlen($css));
			header("Last-Modified: {$last_modified}");
			header("ETag: $f");
			header('Cache-Control: max-age=31356000');
			
			echo $css;
		}
	}

	// clears all cache versions
	private function clear_cache() {
		$dir = $this->cdir . '../../cache/css/';
		$css_dir = opendir($dir);
		
	    while( ($file = readdir($css_dir)) !== false ) {
	        if($file != "." && $file != "..") {
	            chmod($dir . $file, 0777);
				
	            if(is_file($dir . $file)) {
	            	unlink($dir . $file);
	            }
	        }
	    }
	    closedir($css_dir);
	}
	
	// get the most recent file's timestamp
	public function newest() {
		$newest = 0;
	
		foreach($this->css_files as $file) {
			$newest = max($newest, filemtime($this->cdir.$file.'.css'));
		}
		
		return $newest;
	}
};
$combined_css = new CSS_Combine();
