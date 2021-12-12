<?php 
use classes\Project;
use classes\Group;
use classes\Student;
use PHPUnit\Framework\MockObject\Api;

require_once 'config.php';
require_once 'classes/Project.php';
require_once 'classes/Group.php';
require_once 'classes/Student.php';
require_once 'db/DB.php';

if (isset($_POST['studentsSelect'])) {
    $result = $_POST['studentsSelect'];
    $result_explode = explode('|', $result);
    $student_id = $result_explode[0];
    $group_id = $result_explode[1];
    $student = new Student($student_id);
    $student->group_id = $group_id;
    $student->save();
}

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/index.js" defer></script>
<script>
/////////////////////////automatically update every 10 seconds
$(document).ready(function() {
	$("#projectInfoTable").load("students_list.php");
	$("#groupsUpdate").load("groups.php")
	setInterval(function() {
	$("#projectInfoTable").load("students_list.php");
	$("#groupsUpdate").load("groups.php");
	refresh();
	} ,10000);
});
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mohave:wght@400;500&display=swap" rel="stylesheet">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<title>Deividas Urbanavičius - NFQ Internship Task</title>
</head>
<body>
<?php //pop ups//////////////////////////////////////////////////////////////////
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $studentExists = Student::checkIfStudentExists($name);
    if ($studentExists == true || $name == '' || is_numeric($name)) { ?>
        <div class="studentExistsPopUp" id="studentExistsPopUp">
            <div class="popUpBackground" id="popUpBackground"></div>
            <div class="popUpBox">
            <?php if ($studentExists == true) {?>
                    <span class="studentExistsSpan">This student already exists</span>
            <?php }
                  if ($name == '') {?>
                  	<span class="studentExistsSpan">You must enter full name</span>
            <?php }
                  if (is_numeric($name)) {?>
                  	<span class="studentExistsSpan">Name can't be numbers</span>
            <?php }?>
                    <div>
                        <span id="goBackIfStudentExists" class="myButton myButtonDelete">Go Back</span>
                    </div>     
        	</div>
		</div>
    <?php } else {
        $student = new Student();
        $student->student_name = $_POST['name'];
        $student->addStudent();
    }
} ?>
<div class="addStudentPopUp" id="addStudentPopUp">
	<div class="popUpBackground" id="popUpBackground"></div>
    <div class="popUpBox">
    	<form method="post">
        	<span class="studentExistsSpan">Add new student</span>
        	<input maxlength="32" type="text" placeholder="Enter full name" name="name" class="addStudentInput">
        	<div>
        		<button type="submit" class="myButton">ADD</button>
        		<span id="goBack" class="myButton myButtonDelete">Go Back</span>
        	</div>
    	</form>
    </div>
</div>
<?php
if (isset($_GET['delete'])) {
    ($_GET['delete'] != "deleteProject") ? $student = new Student($_GET['delete']) : $deleteProject = $_GET['delete'];
?>
<div class="popUpDelete" id="popUpDelete">
	<div class="popUpBackground"></div>
    <div class="popUpBox">
    	<span>Delete <?=($_GET['delete'] != "deleteProject") ? $student->student_name : "project with all information"?></span>
    	<span>Are you sure?</span>
    	<?= ($_GET['delete'] == "deleteProject") ? '<span>You can create a new project</span>' : ''?>
    	<div>
    		<a href="<?=($_GET['delete'] != "deleteProject") ? "delete_student?delete=".$student->id : "delete_project?delete=".$deleteProject?>" class="myButton">Yes</a>
    		<a href="project" class="myButton myButtonDelete">No</a>
    	</div>
    </div>
</div>
<?php } //MAIN /////////////////////////////////////////////////////////////
$createdProject = Project::getProject();
$project = end($createdProject);
if ($createdProject != []) { ?>
<div class="mainContainer" id="is_project_created">
	<div class="wrapperMainContainer">
    	<div class="projectInfo">
        	<div class="projectInfoH3">
                <h3>Project name: <?= $project->project_name?></h3>
                <h3>Number of groups: <?= $project->number_of_groups?></h3>
                <h3>Students per group: <?= $project->students_per_group?></h3>
           	</div>
            <table class="projectInfoTable" id="projectInfoTable"></table>
            <button class="myButton addStudentButton" id="addStudentButton">ADD STUDENT</button>
        </div>
        <div class="groups" id="groupsUpdate"></div>
    </div>
    <form method="get">
    	<a href="project?delete=deleteProject" class="myButton myButtonDelete">Delete project</a>
    </form>
</div>
<?php
} else {
    header("Location: index");
}
?>
</body>
</html>