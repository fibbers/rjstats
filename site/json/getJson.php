<?php
if(!is_numeric($start)) {
	$start = time() - 24 * 3600 * 3;
}
$command = array();
$command[] = 'rrdtool';
$command[] = 'xport';
$command[] = '--json';
$command[] = '--start '.$start;
$parsedRrdDefs = array();
exec(__DIR__ . "/parserrddefs.py " . RJSTATS_DATA . " $computer $service", $parsedRrdDefs);
$command[] = join(' ', $parsedRrdDefs);
$command[] = '2>&1';
$cmd = join(' ', $command);
if(!isset($_REQUEST['debug'])) {
	header('Content-type: text/plain');
}
passthru($cmd);
?>
