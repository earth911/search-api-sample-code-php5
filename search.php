<?php
require_once 'config.php';

require_once 'lib/Earth911Api.php';
require_once 'lib/Earth911Utils.php';

$api = new Earth911Api(EARTH911_API_URL, EARTH911_API_KEY);

$searchArgs = $searchArgs = new SearchArgs($_REQUEST, $api);
$baseUrl = 'search?' . $searchArgs->queryString();

$locations = array();
$programs = array();

// Perform search queries

if ($searchArgs->what && $searchArgs->where) {
    // Find matching materials

    $args = array('query' => $searchArgs->what);
    $materials = $api->searchMaterials($args);

    $material_ids = array();
    foreach ($materials as $material) {
        $material_ids[] = $material['material_id'];
    }

    // If materials were found, run the query

    if ($material_ids) {
        $args = array('latitude' => $searchArgs->latitude,
                      'longitude' => $searchArgs->longitude,
                      'material_id' => $material_ids);
        $locations = $api->searchLocations($args);
        $programs = $api->searchPrograms($args);
    }
}

$results = array();
foreach ($locations as $location) {
    $location['type'] = 'location';
    $location['id'] = $location['location_id'];
    $results[] = $location;
}
foreach ($programs as $program) {
    $program['type'] = 'program';
    $program['id'] = $program['program_id'];
    $results[] = $program;
}

$page = intval(isset($_REQUEST['page']) ? $_REQUEST['page'] : 1);
$pager = new SearchPager($results, $page);
$results = $pager->result();

$location_ids = array();
$program_ids = array();
        
foreach ($results as &$result) {
    if ($result['type'] == 'location') {
        $location_ids[] = $result['id'];
    }
    if ($result['type'] == 'program') {
        $program_ids = $result['id'];
    }
    $result['url'] =
        ('details.php?type=' . $result['type']
         . '&id=' . $result['id']
         . '&' . $searchArgs->queryString());
}

$location_details = array();
if ($location_ids) {
    $args = array('location_id' => $location_ids);
    $location_details = $api->getLocationDetails($args);
}

$program_details = array();
if ($program_ids) {
    $args = array('program_id' => $program_ids);
    $program_details = $api->getProgramDetails($args);
}

$locationDetails = $location_details;
$programDetails = $program_details;

$content = 'search.tpl.php';
include 'templates/base.tpl.php';
?>
