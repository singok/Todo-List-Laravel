<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Todos extends Component
{
    public $name = null;
    public $description = null;
    public $updateName = null;
    public $updateDescription = null;
    public $status = "Incomplete";
    public $updateID = null;

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    // insert task details
    public function addTask()
    {
        $this->validate();
        $data = new Task();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->status = $this->status;
        $feedback = $data->save();

        if($feedback) {
            $this->dispatchBrowserEvent('add-success', [
                'message' => 'Task Added successfully !!!'
            ]);
            $this->name = null;
            $this->description = null;
        } else {
            $this->dispatchBrowserEvent('add-failure', [
                'message' => 'Something went wrong !!!'
            ]);
        }
    }

    // change status (i.e Complete)
    public function changeStatusToComplete($id)
    {
        DB::table('task')->where('id', $id)->update([
            'status' => 'Complete'
        ]);
        $this->dispatchBrowserEvent('mark-complete', [
            'message' => 'Marked as complete !!!'
        ]);
    }

    // change status (i.e Incomplete)
    public function changeStatusToIncomplete($id)
    {
        DB::table('task')->where('id', $id)->update([
            'status' => 'Incomplete'
        ]);
        $this->dispatchBrowserEvent('mark-incomplete', [
            'message' => 'Unmarked as incomplete !!!'
        ]);
    }

    // delete tasks
    public function deleteTask($id)
    {
        DB::table('task')->where('id', $id)->delete();
        $this->dispatchBrowserEvent('task-delete', [
            'message' => 'Task deleted successfully !!!'
        ]);
    }

    // show update form
    public function showUpdateForm($id)
    {
        $this->updateID = $id;
        $data = DB::table('task')->where('id', '=', $id)->first();
        $this->updateName = $data->name;
        $this->updateDescription = $data->description;
        $this->dispatchBrowserEvent('update-form');
    }

    // update task details
    public function updateTask()
    {
        DB::table('task')->where('id', $this->updateID)->update([
            'name' => $this->updateName,
            'description' => $this->updateDescription
        ]);
        $this->dispatchBrowserEvent('update-success', [
            'message' => 'Task Updated Successfully !!!'
        ]);
    }

    // close update form 
    public function closeUpdateForm()
    {
        $this->dispatchBrowserEvent('update-form-close');
    }

    use WithPagination;
    public function render()
    {
        $data = Task::paginate(5);
        return view('livewire.todos', ['data' => $data]);
    }
}
