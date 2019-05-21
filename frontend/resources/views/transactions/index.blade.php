@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <!-- Display Errors -->
        @include('includes.messages')
    </div>
</div>
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="row">
            <div class="col-lg-2">
                <h2>Transactions</h2>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Purchase Date</th>
                      <th scope="col">Buyer</th>
                      <th scope="col">Branch</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $index => $transaction)
                    <tr>
                        <th scope="row">{{ ++$index }}</th>
                        <td>
                        	@php 
                        		$time = strtotime($transaction->created_at);

								$date = date('m-d-Y',$time);

								echo $date;
                        	@endphp
                        </td>
                        <td>{{ $transaction->buyer_name }}</td>
                        <td>{{ $transaction->branch }}</td>
                     
                    </tr>
                   @empty

					<tr>
						<td colspan="5" class="text-center">No transaction to show!</td>
					</tr>
                   @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



