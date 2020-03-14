@extends('layouts.app')

@section('content')

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

@foreach ($flows as $flow)
<div id="{{$flow->id}}" class="grid-item z-depth-3 gallery-expand gallery-item">
    <div class="placeholder">
        <div class="gallery-curve-wrapper">
            <div class="gallery-header">
                <p><b>Criador:</b> {{$flow->user->name}}</p>
                <p><b>Criado em :</b> {{$flow->created_at}}</p>
                <p>
                    <div class="switch">
                        <label>
                            <span class="green-text">Em andamento<span>
                                    <input disabled type="checkbox" {{ $flow->finish == 1 ? 'checked' : '' }}>
                                    <span class="lever"></span>
                                    <span class="red-text">Finalizado<span>
                        </label>
                    </div>
                </p>
                <p class="center">
                    <a class="btn-floating  blue  btn tooltipped pulse" data-position="bottom" data-delay="50" data-tooltip="Detalhes fluxo" onclick="detail({{$flow->id}})">
                        <i class="material-icons white-text">
                            list
                        </i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endforeach

<div id="modalList" class="modal modal-fixed-footer">
    <div class="modal-content">

        <ul class="collection with-header" id="listTasks">
        </ul>
    </div>

    <div class="modal-footer">
        <div class="row">
            <div class="left">
                <a class="btn-flat tooltipped" data-position='left' data-delay='50' data-tooltip="Abertura">
                    <i class="material-icons green-text">
                        fiber_manual_record
                    </i>
                </a>
                <a class="btn-flat tooltipped" data-position='bottom' data-delay='50' data-tooltip="Intermediária">
                    <i class="material-icons blue-text">
                        fiber_manual_record
                    </i>
                </a>
                <a class="btn-flat tooltipped" data-position='right' data-delay='50' data-tooltip="Finalização">
                    <i class="material-icons red-text">
                        fiber_manual_record
                    </i>
                </a>
            </div>

            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>

        </div>
    </div>
</div>



@endsection
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>

<script>
    function detail(flow) {
        $("#listTasks").empty();
        $("#modalList").modal('open');
        $.ajax({
            type: 'POST',
            url: 'tasks',
            data: {
                "id": flow
            },
            success: function($data) {
                $.each($data['tasks'], function(k, v) {
                    let $color = "red";
                    switch (v['type_id']) {
                        case 1:
                            $color = "green"
                            break;
                        case 2:
                            $color = "blue";
                            break;
                    }
                    let $element = "<li class='collection-item " + $color + "-text'>" + v['name'] + "<a class='secondary-content'><i class='material-icons'>check</i></a></li>";
                    $("#listTasks").append($element);
                });
            }
        });

    }
</script>