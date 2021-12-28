<?php
require_once 'dbal/vendor/autoload.php';

$connectionParams = array(
    'dbname' => 'plus91-techno',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

//print_r($conn);
/*die;

$hostname     = "localhost"; // Enter Your Host Name
$username     = "root";      // Enter Your Table username
$password     = "";          // Enter Your Table Password
$databasename = "plus91-techno"; // Enter Your database Name

$conn = new mysqli($hostname, $username, $password, $databasename);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
*/

?>

