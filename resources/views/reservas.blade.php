@extends('template')

@section('titulo','Reservas')

@section('meio')
<div>
    <h1 style="text-align: center;">LISTA DE RESERVAS</h1>

    <table class="table" id="tabela-salas">
        <thead>
            <tr>
                <th>Dia</th>
                <th>Sala</th>
                <th>Professor</th>
                <th>Horário</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<button class="btn btn-primary" style="width: 100%" id="btnAdicionarNovo">Adicionar nova</button>
@endsection

@section('modals')
<div id="modalAddReserva" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar nova reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="dia">Dia:</label>
                        <input type="date" id="dia" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="codigo_professor">Professor:</label>
                        <select class="form-control" id="codigo_professor">
                            <!-- Preenchimento via JS -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sala_codigo">Sala</label>
                        <select id="sala_codigo" class="form-control">
                            <!-- Preenchimento via JS -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horario">Horário</label>
                        <select id="horario" class="form-control">
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Noturno">Noturno</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnAdicionarReserva">Adicionar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/reservas.js"></script>
@endsection
