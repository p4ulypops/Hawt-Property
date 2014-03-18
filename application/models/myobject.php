<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class myobject extends CI_Model
{
	function saveObject($sourceid, $objectdata) {
		
		$saveme = false;
			
		// Does this object exist and do we need to reinsert it
		
		if ($grabbed = $this->grabObject('sourceid', $sourceid)) {
			// Has this object changed?
			
			if ($grabbed['objectdata'] !== json_encode($objectdata)) {
				$saveme = true;	
			} else {
				return $grabbed;
			}
		} else {
			$saveme = true;
			
		}
		
		
		if ($saveme) {
			$this->db->insert('objects', 
				array(
					'when' => time(), 
					'sourceid' => $sourceid,
					//'sourcelocation' => $sourcelocation,
					'objectdata' => json_encode($objectdata),
					'votehash' => md5($this->config->item('encryption_key').$sourceid)
					)
			);
			return $this->db->insert_id();
		}
		
		
		
		
		return false;
	}
	
	function grabObject($key, $value) {
		$row = 
			$this
				->db
				->get_where('objects', array($key => $value), 1, 0)
				
			->row_array();
		
		return (isset($row) ? $row : false);
	}
	
}

?>