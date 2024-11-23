<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMedia extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $table = 'chat_media';
    public $timestamps = false;
}
