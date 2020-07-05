<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Api extends Model
{
    public $timestamps = false;

    protected $rules = [

    ];

    public function getData(string $host = NULL)
    {
        $response = HTTP::get($host);

        return $response;
    }
}
