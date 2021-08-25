<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parsedown;
use Purifier;
class Question extends Model
{
    use HasFactory;
    use VotableTrait;
    protected $fillable = ['title','body'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
    // public function setBodyAttribute($value){
    //     $this->attributes['body'] = Purifier::clean($value);
    // }
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
        return $this->bodyHtml();
    }
    public function answers(){
        return $this->hasMany(Answer::class)->orderBy('votes_count','desc');
    }
    public function acceptBestAnswers(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    public function favorites(){
        return $this->belongsToMany(User::class,'favorites','question_id','user_id')->withTimestamps();//question id là khóa ngoại
    }
    public function isFavorited(){
        return $this->favorites()->where('user_id',auth()->id())->count() > 0;
    }
    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }
    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }
    public function getExcerptAttribute(){
        return $this->excerpt(250);
    }
    public function excerpt($length)
    {
        return str_limit(strip_tags($this->bodyHtml()),$length);
    }
    public function bodyHtml()
    {
        $parsedown = new Parsedown();
        return Purifier::clean($parsedown->text($this->body));
    }
}