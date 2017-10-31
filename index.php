<?php
require_once 'globals.php';

/*
 *
 //mysql
$data = array();
$data['username'] = 'mustafa2';
$data['name'] = 'mustafa2';
$data['email'] = 'mustafa2@mail.com';
$data['password'] = '1234562';
$data['about'] = 'aaaaaaa';
$data['admin'] = 0;

if (System::Get('db')->Update('users',$data,"WHERE `id`=2")&&System::Get('db')->AffectedRows())
    echo 'Done';
else
    echo 'error';
 
System::Get('db')->EXECUTE("SELECT * FROM `USERS");
print_r(System::Get('db')->GetRows());
 
//raintpl
System::Get('tpl')->assign('name','Mustafa');
System::Get('tpl')->draw('form');
*/ 
System::Get('tpl')->draw('index');