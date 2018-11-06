<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Reserva;

class ReservasController extends Controller
{
    private $reserva = null;

    public function __construct(Reserva $reserva) {
        $this->reserva = $reserva;
    }

    public function getReservas() {
        return response()->json($this->reserva->getReservas(),200);
    }

    public function addReserva(Request $req) {
        $add = $this->reserva->addReserva($req->all());
        if ($add) {
            return response()->json([
                "adicionou"=>"true"
            ],200);
        } else {
            return response()->json([
                "adicionou"=>"false"
            ],400);
        }
    }

    public function getReserva($dia) {
        $reservas = $this->reserva->getReserva($dia);
        return response()->json($reservas,200);
    }

    public function updateReserva(Request $req,$dia,$horario,$sala) {
        $updated = $this->reserva->updateReserva($req->all(),$dia,$horario,$sala);
        if ($updated) {
            return response()->json([
                "alterou"=>"true"
            ],200);
        } else {
            return response()->json([
                "alterou"=>"false"
            ],400);
        }
    }

    public function deleteReserva(Request $req) {
        $deletou = $this->reserva->deleteReserva($req);
        if ($deletou) {
            return response()->json([
                "deletou"=>'true'
            ],200);
        } else {
            return response()->json([
                "deletou"=>"false"
            ],400);
        }
    }

}
