<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Answer extends Model
{
    use HasFactory;

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getBodyHtmlAttribute(){
        $parsedown = new Parsedown();
        return $parsedown->text($this->body);
    }
    public static function boot(){
        parent::boot();
        static::created(function ($answer){
            $answer->question->increment('answers_count');
        });
    }
    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
