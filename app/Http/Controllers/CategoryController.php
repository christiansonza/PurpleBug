<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        Category::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);
        return redirect('Admin.Category')->with('successKey', 'Data inserted successfully!');
    }
    public function getCategory(){
        $displays = Category::all();
        return view('Admin.Category',compact('displays'));
    }

    public function editCategory($id){
        $editCategory = Category::findOrFail($id);
        return view('edit',compact('editCategory'));
    }

    public function updateCategory(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
       $updateCategory = Category::findOrFail($id);
       $updateCategory->update([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
       ]);
       return redirect('Admin.Category')->with('updateKey', 'Data updated successfully!');
    }
    public function deleteCategory($id){
        $deleteCategory = Category::findOrFail($id);
        $deleteCategory->delete();
        return redirect('Admin.Category')->with('deleteKey', 'Data deleted successfully!');
    }
}
