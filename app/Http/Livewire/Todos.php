<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Todos extends Component
{
    public $name, $description;
    public $status = "Incomplete";

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
                'message' => 'Successful !!! A new task added.'
            ]);
        } else {
            $this->dispatchBrowserEvent('add-failure', [
                'message' => 'Error !!! Something went wrong.'
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

    use WithPagination;
    public function render()
    {
        $data = Task::paginate(5);
        return view('livewire.todos', ['data' => $data]);
    }
}
