<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    @if(isset(Auth::user()->email))
    <script>
        window.location = "/main/successlogin";
    </script>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="valign-wrapper row login-box">
        <div class="col card hoverable s10 pull-s1 m6 pull-m3 l4 pull-l4">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div class="card-content">
                    <span class="card-title center">Formulário de Login</span>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" />
                        </div>
                        <div class="input-field col s12">
                            <label for="password">Senha </label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="card-action right-align">
                    <input type="reset" id="reset" class="btn-flat grey-text waves-effect">
                    <input type="submit" class="btn green waves-effect waves-light" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</html>