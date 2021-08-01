<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpekForm extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'form_id', 'title', 'name', 'type'
    ];

    public function form_attributes(){
        return $this->hasMany(FormAttribute::class);
    }

    public function spek_sub_forms(){
        return $this->hasMany(SpekSubForm::class);
    }

    public function form_values(){
        return $this->hasMany(FormValue::class);
    }
}
