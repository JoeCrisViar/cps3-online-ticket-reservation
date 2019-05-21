<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;
use DateTime;
use DateInterval;
use DatePeriod;

class TheatresController extends Controller
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
        $response = $client->get('http://localhost:3000/api/theatres');

        // Getting the body from $response and convert to PHP ARRAY
        $theatres = json_decode($response->getBody());
        // dd($theatres);
        return view('theatres.index', compact('theatres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creating new instance of client
        $client = new Client();
        // Making a client request of movie list
        $response = $client->get('http://localhost:3000/api/movies');

        // Getting the body from $response and convert to PHP ARRAY
        $movies = json_decode($response->getBody());

        return view('theatres.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->movie);
        // $showdates = json_encode($request->showdates);
        // Making a client request by creating new instance of client
        $client1 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response1 = $client1->post('http://localhost:3000/api/theatres', [
                'json' => [ 
                    "branch" => $request->branch,
                    "location" => $request->location
                ]
        ]);

        $theatre = json_decode($response1->getBody());
        
        //Insert no. seats as per user input ($request->seat_count)
        for($i = 1; $i <= $request->seat_count; $i++){
            $client2 = new Client();

            //Inser seats API 
            $response2 = $client2->post("http://localhost:3000/api/theatres/" . $theatre->_id . "/seat", [
                'json' => [
                        "position" => $i,
                        "status" => true
                    ],
                    'headers' =>[
                        "x-auth-token" => Session::get('token')
                    ]
            ]);
        }

        return redirect()->route('theatres.index')->with('success', "Branch has been added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  Creating new instance of client
        $client1 = new Client();

        //Making a client request of a theatre
        $response = $client1->get("http://localhost:3000/api/theatres/" . $id);

        // Getting the body from $response and convert to PHP ARRAY
        $theatre = json_decode($response->getBody());

        // Creating new instance of client
        $client2 = new Client();
        // Making a client request of movie list
        $response = $client2->get('http://localhost:3000/api/movies');

        // Getting the body from $response and convert to PHP ARRAY
        $movies = json_decode($response->getBody());


        // dd($theatre->_id);
        return view('theatres.show', compact('theatre', 'movies'));
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
        $response = $client->get("http://localhost:3000/api/theatres/" . $id);

        // Getting the body from $response and convert to PHP ARRAY
        $theatre = json_decode($response->getBody());

        // dd($user->name);
        return view('theatres.edit', compact('theatre'));
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
        // Making a client request by creating new instance of client
        $client = new Client();

        $response = $client->put("http://localhost:3000/api/theatres/" . $id, [
            'json' => [
                    "branch" => $request->branch,
                    "location" => $request->location
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);
        
        // $theatre = json_decode($response->getBody());
        return redirect()->route('theatres.index')->with('success', 'branch has been edited');
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
        $response = $client->delete("http://localhost:3000/api/theatres/" . $id, [
            'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        return redirect()->route('theatres.index')->with('success', 'Cinema has been deleted');
    }



/*------------------------SCREENS-----------------------*/

    public function index_screen($theatre_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get('http://localhost:3000/api/theatres/' . $theatre_id . '/screen');

        // Getting the body from $response and convert to PHP ARRAY
        $screens = json_decode($response->getBody());

        $client2 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client2->get('http://localhost:3000/api/theatres/' . $theatre_id);        
  
        $theatre = json_decode($response->getBody());

        return view('theatres.screen.index', compact('screens', 'theatre'));
    }

    // Create Screen
    public function create_screen($theatre_id)
    {

        $client = new Client();

        $response = $client->get("http://localhost:3000/api/theatres/" . $theatre_id);
        
        $theatre = json_decode($response->getBody());

        return view('theatres.screen.create', compact('theatre'));
    }

    // Store Screen
    public function store_screen(Request $request, $theatre_id){
        // Making a client request by creating new instance of client
        $client = new Client();

        $response = $client->post("http://localhost:3000/api/theatres/" . $theatre_id . "/screen", [
            'json' => [
                    "screen_type" => $request->screen_type,
                    "price" => $request->price
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);
        
        // $theatre = json_decode($response->getBody());
        return redirect()->route('screen.index', $theatre_id)->with('success', 'New screen has been added');
    }

    // Edit Screen
    public function edit_screen($theatre_id, $screen_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get("http://localhost:3000/api/theatres/" . $theatre_id);

        // Getting the body from $response and convert to PHP ARRAY
        $theatre = json_decode($response->getBody());

        // dd($theatre->branches);
        foreach ($theatre->screens as $key => $screen) {
            if ($screen->_id == $screen_id) {
                return view('theatres.screen.edit', compact('screen', 'theatre'));
            }
        }

    }

    // Update Screen
    public function update_screen(Request $request, $theatre_id, $screen_id)
    {
        // / Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->put("http://localhost:3000/api/theatres/" . $theatre_id . "/screen/" . $screen_id, [
             'json' => [
                    "screen_type" => $request->screen_type,
                    "price" => $request->price
                ],

             'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

         return redirect()->route('screen.index', $theatre_id)->with('success', 'Screen has been edited');
    }

    // Delete Screen
    public function delete_screen($theatre_id, $screen_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->delete("http://localhost:3000/api/theatres/" . $theatre_id . "/screen/" . $screen_id, [
             'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        // Getting the body from $response and convert to PHP ARRAY
        $theatre = json_decode($response->getBody());
        return redirect()->route('screen.index', $theatre_id)->with('success', 'Screen has been deleted');
        
    }


    /*------------------------SCHEDULES-----------------------*/

    public function index_schedule($theatre_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response1 = $client->get('http://localhost:3000/api/theatres/' . $theatre_id . '/schedule');

        // Getting the body from $response and convert to PHP ARRAY
            $schedules = json_decode($response1->getBody());

        $client2 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response2 = $client2->get('http://localhost:3000/api/theatres/' . $theatre_id);        
  
            $theatre = json_decode($response2->getBody());
  
        $client3 = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response3 = $client3->get('http://localhost:3000/api/movies');

            $movies = json_decode($response3->getBody());

        return view('theatres.schedule.index', compact('schedules', 'theatre', 'movies'));
    }

    // Create Schedules
    public function create_schedule($theatre_id, $movie_id)
    {
        // dd($movie_id);

        $client1 = new Client();

        $response1 = $client1->get("http://localhost:3000/api/theatres/" . $theatre_id);
        
            $theatre = json_decode($response1->getBody());

        $client2 = new Client();

        $response2 = $client2->get("http://localhost:3000/api/movies");
        
            $movies = json_decode($response2->getBody());

        if($movie_id == 1){
        
            return view('theatres.schedule.create', compact('theatre', 'movies'));

        }else{
            $client3 = new Client();

            $response3 = $client3->get("http://localhost:3000/api/movies/" . $movie_id);
            
                $movie = json_decode($response3->getBody());
            
            return view('theatres.schedule.create', compact('theatre', 'movies', 'movie'));
        }    
    }

    // Store Schedules
    public function store_schedule(Request $request, $theatre_id){
        
        $dateTime = new DateTime($request->endDate);
        
        $date = $dateTime->format('n/j/Y');
        
        $time = $dateTime->format('H:i');

        $client = new Client();

        $response = $client->post("http://localhost:3000/api/theatres/" . $theatre_id . "/schedule", [
            'json' => [
                    "movie_id" => $request->movie_id,
                    "startdate" => $request->startDate,
                    "enddate" => $date,
                    "times" => $time,
                    "status" => $request->status
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        $client3 = new Client();

        $response3 = $client3->post("http://localhost:3000/api/movies/" . $request->movie_id . "/theatre", [
            'json' => [
                    "theatre_id" => $theatre_id
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);
        
        // $theatre = json_decode($response->getBody());
        return redirect()->route('schedule.index', $theatre_id)->with('success', 'Schedule has been added');
    }

    // Delete Schedules
    public function delete_schedule($theatre_id, $schedule_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->delete("http://localhost:3000/api/theatres/" . $theatre_id . "/schedule/" . $schedule_id, [
             'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        // Getting the body from $response and convert to PHP ARRAY
        $theatre = json_decode($response->getBody());
        return redirect()->route('schedule.index', $theatre_id)->with('success', 'Schedule has been deleted');
        
    }

    /*------------------------SEATSS-----------------------*/

    public function index_seat($theatre_id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get('http://localhost:3000/api/theatres/' . $theatre_id . '/seat');

        // Getting the body from $response and convert to PHP ARRAY
        $seats = json_decode($response->getBody());
  
        return view('theatres.seat.index', compact('seats'));
    }

}
