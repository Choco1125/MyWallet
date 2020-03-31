<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\Wallet;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function add(Request $request){

            $wallet = Wallet::find($request->wallet_id);
            $wallet->money = $wallet->money + $request->amount;
            $wallet->update();

            $transfer = new Transfer;
            $transfer->description = $request->description;
            $transfer->amount = $request->amount;
            $transfer->wallet_id = $request->wallet_id;

            $transfer->save();  
            return response()->json([
                'id' => $transfer->id,
                'description' => $request->description,
                'amount' => $transfer->amount,
                'wallet_id' => $transfer->wallet_id
            ],201);
    }
}
