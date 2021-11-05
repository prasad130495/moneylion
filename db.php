 <?php
if(!defined('PrasadDirectAccessRestriction')) {
   die('Direct access not permitted');
}
$servername = "localhost";
$username = "prasadde_moneylionuser";
$password = "HqgNLjPWjQ_R";
$dbname = "prasadde_moneylion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?> 
