<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sala;

class SalasController extends Controller
{
    private $sala = null;

    public function __construct(Sala $sala) {
        $this->sala = $sala;
    }

    public function getSalas() {
        $salas = $this->sala->getSalas();
        return response()->json($salas,200);
    }

    public function addSala(Request $req) {
        $add = $this->sala->addSala($req->all());
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

    public function updateSala(Request $req) {
        $updated = $this->sala->updateSala($req->all());
        if ($updated) {
            return response()->json($updated,200);
        } else {
            return response()->json([
                "alterou"=>"false"
            ],400);
        }
    }

    public function deleteSala($numero) {
        $deletou = $this->sala->deleteSala($numero);
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

    public function getSala($numero) {
        $sala = $this->sala->getSala($numero);
        return response()->json($sala,200);
    }
}
