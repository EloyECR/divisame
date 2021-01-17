<?php

Route::get('/argentina', 'ScrapingController@DolarInfo');
Route::get('/venezuela', 'ScrapingController@MonitorDolarVE');
Route::get('/', 'ScrapingController@MonitorDolarVE');
Route::get('/origen', function(){
    return view('origen');
});
