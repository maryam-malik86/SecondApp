@extends('layouts.app')
@section('Htitle')
<h2> Upload Post</h2>
@endsection
@section('content')


<div class="fcontainer">
    <form action="{{ route('posts.store') }}" id="fform" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="name" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4" required></textarea>
        </div>
        <button  id="fbth" type="submit">Submit</button>
    </form>
</div>
@endsection

