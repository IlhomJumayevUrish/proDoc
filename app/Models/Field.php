<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $table="fields";
    protected $fillable = [
        'label',
        'key',
        'type',
        'template_id'
    ];
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
