<?php

/**
 * UserController controls following actions:
 * 
 * @author Sonvq
 */
class UserController {

    /**
     * Object user of logic class User
     * @var User 
     */
    private $user;

    /**
     * Call displaying method by requested 'page' 
     */
    public function __construct() {
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] != 'user') {
            SupportFunc::redirect("login.php?action=login");
        }

        $this->user = new User($_SESSION['user']['email'], $_SESSION['user']['role']);

        if(file_exists('./logs/log_' . $_SESSION['user']['email'] . '.log')){
            $file = file_get_contents('./logs/log_' . $_SESSION['user']['email'] . '.log', FILE_USE_INCLUDE_PATH);
            echo '<table width="700" border="1" cellpadding="4">';
                echo "<tr><td>" . nl2br($file) . "</td></tr>\n";
            echo '</table>';
        }
        
    }

}

?>
