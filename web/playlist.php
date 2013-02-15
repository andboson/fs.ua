<?php
 ini_set('max_execution_time', '0');
error_reporting(E_ALL);
$id=$_GET['list'];

$opts = array(
  'http'=>array(
    'method'=>"POST",
    'header'=>"Content-type: application/x-www-form-urlencoded\r\n User-Agent : Opera/9.80 (X11; Linux i686; U; ru) Presto/2.7.62 Version/11.00 \r\n".
    "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8 \r\n".
        "Accept-Charset:utf-8, utf-16, *;q=0.1 \r\n".
        "Accept-Encoding:identity, *;q=0"
  )
);

	$context = stream_context_create($opts);
	$url='http://fs.ua'.$id.'&flist';
	//$html = file_get_contents($url);//, false, $context);
      $html=file($url, false, $context);
	//print_r($html);

		header("Content-Type: x-foo/x-bar");
		//header("Content-Type: text/html");
		header('Content-Description: File Transfer');
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: filename="playlist.jsp"');
		foreach ($html as $item){
			echo $item."|0|0|".$item."|\n\r\n";
		 }
?>