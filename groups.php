<?php
use classes\Student;
use classes\Group;
use classes\Project;

require_once 'classes/Student.php';
require_once 'classes/Group.php';
require_once 'classes/Project.php';
require_once 'db/DB.php';
require_once 'config.php';

$createdProject = Project::getProject();
$API = new Student();

$students = json_decode($API->getStudents());

if ($createdProject != []) {
    $project = end($createdProject);
    $studentsPerGroup = $project->students_per_group;

    foreach (Group::getGroups() as $group) {
        $studentsByGroup = Student::getStudentByGroup($group->id);
        echo "<form method='post'>";
        if (count($studentsByGroup) == $studentsPerGroup) {
            echo "<span class='full'>GROUP IS FULL</span>";
        } else {
            echo "";
        }
        echo "<table class='groupsTable'>";
        echo "<tr>";
        echo "<th>";
        echo $group->group_name;
        echo "</th>";
        echo "</tr>";
        foreach ($studentsByGroup as $student) {
            echo "<tr>";
            echo "<td>";
            echo $student->student_name;
            echo "</td>";
            echo "</tr>";
        }
        for ($i = 1; $i <= $studentsPerGroup - count($studentsByGroup); $i ++) {
            echo "<tr>";
            echo "<td>";
            echo "<select onchange='this.form.submit()' name='studentsSelect'>";
            echo "<option selected disabled='disabled' hidden value=''>Assign student</option>";
            foreach ($students as $student) {
                if ($student->group_id != $group->id) {
                    echo "<option value='$student->id|$group->id'>$student->student_name</option>";
                }
            }
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
    }
} else {
    echo "<script>window.location.reload()</script>";
}
