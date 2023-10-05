<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Dashboard\DeleteUserAction;
use App\Actions\Dashboard\UpdateUserAction;

class UserController extends Controller
{
    public function index()
    {
        $no = 0;
        $users = User::all();
        return view('dashboard.user.index', compact('no','users'));
    }
    public function show(UpdateUserAction $updateUserAction, $id)
    {
        $updateUserAction->execute($id);
        return redirect()->route('dashboard.user.index')->with('success','Role Berhasil di Ganti');
    }
    public function destroy(DeleteUserAction $deleteuserAction,$id)
    {
        $deleteuserAction->execute($id);
        redirect()->route('dashboard.user.index')->with('success','User Berhasil Di Hapus');
    }
}
