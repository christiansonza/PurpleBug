<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        
        $user = User::where('name', $request->input('name'))->first();
        if ($user) {
            Auth::login($user);
                return redirect('Admin.Dashboard')->with('showLoader', true); 
        }
    
        $roleUser = Role::where('name', $request->input('name'))->first();
    
        if ($roleUser) {
            Auth::guard('role')->login($roleUser);
                return redirect('Admin.Dashboard')->with('showLoader', true); 
        }
    
        return redirect('/')->withErrors(['credentials' => 'User does not exist.']);
    }
    
    public function logoutUser(){
        Auth::logout();
        session()->flush();
    
        return redirect('/');
    }

    //crud users

    public function addUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required'
        ]);
        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'role'=>$request->input('role'),
        ]);
        return redirect('Admin.User')->with('successKey', 'Data inserted successfully!');
    }
    public function getUser(){
        $displays = User::all();
        return view('Admin.User',compact('displays'));
    }

    public function editUser($id){
        $editUser = User::findOrFail($id);
        return view('edit',compact('editUser'));
    }

    public function updateUser(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required'
        ]);
       $updateUser = User::findOrFail($id);
       $updateUser->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'role'=>$request->input('role'),
       ]);
       return redirect('Admin.User')->with('updateKey', 'Data updated successfully!');
    }
    public function deleteUser($id){
        $deleteUser = User::findOrFail($id);
        $deleteUser->delete();
        return redirect('Admin.User')->with('deleteKey', 'Data deleted successfully!');
    }
}
