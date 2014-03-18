<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class voter extends CI_Model
{
	
	public function saveVote($objID, $power) {
		if ($this->db->insert('vote', array('when' => time(), 'objectid' => $objID, 'power' => $power))) {
			return true;	
		} else {
			return false;	
		}
		
	}
}

?>