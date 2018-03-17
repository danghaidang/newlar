<?php

function getloc($url,$nobody=0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:37.0) Gecko/20100101 Firefox/37.0');
    curl_setopt($ch, CURLOPT_HEADER,true);
    curl_setopt($ch,CURLOPT_COOKIESESSION,0);
    curl_setopt($ch, CURLOPT_NOBODY,$nobody);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
//	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_TIMEOUT,15);
    $htm=curl_exec($ch); curl_close($ch);

    preg_match('#Location:(\s*)(.+)(\r|\n|\t*)#i',$htm,$r);
    return $r[2];
}
