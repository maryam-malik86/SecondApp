@extends('layouts.app')
@section('Htitle')
<h2> Edit Post</h2>
@endsection
@section('content')


<div class="fcontainer">
    {{-- <form action="{{ route('posts.update',$post->id) }}" id="fform" method="POST"> --}}
       <form action="{{ route('posts.update',$post) }}" id="fform" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">

            <label for="title">Title:</label>
            <input type="text" id="title" name="name" value="{{$post->name  }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="4"  required>{{$post->content }}

            </textarea>
        </div>
        <button  id="fbth" type="submit">Submit</button>
    </form>
</div>
@endsection

