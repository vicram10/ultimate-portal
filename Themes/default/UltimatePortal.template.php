<?php
/**
* @package Ultimate Portal
* @version 1.0.0
* @author vicram10
* @copyright 2024
*/

function template_ultimate_portal_frontpage()
{
	global $context, $ultimateportalSettings, $sourcedir;

	//print the front page
	/*
		This function is from Source/Subs-UltimatePortal-Init-Blocks.php
		first parameter is left column
		second parameter is right column
		and the last parameter is the center column
		the first and second parameter is "1" if the column is are not collapsed and "0" if the column print collapsed
	*/
	$printLeftCol = !empty($ultimateportalSettings['ultimate_portal_enable_col_left']) ? true : false;
	$printRightCol = !empty($ultimateportalSettings['ultimate_portal_enable_col_right']) ? true : false;
	//Portal Above
	up_print_page_above($printLeftCol, $printRightCol, '', false, true);
	//Portal Below
	up_print_page_below(printRightColumn:$printRightCol);
	$context['load_block_right'] = false;
}

?>