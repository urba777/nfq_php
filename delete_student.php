<?php
use classes\Student;
require_once 'config.php';
require_once 'classes/Student.php';
require_once 'db/DB.php';

$id = $_GET['delete'];

$student = new Student($id);
$student->deleteStudent();
Header("location: project");