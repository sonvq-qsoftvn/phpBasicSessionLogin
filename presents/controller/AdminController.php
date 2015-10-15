<?php

/**
 * AdminController controls following actions:
 * 
 * @author Sonvq
 */
class AdminController {

    /**
     * Object user of logic class User
     * @var User
     */
    private $user;

    /**
     * Call displaying method by requested 'page' 
     */
    public function __construct() {
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] != 'admin') {
            SupportFunc::redirect("login.php?action=login");
        }

        $directory = "logs/";
        $dir = opendir($directory);
        while (($file = readdir($dir)) !== false) {
            $filename = $directory . $file;
            $type = filetype($filename);
            if ($type == 'file') {
                $contents = file_get_contents($filename);
                $items = explode('¬', $contents);
                echo '<table width="700" border="1" cellpadding="4">';
                foreach ($items as $item) {
                    echo "<tr><td>" . nl2br($item) . "</td></tr>\n";
                }
                echo '</table>';
            }
        }
        closedir($dir);
    }

}

?>
