<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpekSubForm extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = [
        'spek_form_id', 'option'
    ];

    public function spek_forms(){
        return $this->BelongsTo(SpekForm::class);
    }

}
