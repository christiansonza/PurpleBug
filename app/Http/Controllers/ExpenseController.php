<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function addExpense(Request $request) {
        $request->validate([
            'category' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);
    
        $expenseData = [
            'category' => $request->input('category'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
        ];
    
        $user = Auth::user();
        
        if ($user) {
            $expenseData['user_id'] = $user->id;
        } else {
            $roleUser = Auth::guard('role')->user();
            
            if ($roleUser) {
                $expenseData['role_id'] = $roleUser->id;
            } 
        }
        Expense::create($expenseData);
        return redirect('User.Expense')->with('successKey', 'Data inserted successfully!');
    }
    
    public function getExpense() {
        $displays = collect(); 
        
        if ($userId = Auth::id()) {
            $userExpenses = Expense::where('user_id', $userId)->get(); 
            $displays = $displays->merge($userExpenses); 
        } 
        elseif ($roleUser = Auth::guard('role')->user()) { 
            $roleExpenses = Expense::where('role_id', $roleUser->id)->get(); 
            $displays = $displays->merge($roleExpenses); 
        }
    
        $categories = Category::all();
        
        return view('User.Expense', compact('displays', 'categories'));
    }
    
    
    
    public function editExpense($id){
        $editExpense = Expense::findOrFail($id);
        return view('edit',compact('editExpense'));
    }

    public function updateExpense(Request $request, $id){
        $request->validate([
            'category'=>'required',
            'amount'=>'required',
            'date'=>'required'
        ]);
       $updateExpense = Expense::findOrFail($id);
       $updateExpense->update([
        'category'=>$request->input('category'),
        'amount'=>$request->input('amount'),
        'date'=>$request->input('date'),
       ]);
       return redirect('User.Expense')->with('updateKey', 'Data updated successfully!');
    }

    public function deleteExpense($id){
        $deleteExpense = Expense::findOrFail($id);
        $deleteExpense->delete();
        return redirect('User.Expense')->with('deleteKey', 'Data deleted successfully!');
    }
}
