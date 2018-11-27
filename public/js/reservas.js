$(document).ready(function () {
    /*
    |   Variáveis de ajuda
    */
    var dia;
    var sala;
    var horario;

    /*
    |   Busca todos os dados para preencher os modais
    */
    // Salas Alterar
    $.get('/api/salas', function (data) {
        data.forEach(function (sala) {
            $("#altSala_codigo").append(
                $("<option/>").html(sala.sala_numero).attr("value", sala.sala_numero)
            );
        });
    });

    // Professores Alterar
    $.get('/api/professores', function (data) {
        data.forEach(function (professor) {
            $("#altCodigo_professor").append(
                $("<option/>").html(professor.codigo_professor).attr("value", professor.codigo_professor)
            );
        });
    });

    // Professores ADD
    $.get('/api/professores', function (data) {
        data.forEach(function (professor) {
            $("#codigo_professor").append(
                $("<option/>").html(professor.codigo_professor).attr("value", professor.codigo_professor)
            );
        });
    });

    // Salas ADD
    $.get('/api/salas', function (data) {
        data.forEach(function (sala) {
            $("#sala_codigo").append(
                $("<option/>").html(sala.sala_numero).attr("value", sala.sala_numero)
            );
        });
    });

    /*
    |   Busca todas as reservas para preencher a tabela
    */
    $.get('/api/reservas', function (reservas) {
        console.log(reservas);
        reservas.forEach(function (reserva) {
            $('#tabela-salas tbody').append(
                $("<tr/>").append(
                    $("<td/>").html(reserva.dia)
                ).append(
                    $("<td/>").html(reserva.sala_numero)
                ).append(
                    $("<td/>").html(reserva.codigo_professor)
                ).append(
                    $("<td/>").html(reserva.horario)
                ).append(
                    /*
                    | Aqui fica o código para alterar a reserva!
                    */
                    $("<td/>").html("Alterar").click(function () {
                        $("#modalAlteraReserva").modal();

                        //Preenche os dados conforme a reserva selecionada
                        $("#altDia").val(reserva.dia);
                        $("#altCodigo_professor").val(reserva.codigo_professor);
                        $("#altHorario").val(reserva.horario);
                        $("#altSala_codigo").val(reserva.sala_numero);

                        /*
                        |   Preenche variáveis de ajuda
                        */
                        dia = reserva.dia;
                        sala = reserva.sala_numero;
                        horario = reserva.horario;
                    })
                ).append(
                    /* 
                    | Aqui fica o código para remover a reserva!
                    */
                    $("<td/>").html("Remover").click(function () {
                        deletar = confirm('Tem certeza que deseja remover esta reserva?');
                        if (deletar) {
                            // 
                            // Manda o AJAX para a API remover a sala
                            // 
                            $.ajax(`/api/reservas/`, {
                                method: "DELETE",
                                data: {
                                    "dia": reserva.dia,
                                    "horario": reserva.horario,
                                    "sala_numero": reserva.sala_numero
                                },
                                success: function (data) {
                                    alert('Reserva removida com sucesso!');
                                    location.reload();

                                },
                                error: function () {
                                    alert("Ocorreu um erro ao remover a sala!");
                                }
                            })
                        }
                    })
                )
            );
        });
    });


    /*
    |   Botão de chamar Modal
    */
    $('#btnAdicionarNovo').click(function () {
        $("#modalAddReserva").modal();
    });

    /*
    |   Confirmar a adição
    */

    $("#btnAdicionarReserva").click(function () {
        $.ajax('/api/reservas', {
            method: "POST",
            data: {
                "dia": $("#dia").val(),
                "codigo_professor": $("#codigo_professor").val(),
                "sala_numero": $("#sala_codigo").val(),
                "horario": $("#horario").val()
            },
            success: function () {
                alert("Reserva adicionada com sucesso!");
                location.reload();
            },
            error: function () {
                alert(`Erro! Verifique se já não existe uma reserva neste horário!`);
            }
        })
    });

    /*
    |   Confirmar alteração na reserva
    */

    $("#btnAlterarReserva").click(function () {
        $.ajax(`/api/reservas/${dia}/${horario}/${sala}`, {
            method: "PUT",
            data: {
                "dia": $("#altDia").val(),
                "horario": $("#altHorario").val(),
                "sala_numero": $("#altSala_codigo").val(),
                "codigo_professor": $("#altCodigo_professor").val()
            },
            success: function () {
                alert("Reserva alterada com sucesso!");
                location.reload();
            },
            error: function () {
                alert("Erro ao alterar a reserva, confirme os dados");
            }
        });
    });
})
