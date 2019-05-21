<?php
namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;

class UsersController extends Controller
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
        $response = $client->get('http://localhost:3000/api/users');

        // Getting the body from $response and convert to PHP ARRAY
        $users = json_decode($response->getBody());

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->post('http://localhost:3000/api/users', [
                'json' => [
                    "firstname" => $request->firstname,
                    "lastname" => $request->lastname,
                    "email" => $request->email,
                    "password" => $request->password
                ]
        ]);

        $user = json_decode($response->getBody());

         if(session()->has('user')){
            if(session('user')->isAdmin == true){
                return redirect()->route('users.index')->with('success', 'User added successfully!');                
            }
         }
                  

        return redirect('login')->with('success', 'Registered success! Please login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $response = $client->get("http://localhost:3000/api/users/" . $id);

        // Getting the body from $response and convert to PHP ARRAY
        $user = json_decode($response->getBody());

        // dd($user->name);
        return view('users.edit', compact('user'));
    }

    public function edit_password($id)
    {
        // Making a client request by creating new instance of client
        $client = new Client();
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        $response = $client->get("http://localhost:3000/api/users/" . $id);

        // Getting the body from $response and convert to PHP ARRAY
        $user = json_decode($response->getBody());

        // dd($user->name);
        return view('auth.change_password', compact('user'));
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
        
        $response = $client->get("http://localhost:3000/api/users/" . $id);

            $user = json_decode($response->getBody());

        $stack = HandlerStack::create();
        
        $stack->push(GuzzleRetryMiddleware::factory());

        $client = new Client([$stack]);
     
        // 1st param is the API route, 2nd param where we attached the body PHP ARRAY format
        if(!isset($request->old_password)){
            $response = $client->put("http://localhost:3000/api/users/" . $id, [
                    'json' => [
                        "firstname" => $request->firstname,
                        "lastname" => $request->lastname, 
                        "email" => $request->email
                    ],

                    'headers' =>[
                        "x-auth-token" => Session::get('token')
                    ]
            ]);

            $user = json_decode($response->getBody());

            return redirect()->route('users.index')->with('success', 'User is updated');
        }else{
             $response = $client->put("http://localhost:3000/api/users/" . $id . "/change_password", [
                'json' => [
                    "email" => $user->email,
                    "oldPassword" => $request->old_password,
                    "newPassword" => $request->new_password
                ],

                'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
            ]);
            
            Session::flush();
            // $user = json_decode($response->getBody());
            return redirect()->route('login')->with('success', 'Password changed. Please login!');
        }

        
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
        $response = $client->delete("http://localhost:3000/api/users/" . $id, [
            'headers' =>[
                    "x-auth-token" => Session::get('token')
                ]
        ]);

        return redirect('/users');
    }

    public function myaccount()
    {
        $client = new Client();

        $response = $client->get("http://localhost:3000/api/transactions/" . session('user')->_id);

            $transactions = json_decode($response->getBody());

            // dd($transactions);
        return view('users.myaccount', compact('transactions'));
    }
}
