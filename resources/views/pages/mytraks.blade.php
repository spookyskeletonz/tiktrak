@extends('layout')
@include('includes.navbar')
<h1 class="display-1"><p style="font-size:150px">TikTrak</p></h1>
<h2>MYTRAKS</h2>
@section('content')
@stop
    <?php
    	$user = \Auth::user();
    	$count = "0";
    	$tickerTables = preg_split("/DELIMITER/", $user->tables);
    	foreach($tickerTables as $tickerTable){
    		if($tickerTable == "" || $tickerTable == " "){
    			continue;
    		}
    		if($count != count($tickerTables)-1){
    			echo '<div class="row">';
    			echo '<div class="col-md-8">';
    			echo '<div id="chart'.$count.'">';
    			echo Lava::render('LineChart', 'trakChart'.$count, 'chart'.$count);
    			echo '</div>';
    			echo '</div>';
    			echo '<div class="col-md-4">';
    			?><form class="form-inline" method="GET" action="/mytraks"><?php
    			echo 	'<button type="submit" class="btn" name="delete" value="'.$count.'">Delete</button>';
    			echo '</form>';
    			echo '</div>';
    			echo '</div>';
                $count++;
            }
    	}
    ?>