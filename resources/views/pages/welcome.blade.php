@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md1 col-md-offset-5">
            <h1>tikTrak</h1>
            <form method="POST">
                <label>
                <input type="text" class="form-control" placeholder="Track a ticker" name="ticker">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn">go</button>
                </label>
            </form>
            </div>
        </div>
    </div>
@stop