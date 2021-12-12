<?php
namespace classes;

use db\DB;

class Group {
    public $id;
    public $group_name;
    
    public function __construct($id = null) {
        if ($id != null) {
            $ps = DB::get()->prepare("SELECT * FROM groups WHERE id=?");
            $ps->execute([$id]);
            $data = $ps->fetch(\PDO::FETCH_ASSOC);
            $this->id = $data['id'];
            $this->group_name = $data['group_name'];
        }
    }
    
    public static function getGroups() {
        $result = DB::get()->prepare("SELECT * FROM groups");
        $result->execute();
        
        $groups=[];
        foreach ($result->fetchAll(\PDO::FETCH_ASSOC) as $group){
            $groups[]=new Student();
            $groups[sizeof($groups)-1]->id=$group['id'];
            $groups[sizeof($groups)-1]->group_name=$group['group_name'];
        }
        
        return $groups;
    }
    
    public function createGroup() {           
            $result = DB::get()->prepare("INSERT INTO groups (group_name) VALUES (?)");
            $result->execute([$this->group_name]);
    }
    
    public static function deleteAllGroups() {
        $result = DB::get()->prepare("DELETE FROM groups");
        $result->execute();
        return $result;
    }
    
}