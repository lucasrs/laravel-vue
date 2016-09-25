<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BillPay;
use App\Events\BillPayCreated;

class BillPaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bill = BillPay::paginate(10)->toArray();
        return $bill;
        // return BillPay::all()->toArray();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $billPay = BillPay::create($request->all());
        // broadcast(new BillPayCreated($billPay));
        return response()->json($billPay,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BillPay $bill_pay)
    {
        return $bill_pay;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillPay $bill_pay)
    {
        $bill_pay->fill($request->all());
        $bill_pay->save();
        return response()->json($bill_pay);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillPay $bill_pay)
    {
        $bill_pay->delete();
        return response()->json([],204);
    }
}
