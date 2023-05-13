@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Announcement') }}</div>
                <div class="card-body">
                    <form action="{{route('announcements.update', $announcement->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Title') }}</label>
                            <input type="text" value="{{$announcement->title}}" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="{{ __('Title') }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
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
                            <label for="descript" class="form-label">{{ __('Announcement Description') }}</label>
                            <textarea type="text" class="form-control @error('descript') is-invalid @enderror" id="descript" name="descript" placeholder="{{ __('Announcement Description') }}">{{$announcement->descript}}</textarea>
                            @error('descript')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (!is_null($announcement['media_url']))
                            <div class="mb-3">
                                <img src="{{$announcement['media_url']}}" alt="" class="img-thumbnail">
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="photo" class="form-label">
                                @if (!is_null($announcement['media_url']))
                                    {{ __('Change Photo') }}
                                @else
                                    {{ __('Photo') }}
                                @endif
                            </label>
                            <input name="photo" type="file" class="form-control @error('photo') is-invalid @enderror" id="photo">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
