<?php 

$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, 'damowang');
mysqli_set_charset($link, 'utf8');
$danmu = $_POST['danmu'];
$dan = json_decode($danmu);

$text      = $dan->text;
$color     = $dan->color;
$size      = $dan->size;
$postition = $dan->position;
$time      = $dan->time;
$sql = "insert into dm (uid,vid,text,color,size,position,time) values ('$text','$color','$size','$postition','$time')";
$query=mysqli_query($link, $sql); 
echo $sql;

?>
