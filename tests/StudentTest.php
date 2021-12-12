<?php
namespace tests;

use PHPUnit\Framework\TestCase;
use classes\Student;
use db\DB;
require_once 'classes/Student.php';
require_once 'db/DB.php';
require_once 'config.php';

class StudentTest extends TestCase
{

    public function addStudentForTest()
    {
        $newStudent = new Student();
        $newStudent->id = 99;
        $newStudent->student_name = 'Student Test';
        $newStudent->addStudent();
    }

    public function testDeletesStudent()
    {
        $this->addStudentForTest();

        $studentsNamesArray = [];

        $student = new Student(99);
        $student->deleteStudent();

        $allStudents = Student::getStudents();

        foreach ($allStudents as $student) {
            $studentsNamesArray[] = $student->student_name;
        }

        $this->assertNotContains('Student Test', $studentsNamesArray);
    }
}