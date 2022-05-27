<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable=["Name","Notes"];
    protected $table = 'Grades';
    public $translatable = ['Name'];

    public $timestamps = true;
    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }
}
