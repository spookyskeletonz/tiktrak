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
        if($request->chartoptions == 'percentagechange'){
            $data1 = $this->_percentScrape($request->ticker1, $request->entries);
            $data2 = $this->_percentScrape($request->ticker2, $request->entries);
            $data3 = $this->_percentScrape($request->ticker3, $request->entries);
        } elseif($request->chartoptions == 'closingprice') {
            $data1 = $this->_closingPriceScrape($request->ticker1, $request->entries);
            $data2 = $this->_closingPriceScrape($request->ticker2, $request->entries);
            $data3 = $this->_closingPriceScrape($request->ticker3, $request->entries);
        }
        $datedata1 = $this->_dateScrape($request->ticker1, $request->entries);
        $datedata2 = $this->_dateScrape($request->ticker2, $request->entries);
        $datedata3 = $this->_dateScrape($request->ticker3, $request->entries);
    	if(isset($data1)||isset($data2)||isset($data3)){
    		$datasets = [$data1, $data2, $data3];
            $datedatasets = [$datedata1, $datedata2, $datedata3];
    		$this->_createChart($datasets, $request, $datedatasets, $request->entries, $request->chartoptions);
    		return view('pages.chart');
    	} else {
            return view('pages.welcome');
    	}
    }

    private function _percentScrape($ticker, $entries) {
    	//basic web scrape, taking percentage changes
    	try {
    		$data = file_get_contents("http://data.asx.com.au/data/1/share/$ticker/prices?interval=daily&count=$entries");
    	} catch(Exception $ex) {;
    		return null;
    	}
        $regex = '/change_in_percent":"([^%]*)%/';
        preg_match_all($regex, $data, $match);
        return $match[1];
    }

    private function _closingPriceScrape($ticker, $entries){
        //basic web scrape, taking closing prices
        try {
            $data = file_get_contents("http://data.asx.com.au/data/1/share/$ticker/prices?interval=daily&count=$entries");
        } catch(Exception $ex) {;
            return null;
        }
        $regex = '/close_price":([^,]*)/';
        preg_match_all($regex, $data, $match);
        return $match[1];
    }

    private function _dateScrape($ticker, $entries) {
        try {
            $data = file_get_contents("http://data.asx.com.au/data/1/share/$ticker/prices?interval=daily&count=$entries");
        } catch(Exception $ex) {
            return null;
        }
        $regex = '/close_date":"([^T]*)/';
        preg_match_all($regex, $data, $match);
        return $match[1];
    }

    private function _createChart($datasets, $request, $datedatasets, $entries, $charttype) {
    	$tickerTable = \Lava::DataTable(); //creates a new datatable to create the chart. Lava is a wrapper for Googles Chart API

    	$tickerTable->addDateColumn('Day')
    				->addNumberColumn($request->ticker1)
                    ->addNumberColumn($request->ticker2)
                    ->addNumberColumn($request->ticker3);
    	//we just created the columns for the table

        foreach($datasets as $number => $data){
            if($data != null) {
                foreach($data as $num => $percent){
                    foreach($datedatasets as $datedata){
                        if($datedata == null){
                        } else {
                            $dates = $datedata;
                        }
                    }
                    $tickerTable->addRow([$dates[$num], $datasets[0][$num], $datasets[1][$num], $datasets[2][$num]]);
                }
                break;
            }
        }
    	//now we create the actual chart from the datatable
        if($charttype == 'percentagechange'){
            $chart = \Lava::LineChart('trakChart', $tickerTable, ['title' => 'Percentage Changes for Stocks', 'height' => 600, 'width' => 1200]);
        } elseif($charttype == 'closingprice'){
            $chart = \Lava::LineChart('trakChart', $tickerTable, ['title' => 'Closing Prices for Stocks', 'height' => 600, 'width' => 1200]);
        }
    }
}
