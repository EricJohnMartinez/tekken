@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $job->title }}</h5>
        <p class="card-text">{{ $job->created_at_formatted }}</p>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Applicants</h5>
        @if ($applicants->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Resume</th>
                            <th>Applied At</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $applicant)
                            <tr>
                                <td>{{ $applicant->name }}</td>
                                <td>{{ $applicant->email }}</td>
                                <td>{{ $applicant->number }}</td>
                                <td>
                                    @if ($applicant->media_url)
                                        <a href="{{ $applicant->media_url }}" target="_blank">View</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <td>{{ $applicant->created_at->format('M d, Y h:i A') }}</td>
                                <td><form action="{{ route('user.profile', $applicant->user_id) }}">
                                    <button type="submit" class="btn btn-primary">Visit Profile</button>
                                </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $applicants->links() }}
        @else
            <p>No applicants yet.</p>
        @endif
    </div>
</div>

@endsection
