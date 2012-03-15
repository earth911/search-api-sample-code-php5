<?php
require_once 'config.php';

require_once 'lib/Earth911Api.php';
require_once 'lib/Earth911Utils.php';

$api = new Earth911Api(EARTH911_API_URL, EARTH911_API_KEY);

$searchArgs = $searchArgs = new SearchArgs($_REQUEST, $api);

$type = $_REQUEST['type'];
$id = $_REQUEST['id'];

$args = array();

$details = null;

if ($type == 'location') {
    $args['location_id'] = $id;
    $details = $api->getLocationDetails($args);
} elseif ($type == 'program') {
    $args['program_id'] = $id;
    $details = $api->getProgramDetails($args);
}

if ($details) {
    $details = $details[$id];
}

$content = 'details.tpl.php';
include 'templates/base.tpl.php';
?>
