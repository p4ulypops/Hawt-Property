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

$config['css_base'] = "../assets/css/";
$config['js_base'] = "../assets/js/";
$config['img_base'] = "../assets/img/";
$config['less_base'] = "../assets/less/";

$config['common_view'] = "/common/";
$config['page_view'] = "/pages/";

$config['common_head'] = $config['common_view']."head.php";
$config['common_foot'] = $config['common_view']."foot.php";

$config['alwaysAsset']['css'][] = array('file' => 'boiler.css', 'order' => 0);
//$config['alwaysAsset']['css'][] = array('file' => 'text.css', 'order' => 1);
//$config['alwaysAsset']['css'][] = array('file' => '960_24_col.css', 'order' => 2);

$config['alwaysAsset']['js'][] = array('file' => 'jquery.js', 'order' => 1);
$config['alwaysAsset']['js'][] = array('file' => 'site.js', 'order' => 0);
$config['alwaysAsset']['less'][] = array('file' => 'global.less', 'order' => 0);
$config['alwaysAsset']['less'][] = array('file' => 'elements.less', 'order' => 0);

$config['zoopla_apikey'] = "4jjf9ktdgx4vekc5pwbv7zgd";
$config['zoopla_apiurl'] = "http://api.zoopla.co.uk/api/v1/";

$config['cache_timeout'] = "60";