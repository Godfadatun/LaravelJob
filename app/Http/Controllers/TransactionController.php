<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Transaction;
use App\User;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction = Transaction::with('user')->get();
        return response()->json([
            'message'=> 'success',
            'status' => 'success',
            'data'=> $transaction
        ]);
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
        Balance::where('user_id', $request->id)-> decrement('amount',$request->amount);
        Balance::where('account_nr', $request->account_nr)->  increment('amount',$request->amount);
        $balance = Balance::where('user_id', $request->id)->first();

        $transaction = new Transaction;
        $transaction->user_id = $request->id;
        $transaction->before = ($balance->amount + $request->amount);
        $transaction->account_nr = $request->account_nr;
        $transaction->amount = $request->amount;
        $transaction->after = $balance->amount;
        $transaction->save();

        return response()->json([
            'message'=> 'success',
            'status' => 'success',
            'data'=> $transaction
        ]);

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
        // $balance = Balance::first();
        // $balance->amount = $balance->amount + $request->amount;
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
