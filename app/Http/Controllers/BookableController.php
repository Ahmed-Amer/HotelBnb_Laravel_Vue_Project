<?php

namespace App\Http\Controllers;

use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bookable::all();
    }

    /**
     * Display all boookables for datatables plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardBookables()
    {
        $bookables =  Bookable::all();
         return datatables($bookables)->toJson();
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
            'title' => 'required|min:2',
            'description' => 'required|min:20',
            'price' => 'required|numeric',
        ]);

        $bookable = new Bookable();
        $bookable->title = $request->title;
        $bookable->description = $request->description;
        $bookable->price = $request->price;
        $bookable->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Bookable::findOrFail($id);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookable =  Bookable::findOrFail($id);
        $bookable->delete();

        $bookables =  Bookable::all();
        return datatables($bookables)->toJson();
    }
}
