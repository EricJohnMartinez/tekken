@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat Room</div>

                <div class="card-body">
                    <div class="chat-messages"></div>

                    <div class="chat-input">
                        <form action="{{ route('send-message')}}" method="post"  enctype="multipart/form-data"  >
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter your message..." name="message">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="send-message">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        // Initialize Pusher
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        // Initialize Laravel Echo
        var echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env("PUSHER_APP_KEY") }}',
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        // Listen for new messages
        echo.channel('chat')
            .listen('ChatMessage', function(data) {
                var html = '<div class="message">';
                html += '<strong>' + data.user.name + ':</strong> ';
                html += data.message.message;
                html += '</div>';

                $('.chat-messages').append(html);
            });

        // Send a message
        $('form').submit(function(e) {
            e.preventDefault();

            var message = $('input[name=message]').val();

            $.ajax({
                url: '{{ route("send-message") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message
                },
                success: function(response) {
                    $('input[name=message]').val('');
                }
            });
        });
    });
</script>
@endsection
