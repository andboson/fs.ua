<?php
ini_set('max_execution_time', '0');
error_reporting(0);
if( file_exists('config2.ini')){
    $ini = parse_ini_file("config2.ini");
} else {
    $ini = parse_ini_file("config.ini");
}


if( isset($_POST['url'] )){
    $iniContent = '';
    foreach( $_POST as $key=>$value){
        if( !is_array( $value ) ){
            $iniContent .= $key . '=' . $value ."\n";
        } else {
            foreach( $value as $value_elem ){
               if( strlen($value_elem) > 0 ){
                   $iniContent .= $key . '[]=' . $value_elem . "\n";
               }
            }
        }
    }
   // echo $iniContent; echo "<pre>";print_r($ini);
    file_put_contents('config2.ini', $iniContent );
    Header('location: config.php');
}
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
    </style>
</head>

<body onloadset="<?php echo $focus; ?>" marginwidth=20 marginheight=20 background="img/cutbg.png" background-repeat="no-repeat" FOCUSCOLOR="#FF4F38" FOCUSTEXT="#00000" bgcolor="#302226">
<!--<br><br><a href="TV.php">TV.test</a><br>
<a href="http://tv.x-lan.net.ua:8015/1plus1" vod>TV.tes22t</a>      -->
<center>
<br>
    <div id="sdiv"><a href="index.php"><h1>На главную</h1></a></div>

</center>

<div style="padding:10px 60px 0px;">
    <h2>Редактирование конфига</h2>

<form action="" method="post">
    <?php if( is_array( $ini['login'])){ ?>
    <h4>Используемый логин</h4>
    <?php    foreach( $ini['login'] as $key=>$login ){ ?>
        <?php $selected =  $ini['use_login'] == $key ? 'checked' : ''; ?>
        <label>
            <input type="radio" <?php echo $selected ?> name="use_login" value="<?php echo $key ?> "/>
            <?php echo $login ?>
        </label>
    <?php    }
    }
    ?>
    &nbsp; &nbsp; &nbsp;<input type="submit" value="Сохранить"/>
    <?php
    foreach( $ini as $key=>$value){?>
        <?php if( $key == 'use_login') continue; ?>
        <h3><?php echo $key?></h3>
        <?php if( !is_array($value)){?>
        <input type="text" name="<?php echo $key ?>" value="<?php echo $value ?>" size="100"/>
            <?php } else { ?>
                <ol>
                <?php foreach( $value as $val_elem){?>
                    <li><input type="text" name="<?php echo $key ?>[]" value="<?php echo $val_elem ?>" size="100"/>
                <?php } ?>
                <li><input type="text" name="<?php echo $key ?>[]" value="" size="100">
                </ol>
            <?php } ?>
   <?php } ?>
    </br>
    </br>
    <input type="submit" value="Сохранить"/>
</form>
</div>
<center>
    <div id="sdiv"><a href="index.php"><h1>На главную</h1></a></div>
</center>
</body>
</html>