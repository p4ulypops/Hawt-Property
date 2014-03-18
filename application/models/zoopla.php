<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class zoopla extends CI_Model
{
	public $urlEndpoint = "";
    public $lastURL = "";
	public $lastReturnedData = "";
	
	public $currentURL = "";
	
	public $dataProcessed = array();
	
	public $queryArray = array();
	public $zooplaMode = "property_listings";
	public function __construct()
    {
    	$this->urlEndpoint = $this->config->item('zoopla_apiurl');	
	}
	public function index() {
		//echo 'assetlib loaded';	
	}
	
	/* - Detail Setter and Getter */
				public function detail($key, $value = false) {
					
					if (! $value) {
						return (isset($this->queryArray[$key]) ? $this->queryArray[$key] : false);	
					} else {
						$this->queryArray[$key] = $value;	
					}
					
					
				}
				/* Delete */
				public function deleteDetail($key) {
					if ($key == "RESETMODE") { $this->queryArray = array(); } 
					elseif (isset($this->queryArray[$key])) { unset($this->queryArray[$key]); return true; } 
					else { return false; }
				}
	/* - Mode Setter */
	public function setMode($mode = "property_listings") {
		
		if (in_array($mode, array(
			'zed_index', 'richlist', 'average_area_sold_price', 
			'zed_indices', 'average_sold_prices', 'property_listings', 
			'get_session_id', 'refine_estimate', 'arrange_viewing',
			'property_historic_listings', 'geo_autocomplete'))) 
			{
				$this->zooplaMode = $mode;	
			} else {
				return false;	
			}
	}
	/* Function get Get Stuff (tm) */
	public function grabIt() {
		$this->_buildURL();
		$this->_grabData();
		$this->_proccessData();
	}
	
	public function getListings() {
		if (isset($this->dataProcessed['listing'])) {
			return $this->dataProcessed['listing'];
		}
	}
	
	
	private function _proccessData() {
		if (! empty($this->lastReturnedData)) {
			$this->dataProcessed = 	obj2arr(json_decode($this->lastReturnedData));
		}
	}
	private function _grabDataForceCache() {
		$url = $this->currentURL;
		
		$cache = $this->db
			->select('result')
			->from('api_cache')
			->where('url', $url)
			->get()->row_array();		
		if (! empty($cache)) {
			$this->lastURL = $url;
			$this->lastReturnedData = $cache['result'];
			return $cache['result'];	
		}
		return false;
	}
	/* DoesWhatItSaysOnTheTin */
	private function _grabData($return = false) {
		
		$url = $this->currentURL;
		// Is there a cache for this?
		$cache = $this->db
			->select('result')
			->from('api_cache')
			->where('url', $url)
			->where('when > ', time() - $this->config->item('cache_timeout'))
			->get()->row_array();
			
		if (! empty($cache)) {
			$this->lastURL = $url;
			$this->lastReturnedData = $cache['result'];
			return $cache['result'];	
		}
		// No cache? Let's trab it.
		
		if (@$result = file_get_contents($url)) {
			$this->lastURL = $url;
			$this->lastReturnedData = $result;
			$this->db->insert('api_cache', array('url' => $url, 'result' => $result, 'when' => time()));
			if ($return) { return $result;	 } else { return true; }
		} else {
			// Oh no, we can't even grab it, let's see if we have a copy.	
			if ($backup = $this->_grabDataForceCache()) {
				$this->lastReturnedData = $backup;
				if ($return) { return $backup;	 } else { return true; }
			}
		}
		return false;	
	}
	
		/* DoesWhatItSaysOnTheTin */
	private function _buildURL($return = false) {
		$a = $this->queryArray;
		if (!isset($a['api_key'])) { $a['api_key'] = $this->config->item('zoopla_apikey'); }
		
		$return = $this->urlEndpoint.$this->zooplaMode.".json?1=1"; 
		foreach($a as $k => $v ) {
			$return .= "&".urlencode($k)."=".urlencode($v);
		}
		
		//exit($return);
		if ($return) { $this->currentURL = $return; } else { return $return;}
		
		
	}

}