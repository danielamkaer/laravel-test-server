<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestFile extends Model
{
    protected $fillable = ['name','filename'];

    public function run() {
        return $this->belongsTo('App\TestRun');
    }
}
