<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // CONTACT INFO WITH AJAX
    // public function list (Request $request) {
    //     $this->validationCheck($request);
    //     $data = $this->getRequestData($request);
    //     logger($data);
    //     Contact::create($data);
    // }

    public function listPage () {
        return view ('user.contact.form');
    }

    // CONTACT INFO WITH FORM POST SUBMIT
    public function list (Request $request) {
        $this->validationCheck($request);
        $data = $this->getRequestData($request);
        Contact::create($data);
        return back()->with(['success' => 'Send Message Success']);
    }

    // ADMIN CONTACT SENDING FROM USER
    public function contactListPage () {
        $contactData = Contact::select('contacts.*' , 'users.image as user_image' , 'users.gender as user_gender' , 'users.id as user_id')
                ->leftJoin('users' , 'contacts.user_id' , 'users.id')
                ->orderBy('created_at' , 'desc')
                ->when(request('searchKey') , function ($query) {
                    $query->orwhere('users.id' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('contacts.name' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('contacts.email' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('contacts.subject' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('contacts.message' , 'like' , '%'.request('searchKey').'%')
                          ->orwhere('users.gender' , 'like' , '%'.request('searchKey').'%');
                })
                ->paginate(3);
        $contactData->appends(request()->all());
                // dd($contactData->toArray());
        return view ('admin.contact.list' , compact ('contactData'));
    }

    // contact edit page
    public function contactEditPage ($id) {
        $data = Contact::select('contacts.*' , 'users.image as user_image' , 'users.gender as user_gender' , 'users.id as user_id')
                    ->leftJoin('users' , 'contacts.user_id' , 'users.id')
                    ->orderBy('created_at' , 'desc')
                    ->when(request('searchKey') , function ($query) {
                        $query->orwhere('users.id' , 'like' , '%'.request('searchKey').'%')
                            ->orwhere('contacts.name' , 'like' , '%'.request('searchKey').'%')
                            ->orwhere('contacts.email' , 'like' , '%'.request('searchKey').'%')
                            ->orwhere('contacts.subject' , 'like' , '%'.request('searchKey').'%')
                            ->orwhere('contacts.message' , 'like' , '%'.request('searchKey').'%')
                            ->orwhere('users.gender' , 'like' , '%'.request('searchKey').'%');
                    })
                    ->where('user_id' , $id)->first();
        // dd($data->toArray());
        return view('admin.contact.edit' , compact('data'));
    }

    // delete contact list
    public function contactDelete ($id) {
        Contact::where('contact_id' , $id)->delete();
        return back();
    }

    // GET REQUEST DATA FROM CONTACT FORM
    private function getRequestData ($request) {
        return [
            'user_id' => Auth::user()->id ,
            'name' => $request->firstName.' '.$request->lastName ,
            'email' => $request->email ,
            'subject' => $request->subject ,
            'message' => $request->message
        ];
    }

    // VALIDATION CHECK
    private function validationCheck($request) {
        Validator::make($request->all() , [
            'firstName' => 'required' ,
            'lastName' => 'required' ,
            'email' => 'required' ,
            'subject' => 'required' ,
            'message' => 'required' ,
        ])->validate();
    }
}
