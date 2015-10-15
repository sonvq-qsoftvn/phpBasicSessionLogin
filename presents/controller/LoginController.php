<?php

/*
 * LoginController controls following actions:
 * Login
 * Logout
 * Redirect to user homepage
 * 
 * @author: Sonvq
 */
class LoginController {
    
    /**
     * Construction function
     * Call processing method by requested 'action'
     */
    public function __construct() {
        $action = SupportFunc::getParameter('action');
        if ($action == 'login') 
        {
            $this->actionLogin();
        }
        elseif($action == 'logout')
        {
            $this->actionLogout();
        }
        else
        {
            $this->actionHome();
        }
    }
    
    /**
     * Get login information and authenticate
     */
    public function actionLogin(){
        if(isset($_POST['Login'])){
            try {
                $userLogic = new User;
                if($userLogic->authenticate($_POST['Login']['email'], $_POST['Login']['password'])){
                    $userLogic->saveUserInfoToSession($_POST['Login']['email']);
                    $userLogic->saveUserAction($_POST['Login']['email'], 'logged in to');
                    SupportFunc::redirectByRole($_SESSION['user']['role']);
                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
    
    /**
     * Destroy session, log user out
     */
    public function actionLogout(){
        $userLogic = new User;
        if(isset($_SESSION['user']['email'])) {
            $userLogic->saveUserAction($_SESSION['user']['email'], 'logged out of');    
        }
        
        session_destroy();
        SupportFunc::redirect("login.php?action=login");
    }

    /**
     * Redirect to user homepage
     */
    public function actionHome(){
        if (!isset($_SESSION['user']) || $_SESSION['user'] == null){
            SupportFunc::redirect("login.php?action=login");
        }else{
            SupportFunc::redirectByRole($_SESSION['user']['role']);
        }
    }


}

?>
