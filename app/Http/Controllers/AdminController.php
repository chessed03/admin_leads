<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.index');
    }

    public function sendForm(Request $request)
    {
        
        $client = new \GuzzleHttp\Client(); 

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 16|H0RDlUbw20daXreZcbzXKmhjInf6amy09DF9fMEw'
        ];

        $options = [
            'multipart' => [
                    [
                    'name' => 'file',
                    'contents' => Psr7\Utils::tryFopen('/home/eduardo/Documentos/00_archivos_test/emails to process.txt', 'r'),
                    'filename' => '/home/eduardo/Documentos/00_archivos_test/emails to process.txt',
                    'headers'  => [
                        'Content-Type' => '<Content-type header>'
                        ]
                    ]
                ]
        ];
        
        $request = new Psr7\Request('POST', 'http://127.0.0.1:8000/api/processDataFile', $headers);
        $res = $client->sendAsync($request, $options)->wait();

    
        dd( json_decode($res->getBody()) );

        return view('admin.index');
        
    }

}
