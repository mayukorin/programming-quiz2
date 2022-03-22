<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Stock;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Stock $stock)
    {
        return $user->id === $stock->user_id;
    }
}
