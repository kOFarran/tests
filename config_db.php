<?Php
/////// Database login details /////
$dbhost_name = "iercdevsrv.tyndall.ie"; // Your host name
$database = "pm";       // Your database name
$username = "ierc_admin";            // Your login userid
$password = "TyndallIerc2017#";            // Your password
//////// End of database details of your server //////

//////// Do not Edit below /////////
try {
	$db = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);

	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

	print "Error!: " . $e->getMessage() . "<br/>";
	die();

}
?>
