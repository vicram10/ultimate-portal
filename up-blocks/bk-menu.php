<?php
/**
* @package Ultimate Portal
* @version 1.0.0
* @author vicram10
* @copyright 2024
*/

if (!defined('SMF'))
	die('Hacking attempt...');
	
global $settings, $db_prefix, $boardurl, $context;
global $smcFunc, $sourcedir, $upCaller;
$upSubs = $upCaller->subs();
//Ultimate Portal use SMF Cache data... UP it's the best, only "UP", can create this feature
if(!empty($ultimateportalSettings['up_reduce_site_overload']))
{
	if((cache_get_data('bk_menu', 1800)) === NULL)
	{
		$upSubs->getMainLinks();
		cache_put_data('bk_menu', $context['main-links'], 1800);		
	}else{
		$context['main-links'] = cache_get_data('bk_menu', 1800);
	}
}else{
	$upSubs->getMainLinks();
}

echo '
	<table border="0" width="100%" cellpadding="5" cellspacing="1">';
foreach($context['main-links'] as $main_link) 
{
	//Is Active?
if ($main_link['active'])  
{
		echo '
			<tr>
				<td class="'.!empty($main_link['class']).'" align="left">
					<span style="margin-right:10px;">'. $main_link['icon'] .'</span>
					<a href="'. $main_link['url'] .'">
						<span>'. $main_link['title'] .'</span>
					</a>
				</td>
			</tr>';		
}			
	
}
echo '
	</table>';				

?>