
@extends('layout')
@include('includes.navbar')
<h1 class="display-1"><p style="font-size:150px">TikTrak</p></h1>
<div class="container" style="text-align:center">
    <h1>Your chart is displayed below.</h1>
</div>
@section('content')
@stop
<div id="closing-prices-chart">
    <?php 
        echo Lava::render('LineChart', 'trakChart', 'closing-prices-chart');
    ?>
</div>
<?php
    if(Auth::check()){
?>
        <div class = "container" style = "text-align: center">
        <form method="POST">
        <button type="submit" class="btn" name="add"><h4>ADD TO MY TRAKS</h4></button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        </form>
        </br>
        </br>
<?php
    }
?>