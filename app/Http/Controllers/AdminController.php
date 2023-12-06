<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // ADMIN ACCOUNT CHANGE PASSWORD PAGE
    public function changePasswordPage () {
        return view('admin.account.changePassword');
    }

    // ADMIN ACCOUNT CHANGE PASSWORD
    public function changePassword (Request $request) {
        $this->changePasswordValidation($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        $clientHashPassword = $this->getUserPassword($request);

        if (Hash::check($request->currentPassword, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update($clientHashPassword);

            // Auth::logout();
            return back()->with(['changeSuccess' => 'Changed Password Successfully!']);
        }
        return back()->with(['notMatch' => 'The Current Password Is Not Match, try again!']);
    }

    // DIRECT ADMIN ACCOUNT DETAILS
    public function details () {
        return view ('admin.account.details');
    }

    // DIRECT ADMIN ACCOUNT
    public function edit () {
        return view ('admin.account.edit');
    }

    // UPDATE ADMIN PROFILE
    public function update (Request $request , $id) {
        $this->acccountValidationCheck($request);
        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id' , $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public' , $fileName);
            $data['image'] = $fileName;
        }

        User::where('id' , $id)->update($data);
        return redirect()->route('admin#details');
    }

    // DIRECT ADMIN LIST
    public function list () {
        $admin = User::when(request('searchKey') , function ($query) {
                    $query->orWhere('name' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('email' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('gender' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('phone' , 'like' , '%'.request('searchKey').'%')
                          ->orWhere('address' , 'like' , '%'.request('searchKey').'%');
                })
                ->where('role' , 'admin')
                ->paginate(3);
        $admin->appends(request()->all());
        return view ('admin.account.list' , compact('admin'));
    }

    // DELETE ADMIN ACCOUNT
    public function delete ($id) {
        User::where('id' , $id)->delete();
        return back()->with(['deleteSuccess' => 'Deleted Account Successfully']);
    }

    // DIRECT CHANGE ROLE PAGE
    public function changeRole ($id) {
        $changeData = User::where('id' , $id)->first();
        return view ('admin.account.changeRole' , compact('changeData'));
    }

    // CHANGE ROLE
    public function change (Request $request , $id) {
        $data = $this->requestUserData($request);
        User::where('id' , $id)->update($data);
        return redirect()->route('admin#list');
    }

    // AJAX CHANGE ROLE STATUS
    public function ajaxChangeStatus (Request $request) {
        $data = [
            'role' => $request->status
        ];
        User::where('id' , $request->userId)->update($data);
    }

    // USER LIST DELETE
    public function userListDelete ($id) {
        User::where('id' , $id)->delete();
        return back();
    }

    // DIRECT USER EDIT LIST PAGE
    public function userListEdit ($id) {
        $data = User::where('id' , $id)->first();
        // dd($data);
        return view('admin.user.edit' , compact('data'));
    }

    // USER LIST UPDATE ROLE
    public function updateUserList (Request $request , $id) {
        $data = [
            'role' => $request->role ,
        ];

        User::where('id' , $id)->update($data);
        return redirect()->route('user#list');
    }

    // REQUEST USER DATA TO CHANGE ROLE
    private function requestUserData($request) {
        return [
            'role' => $request->role
        ];
    }

    // ACCOUNT VALIDATION CHECK
    private function acccountValidationCheck($request) {
        Validator::make($request->all() , [
            'name' => 'required' ,
            'email' => 'required' ,
            'address' => 'required' ,
            'phone' => 'required' ,
            'image' => 'mimes:png,jpg,jpeg | file' ,
            'gender' => 'required'
        ])->validate();
    }

    // get user data
    private function getUserData ($request) {
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'address' => $request->address ,
            'phone' => $request->phone ,
            'gender' => $request->gender ,
        ];
    }

    // get user password
    private function getUserPassword ($request) {
        return [
            'password' => Hash::make($request->confirmedPassword),
        ];
    }

    // Change Password validation
    private function changePasswordValidation ($request) {
        Validator::make($request->all(), [
            'currentPassword' => ' required | min:6 ',
            'newPassword' => 'required | min:6',
            'confirmedPassword' => 'required | min:6 | same:newPassword',
        ])->validate();
    }
}
