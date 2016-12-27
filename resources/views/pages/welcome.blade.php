@extends('layout')
@section('content')
<h1>tikTrak</h1>
<h2>Try Typing a Ticker eg. SYD for Sydney Airport</h2>
<form method="POST">
    <label>
    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker1">
    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker2">
    <input type="text" class="form-control" placeholder="Track a ticker" name="ticker3">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="btn">go</button>
    </label>
</form> 
@stop