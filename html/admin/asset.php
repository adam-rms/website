<?php
require_once __DIR__ . '/common/headSecure.php';

$DBLIB->orderBy("assetCategories.assetCategories_id", "ASC");
$DBLIB->orderBy("assetTypes.assetTypes_name", "ASC");
$DBLIB->join("manufacturers", "manufacturers.manufacturers_id=assetTypes.manufacturers_id", "LEFT");
$DBLIB->where("assetTypes.assetTypes_id", $_GET['id']);
//$DBLIB->where("((SELECT COUNT(*) FROM assets WHERE assetTypes.assetTypes_id=assets.assetTypes_id AND assets.instances_id = '" . $AUTH->data['instance']['instances_id'] . "' AND assets_deleted = 0) > 0)");
$DBLIB->join("assetCategories", "assetCategories.assetCategories_id=assetTypes.assetCategories_id", "LEFT");
$PAGEDATA['asset'] = $DBLIB->getone('assetTypes', ["*", "assetTypes.instances_id as assetInstances_id"]); //have to double download it as otherwise manufacturer instance id is returned instead
if (!$PAGEDATA['asset']) die("404 Asset Not Found");
$PAGEDATA['asset']['thumbnail'] = $bCMS->s3List(2, $PAGEDATA['asset']['assetTypes_id']);
$PAGEDATA['asset']['files'] = $bCMS->s3List(3, $PAGEDATA['asset']['assetTypes_id']);
$PAGEDATA['asset']['fields'] = explode(",", $PAGEDATA['asset']['assetTypes_definableFields']);

$DBLIB->where("assets.instances_id", $AUTH->data['instance']['instances_id']);
$DBLIB->where("assets.assetTypes_id", $PAGEDATA['asset']['assetTypes_id']);
if (isset($_GET['asset'])) {
    $PAGEDATA['asset']['oneasset'] = true;
    $DBLIB->where("assets.assets_id", $_GET['asset']);
}
$DBLIB->where("assets.assets_deleted", 0);
$assets = $DBLIB->get("assets", null);
if (!$assets) die("404 Assets Not Found");
$PAGEDATA['assets'] = [];
foreach ($assets as $asset) {
    if ($AUTH->data['users_selectedProjectID'] != null and $AUTH->instancePermissionCheck(31)) {
        //Check availability
        $DBLIB->where("assets_id", $asset['assets_id']);
        $DBLIB->where("assetsAssignments.assetsAssignments_deleted", 0);
        $DBLIB->where("(projects.projects_id = '" . $PAGEDATA['thisProject']['projects_id'] . "' OR projects.projects_status NOT IN (" . implode(",", $GLOBALS['STATUSES-AVAILABLE']) . "))");
        $DBLIB->join("projects", "assetsAssignments.projects_id=projects.projects_id", "LEFT");
        $DBLIB->where("projects.projects_deleted", 0);
        $DBLIB->where("((projects_dates_deliver_start >= '" . $PAGEDATA['thisProject']["projects_dates_deliver_start"]  . "' AND projects_dates_deliver_start <= '" . $PAGEDATA['thisProject']["projects_dates_deliver_end"] . "') OR (projects_dates_deliver_end >= '" . $PAGEDATA['thisProject']["projects_dates_deliver_start"] . "' AND projects_dates_deliver_end <= '" . $PAGEDATA['thisProject']["projects_dates_deliver_end"] . "') OR (projects_dates_deliver_end >= '" . $PAGEDATA['thisProject']["projects_dates_deliver_end"] . "' AND projects_dates_deliver_start <= '" . $PAGEDATA['thisProject']["projects_dates_deliver_start"] . "'))");
        $asset['assignment'] = $DBLIB->get("assetsAssignments", null, ["assetsAssignments.projects_id", "projects.projects_name"]);
    }

    //Flags&Blocks
    $asset['flagsblocks'] = assetFlagsAndBlocks($asset['assets_id']);

    //Calendar
    $DBLIB->where("assets_id", $asset['assets_id']);
    $DBLIB->where("assetsAssignments.assetsAssignments_deleted", 0);
    $DBLIB->join("projects", "assetsAssignments.projects_id=projects.projects_id", "LEFT");
    $DBLIB->where("projects.projects_deleted", 0);
    $asset['assignments'] = $DBLIB->get("assetsAssignments", null, ["assetsAssignments.projects_id", "projects.projects_status", "projects.projects_name","projects_dates_deliver_start","projects_dates_deliver_end"]);

    $asset['files'] = $bCMS->s3List(4, $asset['assets_id']);

    $PAGEDATA['assets'][] = $asset;
}
$PAGEDATA['pageConfig'] = ["TITLE" => $PAGEDATA['asset']['assetTypes_name'], "BREADCRUMB" => false];

// For asset type editing
$DBLIB->where("(manufacturers.instances_id IS NULL OR manufacturers.instances_id = '" . $AUTH->data['instance']['instances_id'] . "')");
$DBLIB->orderBy("manufacturers_name", "ASC");
$PAGEDATA['manufacturers'] = $DBLIB->get('manufacturers', null, ["manufacturers.manufacturers_id", "manufacturers.manufacturers_name"]);

$DBLIB->orderBy("assetCategories_rank", "ASC");
$PAGEDATA['categories'] = $DBLIB->get('assetCategories');

// Jobs
if (count($PAGEDATA['assets']) == 1) {
    $DBLIB->where("maintenanceJobs.maintenanceJobs_deleted", 0);
    $DBLIB->where("(FIND_IN_SET(" .$PAGEDATA['assets'][0]['assets_id'] . ", maintenanceJobs.maintenanceJobs_assets) > 0)");
    $DBLIB->join("maintenanceJobsStatuses", "maintenanceJobs.maintenanceJobsStatuses_id=maintenanceJobsStatuses.maintenanceJobsStatuses_id", "LEFT");
    $DBLIB->join("users AS userCreator", "userCreator.users_userid=maintenanceJobs.maintenanceJobs_user_creator", "LEFT");
    $DBLIB->join("users AS userAssigned", "userAssigned.users_userid=maintenanceJobs.maintenanceJobs_user_assignedTo", "LEFT");
    $DBLIB->orderBy("maintenanceJobsStatuses.maintenanceJobsStatuses_order", "ASC");
    $DBLIB->orderBy("maintenanceJobs.maintenanceJobs_timestamp_due", "ASC");
    $DBLIB->orderBy("maintenanceJobs.maintenanceJobs_timestamp_added", "ASC");
    $PAGEDATA['assets'][0]['jobs'] = $DBLIB->get('maintenanceJobs', null, ["maintenanceJobs.*", "maintenanceJobsStatuses.maintenanceJobsStatuses_name","userCreator.users_userid AS userCreatorUserID", "userCreator.users_name1 AS userCreatorUserName1", "userCreator.users_name2 AS userCreatorUserName2", "userCreator.users_email AS userCreatorUserEMail","userAssigned.users_name1 AS userAssignedUserName1","userAssigned.users_userid AS userAssignedUserID", "userAssigned.users_name2 AS userAssignedUserName2", "userAssigned.users_email AS userAssignedUserEMail"]);
}


echo $TWIG->render('asset.twig', $PAGEDATA);
?>
