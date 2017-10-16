<?php

/**
 * Parses time string from right to left. String must be in one of the following formats:
 * 23:59:59:999.999
 * 59:59:999.999
 * 59:999.999
 * micro - required
 * msec - required
 * sec - required
 * min - NOT required
 * hours - NOT required
 * @param $str string Timestring
 *
 * @return array Associative array with keys 'micro', 'msec', 'sec', 'min', 'hours'
 */
function parseTimeStr($str)
{
	$respKeys = ['micro', 'msec', 'sec', 'min', 'hours'];
	$pattern  = '/^([\d]{1,3})\.([\d]{1,3}):([\d][0-5]){1,2}(?::([\d][0-5]){1,2})?(?::([\d][0-5]){1,2})?$/m';
	preg_match($pattern, strrev($str), $matches, 0, 0);
	array_shift($matches);
	return array_combine($respKeys,
		array_pad(array_map('strrev', $matches), count($respKeys), 0));
}