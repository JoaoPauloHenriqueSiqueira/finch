  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flows</title>

    <!-- Lato Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/gallery-materialize.min.opt.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
      .nav {
        background-color: #c52f33;
      }

      .nav-dark {
        background-color: #7b2023;
      }

      .grid-item {
        width: 290px;
        margin: 5px;
      }

      .modal-content {
        height: 100% !important;
      }

      .material-tooltip {
        background-color: purple;
      }

      .caret {
        display: none;
      }

      .modal-flow {
        height: 55% !important;
      }

      #modalDelete {
        height: 25% !important;
      }
    </style>

  </head>

  <body class="vsc-initialized">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <script>
          M.toast({
            html: '{{$error}}'
          }, 5000);
        </script>
        @endforeach
      </ul>
    </div>
    @endif

    @if(session()->has('message'))
    <div class="alert alert-success">
      <script>
        M.toast({
          html: '{{ session()->get("message")}}'
        }, 5000);
      </script>
    </div>
    @endif
    <!-- Navbar and Header -->
    <nav class="nav-extended nav">
      <div class="nav-background">
        <div class="ea k">

        </div>
      </div>
      <div class="nav-wrapper db">
        <ul class="bt">
          <li>
            <a class="white-text" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>

        </ul>
        <!-- Dropdown Structure -->

        <div class="nav-header de">
        </div>
      </div>
    </nav>
    <ul class="side-nav" id="nav-mobile" style="transform: translateX(-100%);">
    </ul>

    <nav class="nav-dark">
      <div class="nav-wrapper">
        <a class="brand-logo right hide-on-med-and-down">Finch Workflow</a>
        <ul>
          <li id="home">
            <a class="tooltipped" href="{{ URL::route('home') }}" data-position='right' data-delay='50' data-tooltip="CRUD para as TAREFAS">Tarefas</a>
          </li>
          <li id="flows">
            <a class="tooltipped" href="{{ URL::route('flows') }}" data-position='right' data-delay='50' data-tooltip="Cria ou avança nos FLUXOS criados">Criar/Avançar fluxo</a>
          </li>
          <li id="list">
            <a class="tooltipped" href="{{ URL::route('list') }}" data-position='right' data-delay='50' data-tooltip="Listagem de todos os FLUXOS e seus passos">Fluxos</a>
          </li>
        </ul>
      </div>
    </nav>

    <div id="portfolio" class="cx gray">

      <div class="db">
        <div class="b e messages grid">
          @yield('content')
        </div>
      </div>
    </div><!-- /.container -->

    <!-- Core Javascript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>

    <script>
      $(document).ready(function() {
        $('select').formSelect();
        $("#typeTask").formSelect();
        $('.modal1').modal();
        $('.buttonsModal').modal();
        $('#modalList').modal();
        $('#modalFlow').modal();
        $("#modalDelete").modal();
      });

      $("#{{\Request::route()->getName()}}").addClass("active");

      $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 50
      });

      $('#modal1').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        complete: function() {
          $("#idTask").empty();
          $('#formTask').get(0).setAttribute('method', 'POST');
          $("#task").html("Nova Tarefa");
          $("#nameTask").val('');
          $("#typeTask").val(1);
          $("#idTask").remove();
          $("#typeTask").formSelect();
        }
      });

      $('#buttonsModal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        complete: function() { // Callback for Modal close
          $("#selectButtonsTask").empty();
          $("#selectButtonsTask").formSelect();
          $("#buttons").empty();
        }
      });

      $('#modalFlowNext').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        complete: function() { // Callback for Modal close
          $("#nextTask").empty();
          $("#nextTask").formSelect();
          $("#buttons").empty();
        }
      });
    </script>

  </html>