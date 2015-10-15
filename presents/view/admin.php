<?php
session_start();
$root = dirname(dirname(dirname(__FILE__)));
require_once ($root . '/config.php');
require_once('components/header.php');
$ctrl = new AdminController;
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>        
    </body>
</html>
