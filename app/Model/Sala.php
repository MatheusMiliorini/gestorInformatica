<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = "salas";
    protected $fillable = ['sala_numero','descricao','quantidade_computadores'];
    protected $primaryKey = 'sala_numero';

    public $timestamps = false;

    public function getSalas() {
        return self::all();
    }

    public function getSala($numero) {
        return self::find($numero);
    }

    public function addSala($req) {
        $sala = new self($req);
        try {
            $sala->save();
        } catch (\Exception $e) {
            $sala = false;
        }
        return $sala;
    }

    public function updateSala($req) {
        $sala_antiga = self::find($req['sala_numero']);
        if (!is_null($sala_antiga)) {
            $sala_nova = $sala_antiga->fill($req);
            $sala_nova->save();
        } else {
            $sala_nova = false;
        }
        return $sala_nova;
    }

    public function deleteSala($numero) {
        $sala = self::find($numero);
        if (!is_null($sala)) {
            try {
                $sala->delete();
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
        
    }
}
