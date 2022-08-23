<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'entry_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
