<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Charge;
use DataTables;
use Auth;

class ChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            
            $data=Charge::latest()->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $btn=' <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Edit" class="donate btn btn-warning btn-sm">Edit</a>
                <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Donate" class="donate btn btn-primary btn-sm">Delete</a>';  
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.dashboard.charges.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.charges.create');

    }

     /**
     * Dropdown Warehouse List 
     */

    public function chargesList()
    {
       $charges=Charge::latest()->get();
       return response()->json($charges);
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
        $validator = Validator::make($request->all(),[
            'unit' => 'required|max:255',
            'charge_plan' => 'required',
            'cost_charge' => 'required|max:255'
        ]);
        if($validator->passes())
        {
         $charge =  Charge::create([
            'unit' => $request->unit,
            'charge_plan' => $request->charge_plan,
            'cost_charge' => $request->cost_charge,
          ]);

          // $accessToken = $charge->createToken('authToken')->accessToken;
          
          return response()->json(['charge'=>$charge,'success'=>'Charge Plan Successfully Added']);
        }
        else {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
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
