<?php
/**
* @package Ultimate Portal
* @version 1.0.0
* @author vicram10
* @copyright 2024
*/

if (!defined('SMF'))
	die('Hacking attempt...');
	
$topNumber = 6;

global $txt, $db_prefix, $scripturl, $user_info;
global $smcFunc, $boarddir, $settings;
global $memberContext, $upCaller;

$modeller = $upCaller->ssi()->getModeller();

//Load Top Poster (ssi_topPoster from SSI.php)
require_once($boarddir . '/SSI.php');
$topPoster = [];

//Ultimate Portal use SMF Cache data... UP it's the best, only "UP", can create this feature
if(!empty($ultimateportalSettings['up_reduce_site_overload']))
{
	if((cache_get_data('bk_top_poster', 1800)) === NULL)
	{
		$topPoster = ssi_topPoster($topNumber,'array');
		cache_put_data('bk_top_poster', $topPoster, 1800);		
	}else{
		$topPoster = cache_get_data('bk_top_poster', 1800);
	}
}else{
	$topPoster = ssi_topPoster($topNumber,'array');
}

// Make a quick array to list the links in.
echo '
	<table  style="border-spacing:5px;width:100%;" border="0" cellspacing="1" cellpadding="3">
		';
$count=0;
foreach ($topPoster as $member)
{
	//load member data
	loadMemberData($member['id']);
	loadMemberContext($member['id']);
	//end load member data...
	$count++;
	echo '
		<tr>
		<td align="left">';
		if (!empty($memberContext[$member['id']]['avatar']['href'])) {
				echo'<img src="'. $memberContext[$member['id']]['avatar']['href'] . '" 
				style="-moz-box-shadow: 0px 0px 5px #444;
                       -webkit-box-shadow: 0px 0px 5px #444;
                       box-shadow: 0px 0px 5px #444;" width="50px;" alt="" />';}
			echo'</td>
			<td width="100%" valign="middle">
				', $modeller->getStarImage($count) ,'<span class="fw-bold">'. $member['link'] . '</span>
				<div><span class="fw-bold">', $txt['posts'],':</span> '. $member['posts'] .'</div>
			</td>
		</tr>
		
	';
}

echo '
	</table>';
?>