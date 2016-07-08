<?php 
session_start();
$dbusername="thiuid_fw";
$dbpassword="abc123xyz";
$database="thiuid_fw";
$username = $_POST['username'];
$password = $_POST['password'];
mysql_connect("localhost", $username, $password);
@mysql_select_db($database) or die( "Unable to select database");
$query = "SELECT * FROM client WHERE user_name = '{$username}' AND password_hash = '" . crypt($password) . "'";
$result = mysql_query($query);
if (mysql_num_rows($result) == 0) {
	echo json_encode(array('success'=>'no', 'msg'=>"Invalide Login");
	return;
}
$row = mysql_fetch_array($result);
$client_id = $row['client_id'];
$update = "UPDATE client SET last_login = now() WHERE client_id = {$client_id}";
mysql_query($update);
$_SESSION['loggedIn'] = 'yes';
mysql_close();
echo json_encode(array('success'=>'yes');
?>