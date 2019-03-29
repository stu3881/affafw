<?php

namespace App\Http\Controllers;

use App\Models\MiscThing;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MiscThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *snippet_string
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
      //
        $miscThings=MiscThing::all();
        return view('miscThings.index',compact('miscThings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('miscThings.create');
    }

    public function derive_validation_array()
    {
        //exit ('exit in MiscThing controller derive_validation_array');
       //return view('miscThings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(REQUEST $request) {
        $this->debug_exit(__FILE__,__LINE__,10);
        //var_dump(compact($request->Input['report_name']));
        //echo($request->Input('record_type'));
        //var_dump($request->Input('report_name'));exit("exit at 51");
        //$this->derive_validation_array();
        $this->validate($request, 
        [ 
        'record_type' => 'required',
        'report_name' => 'required',
        ]
        );
        //exit("exit at 58");
        $miscThing=$request->all(); // important!!
        MiscThing::create($miscThing);
        return redirect('miscThings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $miscThing=MiscThing::find($id);
       return view('miscThings.show',compact('miscThing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $miscThing=MiscThing::find($id);
       return view('miscThings.edit',compact('miscThing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       //
        $this->validate($request, 
            [ 
        'record_type' => 'required',
        'report_name' => 'required',
        'report_query' => 'required',
        'bypassed_field_name' => 'required',
        'report_containing_menu' => 'required'
        ]);

        $miscThingUpdate=$request->all(); // important!!
        $miscThing=MiscThing::find($id);
        $miscThings->update($miscThingUpdate);
 
       return redirect('miscThings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(REQUEST $request, $id) {
       MiscThing::find($id)->delete();
       return redirect('miscThings');
    }
}
