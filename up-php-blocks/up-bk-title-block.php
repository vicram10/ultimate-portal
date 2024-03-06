<?php
//NOT DELETE THIS PART
if (!defined('SMF'))
	die('Hacking attempt...');
//END IMPORTANT PART

global $user_info, $txt, $context;
$username = $user_info['username'];
echo $txt['ultport_tmp_bk_php_hello'] . ' <b>'. $username . '</b> Hola';
