<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Warehouse;
use DataTables;
use Auth;

class WarehouseController extends Controller
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
            
            $data=Warehouse::latest()->get();
            return DataTables::of($data)->addIndexColumn()
            
            ->addColumn('action',function($row){
                $btn=" <a href='". route('warehouses.edit',$row->id)."' class='edit btn btn-warning btn-sm'>Edit</a>
                <a href='javascript:void(0)' onClick='removeWarehouse(".$row->id.")' class='delete btn btn-danger btn-sm'>Remove</a>";  
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.dashboard.warehouses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.warehouses.create');
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
        //
        $validator = Validator::make($request->all(),[
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|',
            'description' => 'required|max:255'
        ]);
        if($validator->passes())
        {
         $warehouse =  Warehouse::create([
            'user_id' => 1,
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description
          ]);

          // $accessToken = $user->createToken('authToken')->accessToken;
          
          return response()->json(['warehouse'=>$warehouse,'success'=>'Warehouse Successfully Added']);
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
