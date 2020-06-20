<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;

class CallbackController extends Controller
{
    private $access_token = "pk.eyJ1IjoiaWFua3VtdSIsImEiOiJjazlsYm94am8xYXJ0M2txNnNtdWJldjhpIn0.5R5ZniWxnkTUYkztu7iAYQ";

    public  function index($currentLongitude,$currentLatitude,$destinationLongitude,$destinationLatitude)
    {


        $url = "https://api.mapbox.com/directions/v5/mapbox/driving/".$currentLongitude.','.$currentLatitude.';'.$destinationLongitude.','.$destinationLatitude.'?alternatives=true&language=en&voice_instructions=true&steps=true&geometries=geojson&access_token=' . $this->access_token;


        return Http::get("$url")->json();

    }
}