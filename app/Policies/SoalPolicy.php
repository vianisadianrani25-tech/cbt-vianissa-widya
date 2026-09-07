<?php

namespace App\Policies;

use App\Models\Soal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SoalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Soal $soal): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Soal $soal): bool
    {
        // Admin selalu boleh, guru hanya boleh edit soal miliknya sendiri
        return $user->hasRole('admin') || $soal->created_by === $user->id;
    }

    public function delete(User $user, Soal $soal): bool
    {
        return $user->hasRole('admin') || $soal->created_by === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Soal $soal): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Soal $soal): bool
    {
        return false;
    }
}
