<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // العلاقة بين Make و Mode
    public function modes()
    {
        return $this->hasMany(Mode::class);
    }
}
