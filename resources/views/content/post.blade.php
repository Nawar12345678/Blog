@extends('master')

@section('content')
<!-- Blog Entres Column -->
<div class="col-md-8">

            <h2>
                <a href="/posts/{{ $post->id}}">{{$post->title}}</a>
            </h2>


            <p><span class="glyphicon glyphicon-time"></span>
            Posted on {{ $post->created_at->toDayDateTimeString() }}
        </a>
            </p>




        @if ($post->url)
        <p><img src="../upload/{{$post->url}}"></p>
        @endif



            <p>{{ $post->body}}</p>
<br>
<div class="comments">
@foreach ( $post->comments as $comment )
<div class="comment">
    <p class="comment-time">
        <span class=" glyphicon glyphicon-time "></span>
        {{ $comment->created_at->diffForHumans()}}
        <p class="comment-text"> {{ $comment->body }} </p>


</div>
@endforeach
</div>

<br>


            <form method="POST" action="/posts/{{$post->id}}/store">
                {{  csrf_field() }}


                    <div class="form-group">
                    <label for="body"> Write your Comment ...</label>
                    <textarea  name="body" id="body" class="form-control"></textarea>
                </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> Add Comment</button>
                    </div>
            </form>









                <!-- pager -->
                <ul class="pager">
                    <li class="previous">
                    <a href="#"> &larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#"> Newer &rarr;</a>
                    </li>
                </ul>
                <div>
                    @stop

















