<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class Todos extends Component
{
    public $name, $description;
    public $status = "Incomplete";

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    // show add form
    public function showForm()
    {
        $this->dispatchBrowserEvent('show-addForm');
    }

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

    public function render()
    {
        return view('livewire.todos');
    }
}
