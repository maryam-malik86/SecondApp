@extends('layouts.app')

@section('Htitle')
    <h2>Posts</h2>
@endsection

@section('content')
    <div class="container mt-4">
        @foreach ($posts as $post)
            <div class="post-card mb-4">
                <div class="post-header">
                    <img src="{{ asset('dist/img/postUser.png') }}" alt="User Icon" class="user-icon">
                    <span class="username">{{ $post->user->name }}</span>
                </div>
                <div class="post-body">
                    <h4>{{ $post->name }}</h4>
                    <p>{{ $post->content }}</p>
                </div>
                <div class="post-footer text-right">
                    <a href="#" class="comment-icon-trigger" data-post-id="{{ $post->id }}">
                        <img src="{{ asset('dist/img/postComment.png') }}" alt="Comments" class="comment-icon">
                    </a>
                </div>

                <!-- Comments section -->
                <div class="comments-section" id="comments-section-{{ $post->id }}"></div>
            </div>
            <script>
                var commentsRoute = "{{ route('comments.show', '') }}";
                var postUserImageUrl = "{{ asset('dist/img/postUser.png') }}";
                var commentsAdd = '{{ route("comments.store") }}'; // Set this variable
                var csrfToken = '{{ csrf_token() }}';
            </script>
            <script src="{{ asset('dist/js/comPage') }}"></script>
        @endforeach
    </div>
@endsection
