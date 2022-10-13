{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>401 | Unoauthorized</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('error/css/bootstrap.css')}}" rel="stylesheet"><!-- Custom styles for this template -->
    <!-- Custom styles for this template -->
    <link href="{{asset('error/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>

  <body>

  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 401</h1>
        <h2>Oops... You Dont Have Access Here!</h2>

    <div class="mt-5 d-flex justify-content-center">
            <a href="{{route('logout')}}" class="btn btn-primary d-flex  justify-content-center" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" style="width: max-content">Kembali</a>
    
            <form action="{{route('logout')}}" method="POST" id="logout-form">
                @csrf
                </form>
        </div>

        <!--<p>If you think you have arrived here by our mistake, please <a href="#">contact us</a></p>-->

        <!--<h3>Follow us:</h3>-->
        <!--<div class="social-networks">-->
        <!--  <a href="https://www.facebook.com/creativedesignthemes/" target="_blank"><i class="fab fa-facebook-square"></i></a>-->
        <!--  <a href="https://www.pinterest.com/creative3355/" target="_blank"><i class="fab fa-pinterest-square"></i></a>-->
        <!--  <a href="https://twitter.com/creativedesign_" target="_blank"><i class="fab fa-twitter-square"></i></a>-->
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          &copy; {{date('Y')}} All Rights Reserved MarkOI
        </div>
      </div>
    </div>
  </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('error/js/jquery.js')}}"></script>
    <script src="{{asset('error/js/bootstrap.js')}}"></script>
  </body>
</html>
