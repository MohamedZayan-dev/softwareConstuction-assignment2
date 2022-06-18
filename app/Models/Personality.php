<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personality extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function quiz(){
        return $this->hasOne(Quiz::class);
    }

    public function assessment(){
        return $this->belongsTo(Assessment::class);
    }

    public function careers(){
        return $this->belongsToMany(Career::class);
    }
}
