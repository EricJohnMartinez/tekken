<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;

class UserController extends Controller
{
    /**
     * For SUPER ADMIN
     */

    public function getPendingUsers()
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.pending-users', compact(['users']));
    }


    public function approveUser(User $user)
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $user->approved = true;
        $user->save();

        session()->flash('success', $user->name . ' has been approved');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return redirect()->route('admin.pending-users')->with([
            'users' => $users,
        ]);
    }

    public function declineUser(User $user)
    {
        abort_if(!auth()->user()->hasRole('admin'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $user->delete();

        session()->flash('primary', $user->name . ' has been declined');

        $users = User::where('approved', false)->orderBy('created_at', 'DESC')->paginate(10);

        return redirect()->route('admin.pending-users')->with([
            'users' => $users,
        ]);
    }
    public function index()
    {
        abort_if(!auth()->user()->can('show user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        $users = User::all();
        $survey = Survey::all();
        return view('userprofile.index', compact('users','survey'));
    }

    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('update user'), Response::HTTP_FORBIDDEN, 'Unauthorized');
        return view('userprofile.edit', compact('user'));
    }

    public function userIndex(Request $request)
    {
        abort_if(!auth()->user()->can('view user'), Response::HTTP_FORBIDDEN, 'Unauthorized');

        $keyword = $request->input('keyword');
        $department = $request->input('department');
        $employment_status = $request->input('employment_status'); 

        $users = User::when($keyword, function ($query, $keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('work_address', 'LIKE', "%{$keyword}%")
                        ->orWhere('department', 'LIKE', "%{$keyword}%");
                })
                ->when($employment_status, function ($query, $employment_status) { // Added this line
                    $query->where('employment_status', $employment_status);
                })
                ->when($department, function ($query, $department) {
                    $query->where('department', $department);
                })
                ->paginate(15);

        return view('userprofile.view', ['users' => $users, 'keyword' => $keyword]);
    }

    public function survey(Request $request)
    {
        $validatedData = $request->validate([
            'course' => 'required|string',
            'age' => 'required|integer',
            'year_graduated' => 'required|integer',
            'permanent_home_address' => 'required|string',
            'work_company' => 'required|string',
            'employment_status' => 'required|string',
            'company_location' => 'required|string',
            'position_on_work' => 'required|string',
            'date_hired' => 'required|date',
            'employed_status' => 'required|string',
            'civil_service' => 'nullable|string',
            'awards_received' => 'nullable|string',
            'job_to_course' => 'nullable|string',
            'status' => 'required|string'
        ]);
    
        $validatedData['user_id'] = auth()->user()->id;

        Survey::create($validatedData);
        return redirect()->back();
        // Store the survey data in your database or perform any other necessary actions here
    }

    public function updateSurvey(Request $request, $id)
    {
        $survey = Survey::find($id);
        $validatedData = $request->validate([
            'course' => 'required|string',
            'age' => 'required|integer',
            'year_graduated' => 'required|integer',
            'permanent_home_address' => 'required|string',
            'work_company' => 'required|string',
            'employment_status' => 'required|string',
            'company_location' => 'required|string',
            'position_on_work' => 'required|string',
            'date_hired' => 'required|date',
            'employed_status' => 'required|string',
            'civil_service' => 'nullable|string',
            'awards_received' => 'nullable|string',
            'job_to_course' => 'nullable|string',
            'status' => 'required|string',
        ]);
    
        $validatedData['status'] = 'completed'; // set default value of "completed" for "status" field
    
        $survey->update($validatedData);
    
        return redirect()->back();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user)
{
    abort_if(!auth()->user()->can('update user'), Response::HTTP_FORBIDDEN, 'Unauthorized');

    $user = User::where('id', auth()->user()->id)->first();
    $user->update($request->validated());

    if ($request->has('photo')) {
        $user->clearMediaCollection('photos');
        $user->addMediaFromRequest('photo')->toMediaCollection('photos');
    }
    
    if ($request->has('resume')) {
        $user->clearMediaCollection('resume');
        $user->addMediaFromRequest('resume')->toMediaCollection('resume');
    }
    // Geocode the work address
    $client = new Client();
    $workAddress = urlencode($user->work_address);

    $response = $client->request('GET', "https://nominatim.openstreetmap.org/search?q={$workAddress}&format=json");
    $workLocation = json_decode($response->getBody(), true);
    if (!empty($workLocation)) {
        $user->work_lat = $workLocation[0]['lat'];
        $user->work_lng = $workLocation[0]['lon'];
    }

    $user->save();

    return redirect()->route('userprofile.index')->with('success', 'User profile updated successfully');
}

    

}
