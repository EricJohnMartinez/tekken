@extends('layouts.app')

@section('content')
<form action="{{ route('userIndex') }}" method="GET" class="form-inline mb-4">
  <div class="row">
    <div class="col-md-4 mb-3">
      <input type="text" class="form-control" name="keyword" placeholder="Search users..." value="{{ $keyword ?? '' }}">
      <div class="col-md-2 mb-3">
        <button class="btn btn-primary btn-block" type="submit">Search</button>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <select name="department" id="department" class="form-control">
        <option value="">All Departments</option>
        <option value="BSED" {{ request('department') === 'BSED' ? 'selected' : '' }}>BSED</option>
        <option value="BTVTED" {{ request('department') === 'BTVTED' ? 'selected' : '' }}>BTVTED</option>
        <option value="BSIT" {{ request('department') === 'BSIT' ? 'selected' : '' }}>BSIT</option>
        <option value="Criminology" {{ request('department') === 'Criminology' ? 'selected' : '' }}>Criminology</option>
        <option value="CBM" {{ request('department') === 'CBM' ? 'selected' : '' }}>CBM</option>
        <option value="AB" {{ request('department') === 'AB' ? 'selected' : '' }}>AB</option>
      </select>
      <div class="col-md-2 mb-3">
        <button class="btn btn-primary btn-block" type="submit">Search</button>
      </div>
    </div>
      <div class="col-md-4 mb-3">
      <select class="form-control ml-2" id="employment_status" name="employment_status">
        <option value="">Employment Status</option>
        <option value="employed" {{ request('employment_status')  == 'employed' ? 'selected' : '' }}>Employed</option>
        <option value="unemployed" {{ request('employment_status')  == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
        <option value="employer" {{ request('employment_status')  == 'employer' ? 'selected' : '' }}>Employer</option>
      </select>
      <div class="col-md-2 mb-3">
        <button class="btn btn-primary btn-block" type="submit">Search</button>
      </div>
    </div>
    
  </div>
</form>
  @if ($users->isEmpty())
  <div style="display: flex; justify-content: center; align-items: center; height: 50vh;">
    <p style="text-align: center; font-size: 1.5rem; font-weight: bold;">No Alumni found.</p>
  </div>
@else
<div class="row">
  @foreach ($users as $user)
  <div class="col-md-4 mb-4">
    <div class="card border @if ($user->employment_status == 'unemployed') border-danger @elseif ($user->employment_status == 'employed') border-primary @else border-success @endif border-3">
          <div class="card-body">
              <h5 class="card-title">{{ $user->name }}</h5>
              <p class="card-text">Employment Status: {{ $user->employment_status}}</p>
              <p class="card-text">Department: {{ $user->department }}</p>
              <form action="{{ route('user.profile', $user->id) }}">
                  <button type="submit" class="btn btn-primary">Visit Profile</button>
              </form>
          </div>
          <div class="card-footer">
              <small class="text-muted">Date Joined {{$user->created_at}}</small>
          </div>
      </div>
  </div>
  @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endif


@endsection
<style>
    .card {
  border: 1px solid #ddd;
  border-radius: 0.25rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.card-text {
  margin-bottom: 0.5rem;
}

.card-footer {
  background-color: #f8f9fa;
  border-top: 1px solid #ddd;
  padding: 0.5rem;
}
</style>