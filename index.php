<?php 
use classes\Project;

require_once 'config.php';
require_once 'classes/Project.php';
require_once 'db/DB.php';

$validations = [''];
$errorBorderColor = 'red';
$nameBorderColor = '#CCCCCC'; $numberOfGroupsBorderColor = '#CCCCCC'; $studentsPerGroupBorderColor = '#CCCCCC'; 
$createdProject = Project::getProject();

//validations
if (isset($_POST['projectName']) && $_POST['projectName'] == '') {
    $validations[] = "You must enter project name";
    $nameBorderColor = $errorBorderColor;
} elseif (isset($_POST['projectName']) && is_numeric($_POST['projectName'])) {
    $validations[] = "Name must be letters";
    $nameBorderColor = $errorBorderColor;
}
if (isset($_POST['numberOfGroups']) && $_POST['numberOfGroups'] == '') {
    $validations[] = "You must enter a number of groups";
    $numberOfGroupsBorderColor = $errorBorderColor;
} elseif (isset($_POST['numberOfGroups']) && !is_numeric($_POST['numberOfGroups'])) {
    $validations[] = "Number of groups must be number";
    $numberOfGroupsBorderColor = $errorBorderColor;
} elseif (isset($_POST['numberOfGroups']) && $_POST['numberOfGroups'] == 0) {
    $validations[] = "Number of groups can't be 0";
    $numberOfGroupsBorderColor = $errorBorderColor;
}
if (isset($_POST['studentsPerGroup']) && $_POST['studentsPerGroup'] == '') {
    $validations[] = "You must enter a number of students per group";
    $studentsPerGroupBorderColor = $errorBorderColor;
} elseif (isset($_POST['studentsPerGroup']) && !is_numeric($_POST['studentsPerGroup'])) {
    $validations[] = "Students per groups must be a number";
    $studentsPerGroupBorderColor = $errorBorderColor;
} elseif (isset($_POST['studentsPerGroup']) && $_POST['studentsPerGroup'] == 0) {
    $validations[] = "Students per groups can't be 0";
    $studentsPerGroupBorderColor = $errorBorderColor;
}

if (isset($_POST['projectName']) && $_POST['projectName'] != '' && !is_numeric($_POST['projectName'])
    && is_numeric($_POST['numberOfGroups'])  && $_POST['numberOfGroups'] != '' && $_POST['studentsPerGroup'] != '' 
    && is_numeric($_POST['studentsPerGroup']) && $createdProject == [] && $_POST['studentsPerGroup'] != 0 && $_POST['numberOfGroups'] != 0) {
        $project = new Project();
        $project->project_name = $_POST['projectName'];
        $project->number_of_groups = $_POST['numberOfGroups'];
        $project->students_per_group = $_POST['studentsPerGroup'];
        $project->createProject();
        header("Refresh:0");
}
?>
<!DOCTYPE html>
<html>
<head>
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
<?php 

if ($createdProject == []) {
?>
<div class="mainContainer newProject">
	<h2>Create new project</h2>
	<form method="post">
		<label>Project name:</label>
    	<input maxlength="32" style="border-color: <?=$nameBorderColor?>" type="text" name="projectName" placeholder="Project name" value=<?=(isset($_POST['projectName']) ? $_POST['projectName'] : '')?>>
    	<label>Number of groups:</label>
    	<input maxlength="2" style="border-color: <?=$numberOfGroupsBorderColor?>" type="text" name="numberOfGroups" placeholder="Number of groups" value=<?=(isset($_POST['numberOfGroups']) ? $_POST['numberOfGroups'] : '')?>>
    	<label>Students per group:</label>
    	<input maxlength="2" style="border-color: <?=$studentsPerGroupBorderColor?>"  type="text" name="studentsPerGroup" placeholder="Students per group" value=<?=(isset($_POST['studentsPerGroup']) ? $_POST['studentsPerGroup'] : '')?>>
    	<button class="myButton" type="submit">CREATE PROJECT</button>
	</form>
	<?php foreach ($validations as $error) {?>
		<h2 class="error"><?=$error?></h2>
	<?php }?>
</div>
<?php 
} else {
    header("Location: project");
}
?>
</body>
</html>