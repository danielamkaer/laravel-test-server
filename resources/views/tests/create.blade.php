@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create test</div>
                <div class="panel-body">
                    <form action="{{url('tests')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group"><label>Test Name</label><input class="form-control" type="text" name="name"></div>
                        <div class="form-group"><label>Runs</label><input class="form-control" type="numeric" name="runs"></div>
                        <div class="form-group"><label>Stdin</label>
                            <textarea name="stdin" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary">Create test</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

