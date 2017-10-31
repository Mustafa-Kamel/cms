<?php

function is_admin(){
    /* @var $_SESSION type */
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1 ) {
        System::RedirectTo('login.php');
    }
}