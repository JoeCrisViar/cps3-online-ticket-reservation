<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get('http://localhost:3000/api/movies');

        // Getting the body from $response and convert to PHP ARRAY
        $movies = json_decode($response->getBody());

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->release_time);
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->post('http://localhost:3000/api/movies', [
                'json' => [
                    "title" => $request->title, 
                    "release_date" => $request->release_date
                ]
        ]);

        $movie = json_decode($response->getBody());
        return redirect('/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = new Client();

        $response = $client->get("http://localhost:3000/api/movies/" . $id);

        $movie = json_decode($response->getBody());
        

        $client2 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response2 = $client2->get("http://localhost:3000/api/theatres");

        // Getting the body from $response and convert to PHP ARRAY
        $theatres = json_decode($response2->getBody());

        return view('movies.show', compact('movie', 'theatres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get("http://localhost:3000/api/movies/" . $id);

        // Getting the body from $response and convert to PHP ARRAY
        $movie = json_decode($response->getBody());


        $client2 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response2 = $client2->get("http://localhost:3000/api/theatres");

        // Getting the body from $response and convert to PHP ARRAY
        $theatres = json_decode($response2->getBody());

        // dd($movie);
        return view('movies.edit', compact('movie', 'theatres'));
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
        $client = new Client();
     
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->put("http://localhost:3000/api/movies/" . $id, [
                'json' => [
                    "title" => $request->title, 
                    "release_date" => $request->release_date
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);
        
        
        // $user = json_decode($response->getBody());
        return redirect()->route('movies.index')->with('success', 'User is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->delete("http://localhost:3000/api/movies/" . $id, [
            'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        return redirect()->route('movies.index')->with('success', 'Movies has been deleted');
    }
}
