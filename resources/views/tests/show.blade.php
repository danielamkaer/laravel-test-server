@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading clearfix"><strong>{{ $test->name }}</strong>
                    <div class="pull-right"><a class="btn btn-info btn-sm" href="{{url('tests/'.$test->id.'/edit')}}">Edit test</a></div>
                </div>

                <div class="panel-body">
                    <p>Number of runs: {{ $test->runs }}</p>
                    <pre>{{$test->stdin}}</pre>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Run Number</th>
                            <th>Completed</th>
                            <th>Files</th>
                            <th>Test started</th>
                            <th>Test stopped</th>
                            <th>Last update</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($test->test_runs as $run)
                            <tr @if (!$run->completed) class="success" @endif>
                            <td>{{$run->run_number}}</td>
                            <td>{{$run->completed?'Yes':'No'}}
                                @if ($run->completed)
                                    <a href="{{url('tests/'.$test->id.'/stdout/'.$run->id)}}">stdout</a>
                                    <a href="{{url('tests/'.$test->id.'/stderr/'.$run->id)}}">stderr</a>
                                @endif</td>
                            <td>
                                <ul>
                                @foreach($run->files as $file)
                                    <li><a href="{{url('tests/'.$test->id.'/get_file/'.$file->id)}}">{{$file->name}} ({{basename($file->filename)}})</a> - {{number_format(filesize($file->filename)/1024, 1) }} KB</li>
                                @endforeach
                                </ul>
                            </td>
                            <td class="moment-time">{{$run->start_time?$run->start_time->toRfc2822String():''}}</td>
                            <td class="moment-time">{{$run->end_time?$run->end_time->toRfc2822String():''}}</td>
                            <td class="moment-time">{{$run->updated_at->toRfc2822String()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
