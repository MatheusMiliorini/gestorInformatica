<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professores";
    protected $fillable = ['codigo_professor','nome','email'];
    protected $primaryKey = "codigo_professor";
    public $timestamps = false;

    public function getProfessores() {
        return self::all();
    }

    public function addProfessor($req) {
        $professor = new self($req);
        try {
            $professor->save();
        } catch (\Exception $e) {
            $professor = false;
        }
        return $professor;
    }

    public function getProfessor($codigo) {
        return self::find($codigo);
    }

    public function updateProfessor($req) {
        $professor_antigo = self::find($req['codigo_professor']);
        if (!is_null($professor_antigo)) {
            $professor_novo = $professor_antigo->fill($req);
            $professor_novo->save();
        } else {
            $professor_novo = false;
        }
        return $professor_novo;
    }

    public function deleteProfessor($codigo) {
        $professor = self::find($codigo);
        if (!is_null($professor)) {
            try {
                $professor->delete();
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}
