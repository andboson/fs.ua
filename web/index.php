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

$focus=explode("/",$category);
$focus= ($focus[2]) ? $focus[2]: "albums";
if($dl) $focus="play";
if($mode=="downloads") $focus="dls";
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
  .hiden{visibility:hidden;top:175px}
  .show2{top:0px;left:0px;height:90px;width:450px;}
  .3key {width:28px;height:24px;text-align:center;color:#fff}
  .3key:before { content: "\00a0 \00a0 " }
  .3key:after { content: "\00a0 \00a0 |" }
  td a {width:28px;height:26px;text-align:center;}
  td {color:<?php echo $ini['text'];?>;}
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
<form method="get" action="index.php">
<?php if($ini['simple_search'] != 1 ) { ?>
<table width="400px;" cellspacing="0" cellpadding="0" border="0"><tr>
<td width="277px" background="img/25search.jpg" style="background-repeat:no-repeat;">
<p id="stitle" >&nbsp;</p></td><td align="left"><input type="image" src="img/21btn.jpg"></td>
</tr></table>
<input type="hidden" name="sbox" id="sbox" size="15">
<?php } else { ?>
   <div id="keyb">
      <input type="text" name="sbox" size="15" />
    </div>
     <div id="sdiv"><input type="submit" value="Поиск"></div>
<?php } ?>
</form>
 <?php
 if($ini['simple_search'] != 1 ) include('keys.php');
?>
</center>

<div style="padding:35px 60px;">
  <?php if(isset($ini['login'])) { ?>
    <h5><img src="img/favor.png" style="vertical-align:middle">
        <a href="?mode=favor">Избранное</a>&nbsp;
        <a href="?mode=favor&f_page=inprocess">В процессе</a>&nbsp;
        <a href="?mode=favor&f_page=recommended">Рекомендуемое</a>&nbsp;
        <a href="?mode=favor&f_page=forlater">На будущее</a>
    </h5>
   <?php } ?>
   <div class="b-subcategories">
      <h2><img src="img/vbg.png" style="vertical-align:middle">
        <a href="?cat=/video/films/?sort=new" name="films">Фильмы</a>&nbsp;
        <a href="?cat=/video/serials/?sort=new" name="serials">Сериалы</a>&nbsp;
        <a href="?cat=/video/cartoons/?sort=new" name="cartoons">Мультфильмы</a>&nbsp;
        <a href="?cat=/video/cartoonserials/?sort=new" name="cartoonserials">Мультсериалы</a>&nbsp;&nbsp;
        <a href="?cat=/video/tvshow/?sort=new" name="tvshow">Передачи</a>&nbsp;
        <a href="?cat=/video/clips/?sort=new" name="clips">Клипы</a></h2>
    </div>
 <div class="b-subcategories"><h3><img src="img/abg.png" style="vertical-align:middle">
      <a href="?cat=/audio/albums/?sort=new" name="albums">Альбомы</a>&nbsp;
      <a href="?cat=/audio/collections/?sort=new" name="collections">Сборники</a>&nbsp;
      <a href="?cat=/audio/soundtracks/?sort=new" name="soundtracks">Саундтреки</a>&nbsp;
      <a href="?cat=/video/concerts/?sort=new" name="concerts">Концерты</a><img src="img/dlbg.png" style="vertical-align:middle">&nbsp;&nbsp;<a href="?mode=downloads" name="dls">закачки</a>
     </h3>
  </div>
</div>
<?php
/////// избранное
if ($mode == 'favor'){

    $postdata = http_build_query(
        array(
            'login' => $ini['login'],
            'passwd' => $ini['password']
        )
    );

    $opts = array(
        'http'=>array(
            'method'=>"POST",
            'header'=>"Content-type: application/x-www-form-urlencoded\r\n User-Agent : Opera/9.80 (X11; Linux i686; U; ru) Presto/2.7.62 Version/11.00 \r\n".
                "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8 \r\n".
                "Accept-Charset:utf-8, utf-16, *;q=0.1 \r\n".
                "Accept-Encoding:identity, *;q=0",
            'content' => $postdata
        )
    );

    $context  = stream_context_create($opts);
    $result = file_get_contents('http://fs.ua/login.aspx', false, $context);
    $coo = Array();
    foreach( $http_response_header as $head){
        if(stristr($head, 'Set-Cookie:' )) $coo[] = (str_ireplace('Set-Cookie:', '', $head ));
    }
    $coo = implode('; ',$coo);

    $opts = array(
        'http'=>array(
            'method'=>"POST",
            'header'=>"Content-type: application/x-www-form-urlencoded\r\n User-Agent : Opera/9.80 (X11; Linux i686; U; ru) Presto/2.7.62 Version/11.00 \r\n".
                "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8 \r\n".
                "Accept-Charset:utf-8, utf-16, *;q=0.1 \r\n".
                "Accept-Encoding:identity, *;q=0 \r\n".
                "Cookie: ".$coo,
            'content' => $postdata
        )
    );

    $context  = stream_context_create($opts);
    $result = file_get_contents('http://fs.ua/myfavourites.aspx?page='.$f_page, false, $context);
    /// разделы
    $arr = Array();
    preg_match_all('/b-category(.+?)m-in-load/ism',$result,$arr);

    //содержимое
    $arrR = Array();
    foreach( $arr[0] as $razdel ){
        $arrHead = Array();
        preg_match_all('/m-themed(.+?)item\s(.+?)"(.+?)<b>(.+?)<\/b/ism',$razdel,$arrHead);
        $category_id = $arrHead[2][0];
        echo "<h2>".$arrHead[4][0]."</h2>";
        $is_serial = stristr($category_id, "seri") || stristr($category_id, "tvshows") ? true :false;
        preg_match_all('/item\/(.+?)"(.+?)b-poster-thin(.+?)<span>(.+?)<p/ism',$razdel,$arrR);
        echo "<ol>";
            foreach( $arrR[1] as $key => $id){
                $name = $arrR[4][$key];
                $serial_mode = '&cat0='.$category_id;
                echo "<li>";
                echo "<a href='?fitem=/item/".$id.$serial_mode."'>".$name."</a>";
                echo "</li>";
            }

         echo "</ol>";
    }
  exit();
}

if($del) {  /// удалить файл
	unlink($del);
}

if($mode=="downloads") { ///просмотр скачанных файлов
   downloadlist();
   exit ();
}

if($kill){    //// убить закачку и файл лога
	$name=$_GET['name'];
	exec("kill ".$kill,$ret);
	echo "<center><h3>";
	echo $ret[0];
	echo "</h3></center>";
	unlink($name);
	unlink(substr($name,0,strpos($name,".log")));
}

if($dl){  // качаем урл
	$log=$ini['save_dir'].strrchr($dl,"/").".log"; //имя файла
	//echo "wget -c --output-file=".$log." --directory-prefix=".$ini['save_dir']." -b \"".$dl."\"";
	exec("wget -c --output-file=\"".$log."\" --directory-prefix=".$ini['save_dir']." -b \"".$dl."\"",$ret);
	do{
	$logcontent = file_get_contents($log);
	if (strripos($logcontent,"Saving to")) break;
	}while(strripos($logcontent,"Connecting"));

    $pid=strrchr($ret[0],"pid");
    $pid=substr($pid,4,-1);
    $pid = ( int ) trim($pid);
       exec('echo '.$pid.' > '.$ini['save_dir'].strrchr($dl,"/").'.pid');
        echo "<br><h3 style='color:white;'><center>";
	$video=$ini['url_save_dir'].'/'.strrchr($dl,"/");//substr($log,0,strpos($log,".log"));
	echo "<h3><b>Файл: ".strrchr($dl,"/")."</b></h3>";
	echo "<a name='play' href='".$video."' vod>[Начать просмотр]</a>";
	echo "&nbsp;<a href='?kill=".$pid."&name=".$log."'>[Прервать закачку]</a>";
	echo "</center></h3>";
	exit();
}


$r = mt_rand(0, 10000000000);
$r = $r / 10000000000;

if (isset($sbox)){      // вывод результата поиска
    search($sbox);
    exit();
  }


if (isset($serial)){  // папка сезона сериала
    getfolder($serial);
    exit();
  }

if (isset($folderitem)) {    //  содержимое корневой папки
	getitem($folderitem);
    exit();
    }

if (isset($fitem)){
    //echo ">>>".$fitem;
	if (stristr ($category0,"ser") || stristr ($category0,"show")){
		getserial($fitem); // папка сезонов сериала
		exit();
	}

   $id = substr($fitem,stripos($fitem,'/',1) + 1);
    getSeasonFolder($fitem, $r, $id , '0');
    //getfolder($fitem);     /// содержимое папки
    exit();
  }


if(isset($selectSeason)){
    getSeasonFolder($selectSeason, $_GET['r'],$_GET['id'],$_GET['folder']);
    exit();
}

if(isset($selectLangFolder)){
    getLangFolder($selectLangFolder, $_GET['folder']);
    exit();
}


//// содержимое категории
if (isset($category)){
	$currentpage = ($_GET['page']) ? '&page='.$_GET['page'] : '';
	$html = file_get_contents('http://fs.ua'.$category.$currentpage, false, $context);
	$saw = new nokogiri($html);
    $u=$saw->get('a.subject-link')->toArray();
    $pager=$saw->get('div.b-pager')->toArray();
    pages($pager);
    echo '<ul>';
    for ($i=0;$i<count($u);$i++){
	echo '<li><a href="?fitem='.$u[$i]['href'].'&cat0='.$category.'">'.$u[$i]["span"][0]["#text"].'</a></li>';
	}
	echo '</ul>';
	pages($pager);
}

function pages($pager){
	echo "<br><center>";
     $pagelist=$pager[0]['div']['ul']['li'];
    foreach($pagelist as $page){     /// echo pages
        $b1=""; $b2="";
    	if($page['a']['class']=='selected') { $b1="<b>["; $b2="]</b>"; }
    	$text = ($page['a']["#text"]) ? $page['a']["#text"] : $page['a']['b'][0]["#text"];
    	echo $b1.'&nbsp;<a href="?cat='.$page['a']["href"].'">'.$text.'</a>&nbsp;'.$b2;
    }
    echo "</center>";
}

/// папка сезонов сериала
function getserial($id){
   $id = substr($id,stripos($id,'/',1) + 1);
	global $opts, $r, $category0;
	$context = stream_context_create($opts);
    $folder = 0;
    $req = $id.'?ajax&r='.$r.'&id='.$id.'&folder='.$folder;
	$url='http://fs.ua/item/'.$req;
    $html = file_get_contents($url, false, $context);
    $arr = Array();
    preg_match_all('/fl(\d+)(.+?)\<b\>(.+?)\<\/b\>/ism',$html,$arr);
echo "<ol>";
    foreach( $arr[1] as $key => $value){
      $name = $arr[3][$key];
    echo "<li>";
        echo "<a href='?selectseason=".$req.$value.'&cat0='.$category0."'>".$name."</a>";
     echo "</li>";
    }

 echo "</ol>";
}


///// содержимое папки сезона
function getSeasonFolder($item, $r, $id, $folder){
    global $context, $category0;
    $req = $id.'?ajax&r='.$r.'&id='.$id.'&folder='.$folder;
    $url='http://fs.ua/item/'.$req;
    $html = file_get_contents($url, false, $context);
    $arr = Array();
    preg_match_all('/ name="fl(\d+)".+?>(.+?)<\/a>.+?material-size">([\d]+.[\d]+.+?)<.+?material-details">(.+?)</ism',$html,$arr);

    $plisttype='vod="playlist"';
    if(strstr($category0,"aud") || strstr($category0,"sound")){
        $plisttype='pod="2,1,http://andboson.net/ex/panda.php?'.time().'"';
    }
    echo "<ol>";
    foreach( $arr[1] as $key => $value){
        $name = $arr[3][$key];
        $plistlink= "http://fs.ua/flist/".$id."?folder=".$value;
        echo "<li>";
        echo "<a href='?selectlangfolder=".$id."&folder=".$value."'>".$arr[2][$key];
        echo " ".$arr[3][$key]." ".$arr[4][$key]."</a>";
        echo '&nbsp;&nbsp;<a '.$plisttype.' href="playlist.php?list='.$plistlink.'"><small>[играть все]</small></a>';
        echo "</li>";
    }
    echo "</ol>";
}

///содержимое языковой папки
function getLangFolder($id, $folder){
    global $context, $ini;;
    $req = $id.'?folder='.$folder;
    $url='http://fs.ua/flist/'.$req;
    $html = file_get_contents($url, false, $context);
    $files = explode("\r\n", $html);
    //echo $html;
    echo '<ol>';
    foreach($files as $onefile){
        if( strlen($onefile) < 20 ) continue;
        $del=$ini['save_dir'].strrchr($onefile,"/");
        $filename = substr($onefile, strripos($onefile, '/') +1 );
        $downornot = (file_exists($ini['save_dir'].strrchr($onefile,"/"))) ? '<a href="?delete='.$del.'&folder='.$filename.'">[удалить]</a>&nbsp;<a vod href="'.$onefile.'">[играть]</a>' : '<a href="?dl='.$onefile.'">[скачать]</a>';
        echo '<li><a vod href="'.$onefile.'">'.$filename.'</a>&nbsp;&nbsp;&nbsp;'.$downornot.'</li>';
    }
    echo '</ol>';
}


///////////  search
/////////////////////////////////////////

function search($id){
	global $opts;
	$context = stream_context_create($opts);
	$path="none";
if (is_numeric($id)){  /////search by material id
	$types=Array('/video/films/i'); //,'/video/serials/i','/video/cartoonserials/i','/video/tvshow/i','/video/clips/i','/audio/albums/i',
//	'/audio/collections/i','/audio/soundtracks/i','/video/concerts/i');
	  foreach($types as $type){
	    $get="";
      	$url='http://fs.ua'.$type.$id;
		$html = file_get_contents($url);//, false, $context);
		$saw = new nokogiri($html);
		$u=$saw->get('a.b-files-folders-link')->toArray();
        $path = substr($u['href'],0,strpos($u['href'],"/i"));
		$path = $path."/i";
	  }

  // echo $path.$id;
    if (stristr ($path,"ser") || stristr ($path,"show")){
		getserial($path.$id);
		exit();
	}

	if ($path!="none") {
		echo "<br><center><h3><i>Вы искали:&nbsp;".$id."</i></h3></center>";
		getfolder($path.$id);
		} else {
		   echo "<center><h3><i>".$id."</i></h3></center>";
			echo "<center><h3>Ничего не нашлось</h3></center>";
		}
} else {  ////// search by text
      echo "<br><center><h3><i >Вы искали:&nbsp;".$id."</i></h3></center>";
      	$url='http://fs.ua/search.aspx?search='.$id;
      	//echo $url;
      	$html = file_get_contents($url);//, false, $context);
		$saw = new nokogiri($html);
		$u=$saw->get('a.title')->toArray();
		$type=$saw->get('span.section')->toArray();
        echo "<center><table >";
        for($i=0;$i<count($u);$i++){
	      echo  '<tr><td ><i>'.$type[$i]["#text"].'</i><hr></td><td><a  href="?fitem='.$u[$i]["href"].'">'.$u[$i]["#text"].'</a><hr></td></tr>';
        }
        echo "</table></center>";
	}

}

////////////////  текущие и законченные закачки
/////////////////////////////////////////////////
function downloadlist(){
    global $ini;
    $handle = opendir($ini['save_dir']);
    if($_GET['deleteall']){
    $dfile=$_GET['deleteall'];
    $pid = (int)trim( file_get_contents($ini['save_dir']."/".$dfile.'.pid') );
    //exec("kill  $(ps  |grep ".$dfile."| grep -v grep | awk '{print $1}') >".$ini['save_dir']."/11111.txt");
    exec("kill ".$pid);
    unlink($ini['save_dir']."/".$dfile);
    unlink($ini['save_dir']."/".$dfile.".log");
    unlink($ini['save_dir']."/".$dfile.".pid");
    }
    echo "<center><h2>Все закачки:</h2><table width='60%'>";
    while (false !== ($rfile = readdir($handle))) {
        //echo "$file\n";
        $file = $ini['save_dir'].'/'.$rfile;
        $logfile = $file.".log";
       // echo "<br>".$logfile;
        if (file_exists($logfile)) {
            $data = file($logfile);
            $line = $data[count($data)-2];
            if(stristr($line,"saved")) $percent="100%";
            if(stristr($line,"%")) $percent = substr($line, stripos($line,"%")-3,4);
            $buttons = '<!--<a vod href="'.$ini['url_save_dir'].'/'.$rfile.'"><img src="img/y.png"></a>&nbsp;--><a href="?mode=downloads&deleteall='.$rfile.'"><img src="img/x.png"></a>';
           echo "<tr><td style='word-wrap:break-word;'><a vod href=\"".$ini['url_save_dir']."/".$rfile."\">".$rfile."</a><hr></td><td align='center'>&nbsp;".$percent."&nbsp;<hr></td><td width='130px'>".$buttons."</td></tr>";

        }
    }
    echo "</table></center>";
    closedir($handle);
}
?>
</body>
</html>

