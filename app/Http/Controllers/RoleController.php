<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function addRole(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        Role::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);
        return redirect('Admin.Role')->with('successKey', 'Data inserted successfully!');
    }
    public function getRoles(){
        $displays = Role::all();
        return view('Admin.Role',compact('displays'));
    }

    public function editRole($id){
        $editRole = Role::findOrFail($id);
        return view('edit',compact('editRole'));
    }

    public function updateRole(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
       $updateRole = Role::findOrFail($id);
       $updateRole->update([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
       ]);
       return redirect('Admin.Role')->with('updateKey', 'Data updated successfully!');
    }
    public function deleteRole($id){
        $deleteRole = Role::findOrFail($id);
        $deleteRole->delete();
        return redirect('Admin.Role')->with('deleteKey', 'Data deleted successfully!');
    }
    
}
