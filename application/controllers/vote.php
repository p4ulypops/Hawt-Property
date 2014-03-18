<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vote extends CI_Controller {
		public function __CONSTRUCT() {
			parent::__construct();
			$this->load->model('myobject');
			$this->load->model('voter');	
		}
		
		public function index($votehash = '', $power = '') {
			$dataOut = array();
			$dataOut['error'] = "no";
			
			if ($votehash == '') {
				$votehash = $this->input->post('votehash');	
			}
			if ($power == '') {
				$power = $this->input->post('power');	
			}
			
			$dataOut['votehash'] = $votehash;
			$dataOut['power'] = $power;
			
			if (empty($dataOut['votehash']) || empty($dataOut['power'])) {
					$dataOut['message'] = "Empty Power or Hash";
			} else {
				$object = $this->myobject->grabObject('votehash', $votehash);			
				$dataOut['object'] = $object;
				//print_r($object);exit();
				if (! empty($object['id'])) {
					$datOut['object'] = $object;
						if ($this->voter->saveVote($object['id'], $power)) { 
							$dataOut['message'] = "Vote saved"; 
						} else { 
							$dataOut['message'] = "Could not save vote to DB";
						}
				} else {
					$dataOut['error'] = "yes";
					$dataOut['message'] = "Can not vote - object not found";
				}
			}
			
			
			
			echo json_encode($dataOut);
		}
	
}

?>