<?

/*
|--------------------------------------------------------------------------
| Paths and stuff
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

$config['css_base'] = "/assets/css/";
$config['js_base'] = "/assets/js/";
$config['img_base'] = "/assets/img/";
$config['common_view'] = "/common/";
$config['page_view'] = "/pages/";
$config['common_head'] = $config['common_view']."head.php";
$config['common_foot'] = $config['common_view']."foot.php";

//$config['alwaysAsset']['css'][] = array('file' => 'reset.css', 'order' => 0);
//$config['alwaysAsset']['css'][] = array('file' => 'text.css', 'order' => 1);
//$config['alwaysAsset']['css'][] = array('file' => '960_24_col.css', 'order' => 2);

$config['alwaysAsset']['js'][] = array('file' => 'jquery.js', 'order' => 0);
