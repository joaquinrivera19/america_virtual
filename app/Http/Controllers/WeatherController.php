<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pais = 'Argentina';
        $ciudad = 'Ciudad de Buenos Aires';

        $response_actual = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $pais . '&units=metric&lang=sp&appid=626e3e23eedbe0fd9c9cad8a52d6adbb');
        $weathers_actual = $response_actual->json();

        $resultado = $this->getWeather($pais,$ciudad);

        //dump($weathers_actual);
        //dd();

        return view('/weather', compact('resultado','pais','ciudad','weathers_actual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pais = $request->input('pais');
        $ciudad = $request->input('ciudad');

        $response_actual = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $pais . '&units=metric&lang=sp&appid=626e3e23eedbe0fd9c9cad8a52d6adbb');
        $weathers_actual = $response_actual->json();
    
        $resultado = $this->getWeather($pais,$ciudad);

        $transaction = new Transaction();
        $transaction->descripcion = $pais;
        $transaction->save();

        //dump($resultado);
        //dd();

        return view('/weather', compact('resultado','pais','ciudad','weathers_actual'));
    }


    public function getWeather($pais,$ciudad)
    {
        $resultado = [];

        $fechaActual = Carbon::now('America/Argentina/Buenos_Aires')->toDateString();
        $date = Carbon::parse($fechaActual)->locale('es');

        $response = Http::get('api.openweathermap.org/data/2.5/forecast?q=' . $pais . '&units=metric&lang=sp&appid=626e3e23eedbe0fd9c9cad8a52d6adbb');
        $weathers = $response->json();

        $dia1 = substr($date->addDays(1), 0, 10);
        $dia1_nombre = $date->isoFormat('dddd');

        $dia2 = substr($date->addDays(1), 0, 10);
        $dia2_nombre = $date->isoFormat('dddd');

        $dia3 = substr($date->addDays(1), 0, 10);
        $dia3_nombre = $date->isoFormat('dddd');

        $dia4 = substr($date->addDays(1), 0, 10);
        $dia4_nombre = $date->isoFormat('dddd');

        $dia5 = substr($date->addDays(1), 0, 10);
        $dia5_nombre = $date->isoFormat('dddd');

        foreach ($weathers['list'] as $weather) {

            $rest = substr($weather['dt_txt'], 0, 10);

            if ($rest == $dia1) {
                $resultado[$rest]['fecha_nombre'] = $dia1_nombre;
                $resultado[$rest]['fecha'] = $rest;
                $resultado[$rest]['temp'] = $weather['main']['temp'];
                $resultado[$rest]['main'] = $weather['weather'][0]['main'];
                $resultado[$rest]['description'] = $weather['weather'][0]['description'];
                $resultado[$rest]['icon'] = 'http://openweathermap.org/img/wn/' . $weather['weather'][0]['icon'] . '@2x.png';
            }

            if ($rest == $dia2) {
                $resultado[$rest]['fecha_nombre'] = $dia2_nombre;
                $resultado[$rest]['fecha'] = $rest;
                $resultado[$rest]['temp'] = $weather['main']['temp'];
                $resultado[$rest]['main'] = $weather['weather'][0]['main'];
                $resultado[$rest]['description'] = $weather['weather'][0]['description'];
                $resultado[$rest]['icon'] = 'http://openweathermap.org/img/wn/' . $weather['weather'][0]['icon'] . '@2x.png';
            }

            if ($rest == $dia3) {
                $resultado[$rest]['fecha_nombre'] = $dia3_nombre;
                $resultado[$rest]['fecha'] = $rest;
                $resultado[$rest]['temp'] = $weather['main']['temp'];
                $resultado[$rest]['main'] = $weather['weather'][0]['main'];
                $resultado[$rest]['description'] = $weather['weather'][0]['description'];
                $resultado[$rest]['icon'] = 'http://openweathermap.org/img/wn/' . $weather['weather'][0]['icon'] . '@2x.png';
            }

            if ($rest == $dia4) {
                $resultado[$rest]['fecha_nombre'] = $dia4_nombre;
                $resultado[$rest]['fecha'] = $rest;
                $resultado[$rest]['temp'] = $weather['main']['temp'];
                $resultado[$rest]['main'] = $weather['weather'][0]['main'];
                $resultado[$rest]['description'] = $weather['weather'][0]['description'];
                $resultado[$rest]['icon'] = 'http://openweathermap.org/img/wn/' . $weather['weather'][0]['icon'] . '@2x.png';
            }

            if ($rest == $dia5) {
                $resultado[$rest]['fecha_nombre'] = $dia5_nombre;
                $resultado[$rest]['fecha'] = $rest;
                $resultado[$rest]['temp'] = $weather['main']['temp'];
                $resultado[$rest]['main'] = $weather['weather'][0]['main'];
                $resultado[$rest]['description'] = $weather['weather'][0]['description'];
                $resultado[$rest]['icon'] = 'http://openweathermap.org/img/wn/' . $weather['weather'][0]['icon'] . '@2x.png';
            }
        }

        return $resultado;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
