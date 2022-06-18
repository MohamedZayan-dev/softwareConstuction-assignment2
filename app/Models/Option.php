<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function personality(){
        return $this->belongsTo(Personality::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
