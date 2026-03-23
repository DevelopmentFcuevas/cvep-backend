<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
 * *** Definicion del prefijo '/api' en routes/api.php ***
 * 
 * La palabra 'api' no aparece por arte de magia, sino que 
 * está definida en esta configuración del sistema.
 * 
 * Al definir api: __DIR__.'/../routes/api.php', Laravel hace 
 * dos cosas automáticamente por convención: 
 * 1. Busca todas las rutas dentro del archivo 'routes/api.php'.
 * 2. Les pone el prefijo '/api' a todas esas rutas para diferenciarlas 
 *    de las rutas web normales.
 * 
 * Sería algo así como: "Todo lo que esté en api.php lleva el prefijo '/api'".
 * 
*/
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
