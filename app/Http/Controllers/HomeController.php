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
    return view('home', compact('dept','empStat'));
}

public function pdf()
{
    date_default_timezone_set('Asia/Manila');

    $employmentStatusCounts = User::groupBy('employment_status')
        ->selectRaw('employment_status, count(*) as count')
        ->pluck('count', 'employment_status');

    $employmentStatuses = '';
    foreach ($employmentStatusCounts as $status => $count) {
        $employmentStatuses .= "$count $status ";
    }
    $employmentStatuses = rtrim($employmentStatuses, ',' );

    $dompdf = new Dompdf();
    
    $dompdf->loadHtml(view('pdf.records', compact('employmentStatuses')));

    // (Optional) Set the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the PDF
    $dompdf->render();

    $fileName = 'Alumni-Records-' . date('F-d-Y') . '.pdf';
    // Stream the PDF to the browser
    return $dompdf->stream($fileName);
}

}
