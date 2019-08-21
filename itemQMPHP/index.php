    <?php include 'functionN.php';?>
	<?php
	$ip = $_SERVER["REMOTE_ADDR"];
    $weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
    $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip; 
    $UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';  
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_HEADER, 0);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
    curl_setopt($curl, CURLOPT_ENCODING, '');  
    curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
    $data = curl_exec($curl);
    $data = json_decode($data, true);
    $country = $data['data']['country']; 
    $region = $data['data']['region']; 
    $city = $data['data']['city'];
    header("Content-type: image/JPEG");
    $im = imagecreatefromjpeg('https://img.vim-cn.com/35/eff60058a100efd4bad62ed8f949dbec4254a5.png');  //图片链接
    $red = ImageColorAllocate($im, 255,0,0);//红色
    $font = 'msyh.ttf';//加载字体
    imagettftext($im, 12, 0, 240, 40, $red, $font,'来自'.$country.'-'.$region.'-'.$city.'的朋友');
    imagettftext($im, 12, 0, 240, 72, $red, $font, '今天是'.date('Y年n月j日')."  星期".$weekarray[date("w")]);//当前时间添加到图片
    imagettftext($im, 12, 0, 200, 100, $red, $font,'IP地址:'.$ip);//ip
    imagettftext($im, 12, 0, 200, 115, $red, $font,'系统:'.$os);
    imagettftext($im, 12, 0, 200, 130, $red, $font,'浏览器:'.$bro);
	ImageGif($im);
    ImageDestroy($im);
    ?>