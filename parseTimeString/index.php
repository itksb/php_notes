<?php

require 'parseTimeStr.php';

echo '<pre>';

print_r(parseTimeStr('23:59:59:999.999'));
print_r(parseTimeStr('59:59:999.999'));
print_r(parseTimeStr('59:999.999'));
print_r(parseTimeStr('23:59:59'));
print_r(parseTimeStr('23:59'));


require 'TimeString.php';

// usage example:
$dt = new TimeString('00:00:15.01');
echo $dt->getDiffInMsec(new TimeString('00:00:01'));

echo '</pre>';