@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">{{ __('Edit Job') }}</div>

                <div class="card-body">
           <form action="{{route('jobs.update', $job['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
               <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name="title" value="{{$job['title']}}" type="text" class="form-control @error('title') is-invalid @enderror" id="title"  placeholder="Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
               <div class="mb-3">
                    <label for="company" class="form-label">Company Name</label>
                    <input name="company" value="{{$job['company']}}" type="text" class="form-control @error('company') is-invalid @enderror" id="company"  placeholder="Company Name">
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
               <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input name="location" value="{{$job['location']}}" type="text" class="form-control @error('location') is-invalid @enderror" id="location"  placeholder="Location">
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input name="website" value="{{$job['website']}}" type="text" class="form-control @error('website') is-invalid @enderror" id="website"  placeholder="Website">
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
{{-- 
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tags</label>
                    <select name="tags[]" class="form-control @error('tags') is-invalid @enderror" multiple aria-label="multiple select example">
                        <option @if(is_null($job['tags'])) selected @endif>Need Many Employee</option>
                        <option @if(in_array("urgent", $job['tags'])) selected @endif value="urgent">Urgent</option>
                        <option @if(in_array("vacancy", $job['tags'])) selected @endif value="vacancy">Vacancy</option>
                        <option @if(in_array("high priority", $job['tags'])) selected @endif value="high priority">High Priority</option>
                    </select>
                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" value="{{$job['email']}}" type="email" class="form-control @error('email') is-invalid @enderror" id="email"  placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea name="descript" class="form-control @error('descript') is-invalid @enderror" id="description"  placeholder="Job Description">{{$job['descript']}}</textarea>
                       @error('descript')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                @if (!is_null($job['media_url']))
                    <img src="{{$job['media_url']}}" alt="" class="img-thumbnail">
                @endif

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">
                        @if (!is_null($job['media_url']))
                            Change Photo
                        @else
                            Photo
                        @endif
                    </label>
                    <input name="photo"  type="file"  id="">
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="mb-3">
                    <input name="submit" type="submit" class="btn btn-primary"/>
                </div>
           </form>
        </div>
    </div>
</div>    </div>
</div>
@endsection
