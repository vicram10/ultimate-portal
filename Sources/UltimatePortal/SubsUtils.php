<?php

namespace UltimatePortal;

class SubsUtils
{
    function loadBlock(string $place): void
    {
        global $smcFunc;
        $context['exists_'.$place] = 0;
        $myquery = $smcFunc['db_query'](
            '',
            "
		SELECT * FROM {db_prefix}ultimate_portal_blocks 
		WHERE position = {string:position}
		ORDER BY active DESC, progressive, id",
            array(
                'position' => $place,
            )
        );
        $blockTotals = $smcFunc['db_num_rows']($myquery);

        $context[$place.'-progoption'] = ''; //only is declared

        for ($i = 1; $i <= $blockTotals; $i++) {
            $context[$place.'-progoption'] .= "<option value=\"$i\">$i</option>";
        }

        while ($row = $smcFunc['db_fetch_assoc']($myquery)) {
            $context['block-'.$place][] = self::_colModeller(place: $place, blockTotals: $blockTotals, row: $row);
        }
    }

    private function _colModeller(string $place, int $blockTotals, array $row): array
    {
        global $txt;

        $context['exists_' . $place] = true;
        $id = $row['id'];
        $isActive = $row['active'];

        return [
            'id' => $id,
            'title' => $row['title'],
            'position' => $txt['ultport_blocks_' . $place],
            'progressive' => !empty($row['progressive']) && $row['progressive'] >= 100 ? $blockTotals : $row['progressive'],
            'active' => $row['active'],
            'activestyle' => $isActive ? "windowbg" : "windowbg2",
            'active' => $isActive ? "checked=\"checked\"" : "",
            'title_form' => $id . "_title",
            'position_form' => $id . "_position",
            'progressive_form' => $id . "_progressive",
            'active_form' => $id . "_active",
        ];
    }
}
