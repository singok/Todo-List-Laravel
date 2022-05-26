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

    public function showForm()
    {
        $this->dispatchBrowserEvent('show-addForm');
    }
    public function addTask()
    {
        $this->validate();
        $data = new Employee();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->status = $this->status;
        $feedback = $data->save();

        if($feedback) {
            dd('data inserted ');
        }
    }

    public function render()
    {
        return view('livewire.todos');
    }
}
