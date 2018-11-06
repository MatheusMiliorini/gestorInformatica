@extends('template')

@section('titulo','Professores')

@section('meio')
<div>
    <h1 style="text-align: center;">LISTA DE PROFESSORES</h1>

    <table class="table" id="tabela-professores">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<button class="btn btn-primary" style="width: 100%" id="btnAdicionarNovo">Adicionar novo</button>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $.get('/api/professores', function (professores) {
            console.log(professores);
            professores.forEach(function (professor) {
                $('#tabela-professores tbody').append(
                    $("<tr/>").append(
                        $("<td/>").html(professor.codigo_professor)
                    ).append(
                        $("<td/>").html(professor.nome)
                    ).append(
                        $("<td/>").html(professor.email)
                    ).append(
                        $("<td/>").html("Alterar")
                    ).append(
                        $("<td/>").html("Remover").click(function() {
                            deletar = confirm('Tem certeza que deseja remover este professor?');
                            if (deletar) {
                                $.ajax(`/api/professores/${professor.codigo_professor}`,{
                                    method: "DELETE",
                                    success: function(data) {
                                        console.log(data);
                                        if (data.deletou == "true") {
                                            alert('Professor removido com sucesso!');
                                            location.reload();  
                                        } else {
                                            alert("Ocorreu um erro ao deletar o professor");
                                        }
                                        
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
        codigo = prompt('Informe o código do professor');
        nome = prompt('Informe o nome do professor');
        email = prompt('Informe o e-mail do professor');
        
        if (codigo != null && nome != null  && email != null) {
            $.ajax('/api/professores',{
                method: 'POST',
                data: {
                    "codigo_professor": codigo,
                    "nome":nome,
                    "email":email
                },
                success: function(data) {
                    if (data.adicionou == "true") {
                        alert('Adicionado com sucesso!');
                        location.reload();
                    } else {
                        alert('Falha ao adicionar! Cheque os dados novamente');
                    }
                }
            });
        }
    })

</script>
@endsection
