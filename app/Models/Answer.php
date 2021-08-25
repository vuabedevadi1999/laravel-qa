<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parsedown;
use Purifier;
class Answer extends Model
{
    use VotableTrait;
    use HasFactory;
    
    protected $fillable = ['body','user_id'];
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getBodyHtmlAttribute(){
        $parsedown = new Parsedown();
        return Purifier::clean($parsedown->text($this->body));
    }
    public static function boot(){
        parent::boot();
        static::created(function ($answer){
            $answer->question->increment('answers_count');
        });
        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
        });
    }
    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute(){
        return $this->isBest() ? 'vote-accepted' : '';
    }
    public function getIsBestAttribute(){
        return $this->isBest();
    }
    public function isBest(){
        return $this->id == $this->question->best_answer_id;
    }
}
