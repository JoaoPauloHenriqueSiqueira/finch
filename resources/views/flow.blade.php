@extends('layouts.app')

@section('content')

@foreach ($flows as $flow)
@if($flow->taskAtual)
<div id="{{$flow->id}}" class="grid-item z-depth-3">
    <div class="placeholder">
        <div class="gallery-curve-wrapper">
            <div class="gallery-header">
                <p><b class="red-text">Tarefa:</b> {{$flow->taskAtual->name}}</p>
                <p><b class="red-text">Criador:</b> {{$flow->user->name}}</p>
                <p><b class="red-text">Obs:</b> {{$flow->taskAtual->pivot->note}}</p>
                <p class="center">
                    <a class="btn-floating  blue  btn tooltipped pulse" data-position="bottom" data-delay="50" data-tooltip="Avançar fluxo" onclick="next({{$flow->id}},{{$flow->taskAtual}})">
                        <i class="material-icons white-text">
                            arrow_right_alt
                        </i>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red modal-trigger btn tooltipped pulse" data-background-color="red lighten-3" data-position="left" data-delay="50" data-tooltip="Criar fluxo" href="#modalFlow">
        <i class="large material-icons">add</i>
    </a>
</div>

<!-- Modal Structure -->
<div id="modalFlow" class="modal modal-fixed-footer modal-flow">
    <div class="modal-content">
        <h4 id="task" class="center red-text">Novo flow</h4>
        <form class="col s12" method="POST" action="flows">
            <div class="row">
                <div class="input-field col s12">
                    <select name="task_id">
                        @foreach($tasks as $task)
                        <option value='{{ $task->id }}'>{{ $task->name }}</option>
                        @endforeach
                    </select>
                    <label>Selecione uma task de abertura</label>
                </div>

                <div class="input-field col s12">
                    <textarea id="textarea1" name="note" class="materialize-textarea"></textarea>
                    <label for="textarea1">Observação</label>
                </div>
            </div>
    </div>

    <div class="modal-footer">
        <button class="modal-action waves-effect waves-green btn-flat " type="submit">Salvar</button>
        </form>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>


<!-- Modal Structure -->
<div id="modalFlowNext" class="modal modal-fixed-footer modal-flow">
    <div class="modal-content">
        <h4 id="task" class="center orange-text">Avançar flow:</h4>
        <h5 class="center" id="flowName"></h5>
        <form class="col s12" method="POST" action="flows/next" id="formNext">
            <div class="row">
                <div class="input-field col s12">
                    <select name="task_id" id="nextTask">
                    </select>
                    <label>Selecione a próxima task</label>
                </div>

                <div class="input-field col s12">
                    <textarea id="textarea1" name="note" class="materialize-textarea"></textarea>
                    <label for="textarea1">Observação</label>
                </div>
            </div>
    </div>

    <div class="modal-footer">
        <button class="modal-action waves-effect waves-green btn-flat " type="submit">Salvar</button>
        </form>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>

@endsection
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>

<script>
    function next(flow, task) {
        $("#flowName").html(task['name']);
        $('<input>').attr({
            type: 'hidden',
            name: 'flow_id',
            value: flow
        }).appendTo('#formNext');
        $.each(task['buttons'], function(k, v) {
            let id = v['id'];
            let $element = "<option value=" + v['next_id'] + ">" + v['name'] + "</option>";
            $("#nextTask").append($element);
        });
        $('#nextTask').formSelect();
        $("#modalFlowNext").modal('open');
    }
</script>