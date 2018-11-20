$(document).ready(function () {
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
                    | Aqui fica o código para alterar o sala!
                    */
                    $("<td/>").html("Alterar").click(function () {
                        // var new_descricao = prompt('Insira a nova descrição da sala', sala.descricao);
                        // var new_quantidade_computadores = prompt('Insira a nova quantidade de computadores', sala.quantidade_computadores);
                        // if (new_descricao != null && new_quantidade_computadores != null) {
                        //     // 
                        //     // Faz a requisição API para alterar o sala
                        //     // 
                        //     $.ajax('/api/salas', {
                        //         method: "PUT",
                        //         data: {
                        //             "sala_numero": sala.sala_numero,
                        //             "descricao": new_descricao,
                        //             "quantidade_computadores": new_quantidade_computadores
                        //         },
                        //         success: function (data) {
                        //             alert("Sala alterada com sucesso");
                        //             location.reload();
                        //         },
                        //         error: function (err) {
                        //             alert('Ocorreu um erro ao alterar a sala!');
                        //         }
                        //     })
                        // }
                    })
                ).append(
                    /* 
                    | Aqui fica o código para remover o sala!
                    */
                    $("<td/>").html("Remover").click(function () {
                        // deletar = confirm('Tem certeza que deseja remover esta sala?');
                        // if (deletar) {
                        //     // 
                        //     // Manda o AJAX para a API remover a sala
                        //     // 
                        //     $.ajax(`/api/salas/${sala.sala_numero}`, {
                        //         method: "DELETE",
                        //         success: function (data) {
                        //             console.log(data);
                        //             if (data.deletou == "true") {
                        //                 alert('Sala removida com sucesso!');
                        //                 location.reload();
                        //             } else {
                        //                 alert("Ocorreu um erro ao deletar a sala");
                        //             }

                        //         },
                        //         error: function () {
                        //             alert("Ocorreu um erro ao remover a sala!");
                        //         }
                        //     })
                        // }
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

        // Preenche os dados do modal

        // Professores
        $.get('/api/professores', function (data) {
            data.forEach(function (professor) {
                $("#codigo_professor").append(
                    $("<option/>").html(professor.codigo_professor).attr("value", professor.codigo_professor)
                );
            });
        });

        // Salas
        $.get('/api/salas', function (data) {
            data.forEach(function (sala) {
                $("#sala_codigo").append(
                    $("<option/>").html(sala.sala_numero).attr("value", sala.sala_numero)
                );
            });
        });
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
})
