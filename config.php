<?php

$currencyName;
$currencyValue;

$contents = get_content();
$pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
preg_match_all($pattern, $contents, $out, PREG_SET_ORDER);

function get_content(){

    $link = "http://www.cbr.ru/scripts/XML_daily.asp";

    $fd = @fopen($link, "r");
    $text="";
    if (!$fd) echo "Сервер ЦБ не отвечает";
        else
    {
    while (!feof ($fd)) $text .= fgets($fd, 4096);
        fclose ($fd);
    }
return $text;
}



foreach($out as $row => $r){
    $r[3] = mb_convert_encoding($r[3], "UTF-8", "windows-1251");
    $r[4] = str_replace(",",".",$r[4]);

    if ($r[3] == "Гонконгских долларов"){
        $currencyName = $r[3];
        $currencyValue = $r[4];
    }
}


?>