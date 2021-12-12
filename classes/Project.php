<?php
namespace classes;
require_once 'classes/Group.php';
require_once 'classes/Student.php';

use db\DB;

class Project {
    public $id;
    public $project_name;
    public $number_of_groups;
    public $students_per_group;
    
    public function __construct($id = null) {
        if ($id != null) {
            $ps = DB::get()->prepare("SELECT * FROM project WHERE id=?");
            $ps->execute([$id]);
            $data = $ps->fetch(\PDO::FETCH_ASSOC);
            $this->id = $data['id'];
            $this->project_name = $data['project_name'];
            $this->number_of_groups = $data['number_of_groups'];
            $this->students_per_group = $data['students_per_group'];
        }
    }
    
    public function createProject() {
        $result = DB::get()->prepare("INSERT INTO project (project_name, number_of_groups, students_per_group) VALUES (?, ?, ?)");
        $result->execute([$this->project_name, $this->number_of_groups, $this->students_per_group]);
        for ($i = 1; $i <= $this->number_of_groups; $i++) {
            $group = new Group();
            $group->group_name = 'Group #'.$i;
            $group->createGroup();
        }
    }
    
    public static function getProject() {
        $result = DB::get()->prepare("SELECT * FROM project");
        $result->execute();
        $projects = [];
        foreach ($result->fetchAll() as $project) {
            $projects[] = new Project($project['id']);
        }
        return $projects;
    }
    
    public static function deleteProject() {
        $result = DB::get()->prepare("DELETE FROM project");
        $result->execute();
        Student::deleteAllStudents();
        Group::deleteAllGroups();
        return $result;
    }
}