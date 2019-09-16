<?php
include('config.php');
$res = $sb->_Query("SELECT * FROM listshell");
foreach($res as $data)
{
$array = @get_headers($data['linkshell']);
$string = $array[0];
if(strpos($string,"200"))
  { $code = "200"; }
  else { if(strpos($string,"404"))
  { $code = "404"; }
  else { if(strpos($string,"403"))
  { $code = "403"; }
  else { if(strpos($string,"500"))
  { $code = "500"; }
  else { if(strpos($string,"406"))
  { $code = "406"; }
  else { $code = "0"; } } } } }
	$sb->_Query('UPDATE listshell SET trangthai = \''.intval($code).'\' WHERE idshell = \''.intval($data['idshell']).'\'',false);
}
echo  "<center><h1>CHECK SHELL LIVE/DIE<h1></center>";
?>