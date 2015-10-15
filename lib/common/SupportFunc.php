<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupportFunc
 *
 * @author sonvq
 */
class SupportFunc {
    public static function getParameter($param){
        return strtolower(trim($_GET[$param]));
    }
    //redirect
    public static function redirect($url){
        ?>
        <script>window.location = "<?php echo $url;?>";</script>
        <?php
    }

    public static function redirect2($url){  
        $i = 1;
        if ($i == 1)
        {
        ?>
        <script language="javascript">
        window.location = "<?php echo htmlspecialchars_decode($url); ?>";
        </script>
        <?php
        }
    }
    
    public static function redirectByRole($role){
        $url = 'login.php';
        switch ($role){
            case "admin":
                $url = 'admin.php';
                break;
            case "user":
                $url = 'user.php';
                break;
            default :
                $url = 'login.php?action=login';
                break;
        }
        ?>
        <script>window.location = "<?php echo $url;?>";</script>
        <?php
    }
    
   //Alert message to user
   public static function alert($msg){
        ?>
        <script>alert('<?php echo $msg;?>');</script>
        <?php 
   }
}

?>
