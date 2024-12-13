<?php
  session_start();  
  include_once("../Model/M_.php");
  include_once("../Model/E_.php");
  include_once("../Model/E_1.php");
  include_once("../Model/M_1.php");

  class C_{
    private $model;
    private $model1;
    public function __construct(){
      $this->model = new M_();
      $this->model1 = new M_1();
      $this->handleAction();
    }

    public function handleAction(){

      if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch($action){
          case 'login-failed':
            $this->loginFailed();
            break;  
          case 'login':
            $this->login();
            break;  
          case 'logout':
            $this->logout();
            break;
          case 'list':
            $this->listAll();
            break;    
          case 'search':
            $this->search();  
            break;
          case 'add':
              $this->add();
              break;
          case 'update':
              $this->update();
              break;
          case 'updatepost':
              $this->updateSubmit();
              break;    
          case 'delete':
              $this->delete();
              break;
          case 'check-exist-one' :
              $this->checkExist(); 
              break;   
          default:
              echo "Hành động không hợp lệ.";
              break;
            }
      }else {
        $this->listAll();
      }
    }
    
    














































    public function logout(){
      session_destroy();
      header("Location: ../Controller/C_.php?action=login");
      exit();
    }

    public function loginFailed(){
      include_once("../View/Invalid.php");
    }

    private function checkLogin() {
      if (!isset($_SESSION['user'])) {
          header("Location: ../Controller/C_.php?action=login");
          exit();
      }
    }
    
  }

  new C_();
?>