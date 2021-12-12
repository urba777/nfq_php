<?php
use classes\Project;
require_once 'config.php';
require_once 'classes/Project.php';
require_once 'db/DB.php';

if (isset($_GET['delete']) && $_GET['delete'] == 'deleteProject') {
    Project::deleteProject();
    header("location: index");
}
