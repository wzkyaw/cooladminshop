<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChangeUserController extends Controller
{
    // DIRECT CHANGE USER ACCOUNT TO ADMIN LIST PAGE
    public function userList (Request $request) {
        $user = User::when(request('searchKey') , function ($query) {
                    $query->orWhere('name' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('gender' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('email' , 'like' , '%'.request('searchKey').'%');
                })
                ->where('role' , 'user')
                ->paginate(3);
        $user->appends($request->all());
        return view ('admin.user.list' , compact ('user'));
    }

    // CHANGE USER TO ADMIN ACCOUNT
    public function changeStatus (Request $request) {
        User::where('id' , $request->userId)->update([
            'role' => $request->status
        ]);
    }
}
