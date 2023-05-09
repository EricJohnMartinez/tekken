@extends('layouts.app')

@section('content')


<!-- Edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="PUT" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <textarea rows="6" name="post" placeholder="What's on your mind?"
                        class="form-control" id="editPost"></textarea>
                    <div class="mt-3 d-flex p-0">
                        <div class="border rounded m-0 p-2">
                            <input name="photo" type="file" id="editPhoto">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row justify-content-center">
   
    <form action="{{ route('socialmedia.store') }}" method="POST" enctype="multipart/form-data" class="col-6">
        <div class="card p-4 m-5">
            <div class="col-3 mb-4 fw-bold fs-3 p-0">Post</div>
            @csrf
            <textarea rows="6" name="post" placeholder="What's on your mind?"
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
    </form>
</div>

@foreach ($socialmedias as $socialmedia)
    <div class="card mt-5" style="width: 22rem; margin: 0 auto;">
        <img src="{{ $socialmedia->media_url }}" class="card-img-top" alt="">
        <div class="card-body">
            
            <p class="card-text, h4">{{ $socialmedia->post }}</p>
            <p class="card-text">Posted on {{ $socialmedia->created_at_formatted }}</p>
            <div class="d-flex justify-content-between">
                @can('store socialmedia')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal" 
                        data-id="{{ $socialmedia->id }}" data-action="{{ route('socialmedia.update', ['socialmedia' => $socialmedia]) }}" 
                        data-post="{{ $socialmedia->post }}">Edit</button>
                @endcan
                @can('store socialmedia')
                    @if (Auth::user()->id === $socialmedia->user_id)
                        <form action="{{ route('socialmedia.destroy', ['socialmedia' => $socialmedia]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>
    </div>
@endforeach


@endsection

@section('scripts')

<!-- View modal script -->
<script>
    var viewModal = document.getElementById('viewModal')
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var image = button.getAttribute('data-image')
        var post = button.getAttribute('data-post')
        var createdAt = button.getAttribute('data-created-at')
        var modalImage = viewModal.querySelector('#viewImage')
        var modalPost = viewModal.querySelector('#viewPost')
        var modalCreatedAt = viewModal.querySelector('#viewCreatedAt')
        modalImage.src = image
        modalPost.textContent = post
        modalCreatedAt.textContent = 'Posted on ' + createdAt
    })
</script>

<!-- Edit modal script -->
<script>
    var editModal = document.getElementById('editModal')
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var action = button.getAttribute('data-action')
        var post = button.getAttribute('data-post')
        var form = editModal.querySelector('#editForm')
        var postInput = editModal.querySelector('#editPost')
        form.action = action
        postInput.textContent = post
        postInput.value = post
    })
</script>

@endsection
