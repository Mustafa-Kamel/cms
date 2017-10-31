<?php

require_once('../globals.php');
is_admin();
System::Get('tpl')->draw('index');