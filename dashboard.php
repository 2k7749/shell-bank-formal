<?php
ob_start();
@set_time_limit(0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
include('config.php');

?>
<?php
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
	// Remove really unwanted tags
	$old_data = $data;
	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
?>
<!DOCTYPE HTML SYSTEM>
<html>

<head>

<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"fc2ce65b9edba90da8be41dfa1416785",petok:"6918ffd447b0902981956b0d86951136b268ab80-1444205512-1800",zone:"vdos-s.com",rocket:"0",apps:{"ga_key":{"ua":"UA-53446092-2","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=e9627cd26a/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<script type="text/javascript" src='https://code.jquery.com/jquery.min.js'></script>
<title>ShellBank | Dashboard</title>
<meta http-equiv='content-type' content='text/html; charset=UTF-8'>
<link rel='stylesheet' type='text/css' href='css/system.css'>
<link href='css/font-awesome/css/font-awesome.css' rel='stylesheet'>
<link href='//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' rel='stylesheet'>
<script type='text/javascript' src='css/tooltip/tooltip_bootstrap.js'></script>
<script type='text/javascript' src='css/tooltip/tooltip.js'></script>

<script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-53446092-2']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>
</head>
<body>
<div id='sidebar'>
<img type='image' src='css/images/EIX.png' width='100%'/>
<h3></h3>
<h3 style='font-size: 13px;'>Xin Chào: <?php
$exec = $sb->_Query('SELECT * FROM member WHERE taikhoan = "'.addslashes($_SESSION['user']).'"');
print "[<u>".$exec[0]['taikhoan']."</u>]<br>Điểm: ".$exec[0]['diemso']."</b> ";
?><br />
<br>Loại TK: Con Gà<br>
<br><?php
$exec = $sb->_Query('SELECT * FROM member WHERE taikhoan = "'.addslashes($_SESSION['user']).'"');

$tongshell = mysql_result(mysql_query("SELECT COUNT(*) FROM `listshell`"), 0);
print "</span>Tổng có : [<b>$tongshell</B>] iêm SHELL";
?>
<h3>✬ Nơi Lưu trữ Shell tốt nhất hiện nay</h3>
<h3>✬ Chú ý : cấm spam link shell die</h3>
<h3>Copyright © 2015. AllRightsReserved The New Kings</h3>
<h3>Thích trang để cập nhật thông tin</h3>
</h3> <a href='https://www.facebook.com/TnK.Teams' rel='tooltip' title='Follow us' class='fa fa-facebook'><br> </a></div>
<?php
$self     =     $_SERVER['PHP_SELF'];
print"
<div id='main'><div class='page'><a href='$self'>Dashboard</a> |
<a href='?Cron-Jobs' target='_bank'>Check Shell Live/Die</a> | 
 <a href='?ThayMatKhau'>Đổi Mật Khẩu</a> |
 <a href='logout.php'>LogOut</a>";
 ?>
 <div>
 <link rel="shortcut icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/danger-problems/512/anonymous-128.png" />
<center><h2><font size="4">✪ Cpanel ShellBank ✪</font></h2></center>
<style type="text/css"> 
HTML,BODY{cursor: url("hub/c1.cur"), url("hub/c1.cur"), auto;} 
A:hover,#submit{cursor: url("hub/c2.cur"), url("hub/c2.cur"), auto;}
</style>
	<?php
if(isset($_GET["tnkip"]))
{
$site = $_GET["tnkip"];
$tnkip = "http://domains.yougetsignal.com/domains.php";
$ch = curl_init($tnkip);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_POSTFIELDS,  "remoteAddress=$site&ket=");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
$resp = curl_exec($ch);
$resp = str_replace("[","", str_replace("]","", str_replace("\"\"","", str_replace(", ,",",", str_replace("{","", str_replace("{","", str_replace("}","", str_replace(", ",",", str_replace(", ",",",  str_replace("'","", str_replace("'","", str_replace(":",",", str_replace('"','', $resp ) ) ) ) ) ) ) ) ) ))));
$array = explode(",,", $resp);
unset($array[0]);
echo "<center><h3>Reverse ip Server: <a href='http://www.bing.com/search?q=ip:$site' target='_bank'>$site</a></h3><table class=tbl>";
$demsite = "0";
foreach($array as $lnk)
{
print "<tr><td><a href='http://$lnk' target=_blank>$lnk</a></td>";
$demsite++;
print "<td>$site</td></tr>";
}
echo "</table>";
curl_close($ch);
echo "</table><h1>Ch&#250;ng Ta C&#243;: $demsite Site Cùng Server:  <a href='http://www.bing.com/search?q=ip:$site' target='_bank'>$site</a> </h1></center>";
exit();
}
if(isset($_GET['Cron-Jobs'])){
//CheckLive Shell
$res = $sb->_Query("SELECT * FROM listshell");
$shellall   = "0";
$shell200 = "0";
$shell404 = "0";
$shell403 = "0";
$shell500 = "0";
$shell406 = "0";
$shell000 = "0";
foreach($res as $data)
{
$array = get_headers($data['linkshell']);
$shellall++;
$string = $array[0];
if(strpos($string,"200"))
  { $code = "200"; $shell200++; }
  else { if(strpos($string,"404"))
  { $code = "404"; $shell404++; }
  else { if(strpos($string,"403"))
  { $code = "403"; $shell403++; }
  else { if(strpos($string,"500"))
  { $code = "500"; $shell500++; }
  else { if(strpos($string,"406"))
  { $code = "406"; $shell406++; }
  else { $code = "0"; $shell000++; } } } } }
	$sb->_Query('UPDATE listshell SET trangthai = \''.intval($code).'\' WHERE idshell = \''.intval($data['idshell']).'\'',false);
}
echo  "<center><h1> Check Shel Live/Die :D<br>
Số lượng Link shell Đã Check: <b>$shellall</b></h1></center><center><table id='eix'><tr>
<td>Shell 200 Live</td>
<td>Shell 404 Die</td>
<td>Shell 403 Forbidden</td>
<td>Shell 406 Not Acceptable</td>
<td>Shell 500 Internal Server Error</td>
<td>Không Xác Định</td>
</tr><tr>
<td>$shell200</td>
<td>$shell404</td>
<td>$shell403</td>
<td>$shell406</td>
<td>$shell500</td>
<td>$shell000</td></tr></center>
";
echo "</table><center><a href='dashboard.php'><h1>Về Trang Chủ</h1></a></center>";
exit();
}
$newmk = $sb->_Query('SELECT * FROM member WHERE taikhoan = "'.addslashes($_SESSION['user']).'"');
if(isset($_GET['ThayMatKhau'])){
print "<center><h1>Xin Chào: ".$newmk[0]['taikhoan']." Nhập mật khẩu bên dưới để thay đổi";
echo '<form method="POST" action="config.php?NewPass">Nhập mật khẩu mới:<br/></br>
<input class="login-input" type="text" name="matkhaumoi">
<input class="login-input" style="width:auto;cursor:pointer" type="submit" value="Chấp Nhận"></h1></center>
</from></body></html>';
exit();
}
		if(!@$_SESSION['login'])
		{
		?><center>
			<h3>Đăng nhập/Đăng Lý để vào QL ShellBank</h3></center>
		<?php
		}
		else
		{			
			$exec = $sb->_Query('SELECT * FROM member WHERE taikhoan = "'.addslashes($_SESSION['user']).'"');

$tongshell = mysql_result(mysql_query("SELECT COUNT(*) FROM `listshell`"), 0);
$self     =     $_SERVER['PHP_SELF'];
echo "<b><center><font size='3'>Nhập đầy đủ trước khi nhấn -Thêm Shell-</font></center</b> 

<hr/>";
}
	?>
	
		<br/>
		<center>
		<table id="eix">
			<tr style='text-align:center;'>
				<td>ID</td>
				<td>Link Shell</td>
		<td>M&#7853;t Kh&#7849;u</td>
				<td>IP Shell</td>
<td>Kernel Version</td>
	<td>&#272;&#259;ng B&#7903;i <img src="css/images/online.gif"></td>
				<td>Xem B&#7903;i</td>
				<td>Th&#7901;i Gian</td>
				<td>LIVE/DIE <a title="" rel="tooltip" href="#" class="icon-info-sign" data-original-title="Nhấn vào CHECK SHELL LIVE/DIE để biết shell Die hay Live."></a></td>
<td>Xóa Shell</td>
</center>
			</tr>
				
			</tr>
<?php
			$query_main = $sb->_Query('SELECT * FROM listshell');
			if(is_array($query_main))
				foreach($query_main as $result)
				{
	switch($result['trangthai'])
					{
	case "404": $status = "Die";break;
	case "200": $status = "Live";break;
 case "403": $status = "Forbidden";break;
	case "500": $status = "Internal Server Error";break;
case "406": $status = "Not Acceptable";break;
      case "0": $status = "Kh&#244;ng r&#245;";break;
					}
if(isset($_GET['shellselect'])) { 
mysql_query("DELETE FROM `listshell` WHERE `thoigian` = $_GET[delete] ");
$self     =     $_SERVER['PHP_SELF'];
echo '<meta http-equiv="refresh" content="0;'.$self.'">';
}
$poster = $sb->_Query('SELECT * FROM member WHERE idnick = \''.intval($result['nickpost']).'\'');
					if($result['nickxem'])
						$viewer = $sb->_Query('SELECT * FROM member WHERE idnick = \''.intval($result['nickxem']).'\'');
					else
						$viewer = null;
					print "

					<tr>
						<td>$result[idshell]</td>
						<td>".(( @$_SESSION['login'] && (($result['nickxem'] == @$_SESSION['login']) || $result['nickpost'] == @$_SESSION['login'] ))?("<a href=\"$result[linkshell]\" class=\"shell\" target=\"_bank\">".substr($result['linkshell'],0,100).((strlen($result['linkshell']) )?"":null)."</a>"):"".md5(sha1(md5(md5($result['linkshell']))))."")."</td>

<td>".$result['matkhaushell']."</td>
	<td><a href=\"dashboard.php?tnkip=".CleanGetIP($result['linkshell'])."\" target=\"_bank\" title=\"Reverse IP\">".CleanGetIP($result['linkshell'])."</a></td>
	<td>".$result['kernel']."</td>
<td>".$poster[0]['taikhoan']."</td>
<td>".$viewer[0]['taikhoan']."</td>
<td>".date('d-m-Y H:i:s',$result['thoigian'])."</td>
	<td>".$status."</td>";
print "<td>".(( @$_SESSION['login'] && (($result['nickxem'] == @$_SESSION['login']) || $result['nickpost'] == @$_SESSION['login'] ))?"<a href=\"?delete=$result[thoigian]&amp;shellselect\"><center>Xoá</center></a>":("&#272;&#227; Kh&#243;a"))."</td></tr>";

} 
	else
print "<tr><td colspan=\"99%\">Không có dữ liệu !!</td></tr>";
			if(intval(@$_SESSION['login']))
			{
			?>
		
			<?php
			}
			?>
			
		</table>
		</br>
<center>
					<form method="POST">
						<input type="text" class="login-input" style="width:auto;cursor:pointer" placeholder="Link Shell" name="link"/>
						<input type="text" class="login-input" style="width:auto;cursor:pointer" placeholder="M&#7853;t Kh&#7849;u" name="matkhaushell"/>
	
						<input type="submit" class="login-input" value="Th&#234;m Shell" style="width:auto;cursor:pointer" name="addshell"/>
					
					</form>
	</center>

    <script>
    $(".content-page").fadeIn(350);
    </script>
    </body>
    </html>