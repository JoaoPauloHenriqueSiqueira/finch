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

@foreach ($tasks as $task)
<div id="{{$task->id}}" class="grid-item z-depth-3">
    <div class="placeholder">
        <div class="gallery-curve-wrapper">
            <div class="gallery-header">
                <p><b class="red-text">Tarefa:</b> {{$task->name}}</p>
                <p><b class="red-text">Tipo:</b> {{$task->type->title}}</p>
                <div class="row">
                    <a class="btn-flat tooltipped" onclick="editTask({{$task}})" data-position='left' data-delay='50' data-tooltip="Editar Tarefa">
                        <i class="material-icons blue-text">
                            edit
                        </i>
                    </a>
                    <a class="btn-flat tooltipped" onclick="askDelete({{$task->id}})" data-position='bottom' data-delay='50' data-tooltip="Deletar Tarefa">
                        <i class="material-icons red-text">
                            clear
                        </i>
                    </a>
                    <a class="btn-flat tooltipped" data-position='right' data-delay='50' data-tooltip="Associar Botões" @if ($task->type_id == 3) disabled="disabled" @endif onclick="createButton({{$task}},{{$task->type_id}})">
                        <i class="material-icons green-text">
                            account_tree
                        </i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="fixed-action-btn">
    <a class="btn-floating btn-large red modal-trigger btn tooltipped pulse" data-background-color="red lighten-3" data-position="left" data-delay="50" data-tooltip="Criar Tarefa" href="#modal1">
        <i class="large material-icons">add</i>
    </a>
</div>


<!-- Modal Structure -->
<div id="modalDelete" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="center red-text">Deletar tarefa?</h4>
        <div class="row center">
            <input type="hidden" id="deleteInput">
            <a class="btn-flat tooltipped" onclick="deleteTask()" data-position='left' data-delay='50' data-tooltip="Sim">
                <i class="material-icons blue-text">
                    done
                </i>
            </a>
            <a class="btn-flat tooltipped" onclick="closeModal()" data-position='right' data-delay='50' data-tooltip="Não">
                <i class="material-icons red-text">
                    close
                </i>
            </a>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 id="task" class="center red-text">Nova tarefa</h4>
        <form class="col s12" method="POST" action="admin/tasks" id="formTask">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nameTask" name="name" type="text" required class="validate">
                    <label for="disabled">Descrição</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <select name="type_id" id="typeTask">
                        <option value="1">Abertura</option>
                        <option value="2">Intermediário</option>
                        <option value="3">Finalização</option>
                    </select>
                    <label>Tipo</label>
                </div>
            </div>
    </div>

    <div class="modal-footer">
        <button class="modal-action waves-effect waves-green btn-flat " type="submit">Salvar</button>
        </form>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>


<div id="buttonsModal" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 id="task" class="center orange-text">Próximas Tarefas</h4>

        <ul class="collection with-header" id="buttons">
            <li class="collection-header">
                <p class="center">Cadastradas</p>
            </li>
        </ul>

        <form class="col s12" method="POST" action={{ url('admin/buttons') }} id="formButton">
            <input type="hidden" value="{{ csrf_token() }}">
            <div class="row">
                <div class="input-field col s12">
                    <select id='selectButtonsTask' name="next_id">
                    </select>
                </div>
            </div>
    </div>

    <div class="modal-footer">
        <button class="modal-action waves-effect waves-green btn-flat" type="submit">Salvar</button>
        </form>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
    </div>
</div>

@endsection
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>

<script>
    function closeModal() {
        $('#modalDelete').modal('close');
    }

    function editTask(task) {
        $("#idTask").append(task['id']);
        $("#task").html("Editar Tarefa");
        $("#nameTask").val(task['name']);
        $("#typeTask").val(task['type_id']);
        $("#typeTask").formSelect();
        $('<input>').attr({
            type: 'hidden',
            task_id: 'idTask',
            name: 'id',
            value: task['id']
        }).appendTo('#formTask');
        M.updateTextFields()
        $('#modal1').modal('open');
    }

    function createButton(task, type) {
        if (type !== 3) {
            let buttons = task['buttons'];

            let $registros = "Tarefa ainda não possui nenhum botão vinculado";
            if (buttons.length > 0) {
                $registros = "Cadastrados";
            }
            $("#buttons").html('<li class="collection-header"><p class="center">' + $registros + '</p></li>');

            $.each(buttons, function(k1, v1) {
                let elem = "<li class='collection-item' id='button" + v1['id'] + "'><div><b>" + v1['name'] + "<a class='secondary-content' onclick='deleteButton(" + v1['id'] + ");'><i class='material-icons red-text'>delete</i></a></div></li>";
                $("#buttons").append(elem);
            });

            $('<input>').attr({
                type: 'hidden',
                id: 'idTask',
                name: 'task_id',
                value: task['id']
            }).appendTo('#formButton');

            let list = @json($tasks);
            $.each(list, function(k, v) {
                let id = v['id'];

                if (type == 1 && v['type_id'] == 3) {
                    return;
                }

                if ((task != id && v['type_id'] != 1)) {
                    let $element = "<option value=" + id + ">" + v['name'] + "</option>";
                    $("#selectButtonsTask").append($element);
                }
            });

            $('#selectButtonsTask').trigger('contentChanged');
            $('#selectButtonsTask').formSelect();
            $('#buttonsModal').modal('open');
        }
    }

    function askDelete(id) {
        $('#modalDelete').modal('open');
        $("#deleteInput").val(id);
    }



    function deleteTask() {
        let id = $("#deleteInput").val();
        $.ajax({
            type: 'DELETE',
            url: 'admin/tasks',
            data: {
                "id": id
            },
            success: function($data) {
                $("#" + id).remove();
                $('.grid').masonry('reloadItems');;
                $('.grid').masonry({
                    itemSelector: '.grid-item',
                    columnWidth: 50
                });
                M.toast({
                    html: $data
                }, 5000);
                $("#modalDelete").modal("close");   
                $("#deleteInput").val('');
            }
        });
    }

    function deleteButton(id) {
        $.ajax({
            type: 'DELETE',
            url: 'admin/buttons',
            data: {
                "id": id
            },
            success: function($data) {
                $("#button" + id).remove();
                M.toast({
                    html: $data
                }, 5000);
            }
        });
    }
</script>