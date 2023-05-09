@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                @if (Auth::user()->media_urls['photo'])
                                    <img style="height: 170px; object-fit: contain;"
                                        src="{{ Auth::user()->media_urls['photo'] }}" alt="Profile Photo"
                                        class="img-thumbnail rounded-circle w-100">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Minsu.png/640px-Minsu.png"
                                        alt="Profile Photo" class="rounded-circle w-100">
                                @endif
                            </div>

                            <div class="col-md-9">
                                <h2 style="font-family: Arial, sans-serif;">{{ Auth::user()->name }}</h2>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ Auth::user()->media_urls['resume'] }}" target="_blank" class="btn btn-primary float-end">
                                        <i class="bi bi-file-earmark-pdf"></i> View Resume
                                    </a>
                                </div>
                                <p style="font-family: Arial, sans-serif;"><i class="bi bi-geo-alt-fill"></i> Lives in
                                    {{ Auth::user()->home_address }}</p>
                                <p style="font-family: Arial, sans-serif;"><i class="bi bi-building"></i> Work Address:
                                    {{ Auth::user()->work_address }}</p>
                                <p style="font-family: Arial, sans-serif;"><i class="bi bi-calendar"></i> Age:
                                    {{ Auth::user()->age }}</p>
                                <p style="font-family:Arial, sans-serif;"><i class="bi bi-person"></i> Department:
                                    {{ Auth::user()->department }}</p>
                                
                                <form action="{{ route('userprofile.edit', Auth::user()->id) }}" method="get">
                                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
