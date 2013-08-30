<?php
ini_set('max_execution_time', '0');
error_reporting(0);
$ini = parse_ini_file("config.ini");

$opts = array(
    'http'=>array(
        'method'=>"POST",
        'header'=>"Content-type: application/x-www-form-urlencoded\r\n User-Agent : Opera/9.80 (X11; Linux i686; U; ru) Presto/2.7.62 Version/11.00 \r\n".
            "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8 \r\n".
            "Accept-Charset:utf-8, utf-16, *;q=0.1 \r\n".
            "Accept-Encoding:identity, *;q=0"
    )
);

$context  = stream_context_create($opts);

require 'nogo.php';
$fitem=$_GET['fitem'];
$rfolderitem=$_GET['folder'];
$serial=$_GET['serialfolder'];
$category=$_GET['cat'];
$category0=$_GET['cat0'];
$sbox=$_GET['sbox'];
$dl=$_GET['dl'];
$kill=$_GET['kill'];
$del=$_GET['delete'];
$mode=$_GET['mode'];
$selectSeason = $_GET['selectseason'];
$selectLangFolder = $_GET['selectlangfolder'];
$f_page = $_GET['f_page'];
$style = $_GET['style'];

$focus=explode("/",$category);
$focus= ($focus[2]) ? $focus[2]: "albums";
if($dl) $focus="play";
if($mode=="downloads") $focus="dls";

$s_value = isset($_GET['sbox']) ? $_GET['sbox'] : '';
?>
<html>
 <head>
  <meta SYABAS-FULLSCREEN>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <?php if($mode=="downloads") { ?><META HTTP-EQUIV="REFRESH" CONTENT="40"><?php } ?>
  <title>FS.UA for NMT</title>
  <style type="text/css">
  body {background-color: black; padding:0px;margin:0px;color:<?php echo $ini['text'];?>;background-repeat:no-repeat}
  a {font-size:26px;text-decoration:none;color:<?php echo $ini['acolor'];?>;}
  a:hover {text-decoration:underline}
  a.file{ font-family: Arial}
  .hiden{visibility:hidden;top:175px}
  .show2{top:0px;left:0px;height:90px;width:450px;}
  .3key {width:28px;height:24px;text-align:center;color:#fff}
  .3key:before { content: "\00a0 \00a0 " }
  .3key:after { content: "\00a0 \00a0 |" }
  td a {width:28px;height:26px;text-align:center;}
  td {color:<?php echo $ini['text'];?>;}
  .places{margin:20px}
  #stitle{padding:10px;font-size:20px;font-weight:bold;color:#000}
 </style>
  <script type="text/javascript">
//  document.write(location.hash);
  setCookie('hash',location.hash, 0);


function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}


  function foo(){
 	var oSheet = document.styleSheets[0];
      console.log(oSheet);
 	var oRule = oSheet.rules ? oSheet.rules[4] : oSheet.cssRules[4];
 			//oRule.style.visibility="hidden";
 			if (oRule.style.visibility=="hidden") { oRule.style.visibility="visible"; } else { oRule.style.visibility="hidden";}
 			return true;
    }

function stype(x){
 document.getElementById('stitle').firstChild.nodeValue=document.getElementById('stitle').firstChild.nodeValue+x.toString();
	var str=document.getElementById('stitle').firstChild.nodeValue;
	var ln=str.length;
	str=str.substr(1,ln-1);
	document.getElementById('sbox').setAttribute('value',str);
}

function dele(){
  var str=document.getElementById('stitle').firstChild.nodeValue;
  var ln=str.length;
  document.getElementById('stitle').firstChild.nodeValue=str.substr(0,ln-1);
  document.getElementById('sbox').setAttribute('value',str);
}

</script>
</head>

<body onloadset="<?php echo $focus; ?>" marginwidth=20 marginheight=20 background="img/cutbg.png" background-repeat="no-repeat" FOCUSCOLOR="#FF4F38" FOCUSTEXT="#00000" bgcolor="#302226">
<!--<br><br><a href="TV.php">TV.test</a><br>
<a href="http://tv.x-lan.net.ua:8015/1plus1" vod>TV.tes22t</a>      -->
<center>
 <form method="get" action="">



<table width="400px;" cellspacing="0" cellpadding="0" border="0"><tr>
<td width="277px" background="img/25search.jpg" style="background-repeat:no-repeat;">
<p id="stitle" >&nbsp;<?php echo $s_value;?></p></td><td align="left"><input type="image" src="img/21btn.jpg"></td>
</tr></table>
<input type="hidden" name="sbox" id="sbox" size="15" value="<?php echo $s_value;?>">

     <?php
     include_once('keys.php');
     ?>
    <br> <div class="places">
     <h3>
         <label><input type="radio" VALUE="video/films" name="style" checked="checked">Фильм</label>&nbsp;
         <label><input type="radio" VALUE="video/serials" name="style">Сериал</label>&nbsp;
         <label><input type="radio" VALUE="video/cartoons" name="style">Мультик</label>&nbsp;
         <label><input type="radio" VALUE="video/cartoonserials" name="style">Мультсериал</label>&nbsp;
         <label><input type="radio" VALUE="video/concerts" name="style">Концерт</label>&nbsp;
         <label><input type="radio" VALUE="video/tvshow" name="style">TV</label>&nbsp;
         <label><input type="radio" VALUE="albums" name="style">Альбом</label>&nbsp;
         <label><input type="radio" VALUE="soundtracks" name="style">OST</label>
         </h3>
     </div>
     <br>
</form>
</center>

<?php



if(isset($_REQUEST['sbox'])){
    search($sbox, $style);
}


///////////  search
/////////////////////////////////////////

function search($word, $style){
	global $opts;
	$context = stream_context_create($opts);
    $url='http://fs.to/'.$style.'/search.aspx?search='.$word;
	$html = file_get_contents($url, false, $context);

     echo "<br><center><h3><i >Вы искали:&nbsp;".$word."</i></h3></center>";
		$saw = new nokogiri($html);
        $u=$saw->get('table')->toArray();
    echo "<center>";
    echo '<ol>';
foreach( $u[0]['tr'] as $row){
    $item = count($row['td']) > 0 ? $row['td'][2]['a'][0] : $row[2]['a'][0];
        echo '<li><a href="index.php?fitem='.$item['href'].'&cat0='.$style.'">'.$item["#text"].'</a><hr></li>';
}
    echo '</ol>';
    echo "</center>";
}

?>
</body>
</html>

