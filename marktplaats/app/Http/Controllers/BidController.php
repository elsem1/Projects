<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;




class BidController extends Controller
{
    public function store(Request $request, Ad $ad)
    {
        
        request()->validate([
            'bid' => ['required', 'min:1', 'numeric']
        ]);
        
        $bid = new Bid();
        $bid->ad_id = $ad->id;
        $bid->user_id = Auth::id();
        $bid->bid = request('bid');
        $bid->save();

        return redirect()->route('ads.show',$ad->id)->with('success',"Comment posted successfully!");



    }
}
