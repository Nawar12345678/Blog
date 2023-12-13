<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>  Blog </title>

    <!-- Add your head content here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 70px;

        }

.comment {
    border:  2px solid #ccc;
    padding: 10px;
}



    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/posts"> Our Blog</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">


                    <li><a href="#">About</a></li>
                    <li><a href="/Statistics">Statistics</a></li>

                    @if(Auth::check())
                    @if (Auth::user()->hasRole('Admin'))

                    <li><a href="/admin">ِAdmin</a></li>


                    @endif

                    <li>
                        <a> Welcome: {{Auth::user()->name}}</a>
                    </li>

                    <li>
                        <a href="/logout">Logout</a>
                    </li>

                    @else
                    <li>
                        <a href="/register">Register</a>
                    </li>
                    <li>
                        <a href="login">Login</a>
                    </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>




    <!--page Content -->
    <div class="container">
        <div class="row">
            @yield('content')

<!-- Blog Post Content -->
<div class="col-lg-4">
    <div class="well">
        <h4> Blog Search </h4>
        <div class="input-group">
            <input type="text" class="fom-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
            </span>

        </div>

    </div>


    </div>
                    
                </div>
            </div>
        </div>
    </div>



</div>

</div>



    </form>
</div>




</div>

        </div>
    </div>


            <!-- Container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9KWDrMNeT87bh95OGNyZPhcTNXj1NXj1NW7RuBCsyNo0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ url('/js/likes.js') }}"></script>



<script>
    var url = "{{ route('like') }}";
    var url_dis = "{{ route('dislike') }}";
    var token = "{{ Session::token() }}";
</script>




    </body>

</html>




