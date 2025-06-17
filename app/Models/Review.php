<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review','rating'];
    public function book(){
        return $this->belongsTo(Book::class);
    }

    //qe e perdorem cache per me i rujt tdhanat qaty qe veq me i marr gati
    //mos me i marr prej dataabzases gjithe dmth, e tasht na mujm me caktu
    //per sa kohe po dojm qe tdhanat mu rujt ne cache, e nese bojm naj
    //ndryshim nuk shfaqet te na pa kalu qekjo kohe dmth se mesin tdhanat
    //e njejta gjithe, e per qeta e perdorim qet metoden booted, qe me mujt
    //tdhanat mu ba update meniher edhe pse jan trujtme ne cache
    protected static function booted(){
        static::updated(fn (Review $review) => cache()->forget('book:'.$review->book_id));
        static::deleted(callback: fn (Review $review) => cache()->forget('book:'.$review->book_id));
        static::created(callback: fn (Review $review) => cache()->forget('book:'.$review->book_id));
    }
}
