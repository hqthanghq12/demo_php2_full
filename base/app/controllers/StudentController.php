<?php
namespace App\Controllers;
use App\Models\Student;
//include_once 'app/models/Student.php';
//include_once 'app/controllers/BaseController.php';
class StudentController extends BaseController{
    public $student;
    public function __construct()
    {
        $this->student = new Student();
    }

    public function getStudent() {
        $students = $this->student->getListStudent();
        $title = 'Danh sách sinh viên';
        return $this->render('student.index',compact('students', 'title'));
    }
    public function addStudent(){
        $title = 'Thêm sinh viên';
        return $this->render('student.add', compact('title'));
    }
    public function postStudent(){
        if(isset($_POST['btn-submit'])){
            $error = [];
            if(empty($_POST['name'])){
                $error[] = 'Vui lòng nhập tên';
            }
            if(empty($_POST['year_of_birth'])){
                $error[] = 'Vui lòng nhập năm sinh';
            }
            if(empty($_POST['phone_number'])){
                $error[] = 'Vui lòng nhập số điện thoại';
            }
            if(count($error)>=1){
                redirect('errors', $error, 'add-student');
            }else{
                $check = $this->student->addStudent(NULL, $_POST['name'], $_POST['year_of_birth'], $_POST['phone_number']);
                if($check){
                    redirect('success', "Thêm thành công sinh viên", 'add-student');
                }
            }
        }
    }
    public function detailStudent($id){
        $detailStudent = $this->student->detailStudent($id);
        return $this->render('student.edit', compact('detailStudent'));
    }
    public function updateStudent($id){
        if(isset($_POST['btn-submit'])){
            $error = [];
            if(empty($_POST['name'])){
                $error[] = 'Vui lòng nhập tên';
            }
            if(empty($_POST['year_of_birth'])){
                $error[] = 'Vui lòng nhập năm sinh';
            }
            if(empty($_POST['phone_number'])){
                $error[] = 'Vui lòng nhập số điện thoại';
            }
            $detailStudent = 'detail-student/'.$id;
            if(count($error)>=1){
                redirect('errors', $error, $detailStudent);
            }else{
                $check = $this->student->updateStudent($id, $_POST['name'], $_POST['year_of_birth'], $_POST['phone_number']);
                if($check){
                    redirect('success', "Sửa thành công sinh viên", $detailStudent);
                }
            }
        }
    }
    public function deleteStudent($id){
        $check = $this->student->deleteStudent($id);
        if ($check){
            redirect('success', "Xóa thành công sinh viên", 'list-students');
        }
    }
}
