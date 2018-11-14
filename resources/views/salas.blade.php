@extends('template')

@section('titulo','Salas')

@section('meio')
<div>
    <h1 style="text-align: center;">LISTA DE SALAS</h1>

    <table class="table" id="tabela-salas">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Descrição</th>
                <th>Quantidade de computadores</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<button class="btn btn-primary" style="width: 100%" id="btnAdicionarNovo">Adicionar nova</button>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $.get('/api/salas', function (salas) {
            console.log(salas);
            salas.forEach(function (sala) {
                $('#tabela-salas tbody').append(
                    $("<tr/>").append(
                        $("<td/>").html(sala.sala_numero)
                    ).append(
                        $("<td/>").html(sala.descricao)
                    ).append(
                        $("<td/>").html(sala.quantidade_computadores)
                    ).append(
                        // 
                        // Aqui fica o código para alterar o sala!
                        // 
                        $("<td/>").html("Alterar").click(function() {
                            var new_descricao = prompt('Insira a nova descrição da sala',sala.descricao);
                            var new_quantidade_computadores = prompt('Insira a nova quantidade de computadores',sala.quantidade_computadores);
                            if (new_descricao != null && new_quantidade_computadores != null) {
                                // 
                                // Faz a requisição API para alterar o sala
                                // 
                                $.ajax('/api/salas',{
                                    method: "PUT",
                                    data: {
                                        "sala_numero": sala.sala_numero,
                                        "descricao": new_descricao,
                                        "quantidade_computadores": new_quantidade_computadores
                                    },
                                    success: function(data) {
                                        alert("Sala alterada com sucesso");
                                        location.reload();
                                    },
                                    error: function(err) {
                                        alert('Ocorreu um erro ao alterar a sala!');
                                    }
                                })
                            }
                        })
                    ).append(
                        // 
                        // Aqui fica o código para remover o sala!
                        // 
                        $("<td/>").html("Remover").click(function() {
                            deletar = confirm('Tem certeza que deseja remover esta sala?');
                            if (deletar) {
                                // 
                                // Manda o AJAX para a API remover a sala
                                // 
                                $.ajax(`/api/salas/${sala.sala_numero}`,{
                                    method: "DELETE",
                                    success: function(data) {
                                        console.log(data);
                                        if (data.deletou == "true") {
                                            alert('Sala removida com sucesso!');
                                            location.reload();  
                                        } else {
                                            alert("Ocorreu um erro ao deletar a sala");
                                        }
                                        
                                    },
                                    error: function() {
                                        alert("Ocorreu um erro ao remover a sala!");
                                    }
                                })
                            }
                        })
                    )
                );
            });
        });
    });

    $('#btnAdicionarNovo').click(function() {
        // 
        // Adicionar nova sala
        //         
        numero = prompt('Informe o número da sala');
        descricao = prompt('Informe a descrição da sala');
        quantidade_computadores = prompt('Informe a quantidade de computadores');
        
        if (numero != null && descricao != null  && quantidade_computadores != null) {
            // 
            // Requisição API para adicionar uma nova sala
            // 
            $.ajax('/api/salas',{
                method: 'POST',
                data: {
                    "sala_numero": numero,
                    "descricao":descricao,
                    "quantidade_computadores":quantidade_computadores
                },
                success: function(data) {
                    if (data.adicionou == "true") {
                        alert('Adicionado com sucesso!');
                        location.reload();
                    } else {
                        alert('Falha ao adicionar! Cheque os dados novamente');
                    }
                },
                error: function(err) {
                    alert('Falha ao adicionar! Cheque os dados novamente'); 
                }
            });
        }
    })

</script>
@endsection
