<?php
/*requires: core files are required everywhere so it must be included in each file
*in this file we will call all of them then just call this file without rewriting the code
*/
session_start();
define('ROOT',dirname(__FILE__));
define('INC',ROOT.'/includes/');
define('CORE',INC.'/core/');
define('CONTROLLERS',INC.'/controllers/');
define('LIBS',INC.'/libs/');
define('MODELS',INC.'/models/');

//CORE files
require_once (CORE.'config.php');
require_once (CORE.'mysql.class.php');
require_once (CORE.'raintpl.class.php');
require_once (CORE.'system.php');
require_once (INC.'general.php');;

System::Store('db', new mysql());
System::Store('tpl', new RainTPL());


/**
 * Hashing function for the passwords
 * @param type $password
 * @return string
 */
function password($password){
    return sha1('!#@$#@$'.$password).md5(md5('%$@#$').sha1(md5($password)));
}
/*
        $key= mcrypt_create_iv(10);             OR
        $key= openssl_random_pseudo_bytes(10);  OR
        $key= random_bytes(10);
         // HMAC is the best hashing technique (hashed message authentecation code)
        $password   = hash_hmac('sha1', $password, $key);
        ---------
        $hash= password_hash($password, $algo);
        $bool= password_verify($password, $hash);
         */
?>