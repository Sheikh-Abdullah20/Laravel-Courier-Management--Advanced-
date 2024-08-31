<?php

namespace App\Http\Controllers;



// use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{
    public static function middleware() :array{
        return[
            new Middleware('permission:view reports',['only' => 'index']),
        ];
    }
    public function index(){
      
        return view('reports.index');
    }
}
