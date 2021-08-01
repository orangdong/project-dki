<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'nama', 'description', 'valid_until'
    ];

    public function form_tujuans(){
        return $this->hasMany(FormTujuan::class);
    }

    public function spek_forms(){
        return $this->hasMany(SpekForm::class);
    }
}
