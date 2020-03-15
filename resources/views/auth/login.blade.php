<!DOCTYPE html>
<html>
<!-- Lato Font -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">

<link href="{{ asset('css/gallery-materialize.min.opt.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet" type="text/css">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<body>
    @if(isset(Auth::user()->email))
    <script>
        window.location = "/main/successlogin";
    </script>
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

                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block red-text">
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger red-text">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
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