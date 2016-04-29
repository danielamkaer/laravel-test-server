<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestRun extends Model
{
    protected $fillable = ['run_number','stdout','stderr'];

    public function test() {
        return $this->belongsTo('App\Test');
    }

    public function files() {
        return $this->hasMany('App\TestFile');
    }
}
