<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parsedown;
class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title','body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    public function getUrlAttribute(){
        return route('questions.show',$this->slug);
    }
    public function getCreateDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute(){
        if($this->answers_count>0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    public function getBodyHtmlAttribute(){
        $parsedown = new Parsedown();
        return $parsedown->text($this->body);
    }
    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('created_at','desc');
    }
}
