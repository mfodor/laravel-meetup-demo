<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any todos.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the todo.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function view(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can create todos.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the todo.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function update(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the todo.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function delete(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the todo.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function restore(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the todo.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function forceDelete(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id && $todo->trashed();
    }
}
