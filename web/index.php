<?php
ini_set('max_execution_time', '0');
error_reporting(0);
if( file_exists('config2.ini')){
    $ini = parse_ini_file("config2.ini");
} else {
    $ini = parse_ini_file("config.ini");
}


if( !isset($ini['use_login'])){
    $login = $ini['login'][0];
    $password = $ini['password'][0];
} else {
    $login = $ini['login'][$ini['use_login']];
    $password = $ini['password'][$ini['use_login']];
}

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
$selectQualityFolder = $_GET['selectqualityfolder'];
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
        a.file{ font-family: Arial}
        .hiden{visibility:hidden;top:175px}
        .show2{top:0px;left:0px;height:90px;width:450px;}
        .3key {width:28px;height:24px;text-align:center;color:#fff}
        .3key:before { content: "\00a0 \00a0 " }
        .3key:after { content: "\00a0 \00a0 |" }
        td a {width:28px;height:26px;text-align:center;}
        td {color:<?php echo $ini['text'];?>;}
        #stitle{padding:10px;font-size:20px;font-weight:bold;color:#000}
        a.conf{ font-size: 14px; color:<?php echo $ini['text'] ?>; }
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

    <div id="sdiv"><a href="search.php"><img src="img/21btn.jpg"></a></div>

</center>
<div style="padding:35px 60px;">
    <?php if(isset($ini['login']) || isset($ini['login'][0])) { ?>
        <h5><img src="img/favor.png" style="vertical-align:middle">
            <a href="?mode=favor">Избранное</a>&nbsp;
            <a href="?mode=favor&f_page=inprocess">В процессе</a>&nbsp;
            <a href="?mode=favor&f_page=irecommended">Рекомендую</a>&nbsp;
            <a href="?mode=favor&f_page=forlater">На будущее</a>&nbsp;&nbsp;
            <?php if( isset($login) ) {?><a class="conf" href="config.php">[<?php echo $login ?>]</a><?php } ?>
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
            'login' => $login,
            'passwd' => $password
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
    $result = file_get_contents('http://'.$ini['url'].'/login.aspx', false, $context);
    $coo = Array();
    foreach( $http_response_header as $head){
        if(stristr($head, 'Set-Cookie:' )) $coo[] = (str_ireplace('Set-Cookie:', '', $head ));
    }
    $coo = implode('; ',$coo);

    $opts = array(
        'http'=>array(
            'method'=>"POST",
            'header'=>"Content-type: application/x-www-form-urlencoded\r\n User-Agent : Opera/10.80 (X11; Linux i686; U; ru) Presto/2.7.62 Version/11.00 \r\n".
            "Accept-Language: ru-RU,ru;q=0.9,en;q=0.8 \r\n".
            "Accept-Charset:utf-8, utf-16, *;q=0.1 \r\n".
            "Accept-Encoding:identity, *;q=0 \r\n".
            "Cookie: ".$coo,
            'content' => $postdata
        )
    );

    $context  = stream_context_create($opts);
    $result = file_get_contents('http://'.$ini['url'].'/myfavourites.aspx?page='.$f_page, false, $context);
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
       // preg_match_all('/item\/(.+?)"(.+?)b-poster-thin(.+?)<span>(.+?)<p/ism',$razdel,$arrR);
        preg_match_all('/href="\/(.+?)".+?b-poster-thin.*?\<span>(.+?)<\/span/ism',$razdel,$arrR);
      //  echo "<pre>";print_R($arrR);
        echo "<ol>";
        foreach( $arrR[1] as $key => $id){
            $name = $arrR[4][$key];
            $name = $arrR[2][$key];
            $serial_mode = '&cat0='.$category_id;
            echo "<li>";
           // echo "<a href='?fitem=/item/".$id.$serial_mode."'>".$name."</a>";
            echo "<a href='?fitem=/".$id.$serial_mode."'>".str_ireplace(array('<p>', '</p>'), array(' '), $name)."</a>";
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


if (isset($fitem)){
    if (stristr ($category0,"ser") || stristr ($category0,"show")){
        getserial($fitem); // папка сезонов сериала
        exit();
    }

    $id = $fitem;//substr($fitem,stripos($fitem,'/',1) + 1);
    getSeasonFolder($fitem, $r, $id , '0');
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

if(isset($selectQualityFolder)){
    getQualityFolder($selectQualityFolder, $_GET['folder'], $_GET['quality'] );
    exit();
}


//// содержимое категории
if (isset($category)){
    $currentpage = ($_GET['page']) ? '&page='.$_GET['page'] : '';

    if(!isset($_GET['page'])){
        $html = file_get_contents('http://'.$ini['url'].''.$category.$currentpage, false, $context);
    } else {
        $perpage = 15;
        $start = $_GET['page'] * $perpage;
        $html = file_get_contents('http://'.$ini['url'].''.$category.'&scrollload=1&view=list&start='.$start.'&length='.$perpage.'&_='.$currentpage, false, $context);
        $html = stripcslashes($html);
    }

    pages();
    preg_match_all('/b-poster-tile.+?href=\"(.+?)".+?_title-short">(.+?)</ism', $html, $result);
    echo '<ul>';

    foreach ($result[1] as $key=>$href){
        $name = str_ireplace("Смотреть", "", $result[2][$key]);
        $name = str_ireplace("онлайн", "", $name);
        echo '<li><a href="?fitem='.$href.'&cat0='.$category.'">'
        .$name.'</a></li>';
    }
    echo '</ul>';
    pages();
}

function pages(){
 echo "<center>";
   $currPage = isset($_GET['page']) ? $_GET['page'] : 0;

    for($i = -5; $i<6; $i++){
        $pageItem = $currPage + $i;
        if( $pageItem < 0 ) continue;

       $pageStr = $_SERVER['HTTP_HOST'] . preg_replace('/page=(\d+)/i', 'page=' . $pageItem, $_SERVER['REQUEST_URI']);
       if( !isset($_GET['page'])){
           $pageStr = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&page=' . $pageItem;
       }

        if($i==0){
           echo '&nbsp;<big><big>['. ($currPage + 1) .']</big></big>&nbsp;';
       } else{
           echo '&nbsp;<a href="http://'.$pageStr.'">'.($pageItem+1).'</a>&nbsp;';
       }
    }
    echo '<form action="" method="GET" style="display:inline;">
    <input type="hidden" value="'. htmlentities( $_GET['cat'] ).'" name="cat">
    <input type="text" value="" name="page" size="2" style="width:30px;">
    <input type="submit" value=">>">
    </form>';
    echo "</center>";
}

/// папка сезонов сериала
function getserial($id){
    //$id = substr($id,stripos($id,'/',1) + 1);
    global $opts, $r, $category0, $ini;
    $context = stream_context_create($opts);
    $folder = 0;
    $req = $id.'?ajax&r='.$r.'&id='.$id.'&folder='.$folder;
    $url='http://'.$ini['url'].''.$req;
    $html = file_get_contents($url, false, $context);
    $arr = Array();
    preg_match_all('/fl(\d+)(.+?)\<b\>(.+?)\<\/b\>/ism',$html,$arr);
    $resinfo = getposter($id);
    echo "<br><center><h1>".$resinfo['name']."</h1></center>";
    echo "<table cellpadding='10'><tr><td>";
    echo "<img src='". $resinfo['img']. "' >";
    echo "</td><td valign='top'>";
    echo "<ol>";
    foreach( $arr[1] as $key => $value){
        $name = $arr[3][$key];
        echo "<li>";
        echo "<a href='?selectseason=".$req.$value.'&cat0='.$category0."'>".$name."</a>";
        echo "</li>";
    }
    echo "</ol>";
    echo "</td></tr></table>";
}


///// содержимое папки сезона или фильма
function getSeasonFolder($item, $r, $id, $folder){
    global $context, $category0, $ini;
    $req = $id.'?ajax&r='.$r.'&id='.$id.'&folder='.$folder;
    $url='http://'.$ini['url'].''.$req;
    $html = file_get_contents($url, false, $context);
    $arr = Array();
    preg_match_all('/ name="fl(\d+)".+?link-subtype(.+?)title.+?>(.+?)<\/a>/ism',$html,$arr);
    $plisttype='vod="playlist"';
    if(strstr($category0,"aud") || strstr($category0,"sound") || strstr($category0,"album")){
        $plisttype='pod="2,1,http://andboson.net/ex/panda.php?'.time().'"';
    }
    $resinfo = getposter($id);
    echo "<br><center><h1>".$resinfo['name']."</h1></center>";
    echo "<table cellpadding='10'><tr><td>";
    echo "<img src='".$resinfo['img']."' />";
    echo "</td><td valign='top'>";
    echo "<ol>";

    preg_match_all('/(\w+?)-/imsU', $id,  $resId);
    $pureId = $resId[1][0];
    foreach( $arr[1] as $key => $value){
        $name = $arr[3][$key];
        $plistlink= "http://".$ini['url']."/flist/".$pureId."?folder=".$value;
        echo "<li>";
        echo "<a class='file' href='?selectlangfolder=".$id."&folder=".$value."'>";
        echo "<img style='vertical-align:middle;matgin-top:-10px;' src='img/".substr(trim($arr[2][$key]),2).".png'>";
        echo " ".$arr[3][$key]." ".$arr[4][$key]." ".$arr[5][$key]."</a>";
        //echo '&nbsp;&nbsp;<a '.$plisttype.' href="playlist.php?list='.$plistlink.'"><small>[играть все]</small></a>';
        echo "</li>";
    }
    echo "</ol>";
    echo "</td></tr></table>";
}

///содержимое языковой папки - озвучка
function getLangFolder($rawid, $folder)
{
    global $context, $ini;
    $resinfo = getposter($rawid);
    preg_match_all('/.*\/(.+?)-/ims', $rawid, $result);
    $id = $result[1][0];
    $req = $id . '?folder=' . $folder;
    $url = 'http://' . $ini['url'] . '/' . $id . '?ajax&folder=' . $folder;
    $html = file_get_contents($url, false, $context);
    preg_match_all('/parent_id:\s\'(.+?)\'.+?quality_list:\s\'(.+)\'.+?>(.+?)<\/a/i',$html,$arr);

    echo "<br><center><h1>".$resinfo['name']."</h1></center>";
    echo "<table cellpadding='10'><tr><td valign='top'>";
    echo "<img src='". $resinfo['img'] . "' >";
    echo "</td><td valign='top'>";
    echo '<ol>';
    foreach($arr[3] as $key => $dubleName){
        echo "<li>$dubleName";
        $folder = $arr[1][$key];
        $qualityList = explode(',', $arr[2][$key]);
        foreach($qualityList as $quality){
            echo "<a href='?selectqualityfolder=$rawid&folder=$folder&quality=$quality'>&nbsp;[$quality]</a>";
        }
        echo "</li>";    }
    echo '</ol>';
    echo "</td></tr></table>";
}


function getQualityFolder($id, $folder, $quality){
    global $context, $ini;
    $resinfo = getposter($id);
    preg_match_all('/.*\/(.+?)-/ims', $id, $result); $id = $result[1][0];
    $req = $id.'?folder='.$folder;
    $url = 'http://'.$ini['url']. '/' . $id . '?ajax&folder=' . $folder;
    $html = file_get_contents($url, false, $context);
    preg_match_all('/quality-flag-.+?>(.+?)<\/.+?link-material-filename-text".+?>(.+?)<\/span.+?href="(.+?)\".+?link-material-size.=?>(.+?)</is', $html, $result);
    echo "<br><center><h1>".$resinfo['name']."</h1></center>";
    echo "<table cellpadding='10'><tr><td valign='top'>";
    echo "<img src='". $resinfo['img'] . "' >";
    echo "</td><td valign='top'>";
    echo '<ol>';
    foreach($result[2] as $key =>  $onefile){
        $qualityFile = $result[1][$key];
        $urlFile = $result[3][$key];
        $sizeString =  $result[4][$key];
        if(!strstr($qualityFile, $quality)) continue;
        if( strlen($onefile) < 20 ) continue;
        $del=$ini['save_dir'].strrchr($onefile,"/");
        $url = 'http://' . $ini['url'] . '' . $urlFile;
        $filename = $onefile;
        $downornot = (file_exists($ini['save_dir'].strrchr($onefile,"/"))) ? '<a href="?delete='.$del.'&folder='.$filename.'">[удалить]</a>&nbsp;<a vod href="'.$onefile.'">[играть]</a>' : '<a href="?dl='.$url.'">[скачать]</a>';
        echo '<li><a vod href="'.$url.'">'.rawurldecode($filename) . " " .$sizeString .'</a>&nbsp;&nbsp;&nbsp;'.$downornot.'</li>';
    }
    echo '</ol>';
    echo "</td></tr></table>";
}


///poster
function getposter($id){
    global $context, $ini;
    global $context, $ini;
    $req = $id;
    $url='http://'.$ini['url'].''.$req;
    $html = file_get_contents($url, false, $context);
    $arr = Array();
    preg_match_all('/itemprop="name">(.+?)<\/span>/ims',$html, $arr);
    $name = $arr[1][0];
    preg_match_all('/poster-main .+?img.+?src="(.+?)"/ims',$html, $arr);
    $imgData = $arr[1][0];

    return Array('name' => $name, 'img' => $imgData);
}


///////////  search
/////////////////////////////////////////

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