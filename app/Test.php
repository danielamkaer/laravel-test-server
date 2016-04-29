<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['name','stdin','runs'];
    public function test_runs() {
        return $this->hasMany('App\TestRun');
    }

}
