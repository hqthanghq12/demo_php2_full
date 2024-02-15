<?php
namespace App\Models;
//require_once 'app/models/BaseModel.php';
use mysql_xdevapi\Table;

class Student extends BaseModel{
    protected $table = 'sinh_vien';
    public function getListStudent() {
        $sql = "select * from $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function addStudent($id, $name, $year_of_birth, $phone_number){
        $sql = "INSERT INTO $this->table VALUES (?,?,?,?)";
        $this->setQuery($sql);
        return $this->execute([$id, $name, $year_of_birth, $phone_number]);
    }
    public function detailStudent($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }
    public function updateStudent($id, $name, $year_of_birth, $phone_number){
        $sql = "UPDATE $this->table SET name= ?, year_of_birth = ?, phone_number = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$name, $year_of_birth, $phone_number, $id]);
    }
    public function deleteStudent($id){
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
}

?>