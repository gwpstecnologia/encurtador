<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'ip_address',
    ];

    public function Link() {

        return $this->belongsTo('App\Models\Link');
    }
}
