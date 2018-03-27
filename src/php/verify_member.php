<?php 
session_start();

if (isset($_SESSION["user"])) {
  $user = array(
  'user' => $_SESSION['user'],
  'loggedIn' => true 
  );
  echo json_encode($user); 

} else {
  echo "not logged in"; 
}

?>