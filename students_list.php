<?php
use classes\Student;
use classes\Project;

require_once 'classes/Student.php';
require_once 'classes/Project.php';
require_once 'db/DB.php';
require_once 'config.php';

$groupName = '';
$API = new Student();

$students = json_decode($API->getStudents());


if (Project::getProject() != []) {
    if ($students != []) {
        echo "<tr>";
        echo "<th>Student</th>";
        echo "<th>Group</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td>$student->student_name</td>";
            ($student->group_name == NULL) ? $groupName = '-' : $groupName = $student->group_name;
            echo "<td>$groupName</td>";
            echo "<td><a href='project?delete=$student->id' class='myButton myButtonDelete'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo "<th>Student</th>";
        echo "<th>Group</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th>There are currently no students</th>";
        echo "<th></th>";
        echo "</tr>";
    }
} else {
    echo "There's no project";
}

    
