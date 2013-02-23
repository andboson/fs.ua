<html>
<head>
 <meta SYABAS-FULLSCREEN>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>MEGATV</title>
</head>

<body>

<?php
$data='get=list';
$options = array (
        'http' => array (
         'method'=>'GET',
            'header'=>"User-Agent:Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5".
            "Content-Length:".strlen($data)." \r\n ",
            'content' => $data));

$context = stream_context_create($options);
$fp = file_get_contents('http://megatv.ck.ua/menu.php', false, $context);
$arr = Array();
preg_match_all('/name":.+?"(.+?)".+?url":.+?"(.+?)"/ism',$fp,$arr);
echo "<ol>";
    foreach ($arr[1] as $key => $value) {
       echo "<li><a href='".$arr[2][$key]."' vod>".$value."</a><br>";
    }
echo "</ol>";
?>
</body>
</html>