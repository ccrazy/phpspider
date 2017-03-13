# phpspider -- PHP蜘蛛爬虫框架
《我用爬虫一天时间“偷了”知乎一百万用户，只为证明PHP是世界上最好的语言 》所使用的程序  

phpspider是一个爬虫开发框架。使用本框架，你不用了解爬虫的底层技术实现，爬虫被网站屏蔽、有些网站需要登录或验证码识别才能爬取等问题。简单几行PHP代码，就可以创建自己的爬虫，利用框架封装的多进程Worker类库，代码更简洁，执行效率更高速度更快。

demo目录下有一些特定网站的爬取规则，只要你安装了PHP环境，代码就可以在命令行下直接跑。 对爬虫感兴趣的开发者可以加QQ群一起讨论：147824717。

下面以糗事百科为例, 来看一下我们的爬虫长什么样子:

```
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
```
爬虫的整体框架就是这样, 首先定义了一个$configs数组, 里面设置了待爬网站的一些信息, 然后通过调用```$spider = new phpspider($configs);```和```$spider->start();```来配置并启动爬虫.

#### 运行界面如下:      

![](http://www.epooll.com/zhihu/pachong.gif)

更多详细内容，移步到：

[开发文档](http://doc.phpspider.org)
