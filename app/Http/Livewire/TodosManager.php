<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TodosManager extends Component
{
    use AuthorizesRequests;

    /** @var User */
    public $user;

    /** @var int */
    public $toFinalDelete;

    /** @var bool */
    public $confirmingFinalDelete;

    protected $listeners = [
        'todoAdded' => 'refresh'
    ];

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('todos.todos-manager');
    }

    public function markAsDone($todoId) {
        $user = auth()->user();
        $todo = $user->todos()->findOrFail($todoId);
        $this->authorize('update', $todo);

        $todo->fill(['done' => true])->save();

        $this->refresh();
    }

    public function markAsUndone($todoId) {
        $user = auth()->user();
        $todo = $user->todos()->findOrFail($todoId);
        $this->authorize('update', $todo);

        $todo->fill(['done' => false])->save();

        $this->refresh();
    }

    public function delete($todoId) {
        $user = auth()->user();
        $todo = $user->todos()->findOrFail($todoId);

        $this->authorize('delete', $todo);

        $todo->delete();

        $this->refresh();
    }

    public function restore($todoId) {
        $user = auth()->user();
        $todo = $user->todos()->onlyTrashed()->findOrFail($todoId);

        $this->authorize('restore', $todo);

        $todo->restore();

        $this->refresh();
    }

    public function confirmFinalDelete($todoId) {
        $this->confirmingFinalDelete = true;

        $this->toFinalDelete = $todoId;
        logger()->info("to delete: {$todoId}");
    }

    public function finalDelete() {
        logger()->info("final delete #{$this->toFinalDelete}");
        $user = auth()->user();
        $todo = $user->todos()->onlyTrashed()->findOrFail($this->toFinalDelete);
        logger()->info("todo found");

        $this->authorize('forceDelete', $todo);
        logger()->info("authorized");

        $todo->forceDelete();
        logger()->info("deleted really");

        $this->confirmingFinalDelete = false;

        $this->toFinalDelete = null;
        logger()->info("set");

        $this->refresh();
        logger()->info("refreshed");
    }

    public function refresh() {
        $this->user = $this->user->fresh();
    }
}
