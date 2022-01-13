<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Reviews::all()->toArray();
        return array_reverse($data);
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
        $request->validate([
            'item_id' => 'required|integer|min:1|exists:items,id',
            'score' => 'required|integer|min:1|max:10',
            'comment' => 'max:255',
        ]);
        
        $data = new Reviews([
            'item_id' => $request->item_id,
            'score' => $request->score,
            'comment' => $request->comment,
            'created_user_id' => Auth::id()
        ]);
        $data->save();

        return response()->json('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Reviews::find($id);
        return response()->json($data);
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
        $request->validate([
            'item_id' => 'filled|integer|min:1|exists:items,id',
            'score' => 'filled|integer|min:1|max:10',
            'comment' => 'max:255',
        ]);
        
        $data = Reviews::find($id);
        $data->update($request->all());
        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Reviews::find($id);
        $data->delete();
        return response()->json('Success');
    }
}
