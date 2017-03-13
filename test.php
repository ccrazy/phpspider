<?php
ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/core/init.php';
$html = requests::get("http://cpc.people.com.cn/gbzl/flcx.html");
$data = selector::select($html,"/html/body/div[3]/div/div[1]/table/tr/td/a/@href");
$data = array(1);
foreach ($data as $href) {
    // $href = "http://cpc.people.com.cn/gbzl/html/".substr($href,12).".html";
    $href = "http://cpc.people.com.cn/gbzl/html/121000574.html";
    $resume = requests::get($href);
    $dr = array(
        "dname" =>selector::select($resume,"/html/body/div[4]/div[2]/div[1]/strong"),
        "position" =>selector::select($resume,"/html/body/div[4]/div[2]/div[1]/p"),
        "birth" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[1]/text()"),
        "sex" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[2]/text()"),
        "hometown" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[3]/text()"),
        "nation" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[4]/text()"),
        "college" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[5]/text()"),
        "education" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[6]/text()"),
        "partytime" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[7]/text()"),
        "worktime" =>selector::select($resume,"/html/body/div[4]/div[2]/ul/li[8]/text()"),
        "experience" =>selector::select($resume,"/html/body/div[4]/div[2]/p"),
    );
    // file_put_contents("data.txt",var_export($dr,true));
    // exit;
    db::insert("resume", $dr);
}

   


