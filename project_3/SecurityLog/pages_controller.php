<?php
  class PagesController {
    public function home() {
      require_once('views/pages/home.php');
    }
      
    public function login() {
      require_once('views/pages/login.php');
    }
      
    public function logout() {
      require_once('views/pages/logout.php');
    }

    public function history() {
      require_once('views/pages/history.php');
    }
    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>