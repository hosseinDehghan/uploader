<?php

namespace Hosein\Uploader;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable=[
        'id','title','src'
    ];
}
