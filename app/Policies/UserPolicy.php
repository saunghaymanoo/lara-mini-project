<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before(User $user)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }
    public function __construct()
    {
        //
    }
    public function update(User $user)
    {
        return  Auth::id() ==  $user->id;
    }
    public function view(User $user)
    {
        return $user->id == Auth::user()->id;
    }
    public function delete(User $user)
    {
        return $user->id == Auth::user()->id;
    }
}
