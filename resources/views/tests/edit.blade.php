@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create test</div>
                <div class="panel-body">
                    <form action="{{url('tests/'.$test->id)}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group"><label>Test Name</label><input class="form-control" type="text" name="name" value="{{ $test->name }}"></div>
                        <div class="form-group"><label>Runs</label><input class="form-control" type="number" name="runs" value="{{ $test->runs }}"></div>
                        <div class="form-group"><label>Stdin</label>
                            <textarea name="stdin" cols="30" rows="10" class="form-control">{{$test->stdin}}</textarea>
                        </div>
                        <button class="btn btn-primary">Update test</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

