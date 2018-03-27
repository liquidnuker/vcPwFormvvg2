<?php 
class LoginStatus {
  function __construct() {
    $this->loggedIn = false;
    $this->msg = 'wrong username/password';
  }

  private function setValid() {
    $this->loggedIn = true;
    $this->msg = 'valid login';
  }  

  function valid() {
    return $this->setValid();
  }

  function getStatus() {
    $status = array(
      'loggedIn' => $this->loggedIn,
      'msg' => $this->msg
    );
    return $status;
  }
}

?>

