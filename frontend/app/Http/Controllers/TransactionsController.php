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


class TransactionsController extends Controller
{
    public function index(){

         // Selected Movie Details (_id, title, release_date, subdoc[ theatres ids])
        $client = new Client();

        $response = $client->get("http://localhost:3000/api/transactions");

            $transactions = json_decode($response->getBody());

        return view('transactions.index', compact('transactions'));
    }


    public function save(Request $request){
    	// dd($request);
	   $transaction_code = $this->generate_transaction_code();
        // dd($transaction_code);

        $screen_date = $request->screen_date;
    	
        $screen_time = $request->screen_time;
    	
        $ticket_quantity = count($request->seats);

        $online_fee = $request->online_fee;

    	$payment_type = $request->payment_type;

        // Selected Movie Details (_id, title, release_date, subdoc[ theatres ids])
        $client1 = new Client();

        $response1 = $client1->get("http://localhost:3000/api/movies/" . $request->movie_id);

            $movie = json_decode($response1->getBody());


        // Selected Screen Details (_id, screen_type, price)
        $client2 = new Client();

        $response2 = $client2->get("http://localhost:3000/api/theatres/" . $request->theatre_id . "/screen/" . $request->screen_id);

            $screen = json_decode($response2->getBody());


        // Selected Theatre Details (_id, branch, location, subdocs[screens, schedules , seats])
        $client3 = new Client();

        $response3 = $client3->get("http://localhost:3000/api/theatres/" . $request->theatre_id);

            $theatre = json_decode($response3->getBody());

        /* SAVE TRANSACTION*/
        $client4 = new Client();

        $response4 = $client4->post("http://localhost:3000/api/transactions", [
                'json' => [
                    "transaction_code" => $transaction_code,
                    "buyer_id" => Session::get('user')->_id,
                    "buyer_name" => Session::get('user')->firstname . " " . Session::get('user')->lastname,
                    "theatre_id" => $theatre->_id,
                    "branch" => $request->branch,
                    "screen_id" => $screen->_id,
                    "movie_id" => $movie->_id,
                    "release_date" => $request->release_date,
                    "movie_title" => $movie->title,
                    "screen_type" => $request->screen_type,
                    "screening_date" => $request->screen_date,
                    "screening_time" => $request->screen_time,
                    "online_fee" => $request->online_fee,
                    "no_of_seats" => $ticket_quantity,
                    "payment_type" => $request->payment_type

                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

            $transaction = json_decode($response4->getBody());
            
            $quantity = $transaction->no_of_seats - 1;
            
            /* Generate ticket and enter to database*/
            $this->generate_ticket($quantity, $transaction->_id, $transaction->movie_title, $request->seats, $theatre);

            // dump($transaction);
            //     dump($theatre);
            //     dump($movie);
            //     dump($screen);
    
        return redirect()->route('success')->with('success', "Transaction success. Thank you for choosing us.");
    }

    private function generate_ticket($quantity, $transaction_id, $title, $seats, $theatre)
    {
        $counter = 0;

        do
        {
            $token = $this->getToken(3, $counter);
            $code = preg_replace('/\s+/', '', $title) . $token . substr(strftime("%Y", time()),2) . uniqid() . $counter;


            /* Saving Seats into transaction*/
            $client5 = new Client();

            //Inser seats API 
            $response5 = $client5->post("http://localhost:3000/api/transactions/" . $transaction_id . "/seat", [
                'json' => [
                        "seat_id" => $seats[$counter],
                        "ticket" => strtoupper($code)
                    ],
                    'headers' =>[
                        "x-auth-token" => Session::get('token')
                    ]
            ]);



            /*Updating Seat Status*/
            $client6 = new Client();

            $response6 = $client6->put("http://localhost:3000/api/theatres/" . $theatre->_id . "/seat/" . $seats[$counter], [
                 'json' => [
                        "status" => false
                    ],
                    'headers' =>[
                        "x-auth-token" => Session::get('token')
                    ]
            ]);

            $counter++;
            // return $code;  
        }
        while($counter <= $quantity);

           
    }

    private function getToken($length, $seed)
    {    
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);      // Call once. Good since $application_id is unique.

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }

    private function generate_transaction_code(){

        $transaction_code = '';
        while($transaction_code == '')
        {
            $random_string = date('ymd') . uniqid();

            $client = new Client();

            $response = $client->get("http://localhost:3000/api/transactions");

                $transactions = json_decode($response->getBody());
                
            // dd($transactions);
            foreach ($transactions as $key => $transaction) {
                if($transaction->transaction_code ==  $random_string){
                    
                    $random_string = date('ymd') . uniqid();
                }
            }

            $transaction_code = $random_string;
        }

        return $transaction_code; 
    }


    public function success(){

        return view('success');
    }
}
