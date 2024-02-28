<?php

global $user_info;

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF')) {
    require_once(dirname(__FILE__) . '/SSI.php');
} elseif (!defined('SMF')) {
    die('<b>Error:</b> Cannot install - please verify that you put this file in the same place as SMF\'s index.php and SSI.php files.');
}

if ((SMF == 'SSI') && !$user_info['is_admin']) {
    die('Admin privileges required.');
}

$hooksList = [
    //'integrate_pre_include' => '$sourcedir/Subs-UltimatePortal.php',
    //'integrate_admin_areas' => 'UP::LoadAdminArea',
];

//add the important files and functions
if (!empty($hooksList)) {
    foreach ($hooksList as $hook => $action) {
        add_integration_function($hook, $action, true);
    }
}
