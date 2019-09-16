<?php
ob_start();
@set_time_limit(0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
include('config.php');
?>
<html>
<link rel='stylesheet' type='text/css' href='css/login.css'>
<title>Login ShellBank</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/danger-problems/512/anonymous-128.png" />
<body>
<style type="text/css"> 
HTML,BODY{cursor: url("hub/c1.cur"), url("hub/c1.cur"), auto;} 
A:hover,#submit{cursor: url("hub/c2.cur"), url("hub/c2.cur"), auto;}
</style>
<div id="logo">
  <h1><i> ShellBank Login</i></h1>
</div>
<section class="stark-login">

  <form action="dashboard.php" method="POST">
    <div id="fade-box">
      <input type="text" name="username" id="username" placeholder="T&#224;i Kho&#7843;n" required>
      <input type="password" name="password" placeholder="M&#7853;t Kh&#7849;u" required>
      <button type="submit" value="&#272;&#259;ng Nh&#7853;p !!" name="login">Đăng Nhập!</button>
	  <button type="submit" value="&#272;&#259;ng K&#253; !!" name="register">Đăng Ký!</button>
    </div>
  </form>
  <div class="hexagons">
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <br>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <br>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>

    <br>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <br>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
    <span>&#x2B22;</span>
  </div>
</section>

<div id="circle1">
  <div id="inner-cirlce1">
    <h2> </h2>
  </div>
</div>


<ul>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ul>
</body>
</html>