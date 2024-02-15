<?php

/**
 * Determine if a 9 x 9 Sudoku board is valid. Only the filled cells need to be validated according to the following rules:
 *
 * - Each row must contain the digits 1-9 without repetition.
 * - Each column must contain the digits 1-9 without repetition.
 * - Each of the nine 3 x 3 sub-boxes of the grid must contain the digits 1-9 without repetition.
 *
 * Note:
 *
 * A Sudoku board (partially filled) could be valid but is not necessarily solvable.
 * Only the filled cells need to be validated according to the mentioned rules.
 */
class Solution {

    /**
     * @param String[][] $board
     * @return Boolean
     */
    function isValidSudoku($board) {
        $sector_found = [];
        for ($i = 0; $i < 9; $i++) {
            $counts = array_count_values($board[$i]);
            unset($counts['.']);
            rsort($counts);
            if ($counts[0] > 1) {
                return false;
            }
            $col_found = [];
            for ($j = 0; $j < 9; $j++) {
                if ($board[$j][$i] == '.') {
                    continue;
                }
                $sector = floor($j/3) + floor($i/3) * 3;
                if (
                    isset($col_found[$board[$j][$i]]) ||
                    isset($sector_found[$sector][$board[$j][$i]])
                ) {
                    return false;
                }
                $col_found[$board[$j][$i]] = 1;
                $sector_found[$sector][$board[$j][$i]] = 1;
            }
        }
        return true;
    }
}
