<?php 
require 'connect.php';
require "./vendor/gump.class.php";

$validator = new GUMP();

// Set the data
$postData = array(
  'name' => $_POST['f_name'],
);

// $files = array(
//   'file' => $_FILES['f_file'],
// ); 

// You don't have to sanitize, but it's safest to do so.
$postData = $validator->sanitize($postData); 
// $postData = $validator->sanitize(array_merge($postData,$files)); 

// Let's define the rules and filters
$rules = array(
  'name' => 'required|alpha_numeric|max_len,12'
);

$filters = array(
  // 'email' => 'trim|sanitize_email',
);

$postData = $validator->filter($postData, $filters);

// You can run filter() or validate() first
$validated = $validator->validate(
  $postData, $rules
);

// Check if validation was successful
if($validated === TRUE) {
  echo "Successful Validation\n\n";
  print_r($postData); // You can now use POST data safely
  // echo $postData['name'];
  // echo $postData['file']['name'];

  // check if user already registered
  $stmt = $pdo->prepare('SELECT * FROM test_account1 WHERE username = ?');
  $stmt->execute([$postData['name']]);
  
  if ($stmt->rowCount() > 0) {
    echo "user already exists";
    exit;
  } 
  
  // hash before insert
  $hash = password_hash($_POST['f_password'], PASSWORD_DEFAULT);
  
  if (password_verify($_POST['f_passwordconfirm'], $hash)) {
      echo 'Password is valid!';

  // insert
  try {
    $stmt = $pdo->prepare('INSERT INTO test_account1 (username, password) VALUES (?, ?)');
    $stmt->execute([$postData['name'], $hash]);
  
    echo "registered";   
  
  } catch(PDOException $error){
    die("ERROR: Could not able to execute $sql. " . $error->getMessage());
  }

  // Close connection
  unset($pdo);


  } else {
      echo 'Invalid password.';
  } 

  // upload
  // exit;  

} else {
  echo "invalid"; 
  print_r($postData);     
  print_r($validated); // Shows all the rules that failed along with the data
}

// hash password...
// insert...

?>