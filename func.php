<?php
    function crul($url,$post=false)
    {
    $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($ch, CURLOPT_POST, $post ? true : false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post ? $post : false);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $icerik = curl_exec($ch);
	$redirectURL = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL );

	//$icerik = iconv('ISO-8859-9','UTF-8',$icerik); 
	//$icerik=turkish($icerik);
    curl_close($ch);
    return $icerik;
    }
	
	function proxy_curl($url){
	$proxies=file_get_contents("http://pubproxy.com/api/proxy");
	$proxies= json_decode($proxies);
	$proxy=$proxies->data;
	$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_PROXY, $proxy[0]->ipPort);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($ch, CURLOPT_POST, $post ? true : false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post ? $post : false);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $icerik = curl_exec($ch);
	//$icerik = iconv('ISO-8859-9','UTF-8',$icerik); 
	//$icerik=turkish($icerik);
    curl_close($ch);
    return $icerik;
	}
	
	function ara($bas, $son, $yazi)
{
   @preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/si', $yazi, $m);
    return @$m[1];
} 


function turkish($string){
$replace  = array('i', 's', 'o', 'c', 'g', 'u', 'I', 'G', 'O', 'C', 'S', 'U');
$search = array('ı', 'ş', 'ö', 'ç', 'ğ', 'ü', 'İ', 'Ğ', 'Ö', 'Ç', 'Ş', 'Ü');
return str_replace($search,$replace,$string);
}

	?>