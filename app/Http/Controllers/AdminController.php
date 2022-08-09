<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request as ClientRequest;
use \GuzzleHttp\Client as ClientHTTP;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Psr7;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.index');
    }

    public function indexTwo()
    {
        return view('admin.index_two');
    }

    public function sendForm(Request $request)
    {
        
        $client        = new ClientHTTP(); // or \GuzzleHttp\Client();

        $api_url       = 'http://127.0.0.1:8000/api/processDataFile';

        $location_file = '/home/eduardo/Documentos/00_archivos_test/emails to process.txt';

        $source_file   = Utils::tryFopen( $location_file, 'r');

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer 16|H0RDlUbw20daXreZcbzXKmhjInf6amy09DF9fMEw'
        ];

        $options = [
            'multipart' => [
                    [
                    'name' => 'file',
                    'contents' => $source_file,
                    'filename' => $location_file,
                    'headers'  => [
                        'Content-Type' => '<Content-type header>'
                        ]
                    ]
                ]
        ];
        
        $request = new ClientRequest('POST', $api_url, $headers);

        $res = $client->sendAsync($request, $options)->wait();

    
        dd( json_decode($res->getBody()) );

        return view('admin.index');
        
    }

}
