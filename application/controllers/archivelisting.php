<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archivelisting extends CI_Controller {

	/* construction */
	function __construct() { 
		parent::__construct();
		$this->load->model('zoopla');	
		$this->load->model('myobject');
	}
	
	/* Index */
	public function index()
	{
		$data = array();
		
		$data['searchterms'] = $this->session->userdata('searchterms');
		

		if ($data['searchterms'] && count($data['searchterms']) > 0) {
			foreach($data['searchterms'] as $k => $v) {
				$this->zoopla->detail($k, $v);	
			}
		} else {
			$this->zoopla->detail('keywords', 'Swimming Pool');
			$this->zoopla->detail('area', 'london');
		}
		$this->zoopla->setMode('property_listings');
		
		$this->zoopla->grabIt();
		$data['listings_in'] = $this->zoopla->getListings();
		
		// Let's save it and have our own IDs for them.
		if (isset($data['listings_in']) && count($data['listings_in']) > 0) {
			foreach($data['listings_in'] as $listing) {
					$object = $this->myobject->saveObject($listing['listing_id'], $listing);
					$data['listings'][$object['id']] = $listing;
					$data['listings'][$object['id']]['votehash'] = $object['votehash'];
			}
		}
		//print_r($data['listings']);
		//exit();
		// Save all the objects
		$this->layout->detail('page_title', "Hawt Prop");
		$this->layout->page('archive-listing', $data);
		
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */