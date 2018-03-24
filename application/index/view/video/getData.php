<?php 
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, 'damowang');
mysqli_set_charset($link, 'utf8');


$sql="select * from damowang_danmu";
$res=mysqli_query($link, $sql);
$data = mysqli_fetch_all($res,MYSQLI_ASSOC);
echo json_encode($data);
//var_dump($res);
/*while ($res = mysqli_fetch_array($res))
{

}*/


//echo $danmu;
/*echo "[";
$first=0;
while($row=mysql_fetch_array($sql)){
	if ($first) {
		echo ",";
		
	}
$first=1;
echo "'".$row['danmu']."'";
}
	echo "]";
*/
