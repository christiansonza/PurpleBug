<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    
    class DashboardController extends Controller
    {
        public function showPieChart()
        {
          
            $user = Auth::user(); 
            
            $data = [];
        
            if ($user) {
             
                $result = DB::table('expenses')
                    ->select('category', DB::raw('SUM(amount) as total_amount'))
                    ->where('user_id', $user->id) 
                    ->groupBy('category')
                    ->get();
        
            
                foreach ($result as $row) {
                    $data[] = [$row->category, (float)$row->total_amount];
                }
            } else {
             
                $roleUser = Auth::guard('role')->user(); 
        
                if ($roleUser) {
                    
                    $result = DB::table('expenses')
                        ->select('category', DB::raw('SUM(amount) as total_amount'))
                        ->where('role_id', $roleUser->id) 
                        ->groupBy('category')
                        ->get();
        
                    foreach ($result as $row) {
                        $data[] = [$row->category, (float)$row->total_amount];
                    }
                }
            }
         
            if (empty($data)) {
                $data = [['No Data', 0]];  
            }

            return view('Admin.Dashboard', compact('data'));
        }
    }        