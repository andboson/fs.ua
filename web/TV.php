<!-- временно не нужен  -->
<html>
<head>
 <meta SYABAS-FULLSCREEN>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>SOVOK.TV for NMT</title>
</head>

<body>

<?php

//$fil = file_get_contents('http://sovok.tv/api.php');
// curl  -A 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5' -L -d 'channel=6' sovok.tv/api.php?channel=6
@$num=$_GET['num'];
if(is_numeric($num)){  
$data='channel='.$num;
$options = array (
        'http' => array (
         'method'=>'GET',
            'header'=>"User-Agent:Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5".
            "Content-Length:".strlen($data)." \r\n ",
            'content' => $data));

$context = stream_context_create($options);
$fp = file_get_contents('http://sovok.tv/api.php?channel='.$num, false, $context);
$out=(array)json_decode($fp);
$link=$out['url'];

echo "<br><center><H2><a vod href='".$link."'>VIEW</a></H2></center>";
exit();
}


$data='get=list';
$options = array (
        'http' => array (
         'method'=>'GET',
            'header'=>"User-Agent:Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5".
            "Content-Length:".strlen($data)." \r\n ",
            'content' => $data));

$context = stream_context_create($options);
$fp = file_get_contents('http://sovok.tv/api.php?get=list', false, $context);
$out=(array)json_decode($fp);
$out=(array)$out['list'];
echo "<ol>";
    foreach ($out as $value) {
       $val=(array)$value;
       echo "<li><a href='?num=".$val['cid']."'>".$val['name']."</a><br>";
    }
echo "</ol>";
?>
</body>

</html>