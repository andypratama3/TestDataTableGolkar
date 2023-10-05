<?php

namespace App\Actions\Dashboard;

use App\Models\User;

class DeleteUserAction
{
    public function execute($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
    }
}

