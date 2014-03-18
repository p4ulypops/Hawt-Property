<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class assetlib
{
    public function __construct()
    {
       require_once APPPATH.'third_party/jsmin.php';
       require_once APPPATH.'third_party/less.php';
    }
	public function index() {
		echo 'assetlib loaded';	
	}

}