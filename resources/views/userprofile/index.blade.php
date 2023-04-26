@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="https://via.placeholder.com/150" alt="Profile Photo" class="rounded-circle w-100">
                        </div>
                        <div class="col-md-9">
                            <h2 style="font-family: Arial, sans-serif;">{{ Auth::user()->name }}</h2>
                            <p style="font-family: Arial, sans-serif;"><i class="bi bi-geo-alt-fill"></i> Lives in {{ Auth::user()->home_address }}</p>
                            <p style="font-family: Arial, sans-serif;"><i class="bi bi-building"></i> Works at {{ Auth::user()->work_address }}</p>
                            <p style="font-family: Arial, sans-serif;"><i class="bi bi-calendar"></i> Age: {{ Auth::user()->age }}</p>
                            <p style="font-family:Arial, sans-serif;"><i class="bi bi-person"></i> Department: {{ Auth::user()->department }}</p>
                            <form action="{{ route('userprofile.edit', Auth::user()->id)}}" method="get">
                                <button type="submit" class="btn btn-primary">Edit Profile</button>
                            </form>
                           
                        </div>
                        <div>
                       <!-- Button trigger modal -->
                       @php
                       $surveyStatus = auth()->user()->surveyStatus();
                     @endphp
                     
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#surveyModal">
                       @if($surveyStatus === 'completed')
                         Update Survey
                       @else
                         Launch Survey Modal
                       @endif
                     </button>
                     
                     <!-- Modal -->
                     <div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="surveyModalLabel">
                               @if($surveyStatus === 'completed')
                                 Update Survey
                               @else
                                 Survey Form
                               @endif
                             </h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                            <form action="{{ $surveyStatus === 'completed' && auth()->user()->survey ? route('survey.update', auth()->user()->survey->id) : route('survey') }}" method="POST">

                               @csrf
                               @if($surveyStatus === 'completed')
                                 @method('PUT')
                               @endif
                               <div class="mb-3">
                                 <label for="course" class="form-label">Course</label>
                                 <input type="text" class="form-control" id="course" name="course" value="{{ $surveyStatus === 'completed' && auth()->user()->survey ? auth()->user()->survey->course : '' }}" required>

                               </div>
                               <div class="mb-3">
                                 <label for="age" class="form-label">Age</label>
                                 <input type="number" class="form-control" id="age" name="age" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->age : '' }}" required>
                               </div>
                               <div class="mb-3">
                                 <label for="year_graduated" class="form-label">Year Graduated</label>
                                 <input type="number" class="form-control" id="year_graduated" name="year_graduated" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->year_graduated : '' }}" required>
                               </div>
                               <div class="mb-3">
                                 <label for="permanent_home_address" class="form-label">Permanent Home Address</label>
                                 <input type="text" class="form-control" id="permanent_home_address" name="permanent_home_address" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->permanent_home_address : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="work_company" class="form-label">Work Company</label>
                                  <input type="text" class="form-control" id="work_company" name="work_company" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->work_company : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="employment_status" class="form-label">Employment Status</label>
                                  <input type="text" class="form-control" id="employment_status" name="employment_status" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->employment_status : '' }}"required>
                                </div>
                                <div class="mb-3">
                                  <label for="company_location" class="form-label">Company Location</label>
                                  <input type="text" class="form-control" id="company_location" name="company_location" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->company_location : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="position_on_work" class="form-label">Position on Work</label>
                                  <input type="text" class="form-control" id="position_on_work" name="position_on_work" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->position_on_work : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="date_hired" class="form-label">Date Hired</label>
                                  <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->date_hired : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="employed_status" class="form-label">Employed Status</label>
                                  <input type="text" class="form-control" id="employed_status" name="employed_status" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->employed_status : '' }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="civil_service" class="form-label">Civil Service</label>
                                  <input type="text" class="form-control" id="civil_service" name="civil_service" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->civil_service : ''}}" >
                                </div>
                                <div class="mb-3">
                                  <label for="awards_received" class="form-label">Awards Received</label>
                                  <input type="text" class="form-control" id="awards_received" name="awards_received" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->awards_received : '' }}">
                                </div>
                                <div class="mb-3">
                                  <label for="job_to_course" class="form-label">Job to Course</label>
                                  <input type="text" class="form-control" id="job_to_course" name="job_to_course" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->job_to_course : '' }}">
                                </div>
                                <div class="mb-3">
                                  <label for="status" class="form-label">Status</label>
                                  <input type="text" class="form-control" id="status" name="status" value="{{ $surveyStatus === 'completed' ? auth()->user()->survey->status : '' }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ $surveyStatus === 'completed' ? 'Update' : 'Submit' }}</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
