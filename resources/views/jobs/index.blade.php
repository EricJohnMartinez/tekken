@extends('layouts.app')

@section('content')
    <!--Store Modal -->
    <div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobModalLabel">Create Job</h5>
                   
                </div>
                <div class="modal-body">
                    <!-- Place your form code here -->
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields here -->
                        <div class="mb-3">
                            <label for="Title" class="form-label">Job Title</label>
                            <input name="title" value="{{ old('title') }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" id="Title"
                                placeholder="Title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Company" class="form-label">Company Name</label>
                            <input name="company" value="{{ old('company') }}" type="text"
                                class="form-control @error('company') is-invalid @enderror" id="Company"
                                placeholder="Company Name">
                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Location" class="form-label">Location</label>
                            <input name="location" value="{{ old('location') }}" type="text"
                                class="form-control @error('location') is-invalid @enderror" id="Location"
                                placeholder="Location">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Website" class="form-label">Website</label>
                            <input name="website" value="{{ old('website') }}" type="text"
                                class="form-control @error('website') is-invalid @enderror" id="Website"
                                placeholder="Website">
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
                                        <input type="checkbox" name="tags[]" id="All Department" value="All Department"
                                            class="@error('tags') is-invalid @enderror" aria-label="All Department">
                                        <label for="All Department">All Department</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tags[]" id="BSED" value="BSED"
                                            class="@error('tags') is-invalid @enderror" aria-label="BSED">
                                        <label for="BSED">BSED</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tags[]" id="BTVTED" value="BTVTED"
                                            class="@error('tags') is-invalid @enderror" aria-label="BTVTED">
                                        <label for="BTVTED">BTVTED</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tags[]" id="Criminology" value="Criminology"
                                            class="@error('tags') is-invalid @enderror" aria-label="Criminology">
                                        <label for="Criminology">Criminology</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <input type="checkbox" name="tags[]" id="BSIT" value="BSIT"
                                            class="@error('tags') is-invalid @enderror" aria-label="BSIT">
                                        <label for="BSIT">BSIT</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tags[]" id="CBM" value="CBM"
                                            class="@error('tags') is-invalid @enderror" aria-label="CBM">
                                        <label for="CBM">CBM</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="tags[]" id="AB" value="AB"
                                            class="@error('tags') is-invalid @enderror" aria-label="AB">
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
                            <input name="email" value="{{ old('email') }}" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="Email"
                                placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Description" class="form-label">Job Description</label>
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
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <input name="submit" type="submit" class="btn btn-primary float-right" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        $(document).ready(function() {
            // Hide any error messages when the modal is opened
            $('#createJobModal').on('show.bs.modal', function() {
                $('.modal-body').find('.alert').remove();
                $('.modal-body').find('.is-invalid').removeClass('is-invalid');
            });

            // Submit the form when the "Create" button is clicked
            $('#createJobModal').on('click', '#createJobBtn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var url = form.attr('action');
                var formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response here
                    },
                    error: function(xhr) {
                        // Handle error response here
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap CSS -->


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!auth()->user()->hasRole('alumni'))
                <div class="mb-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createJobModal">
                        Post a Job
                    </button>
                </div>
                @else
                @endif
                <div class="row">
                    @if (session()->has('success'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <link rel="stylesheet"
                            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '{{ session()->get('success') }}',
                                showClass: {

                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        </script>
                    @endif
                    @if (session()->has('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('danger') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('primary'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ session()->get('primary') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-columns">
                        @foreach ($jobs as $job)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            @if (is_null($job->media_url))
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930"
                                                    alt="" class="img-thumbnail">
                                            @else
                                                <img src="{{ $job->media_url }}" alt="" class="img-thumbnail">
                                            @endif
                                        </div>

                                        <div class="col-md-8">
                                            <div>
                                                <h5 class="card-title pt-2">{{ $job->title }}</h5>
                                            </div>
                                            <div>
                                                <h5 class="card-title pt-2">{{$job->descript}}</h5>
                                            </div>
                                            <p class="card-text">{{ $job->created_at_formatted }}</p>
                                            @if (auth()->user()->hasRole('admin'))
                                                <p class="card-text">Created by {{ $job->user->name }}</p>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div>
                                                <a href="{{ route('jobs.show', $job->id) }}"
                                                    class="btn btn-light border">View</a>
                                                @if (!auth()->user()->hasRole('alumni'))
                                                    <a href="{{ route('jobs.edit', $job->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <button class="btn btn-danger"
                                                        onclick="deleteJob({{ $job->id }})">Delete</button>
                                                    <a href="{{ route('jobs.applicants', $job->id) }}"
                                                        class="btn btn-info">View Applicants</a>
                                                @endif
                                                <!-- new button -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $jobs->links() }}
                    </div>


                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
                    <link rel="stylesheet"
                        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css" />
                    
                    <script>
                        function deleteJob(jobId) {
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#d33",
                                cancelButtonColor: "#3085d6",
                                confirmButtonText: "Yes, delete it!",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('jobs.delete', '') }}/" + jobId;
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
