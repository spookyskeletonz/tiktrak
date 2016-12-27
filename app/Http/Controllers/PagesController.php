<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Exception;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home(){
		return view('pages.welcome');
    }

    public function about(){
    	return view('pages.about');
    }

    public function tickerFind(Request $request){
    	$data1 = $this->_scrape($request->ticker1);
    	$data2 = $this->_scrape($request->ticker2);
    	$data3 = $this->_scrape($request->ticker3);
    	if(isset($data1)||isset($data2)||isset($data3)){
    		$datasets = [$data1, $data2, $data3];
    		$this->_createChart($datasets, $request);
    		return view('pages.chart');
    	} else {
    		return view('pages.welcome');
    	}
    }

    private function _scrape($ticker) {
    	//basic web scrape, taking the last 3 closing prices atm
    	try {
    		$data = file_get_contents("http://data.asx.com.au/data/1/share/$ticker/prices?interval=daily&count=100");
    	} catch(Exception $ex) {
    		echo 'Please input a valid ASX Ticker';
    		return null;
    	}
        $regex = '/change_in_percent":"([^%]*)%/';
        preg_match_all($regex, $data, $match);
        return $match[1];
    }

    private function _createChart($datasets, $request) {
    	$tickerTable = \Lava::DataTable(); //creates a new datatable to create the chart. Lava is a wrapper for Googles Chart API

    	$tickerTable->addNumberColumn('Day')
    				->addNumberColumn($request->ticker1)
                    ->addNumberColumn($request->ticker2)
                    ->addNumberColumn($request->ticker3);
    	//we just created the columns for the table

    	// foreach ($datasets[0] as $num => $price){
    	// 	//for each closing price in the data, creates a new row, with the index of the arrax as num
    	// 	$tickerTable-> addRow([$num, $price]);
    	// }

        foreach(range(0, 100) as $x){
            $datasets[3][$x] = 0; 
        }

        foreach($datasets as $number => $data){
            if($data == null){
                $datasets[$number] = $datasets[3];
            } else {
                foreach($data as $num => $percent){
                    $tickerTable->addRow([$num, $datasets[0][$num], $datasets[1][$num], $datasets[2][$num]]);
                }
                break;
            }
        }
    	//now we create the actual chart from the datatable
    	$chart = \Lava::LineChart('trakChart', $tickerTable, ['title' => 'Percentage Changes for the Tickers', 'height' => 600, 'width' => 1200]);
    }
}
