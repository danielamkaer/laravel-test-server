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
                            <td>{{count($test->runs_completed)}}</td>
                            <td>{{$test->updated_at}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
