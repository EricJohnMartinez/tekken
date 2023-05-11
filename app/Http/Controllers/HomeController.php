<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $dept = [];
        $empStat = [];
        $jobRelate = [];
        $civil = [];
        $workStat =[];
        $position =[];
        $userCoordinates = [];
    
        // Get department  
        $uniqueDepts = $users->pluck('department')->unique();
        foreach ($uniqueDepts as $department) {
            $count = $users->where('department', $department)->count();
            if ($department && $count) {
                $dept[] = [
                    'label' => $department,
                    'value' => $count
                ];
            }
        }
        
        // Employment
        $uniqueEmpStats = $users->pluck('employment_status')->unique();
        foreach ($uniqueEmpStats as $status) {
            $count = $users->where('employment_status', $status)->count();
            if ($status && $count) {
                $empStat[] = [
                    'label' => $status,
                    'value' => $count
                ];
            }
        }
        // Job Relate to Course
        $uniqueJobRelate = $users->pluck('job_to_course')->unique();
        foreach ($uniqueJobRelate as $status) {
            $count = $users->where('job_to_course', $status)->count();
            if ($status && $count) {
                $jobRelate[] = [
                    'label' => $status,
                    'value' => $count
                ];
            }
        }
        // Civil service
        $uniqueCivil = $users->pluck('civil_service')->unique();
        foreach ($uniqueCivil as $status) {
            $count = $users->where('civil_service', $status)->count();
            if ($status && $count) {
                $civil[] = [
                    'label' => $status,
                    'value' => $count
                ];
            }
        }
         // work employed status
         $uniqueWorkStat = $users->pluck('employed_status')->unique();
         foreach ($uniqueWorkStat as $status) {
             $count = $users->where('employed_status', $status)->count();
             if ($status && $count) {
                 $workStat[] = [
                     'label' => $status,
                     'value' => $count
                 ];
             }
         }
          // position on work
          $uniquePosition = $users->pluck('position_on_work')->unique();
          foreach ($uniquePosition as $status) {
              $count = $users->where('position_on_work', $status)->count();
              if ($status && $count) {
                  $position[] = [
                      'label' => $status,
                      'value' => $count
                  ];
              }
          }
        // Get user coordinates
        foreach ($users as $user) {
            if ($user->work_lat && $user->work_lng) {
                $userCoordinates[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'lat' => $user->work_lat,
                    'lng' => $user->work_lng,
                    'address' => $user->work_address
                ];
            }
        }
    
        return view('home', compact('dept', 'empStat', 'jobRelate', 'civil', 'workStat', 'position','userCoordinates'));
    }
    

public function pdf()
{
    date_default_timezone_set('Asia/Manila');

    $users = User::all();

    $dompdf = new Dompdf();
    
    $dompdf->loadHtml(view('pdf.records', compact('users')));

    // (Optional) Set the paper size and orientation
    $dompdf->setPaper('folio', 'landscape');

    // Render the PDF
    $dompdf->render();

    $fileName = 'Alumni-Records-' . date('F-d-Y') . '.pdf';
    // Stream the PDF to the browser
    return $dompdf->stream($fileName);
}

}
