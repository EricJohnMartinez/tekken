@extends('layouts.app')

@section('content')
<style>
    body{
      background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg');
      background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        height: 100vh !important;
    }
    </style>
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (!session('welcome_notification'))
                    @php
                        session(['welcome_notification' => true]);
                    @endphp
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: "{{ __('Welcome To AlumnConnect!') }} {{ Auth::user()->name }}"
                        })
                    </script>
                @endif
            </div>


            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @if (!auth()->user()->approved)
                            <div class="col-md-8">

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
                                <link rel="stylesheet"
                                    href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

                                <script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'info',
                                        title: '{{ __('Welcome to AlumnConnect!') }}   {{ Auth::user()->name }} {{ __('please wait for admin approval to access site') }}',
                                        showConfirmButton: true,
                                        confirmButtonText: '{{ __('OK') }}',
                                    });
                                </script>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobModalLabel">Create Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Place your form code here -->
                    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields here -->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title</label>
                            <input name="title" value="{{ old('title') }}" type="text"
                                class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1"
                                placeholder="Title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Company Name</label>
                            <input name="company" value="{{ old('company') }}" type="text"
                                class="form-control @error('company') is-invalid @enderror" id="exampleFormControlInput2"
                                placeholder="Company Name">
                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Location</label>
                            <input name="location" value="{{ old('location') }}" type="text"
                                class="form-control @error('location') is-invalid @enderror" id="exampleFormControlInput3"
                                placeholder="Location">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput4" class="form-label">Website</label>
                            <input name="website" value="{{ old('website') }}" type="text"
                                class="form-control @error('website') is-invalid @enderror" id="exampleFormControlInput4"
                                placeholder="Website">
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tags</label>
                            <div>
                                <input type="checkbox" name="tags[]" id="need-many-employee" value="need-many-employee"
                                    class="@error('tags') is-invalid @enderror" aria-label="Need Many Employee">
                                <label for="need-many-employee">Need Many Employee</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]" id="urgent" value="urgent"
                                    class="@error('tags') is-invalid @enderror" aria-label="Urgent">
                                <label for="urgent">Urgent</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]" id="vacancy" value="vacancy"
                                    class="@error('tags') is-invalid @enderror" aria-label="Vacancy">
                                <label for="vacancy">Vacancy</label>
                            </div>
                            <div>
                                <input type="checkbox" name="tags[]" id="high-priority" value="high-priority"
                                    class="@error('tags') is-invalid @enderror" aria-label="High Priority">
                                <label for="high-priority">High Priority</label>
                            </div>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput6" class="form-label">Email address</label>
                            <input name="email" value="{{ old('email') }}" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput6"
                                placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput7" class="form-label">Job Description</label>
                            <textarea name="descript" class="form-control @error('descript') is-invalid @enderror" id="exampleFormControlInput7"
                                placeholder="Job Description">
                    {{ old('descript') }}
                </textarea>
                            @error('descript')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput8" class="form-label">Photo</label>
                            <div class="px-3 py-2 border rounded">
                                <input name="photo" type="file">
                            </div>
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="d-flex justify-content-end">
                            <input name="submit" type="submit" class="btn btn-primary" />
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



@endsection
