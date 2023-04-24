@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg')
        }
    </style>
    <form action="{{ route('socialmedia.store') }}" method="POST" enctype="multipart/form-data" class="container">
      <div class="card p-4 m-5 row">
          <div class="mb-4 fw-bold fs-2 p-0">Post</div>
            @csrf
            <textarea rows="15" name="post" rows="2" placeholder="What's on your mind?"
                class="form-control @error('post') is-invalid @enderror"></textarea>
            @error('post')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-3 d-flex p-0">
              <div class="border rounded m-0 p-2">
                <input name="photo" type="file" id="">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
              </div>
            </div>
            <div class="d-flex justify-content-end">
                <input name="submit" type="submit" class="btn btn-primary" value="Post" />
            </div>
        </div>

        </div>
    </form>


    @foreach ($socialmedias as $socialmedia)
        <div class="card mt-5" style="width: 22rem; margin: 0 auto;">
            <img src="{{ $socialmedia->media_url }}" class="card-img-top" alt="">
            <div class="card-body">
                <p class="card-text, h4">{{ $socialmedia->post }}</p>
                <p class="card-text">Posted on {{ $socialmedia->created_at_formatted }}</p>
                <a href="#" class="btn btn-primary">Like</a>
            </div>
        </div>
    @endforeach
@endsection
