<?php
namespace classes;

use db\DB;

class Student {
    public $id;
    public $student_name;
    public $group_id;
    public $date;
    public $group_name;
    
    public function __construct($id = null) {
        if ($id != null) {
            $ps = DB::get()->prepare("SELECT * FROM students WHERE id=?");
            $ps->execute([$id]);
            $data = $ps->fetch(\PDO::FETCH_ASSOC);
            $this->id = $data['id'];
            $this->date = $data['date'];
            $this->student_name = $data['student_name'];
            $this->group_id = $data['group_id'];
        }
    }
    
    public function addStudent() {
        $result = DB::get()->prepare("INSERT INTO students (id, student_name) VALUES (?, ?)");
        $result->execute([$this->id, $this->student_name]);
    }
    
    public function deleteStudent(){
        $result = DB::get()->prepare("DELETE FROM students WHERE id=?");
        $result->execute([$this->id]);
    }
    
    public function getStudents() {
        $result = DB::get()->prepare("SELECT students.*, groups.group_name AS gr_name FROM students LEFT JOIN groups ON groups.id = students.group_id");
        $result->execute();
        
        $students = array();
        
        while ($OutputData = $result->fetch(\PDO::FETCH_ASSOC)){
            $students[$OutputData['id']] = array(
                'id' => $OutputData['id'],
                'student_name' => $OutputData['student_name'],
                'group_id' => $OutputData['group_id'],
                'group_name' => $OutputData['gr_name']
            );
        }
        
        return json_encode($students);
    }
    
    public static function getStudentByGroup($group_id) {
        $result = DB::get()->prepare("SELECT * FROM students WHERE group_id = ? ORDER BY date ASC");
        $result->execute([$group_id]);
        
        $students=[];
        foreach ($result->fetchAll(\PDO::FETCH_ASSOC) as $student){
            $students[]=new Student();
            $students[sizeof($students)-1]->student_name=$student['student_name'];
            $students[sizeof($students)-1]->group_id=$student['group_id'];
        }
        
        return $students;
    }
    
    public function save() {
        $result = DB::get()->prepare("UPDATE students SET group_id=?, date=? WHERE id=?");
        $result->execute([$this->group_id, date('Y-m-d H:i:s'), $this->id]);
    }
    
    
    public static function checkIfStudentExists($name) {
        $API = new Student();
        
        $allStudents = json_decode($API->getStudents());
        
        $result = false;
        foreach ($allStudents as $student) {
            if ($student->student_name == $name) {
                $result = true;
            }
        }
        
        return $result;
    }
    
    
    public static function deleteAllStudents() {
        $result = DB::get()->prepare("DELETE FROM students");
        $result->execute();
        return $result;
    }
    
}