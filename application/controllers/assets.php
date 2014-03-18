<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assets extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __CONSTRUCT() {
		parent::__construct();
		$this->load->library('assetlib');	
		// Enable GZip encoding.

		// Enable caching
		header('Cache-Control: public');
		header("HTTP/1.0 200 OK");
	}
	public function index()
	{
		echo 'hi';
	}
	
	public function css($file = "") {
		
		$files = explode("----", urldecode($file));
		$output = $this->_comment("Starting JS");
		
		if (is_array($files) && count($files) > 0) {
			
			header('Content-Type: text/css');
		
			foreach($files as $f) {
				if(trim($f) !== "") { 
				$fileToLoad = $this->config->item('css_base').$f;
				
				if (is_file($fileToLoad)) 
					{
						$handle = fopen($fileToLoad, 'r');
						$output .= $this->_comment("Found File:".$fileToLoad);
						//$output .= JSMin::minify(fread($handle, filesize($fileToLoad)));
						$buffer = fread($handle, filesize($fileToLoad));
						$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
						// Remove space after colons
						$buffer = str_replace(': ', ':', $buffer);
						// Remove whitespace
						$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
 						$output .= $buffer;
						fclose($handle);
					}
				else 
					{
						$output .= $this->_comment("Lost File:".$fileToLoad);
						
					}
					}
			}
		}
		$output .= $this->_comment("Completed");
		
		echo $output;
	
	
		return true;
	}
	
	public function less($file = "") {
	
		
		$files = explode("----", urldecode($file));
		$output = $this->_comment("Starting LESS");
		
		if (is_array($files) && count($files) > 0) {
			
			header('Content-Type: text/css');
			$less = new lessc;
			$lessEntire = "";
			$logger = "";
			foreach($files as $f) {
				if(trim($f) !== "") { 
				$fileToLoad = $this->config->item('less_base').$f;
				
				if (is_file($fileToLoad)) 
					{
						$handle = fopen($fileToLoad, 'r');
						
						$logger .=  $this->_comment("Found File:".$fileToLoad);
						$lessEntire .= fread($handle, filesize($fileToLoad));
						fclose($handle);
						/*
						$handle = fopen($fileToLoad, 'r');
						$output .= $this->_comment("Found File:".$fileToLoad);
						$buffer = $less->compile(fread($handle, filesize($fileToLoad)));
						//$buffer = fread($handle, filesize($fileToLoad));
						$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)* /!', '', $buffer);
						// Remove space after colons
						$buffer = str_replace(': ', ':', $buffer);
						// Remove whitespace
						$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
 						$output .= $buffer;
						fclose($handle);
						*/
					}
				else 
					{
						$logger .=  $this->_comment("Found File:".$fileToLoad);
						
					}
					
					
					
					} // end foreach loop
					 $output = $logger.$less->compile($lessEntire);
					
			}
		}
	//	$output .= $this->_comment("Completed");
		
		echo $output;
	
	
		return true;
		
	}
	
	private function _jscomment($text) {
		return "\n console.log('\\n=========\\n ".$text."\\n=========\\n');\n";	
	}
	private function _comment($text) {
		return	"\n\n/*	=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n	=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n		".$text."\n	=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n	=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n	*/\n\n\n";	
	}
	public function js($file = "") {
		$files = explode("----", urldecode($file));
		$output = $this->_comment("Starting JS");
		
		if (is_array($files) && count($files) > 0) {
			
			header('Content-Type: application/javascript');
		
			foreach($files as $f) {
					if(trim($f) !== "") { 
			
				$fileToLoad = $this->config->item('js_base').$f;
				
				if (is_file($fileToLoad)) 
					{
						$handle = fopen($fileToLoad, 'r');
						$output .= $this->_comment("Found File:".$fileToLoad);
						$output .= $this->_jscomment("Loaded File:".$fileToLoad);
						$output .= JSMin::minify(fread($handle, filesize($fileToLoad)));
						
						fclose($handle);
					}
				else 
					{
						$output .= $this->_comment("Lost File:".$fileToLoad);
						$output .= $this->_jscomment("File Missing:".$fileToLoad);
						
					}
					}
			}
		}
		$output .= $this->_comment("Completed");
		
		echo $output;
	return true;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */