<?php

namespace UltimatePortal;

class SSI extends CoreBase{
	/**
	 * Own Modeller
	 * @return Modeller 
	 */
	function getModeller():Modeller{
		return new Modeller();
	}

    /**
     * Board News     
     */
	function getBoardNews(int $numRecent = 8, ?array $excludeBoards = [], array $includeBoards = [], int $length = 0, string $blockCall = '')
	{
		global $context, $settings, $scripturl, $txt, $user_info;
		global $modSettings, $smcFunc;

		loadLanguage('Stats');

		if ($excludeBoards === null && !empty($modSettings['recycle_enable']) && $modSettings['recycle_board'] > 0)
			$excludeBoards = array($modSettings['recycle_board']);
		else
			$excludeBoards = empty($excludeBoards) ? array() : (is_array($excludeBoards) ? $excludeBoards : array($excludeBoards));

		// Only some boards?.
		if (is_array($includeBoards) || (int) $includeBoards === $includeBoards) {
			$includeBoards = is_array($includeBoards) ? $includeBoards : array($includeBoards);
		} elseif ($includeBoards != null) {
			$output_method = $includeBoards;
			$includeBoards = array();
		}

		$stable_icons = array('xx', 'thumbup', 'thumbdown', 'exclamation', 'question', 'lamp', 'smiley', 'angry', 'cheesy', 'grin', 'sad', 'wink', 'moved', 'recycled', 'wireless');
		$icon_sources = array();
		foreach ($stable_icons as $icon)
			$icon_sources[$icon] = 'images_url';

		//Prepare the constructPageIndex() function
		$start = (!empty($_REQUEST['sa']) && $_REQUEST['sa'] == $blockCall . 'boardnews') ? (int) $_REQUEST['start'] : 0;

		$db_count = $smcFunc['db_query'](
			'countUPBoardNews',
			'
		SELECT count(1)
		FROM {db_prefix}topics AS t
			INNER JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
			INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
			INNER JOIN {db_prefix}messages AS ms ON (ms.id_msg = t.id_first_msg)
			LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)' . (!$user_info['is_guest'] ? '
			LEFT JOIN {db_prefix}log_topics AS lt ON (lt.id_topic = t.id_topic AND lt.id_member = {int:current_member})
			LEFT JOIN {db_prefix}log_mark_read AS lmr ON (lmr.id_board = b.id_board AND lmr.id_member = {int:current_member})' : '') . '
		WHERE m.id_topic > 0
			' . (empty($excludeBoards) ? '' : '
			AND b.id_board NOT IN ({array_int:exclude_boards})') . '
			' . (empty($includeBoards) ? '' : '
			AND b.id_board IN ({array_int:include_boards})') . '
			AND {query_wanna_see_board}' . ($modSettings['postmod_active'] ? '
			AND t.approved = {int:is_approved}
			AND m.approved = {int:is_approved}' : ''),
			array(
				'current_member' => $user_info['id'],
				'include_boards' => empty($includeBoards) ? '' : $includeBoards,
				'exclude_boards' => empty($excludeBoards) ? '' : $excludeBoards,
				'is_approved' => 1,
			)
		);

		$numNews = array();
		list($numNews) = $smcFunc['db_fetch_row']($db_count);
		$smcFunc['db_free_result']($db_count);

		$context['page_index'] = constructPageIndex($scripturl . '?sa=' . $blockCall . 'boardnews', $start, $numNews, $numRecent);

		// Find all the posts in distinct topics.  Newer ones will have higher IDs.
		$request = $smcFunc['db_query'](
			'',
			'
		SELECT
			m.poster_time, ms.subject, m.id_topic, m.id_member, m.id_msg, b.id_board, b.name AS board_name, t.num_replies, t.num_views,
			t.locked,
			IFNULL(mem.real_name, m.poster_name) AS poster_name, ' . ($user_info['is_guest'] ? '1 AS is_read, 0 AS new_from' : '
			IFNULL(lt.id_msg, IFNULL(lmr.id_msg, 0)) >= m.id_msg_modified AS is_read,
			IFNULL(lt.id_msg, IFNULL(lmr.id_msg, -1)) + 1 AS new_from') . ', m.body AS body, m.smileys_enabled, m.icon
		FROM {db_prefix}topics AS t
			INNER JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
			INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
			INNER JOIN {db_prefix}messages AS ms ON (ms.id_msg = t.id_first_msg)
			LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)' . (!$user_info['is_guest'] ? '
			LEFT JOIN {db_prefix}log_topics AS lt ON (lt.id_topic = t.id_topic AND lt.id_member = {int:current_member})
			LEFT JOIN {db_prefix}log_mark_read AS lmr ON (lmr.id_board = b.id_board AND lmr.id_member = {int:current_member})' : '') . '
		WHERE m.id_topic > 0
			' . (empty($excludeBoards) ? '' : '
			AND b.id_board NOT IN ({array_int:exclude_boards})') . '
			' . (empty($includeBoards) ? '' : '
			AND b.id_board IN ({array_int:include_boards})') . '
			AND {query_wanna_see_board}' . ($modSettings['postmod_active'] ? '
			AND t.approved = {int:is_approved}
			AND m.approved = {int:is_approved}' : '') . '
		ORDER BY t.id_first_msg DESC
		 ' . ($numRecent < 0 ? "" : " LIMIT {int:start}, {int:limit} ") . '',
			array(
				'current_member' => $user_info['id'],
				'include_boards' => empty($includeBoards) ? '' : $includeBoards,
				'exclude_boards' => empty($excludeBoards) ? '' : $excludeBoards,
				'is_approved' => 1,
				'start' => $start,
				'limit' => $numRecent,
			)
		);

		$return = array();
		while ($row = $smcFunc['db_fetch_assoc']($request)) {
			// If we want to limit the length of the post.
			if (!empty($length) && $smcFunc['strlen']($row['body']) > $length) {
				$row['body'] = $smcFunc['substr']($row['body'], 0, $length);

				// The first space or line break. (<br />, etc.)
				$cutoff = max(strrpos($row['body'], ' '), strrpos($row['body'], '<'));

				if ($cutoff !== false)
					$row['body'] = $smcFunc['substr']($row['body'], 0, $cutoff);
				$row['body'] .= '...';
			}

			$row['body'] = parse_bbc($row['body'], $row['smileys_enabled'], $row['id_msg']);

			// Censor the subject.
			censorText($row['subject']);
			censorText($row['body']);

			if (empty($modSettings['messageIconChecks_disable']) && !isset($icon_sources[$row['icon']]))
				$icon_sources[$row['icon']] = file_exists($settings['theme_dir'] . '/images/post/' . $row['icon'] . '.gif') ? 'images_url' : 'default_images_url';

			// Build the array.
			$return[] = array(
				'board' => array(
					'id' => $row['id_board'],
					'name' => $row['board_name'],
					'href' => $scripturl . '?board=' . $row['id_board'] . '.0',
					'link' => '<a href="' . $scripturl . '?board=' . $row['id_board'] . '.0">' . $row['board_name'] . '</a>'
				),
				'topic' => $row['id_topic'],
				'poster' => array(
					'id' => $row['id_member'],
					'name' => $row['poster_name'],
					'href' => empty($row['id_member']) ? '' : $scripturl . '?action=profile;u=' . $row['id_member'],
					'link' => empty($row['id_member']) ? $row['poster_name'] : '<a href="' . $scripturl . '?action=profile;u=' . $row['id_member'] . '">' . $row['poster_name'] . '</a>'
				),
				'subject' => $row['subject'],
				'replies' => $row['num_replies'],
				'views' => $row['num_views'],
				'short_subject' => shorten_subject($row['subject'], 25),
				'preview' => $row['body'],
				'time' => timeformat($row['poster_time']),
				'timestamp' => forum_time(true, $row['poster_time']),
				'href' => $scripturl . '?topic=' . $row['id_topic'] . '.msg' . $row['id_msg'] . ';topicseen#new',
				'link' => '<a href="' . $scripturl . '?topic=' . $row['id_topic'] . '.msg' . $row['id_msg'] . '#new" rel="nofollow">' . $row['subject'] . '</a>',
				// Retained for compatibility - is technically incorrect!
				'new' => !empty($row['is_read']),
				'is_new' => empty($row['is_read']),
				'new_from' => $row['new_from'],
				'icon' => '<img src="' . $settings[$icon_sources[$row['icon']]] . '/post/' . $row['icon'] . '.gif" align="middle" alt="' . $row['icon'] . '" border="0" />',
				'comment_link' => !empty($row['locked']) ? '' : '<a href="' . $scripturl . '?action=post;topic=' . $row['id_topic'] . '.' . $row['num_replies'] . ';num_replies=' . $row['num_replies'] . '">' . $txt['ssi_write_comment'] . '</a>',
			);
		}
		$smcFunc['db_free_result']($request);

		//ok return now
		return $return;
	}
}