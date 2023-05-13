@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ $user->name }}'s Profile</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="text-center">
                                    @if ($user->media_urls['photo'])
                                        <img style="height: 170px; object-fit: contain;"
                                            src="{{ $user->media_urls['photo'] }}" alt="Profile Photo"
                                            class="img-thumbnail rounded-circle w-100">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Minsu.png/640px-Minsu.png"
                                            alt="Profile Photo" class="rounded-circle w-100">
                                    @endif
                                    @if ($user->media_urls['resume'])
                                        <a href="{{ $user->media_urls['resume'] }}" target="_blank" class="btn btn-primary">
                                            <i class="bi bi-file-earmark-pdf"></i> View Resume
                                        </a>
                                    @else
                                    @endif
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#sendJobModal">
                                        <i class="bi bi-file-earmark-pdf"></i> Send A Job
                                    </button>
                                    <script>
                                        $(document).ready(function() {
                                            $('#sendJobModal').on('shown.bs.modal', function() {
                                                // Add your script here
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h3 class="mb-3">{{ $user->name }}</h3>
                                <p class="lead"><strong>Email:</strong> {{ $user->email }}</p>
                                <p class="lead"><strong>Employment Status:</strong> {{ $user->employment_status }}</p>
                                <p class="lead"><strong>Department:</strong> {{ $user->department }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="sendJobModal" tabindex="-1" role="dialog"
aria-labelledby="sendJobModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createJobModalLabel">Create Job</h5>
        </div>
        <div class="modal-body">
            <!-- Place your form code here -->
            <form action="{{ route('jobs.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Form fields here -->
                <div class="mb-3">
                    <label for="Title" class="form-label">Job Title</label>
                    <input name="title" value="{{ old('title') }}" type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="Title" placeholder="Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Company" class="form-label">Company Name</label>
                    <input name="company" value="{{ old('company') }}"
                        type="text"
                        class="form-control @error('company') is-invalid @enderror"
                        id="Company" placeholder="Company Name">
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Location" class="form-label">Location</label>
                    <input name="location" value="{{ old('location') }}"
                        type="text"
                        class="form-control @error('location') is-invalid @enderror"
                        id="Location" placeholder="Location">
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Website" class="form-label">Website</label>
                    <input name="website" value="{{ old('website') }}"
                        type="text"
                        class="form-control @error('website') is-invalid @enderror"
                        id="Website" placeholder="Website">
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Department" class="form-label">Department</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="All Department" value="All Department"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="All Department">
                                <label for="All Department">All Department</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]" id="BSED"
                                    value="BSED"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="BSED">
                                <label for="BSED">BSED</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="BTVTED" value="BTVTED"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="BTVTED">
                                <label for="BTVTED">BTVTED</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="Criminology" value="Criminology"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="Criminology">
                                <label for="Criminology">Criminology</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="BSIT" value="BSIT"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="BSIT">
                                <label for="BSIT">BSIT</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="CBM" value="CBM"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="CBM">
                                <label for="CBM">CBM</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]"
                                    id="AB" value="AB"
                                    class="@error('tags') is-invalid @enderror"
                                    aria-label="AB">
                                <label for="AB">AB</label>
                            </div>
                        </div>
                    </div>
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email address</label>
                    <input name="email" value="{{ old('email') }}"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="Email" placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Job
                        Description</label>
                    <textarea name="descript" class="form-control @error('descript') is-invalid @enderror" id="Description"
                        placeholder="Job Description">{{ old('descript') }}</textarea>
                    @error('descript')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Photo" class="form-label">Image</label>
                    <input name="photo" type="file" id="">
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="user_id"
                    value="{{ auth()->user()->id }}">
                <div class="mb-3">
                    <input name="submit" type="submit"
                        class="btn btn-primary float-right" />
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
