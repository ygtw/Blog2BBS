<meta charset="big5">
<?php
//echo $_POST["html"];
$str= iconv( "UTF-8","big5//IGNORE", $_POST["html"] );
echo $str;
?>