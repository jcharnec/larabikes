<?php

namespace App\Policies;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BikePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Bike $bike)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Bike $bike)
    {
        //true si el usuario es el propietario o tiene uno de los roles
        return  $user->isOwner($bike) ||
                $user->hasRole(['editor', 'administrador', 'todopoderoso']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Bike $bike)
    {
        //true si el usuario es el propietario o tiene uno de los roles
        return  $user->isOwner($bike) ||
                $user->hasRole(['administrador', 'todopoderoso']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Bike $bike)
    {
        //true si el usuario es el propietario o tiene uno de los roles
        return $user->isOwner($bike) ||
                $user->hasRole(['administrador', 'todopoderoso']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bike  $bike
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Bike $bike)
    {
        //
    }
}
