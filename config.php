<?php
echo '<!DOCTYPE html>
<html><body>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	';
/* 3 chỗ cần điền config */
$info_host = "localhost";
$info_port ="3306";
$info_user = "botlikev_black";
$info_pass = "dCC2#.0(q%)q";
$info_dbname = "botlikev_mr";
if(!class_exists('Connect_Server'));
class Connect_Server
{
public function __construct(){
}
public function __ConnectDB(

$_db_host= "localhost",
$_db_port= "3306",
$_db_user= "botlikev_black",
$_db_pass= "dCC2#.0(q%)q",
$_db_name= "botlikevq_shell"
)
{
if($_db_user && $_db_pass)
$connect = mysql_connect($_db_host.":".(is_numeric($_db_port)?$_db_port:$_db_port),$_db_user,$_db_pass);
else
die('Kh&#244;ng th&#7875; k&#7871;t n&#7889;i t&#7899;i c&#417; s&#7903; d&#432;&#7869; li&#7879;u vui l&#242;ng ki&#7875;m tra l&#7841;i');
if($connect)
$db_select = mysql_select_db($_db_name,$connect);
else
die('L&#7895;i k&#7871;t n&#7889;i t&#7899;i  mysql. '.mysql_error());
if($db_select) //check database select
return True;
else
die('L&#7895;i k&#7871;t n&#7889;i t&#7899;i database. '.mysql_error());
}
public function _Query($query=null,$getresult=True)
{
$exec = mysql_query($query);
if($exec)
if($getresult !== FALSE)
{
while($row = mysql_fetch_array($exec))
{
$res[] = $row;
}
if(!@is_array($res))
return FALSE;
else
return $res;
}
else
{
return TRUE;
}
else
die(mysql_error());
}
public function TnkEncrypt($string=null)
{
if($string)
{
return md5($string);
}
else
{
return FALSE;
}
}
}
class ShellBank extends Connect_Server
{
public function __construct(
$dbhost= "locahost",
$dbport= "3306",
$dbuser= "botlikev_black",
$dbpass= "dCC2#.0(q%)q",
$dbname= "botlikev_mr"
)
{
if($dbuser && $dbpass)
$this->__ConnectDB($dbhost,$dbport,$dbuser,$dbpass,$dbname);
else
die('L&#7895;i k&#7871;t n&#7889;i t&#7899;i server !!!');
}
public function Register($username=null,$password=null)
{
$exec1 = $this->_Query("SELECT * FROM member WHERE taikhoan = '".addslashes($username)."'");
if(@strstr($exec1[0]['taikhoan'], $username))
die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Tên tài khoản đã được tạo!!!")
    window.location.href="index.php";
    </SCRIPT>');
else
$this->_Query("INSERT INTO `member`(`taikhoan`, `matkhau`, `datenick`) VALUES ('".addslashes($username)."','".addslashes($password)."','".intval(strtotime(date('d-m-Y H:i:s')))."')",false);
die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Đăng ký thành công, bạn có thể đăng nhập để sử dụng ShellBank!!!")
    window.location.href="index.php";
    </SCRIPT>');
}
public function ViewShell($shellid=null,$viewer=null)
{
if(is_numeric($shellid))
{
$exec1 = $this->_Query("SELECT * FROM listshell WHERE idshell = '".intval($shellid)."'");
$exec2 = $this->_Query("SELECT * FROM member WHERE idnick = '".intval($viewer)."'");
if($exec2[0]['diemso'] == 0 || $exec2[0]['diemso'] < 0)
die('B&#7841;n Kh&#244;ng &#272;&#7911; &#272;i&#7875;m &#272;&#7875; Xem Shell !!<meta http-equiv="refresh" content="2;index.php">');
switch ($exec1[0]['nickxem']) {
case $viewer: print $exec1[0]['linkshell'];break;
case null: $this->_Query('UPDATE `listshell` SET `nickxem`=\''.intval($viewer).'\' WHERE `idshell` = \''.intval($shellid).'\' ',false);$this->_Query('UPDATE `member` SET `diemso`= diemso - 1 WHERE idnick = "'.intval($viewer).'"',false);print $exec1[0]['linkshell'];
break;
default: print "Shell n&#224;y &#273;&#227; &#273;&#432;&#7907;c xem!";
break;
}
}
else
{
die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Không có hiệu lực!!!")
    window.location.href="dashboard.php";
    </SCRIPT>');
}
}
public function AddShell($linkshell = null,$passshell = null, $kernel = null,$u_post=null){
if(!preg_match('/(http|https)/i',$linkshell))
die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Nhập đầu đủ vào các ô trước khi nhấn Thêm Shell!!!")
    window.location.href="dashboard.php";
    </SCRIPT>');
if($linkshell)
$exec1 = $this->_Query("SELECT * FROM listshell WHERE linkshell = '".addslashes($linkshell)."'");
else
die('R&#7895;ng !!!');
$array = @get_headers($linkshell);
$string = $array[0];
if(strpos($string,"200"))
  {
 $code = "200";
  }
  else
  {
    $code = "404";
  }
if(!$exec1[0]['idshell'])
if($this->_Query('INSERT INTO `listshell`(`linkshell`, `matkhaushell`, `kernel`, `nickpost`, `thoigian`, `trangthai`) VALUES ("'.addslashes($linkshell).'","'.addslashes($passshell).'","'.addslashes($kernel).'","'.intval($u_post).'","'.intval(strtotime(date('d-m-Y H:i:s'))).'", "'.intval($code).'")',false))
print "Th&#234;m Shell Th&#224;nh C&#244;ng,";
else
print "M&#7897;t L&#7895;i X&#7843;y Ra";
else
die("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('$linkshell đã đc tạo, bạn không thể thêm shell này vì bị trùng')
    window.location.href='dashboard.php';
    </SCRIPT>".$exec1[0]['']);
$this->_Query('UPDATE `member` SET `diemso`= diemso + 1 WHERE idnick = "'.intval($u_post).'"',false);
}
}

$info = array(
		'host' => $info_host,
		'port' => $info_port,
		'user' => $info_user,
		'pass' => $info_pass,
		'dbname' => $info_dbname
	);

$sb = new ShellBank($info['host'],$info['port'],$info['user'],$info['pass'],$info['dbname']);

@session_start();

if(isset($_POST['login']) || isset($_POST['register']))
{

	$username = htmlentities($_POST['username']);

	$password = $sb->TnkEncrypt(htmlentities($_POST['password']));

}
if(isset($_POST['login']))
{
	if($username !== "" && $password !== "")
	{

		$query = $sb->_Query("SELECT * FROM member WHERE taikhoan = '".addslashes($username)."' AND matkhau = '".addslashes($password)."'");

		if(is_numeric($query[0]['idnick']))
		{
			$_SESSION['login'] = intval($query[0]['idnick']);

			$_SESSION['user'] = strtoupper($query[0]['taikhoan']);
		}
        else
			die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Sai Tài Khoản hoặc Mật Khẩu Vui long thử lại !")
    window.location.href="index.php";
    </SCRIPT>');
		header('Location: '.$_SERVER['SCRIPT_NAME']);
		
	}

}
if(isset($_POST['logout']))
{
	foreach($_SESSION as $key => $value)
	{

		unset($_SESSION[$key]);

	}

}
if(isset($_POST['register']))
{
	if($username !== "" && $password !== "")

		$query = $sb->Register($username,$password);

	else

		die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Vui lòng nhập tài khoản và mật khẩu, tài khoản và mật khẩu không được để trống")
    window.location.href="index.php";
    </SCRIPT>');

}
if(isset($_POST['addshell']))
{

	if($_POST['link'] !== null)

		$sb->AddShell($_POST['link'],htmlentities($_POST['matkhaushell']),htmlentities($_POST['kernel']),$_SESSION['login']);

	else

		die('<SCRIPT LANGUAGE="JavaScript">
    window.alert("Vui lòng nhập đầy đủ thông tin vào ô yêu cầu")
    window.location.href="dashboard.php";
    </SCRIPT>');

}

if(isset($_GET['viewshell']))
{

	if(is_numeric(@$_GET['viewshell']) && @$_SESSION['login'])
	{

		$sb->ViewShell($_GET['viewshell'],$_SESSION['login']);

	}

header('Location: '.$_SERVER['SCRIPT_NAME']);
}
function CleanGetIP($host)
{

	$host = str_replace(array('http://','https://'),'',$host);

	$idx = strpos($host, '/');

	if($idx)

		$host = substr($host, 0, $idx);

	else

		$host = $host;

	$ip = gethostbyname($host);

	return filter_var($ip, FILTER_VALIDATE_IP)?$ip:"Kh&#244;ng L&#7845;y &#272;&#432;&#7907;c IP";
}

$newmk = $sb->_Query('SELECT * FROM member WHERE taikhoan = "'.addslashes($_SESSION['user']).'"');

if(!@$_SESSION['login'])
		{ 
}
else
{
if(isset($_GET['NewPass'])){
$newpass = md5(htmlentities($_POST['matkhaumoi']));
mysql_query("UPDATE member SET matkhau='$newpass' WHERE idnick=".$newmk[0]['idnick']."");
echo "<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Thay đổi mật khẩu thành công')
    window.location.href='dashboard.php';
    </SCRIPT>";
exit();
}
}

?>
