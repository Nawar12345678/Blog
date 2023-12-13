@extends('master')

@section('content')
<!-- Blog Entries Column -->
<div class="col-md-8">
    <h1 class="page-header">
        Welcome to our Blog
        <hr>
        <small> All Posts here </small>
    </h1>

    <!-- Blog Posts -->
    @forelse ($posts as $post)
        <h2>
            <a href="/posts/{{$post->id}}">{{ $post->title}}</a>
        </h2>

        <p><span class="glyphicon glyphicon-time"></span>
            Posted on {{ $post->created_at}} - <strong> Category:</strong>
            @if ($post->category)
                <a href="../category/{{ $post->category->name}}">
                    {{ $post->category->name}}
                </a>
            @else
                No Category
            @endif
        </p>


        @if($post->url)
            <p><img src="upload//{{$post->url}}"></p>
        @endif

        <hr>

        <p>{{ $post->body }}</p>
        <a class="btn btn-primary" href="/posts/{{$post->id}}"> Read More <span class="glyphicon glyphicon-chevron-ri"></span></a>

        @php
            $like_count = 0;
            $dislike_count = 0;
            $like_status = "btn-secondry";
            $dislike_status = "btn-secondry";


        @endphp


    @foreach ($post->likes as $like)
    {{-- Increment like and dislike counts --}}
    @if($like->like == 1)
        <?php $like_count++; ?>
    @endif

    @if($like->like == 0)
        <?php $dislike_count++; ?>
    @endif

    {{-- Check if the user has liked or disliked --}}
    @if (Auth::check())
        @if($like->like == 1 && $like->user_id == Auth::user()->id)
            <?php $like_status = "btn-success"; ?>
        @endif

        @if($like->like == 0 && $like->user_id == Auth::user()->id)
            <?php $dislike_status = "btn-danger"; ?>
        @endif
    @endif
@endforeach


        <button type="button" data-postid="{{ $post->id}}_l" data-like="{{ $like_status }}" class="like btn {{ $like_status }}">Like <span class="glyphicon glyphicon-thumbs-up"></span> <b> <span class="like_count">{{ $like_count }} </span></b></button>
        <button type="button" data-postid="{{ $post->id}}_d" data-like="{{ $dislike_status }}" class="dislike btn {{ $dislike_status }}">Dislike <span class="glyphicon glyphicon-thumbs-down"></span> <b><span class="dislike_count">{{ $dislike_count }}</b></button>

        <hr>

    @endforeach


    @if(Auth::check())
    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Editor'))
    <form method="POST" action="/posts/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title"> Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="body"> Body</label>
            <textarea  name="body" id="body" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="url"> Image</label>
            <input id="url" type="file" name="url">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Post</button>
        </div>
    </form>
    @endif
    @endif

    <div>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>

</div>
<!-- End Blog Entries Column -->
@stop
