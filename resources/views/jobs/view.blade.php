@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header mb-3">
                        <div class="d-flex justify-content-between">
                            <h2 class="text-center">{{ $job->title }}</h2>
                            <div class="d-flex justify-content-end mt-2">
                                <a class="btn btn-primary"
                                    href="{{ route('jobs.index') }}">Back</a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body mb-3">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <a href="#" data-toggle="modal" data-target="#imageModal">
                                    @if (is_null($job->media_url))
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930"
                                            alt="" class="img-thumbnail">
                                    @else
                                        <img src="{{ $job->media_url }}" alt="" class="img-thumbnail">
                                    @endif

                                </a>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><strong>Company Name:</strong> {{ $job->company }}</p>
                                <p class="card-text"><strong>Tags:</strong>
                                    @if (count($job->tags) > 0)
                                        @foreach ($job->tags as $tag)
                                            <span class="badge bg-primary">{{ $tag }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No tags available</span>
                                    @endif
                                </p>
                                <p class="card-text"><strong>Description:</strong> {{ $job->descript }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                                <p class="card-text"><strong>Email:</strong> {{ $job->email }}</p>
                                <p class="card-text"><strong>Website/Page:</strong> {{ $job->website }}</p>
                                <button class="btn btn-primary align-self-end" data-toggle="modal"
                                    data-target="#applyModal">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal-->

    <!-- Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply to {{ $job->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" value="{{ auth()->user()->name }}" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter your name" readonly>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="number">Contact Number</label>
                            <input name="number" value="{{ old('number') }}" type="text"
                                class="form-control @error('number') is-invalid @enderror" id="number"
                                placeholder="Enter your contact number">
                            @error('number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input name="email" value="{{ auth()->user()->email }}" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter your email address" readonly>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <input name="resume" type="file"
                                class="form-control-file @error('resume') is-invalid @enderror" id="resume">
                            @error('resume')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title justify" id="imageModalLabel">{{ $job->title }}</h5> <button type="button"
                        class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        @if (is_null($job->media_url))
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930"
                                alt="" class="img-thumbnail">
                        @else
                            <img src="{{ $job->media_url }}" alt="" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

@endsection
