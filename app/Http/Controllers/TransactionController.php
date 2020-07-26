<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Transaction;
// use App\User;

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
        //
        $transaction = new Transaction;
        $balance = Balance::first();
        $transaction->user_id = auth()->user()->id;
        $transaction->before = $balance->amount;
        $transaction->account_nr = $balance->account_nr;
        $transaction->amount = $request->amount;
        $transaction->after = $balance->amount + $request->amount;
        $balance->amount = $transaction->after;

        $transaction->save();
        $balance->save();


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
