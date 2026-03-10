<?php
if (!function_exists('pagination')) {
    function pagination($currentPage, $length, $delta = 2)
    {
        $left = $currentPage - $delta;
        $right = $currentPage + $delta + 1;
        $range = [];
        $rangeWithDots = [];
        $l = null;

        for ($i = 1; $i <= $length; $i++) {
            if ($i == 1 || $i == $length || ($i >= $left && $i < $right)) {
                $range[] = $i;
            }
        }

        foreach ($range as $i) {
            if ($l) {
                if ($i - $l === 2) {
                    $rangeWithDots[] = $l + 1;
                } else if ($i - $l !== 1) {
                    $rangeWithDots[] = '...';
                }
            }
            $rangeWithDots[] = $i;
            $l = $i;
        }

        return $rangeWithDots;
    }
}
