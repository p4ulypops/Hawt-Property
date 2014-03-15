<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');




class MY_Loader extends CI_Loader
{
	
	 function __construct()
    {
        parent::__construct();
    }

	
	// Now you can use $_DATA to get all the view's vars.
	function view($view, $vars = array(), $return = FALSE) {
		exit('hi');
		$outputVars = $this->_ci_object_to_array($vars);
		if (is_array($outputVars)) {
			foreach($outputVars as $k => $v) {
				$outputVars['_DATA'][$k] = $v;	
			}
		}
		
		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $outputVars, '_ci_return' => $return));
	}
	
	
	
}