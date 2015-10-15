<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author sonvq
 */
class User {

    private $email;
    private $role;

    public function __construct($email = null, $role = null) {
        if ($email != null) {
            $this->email = $email;
        }
        if ($role != null) {
            $this->role = $role;
        }
    }

    public function authenticate($email, $pass) {
        global $msg;

        // Check if email and password is not empty
        if (empty($email) || empty($pass)) {
            $msg->add('e', 'Please fill in your email and password!');
            return false;
        }

        // Check email format
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($emailSanitize, FILTER_VALIDATE_EMAIL)) {
            $msg->add('e', 'Invalid email format!');
            return false;
        }

        // Check password format
        $regex = "/^([A-Z]{1})(?=.*\d).{5,}/";
        if (!filter_var($pass, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $regex)))) {
            $msg->add('e', 'Invalid password format!');
            return false;
        }

        // Check pair email and password with fixed data
        $arrayFixedUsers = array(
            array('email' => 'admin@qsoftvietnam.com', 'password' => 'Qsoftvietnam2015'),
            array('email' => 'user1@qsoftvietnam.com', 'password' => 'Qsoftvietnam2014'),
            array('email' => 'user2@qsoftvietnam.com', 'password' => 'Qsoftvietnam2013'),
            array('email' => 'user3@qsoftvietnam.com', 'password' => 'Qsoftvietnam2012')
        );
        
        if ($this->searchContain(array('email' => $email, 'password' => $pass), $arrayFixedUsers) == -1) {
            $msg->add('e', 'Wrong email or password');
            return false;
        }                      

        // Otherwise user has successfully logged in 
        return true;
    }
    
    protected function searchContain($stackArray, $arrayFixed){
        for($i=0; $i<count($arrayFixed);$i++){
            $containsSearch = (count(array_intersect($stackArray,$arrayFixed[$i])) == count($stackArray) && count(array_intersect($stackArray,$arrayFixed[$i])) == count($arrayFixed[$i]));
            if($containsSearch){
                return $i;
            }
        }
        return -1;
    }

    public function getEmail() {
        return $this->email;
    }
    
    /**
     * Save User information to session
     */
    public function saveUserInfoToSession($email){
        $_SESSION['user']['email'] = $email;
        
        if ($email == 'admin@qsoftvietnam.com') {
            $_SESSION['user']['role'] = 'admin';
        } else {
            $_SESSION['user']['role'] = 'user';
        }
    }
    
    public function saveUserAction($email, $action){
        // Write action to log
        $date = date('d/m/Y h:i:s a', time());
        
        $log  = "User $email $action the system at $date" . PHP_EOL;
        
        file_put_contents('./logs/log_' . $email . '.log', $log, FILE_APPEND);
    }
    
}

?>
