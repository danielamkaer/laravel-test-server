@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tests</div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Runs total</th>
                            <th>Runs completed</th>
                            <th>Last update</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                        <tr>
                            <td><a href="{{url('tests/'.$test->id)}}">{{$test->name}}</a></td>
                            <td>{{$test->runs}}</td>
                            <td>{{count($test->test_runs) }}</td>
                            <td class="moment-time">{{$test->updated_at->toRfc2822String()}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="panel-footer"><a class="btn btn-success" href="{{url('tests/create')}}">Create test</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
