@extends('master')

@section('content')
<!-- Blog Entres Column -->
<div class="col-md-8">


    <h1 class="page-header">
        Statistics
        <small>  Website  Statistics</small>
    </h1>

<div>
    <table class="table table-hover">
        <tr>
            <td>All Users</td>
            <td> {{$statistics['users']}}</td>
        </tr>
        <tr>
            <td>All Posts</td>
            <td> {{$statistics['posts']}}</td>
        </tr>
        <tr>
            <td>All Comments</td>
            <td> {{$statistics['comments']}}</td>
        </tr>
        <tr>
            <td> Most Active user</td>
            <td>{{ $statistics['active_user'] }}, Likes({{ $statistics['active_user_likes'] }}) Comments {{ $statistics['active_user_comments'] }} </td>
            
        </tr>
        <tr>
            <td>Most Active posts </td>
        </tr>

    </table>
</div>


</div>
@stop

















