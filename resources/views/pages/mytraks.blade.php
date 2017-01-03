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
    		if($count != count($tickerTables)-1){
    			echo '<div id="chart'.$count.'">';
    			echo Lava::render('LineChart', 'trakChart'.$count, 'chart'.$count);
    			echo '</div>';
                $count++;
            }
    	}
    ?>