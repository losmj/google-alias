<?php
/**
 * the index document
 * @license GNU LGPL Ver 3.0
 * @package google-alias
 * @author celend
 * @date 14-10-15
 */
define("QUOTE", TRUE);
error_reporting(E_ALL);
require_once 'config.php';
$ch = curl_init('https://www.google.com/search?hl=zh-CN&num=10&tbs=qdr%3Ay&q='.$_GET['qqq']);

global $headers;
curl_setopt_array($ch, $headers);
$c = curl_exec($ch);
$hsize = curl_getinfo($ch, CURLINFO_HEADER_SIZE );
$h =  substr($c, 0, $hsize);
preg_match_all('`Set-Cookie:(.*)`', $h, $g);
for($i = 0; $i < count($g[1]); $i++){
    curl_setopt($ch, CURLOPT_COOKIE, $g[1][0]);
}
$c = curl_exec($ch);
$hsize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$h =  substr($c, 0, $hsize);
echo $h;
/*if(!isset($_GET['qqq'])){
    require_once 'view.class.php';
    $index = new view();
    $index->show();
}
else{
    require_once 'google_search.class.php';
    require_once 'view.class.php';
    $q = $_GET['qqq'];
    $p = isset($_GET['ppp']) ? $_GET['ppp'] : 0;
    $d = isset($_GET['ddd']) ? $_GET['ddd'] : 'y';
    $n = isset($_GET['num'])? (int) $_GET['num'] : FALSE;
    $g = new Google_search($q);
    if($n)
        $g->set_num($n);
    if($p)
        $g->set_page($p);
    if($d)
        $g->set_time_limit($d);
    $g->load();
    var_dump($g->get_results());
    echo $g->get_full_url();
}*/