<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateTodoForm extends Component
{
    use AuthorizesRequests;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('todos.create-todo-form');
    }

    public function createTodo() {
        $this->authorize('create', Todo::class);

        Validator::make($this->state, [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ])->validateWithBag('createTodo');

        auth()->user()->todos()->save(Todo::make($this->state));

        $this->state = [];

        $this->emit('todoAdded');
    }
}
