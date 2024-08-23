@extends('layouts.app')

@section('Htitle')
    <h2>Post Details</h2>
@endsection

@section('content')

    <div class="post-block">

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Insert</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th>User Name</th>
                    <th colspan="2">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                   @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('posts.show',$post) }}" class="btn btn-primary">View Posts</a>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
