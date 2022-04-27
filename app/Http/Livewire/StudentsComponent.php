<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentsComponent extends Component
{
    public $student_id, $name, $phone, $student_edit_id;
  
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'student_id'=>'required|unique:students,student_id,'.$this->student_edit_id, 
            'name' => 'required',
            'phone' => 'required',
        ]);
    }
    public function storeStudentData()
    {
        $this->validate([
            'student_id'=>'required|unique:students,student_id',
            'name' => 'required',
            'phone' => 'required',
        ]);
        Student::create([
            'student_id' => $this->student_id,
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
        session()->flash('message', 'Siswa: '.$this->name.' berhasil ditambahkan');
        $this->dispatchBrowserEvent('modal-close');
        $this->resetInput();
    }
    
    public function editStudent($id)
    {
        $siswa = Student::find($id); 
        $this->student_edit_id = $siswa->id;
        $this->student_id = $siswa->student_id;
        $this->name = $siswa->name;
        $this->phone = $siswa->phone;
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    
    public function updateStudent()
    {
        $this->validate([
            'student_id'=>'required|unique:students,student_id,'.$this->student_edit_id .'', 
            'name' => 'required',
            'phone' => 'required',
        ]);
        $student  = Student::find($this->student_edit_id);
        $student->update([
            'student_id' => $this->student_id,
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
        session()->flash('message', 'Siswa: '.$this->name.' berhasil diubah');
        $this->resetInput();
        $this->dispatchBrowserEvent('modal-close');
    }
    
    public function render()
    {
        $students = Student::all();
        return view('livewire.students-component', compact('students'))->layout('livewire.layouts.base');
    }
    public function resetInput()
    {
        $this->student_id = null;
        $this->name = null;
        $this->phone = null;
        $this->student_edit_id = null;
    }
}
