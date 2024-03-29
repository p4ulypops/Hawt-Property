<?


class Layout extends CI_Model {
	

    var $files   = array();
    var $details = array();
	
    function __construct()
    {
        parent::__construct();
		$this->files['js'] = array();
		$this->files['css'] = array();
		$this->files['less'] = array();
		$preloadedAssets = $this->config->item('alwaysAsset');
		
		// Load the CSS
		if (isset($preloadedAssets['css']) && is_array($preloadedAssets['css'])) {
			foreach($preloadedAssets['css'] as $css) {
				$this->info('css', $css['file'], $css['order']);	
			}
		}
		// Load the JS
		if (isset($preloadedAssets['js']) && is_array($preloadedAssets['js'])) {
			foreach($preloadedAssets['js'] as $js) {
				$this->info('js', $js['file'], $js['order']);	
			}
		}
		// Load the LESS
		if (isset($preloadedAssets['less']) && is_array($preloadedAssets['less'])) {
			foreach($preloadedAssets['less'] as $js) {
				$this->info('less', $js['file'], $js['order']);	
			}
		}
		
    }
    
	//
	// This is your main function to view a 'page'.
	//
	//
    function view($filename, $data = array(), $returnme = false)
    {
		$data['data'] = $data;
    	$theView = $this->load->view($filename, $data, true);
		if ($returnme) { return $theView; } else { echo $theView; }
	}
	//
	//
	// Common items - you always want to return because 
	// the header is built after the body.... so if you echo
	// then it'll appear above your <head> tag.
	//
	function common($filename, $data = array())
    {
		$data['data'] = $data;
    	$theView = $this->load->view($this->config->item('common_view').$filename, $data, true);
		return $theView; 
		
	}
	
	//
	// This is your main function to view a 'page'.
	//
	//
	
    function page($filename, $data = array(), $returnme = false)
    {

		$data['data'] = $data;
		
		$thePage = $this->view($this->config->item('page_view').$filename, $data, true); // Do this first so the elements build the header.
				
		$theHead = $this->view($this->config->item('common_head'), $data, true);
		$theFoot = $this->view($this->config->item('common_foot'), $data, true);


		$output = $theHead.$thePage.$theFoot;
		
    	//$this->view("pages/".$filename, $data);
		if ($returnme) { return $output; } else { echo $output; }
	
	}	
	
	
	//
	// Use this to set and get 'details', such as a page title or a H1 tag.
	// If the second var is blank, it'll return it (if it exists)
	// 
	function detail($key, $value = '') {
			if ($value == '') {
				if (isset($this->details[$key])) {return $this->details[$key];	 } else { return false; }
			} else {
				$this->details[$key] = $value;
				return true;
			}
	}
	
	
	
	//
	// Use this to add JS/CSS to the queue. I've still got to code in the Order bit for JS.
	//
	
	function info($type = 'css', $filename = '', $order = '') {
		if ($order == "") {
			$order = count($this->files[$type]);
			$order++;	
		}
		// IF the order exists, then we'll add one to it.
		while(isset($this->files[$type][$order])) {
			$order++;
		}
		$this->files[$type][] = array('order' => $order, 'file' => $filename);
					
	}
	
	
	//
	//
	// This will build the JS and CSS strings, it also makes sure that the same one isn't called twice.
	// - If 
	//
	function buildInfo($type = 'css') {
		$return = "";
		
		$files_in = $this->files[$type];
		$files_out = array();
		$tmpFileList = array();
		
	// Make them unique
		foreach($files_in as $k => $v) {
			if (! in_array($v['file'], $tmpFileList)) {
				$files_out[] = $v;
				$tmpFileList[] = $v['file'];
			}
		}
	// Sort them by the 'order' key.	
		uasort($files_out, array($this, "_cmp"));
		$fileString = "";
		foreach($files_out as $k => $v) {
		//	if ($type == "js") {
						$fileString .= '----'.urlencode($v['file']);							
		//	}
		//	if ($type == "css") {
		//			$return .= '<link rel="stylesheet" type="text/css" href="'.$this->config->item('css_base').$v['file'].'" data-order="'.$v['order'].'"  />'."\n";								
		//	}
		}
		
		// Build the string	
		if ($type == "js" && ! empty($fileString)) {
			$return = '<script src="/assets/js/'.$fileString.'"  /></script>'."\n";		
		}
		if ($type == "css" && ! empty($fileString)) {
			$return .= '<link rel="stylesheet" type="text/css" href="/assets/css/'.$fileString.'"   />'."\n";
		}
		if ($type == "less" && ! empty($fileString)) {
			$return .= '<link rel="stylesheet" type="text/css" href="/assets/less/'.$fileString.'"  />'."\n";
		}		
		
	// Return the data
		if (strlen($return) > 0) {
			return $return;	
		} 
		// Always return something
		return false;
	}
	
	//
	//
	// === This is a wrapper for 'view', so we can change it if need-be. 
	//
	//
	function element($file, $data = array(), $return = false, $debug = false ){
		$data['data'] = $data; // All your vars, single array, allows print_r($data);
		
		$extend = ($debug? "<!-- File: ".$file." -->" : ""); // comment this out for production.
		if (!$return) {
			$extend.$this->load->view($file, $data);	
		} else {
			return $extend.$this->load->view($file, $data);	
		}
		
	}
	
	//
	//
	// Used in the ordering of the person	
	//
	//
	function _cmp($a, $b) {
		if($a['order'] == $b['order']) { return 0; } else { 
			return ($a['order'] < $b['order'] ? -1 : 1);
		}	
	}



}

