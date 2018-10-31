<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Professor;

class ProfessoresController extends Controller
{
    private $professor = null;

    public function __construct(Professor $professor) {
        $this->professor = $professor;
    }

    public function getProfessores() {
        $professores = $this->professor->getProfessores();
        return response()->json($professores,200);
    }

    public function getProfessor($codigo) {
        $professor = $this->professor->getProfessor($codigo);
        return response()->json($professor,200);
    }

    public function addProfessor(Request $req) {
        $add = $this->professor->addProfessor($req->all());
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

    public function updateProfessor(Request $req) {
        $updated = $this->professor->updateProfessor($req->all());
        if ($updated) {
            return response()->json($updated,200);
        } else {
            return response()->json([
                "alterou"=>"false"
            ],400);
        }
    }

    public function deleteProfessor($codigo) {
        $deletou = $this->professor->deleteProfessor($codigo);
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
