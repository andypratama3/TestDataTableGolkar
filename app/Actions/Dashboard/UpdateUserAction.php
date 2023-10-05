<?php

namespace App\Actions\Dashboard;

use App\Models\User;

class UpdateUserAction
{
    public function execute($id):void
    {
        $user = User::where('id',$id)->first();
        $cek_role = $user->role;

        if($cek_role == 1){
            $user = User::where('id',$id)->first();
            $user->role = 0;
            $user->update();

        }else{
            $user = User::where('id',$id)->first();
            $user->role = 1;
            $user->update();
        }
    }
}
