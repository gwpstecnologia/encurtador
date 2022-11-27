<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'user_id',
        'link',
        'destination',
        'title',
        'description',
    ];
    public function user() {

        return $this->belongsTo('App\Models\User');
    }

    public function View() {

        return $this->hasMany('App\Models\View');
    }
}
