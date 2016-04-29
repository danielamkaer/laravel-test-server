<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Test;
use App\TestRun;
use App\TestFile;
use Cache;

class ClientController extends Controller
{
    public function beginTest(Request $request) {
        $testRuns = TestRun::where('completed',false)->get();
        if ($testRuns->count() > 0) {
            return response('Already running',503);
        }
        $tests = Test::with('test_runs')->orderBy('id','desc')->get();
        $test_to_run = $tests->first(function($key,$row) {
            return $row->test_runs->count() < $row->runs;
        });
        if (!$test_to_run) {
            return response("Try Again Later", 503);
        }
        if (count($test_to_run->test_runs) > 0) {
            $testRun = new TestRun( ['run_number' => ($test_to_run->test_runs->last()->run_number+1)]);
        } else {
            $testRun = new TestRun(['run_number'=>1]);
        }
        $testRun->start_time = \Carbon\Carbon::now();
        $test_to_run->test_runs()->save($testRun);
        return response($test_to_run->stdin);
    }

    public function currentTest() {
        $testRun = TestRun::with('test')->orderBy('id','desc')->take(1)->first();
        if (!$testRun || $testRun->completed) {
            return response('No test running',404);
        }
        return $testRun->test->stdin;
    }

    public function endTest(Request $request) {
        $testRun = TestRun::with('test')->orderBy('id','desc')->take(1)->first();
        $testRun->completed = true;
        $testRun->end_time = \Carbon\Carbon::now();
        if ($testRun->save()) {
            return response("OK");
        } else {
            return response("Not saved",500);
        }
    }

    public function postStdout(Request $request) {
        $testRun = TestRun::with('test')->orderBy('id','desc')->take(1)->first();
        if (!$testRun || $testRun->completed) {
            return response('No test running',404);
        }
        if ($request->hasFile('stdout') && $request->file('stdout')->isValid()) {
            $testRun->stdout = file_get_contents($request->file('stdout')->getPathname());
            if ($testRun->save())
                return response("OK");
        }
        return response("Stdout not saved",500);
    }

    public function postStderr(Request $request) {
        $testRun = TestRun::with('test')->orderBy('id','desc')->take(1)->first();
        if (!$testRun || $testRun->completed) {
            return response('No test running',404);
        }
        if ($request->hasFile('stderr') && $request->file('stderr')->isValid()) {
            $testRun->stderr = file_get_contents($request->file('stderr')->getPathname());
            if ($testRun->save())
                return response("OK");
        }
        return response("Stderr not saved",500);
    }

    public function uploadFile(Request $request) {
        $testRun = TestRun::with('test')->orderBy('id','desc')->take(1)->first();
        if (!$testRun || $testRun->completed) {
            return response('No test running',404);
        }
        $filename = $request->get('filename');
        if ($request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
            $savePath = storage_path('uploads/'.$testRun->test->id.'/'.$testRun->id);
            if (!is_dir($savePath))
                mkdir($savePath,0755,true);

            $file = $request->file('uploaded_file')->move($savePath,$request->file('uploaded_file')->getClientOriginalName());
            $testFile = new TestFile(['name'=>$filename, 'filename'=>$file->getPathname()]);
            if ($testRun->files()->save($testFile))
                return response("OK");
        }
        return response("File not saved",500);
    }

    public function hasFile(Request $request) {
        $testRun = TestRun::with('test')->with('files')->orderBy('id','desc')->take(1)->first();
        if (!$testRun || $testRun->completed) {
            return response('No test running',404);
        }
        $filename = $request->get('filename');
        if ($testRun->files->first(function($key,$row) use ($filename) { return $row->name == $filename; })) {
            return response("OK");
        } else {
            return response('File not uploaded.',404);
        }
    }
}
