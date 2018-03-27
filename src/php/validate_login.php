<?php 
require "./vendor/gump.class.php";
require "./connect.php";
require "./loginstatus.php";

$loginvalidator = new GUMP();

// Set the data
$loginData = array(
  'name' => $_POST['l_name'],
  'password' => $_POST['l_password']
);

// You don't have to sanitize, but it's safest to do so.
$loginData = $loginvalidator->sanitize($loginData); 

// Let's define the rules and filters
$rules = array(
  'name' => 'required|alpha_numeric|max_len,12'
);

$filters = array(
  'name' => 'trim',
);

$loginData = $loginvalidator->filter($loginData, $filters);

// You can run filter() or validate() first
$loginvalidated = $loginvalidator->validate(
  $loginData, $rules
);

$userLogin = new loginStatus();

// Check if validation was successful
if($loginvalidated === TRUE) {
  // echo "Successful Validation\n";
  // print_r($loginData); // You can now use POST data safely
  
  // check user/password
  try {
  // check if user exists  
  $stmt = $pdo->prepare('SELECT * FROM test_account1 WHERE username = ?');
  $stmt->execute([$loginData['name']]);

  if($stmt->rowCount() > 0){
    
    // user exists, compare password
    $row = $stmt->fetch();

    if (password_verify($_POST['l_password'], $row['password'])) {
      // valid
      $userLogin->valid();
      echo json_encode($userLogin->getStatus());
      
    } else {
      // invalid login
      echo json_encode($userLogin->getStatus());
    } 

    // Free result set
    unset($stmt);

  } else {
    //  echo "No records matching your query were found.";
    echo json_encode($userLogin->getStatus());
  }

  } catch(PDOException $error){
    // die("ERROR: Could not able to execute $sql. " . $error->getMessage());
  }  

  // Close connection
  unset($pdo);

  // upload
  // exit;  

} else {
  print_r($loginData); 
  print_r($loginvalidated); // Shows all the rules that failed along with the data
}

?>