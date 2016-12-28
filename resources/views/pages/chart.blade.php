@extends('layout')
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