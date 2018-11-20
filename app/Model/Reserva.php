<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reserva extends Model
{
    protected $table = "reservas";
    protected $fillable = ['dia','codigo_professor','horario','sala_numero'];
    public $timestamps = false;

    public function getReservas() {
        return self::all();
    }

    public function addReserva($req) {
        $reserva = new self($req);
        try {
            $reserva->save();
        } catch (\Exception $e) {
            $reserva = false;
        }
        return $reserva;
    }

    public function getReserva($dia) {
        $reservas = self::where('dia',$dia)->get();
        return $reservas;
    }

    public function updateReserva($req, $dia, $horario, $sala) {
        $alterou = DB::update("UPDATE reservas SET dia=?,horario=?,sala_numero=?,codigo_professor=? WHERE dia=? AND horario=? AND sala_numero=?",[
            $req['dia'],$req['horario'],$req['sala_numero'],$req['codigo_professor'],$dia,$horario,$sala
        ]);

        if ($alterou == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteReserva($req) {
        $deletado = DB::delete('DELETE FROM reservas WHERE dia=? AND horario=? AND sala_numero=?',[
            $req['dia'],$req['horario'],$req['sala_numero']
        ]);

        if ($deletado == 1) {
            return true;
        } else {
            return false;
        }
    }
}
