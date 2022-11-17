<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Warehouse;
use App\Models\WarehouseAssignment;
use App\Models\Booking;
use App\Models\Charge;
use DataTables;
use Auth;

class WarehouseAssignmentController extends Controller
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
            
            $data=WarehouseAssignment::with(['users','bookings','items','warehouses'])
            ->where('is_checked_out','=',0)
            ->latest()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('client_details',function($row){
                $client_details= 'Name : ' . $row->users->name . ' <br>' .
                'Phone : ' . $row->users->phone_no . '<br>' .
                'Email : '   .  $row->users->email ;
                return $client_details;
            })
            ->addColumn('item_details',function($row){
                $item_details=  $row->items->item_name ;
  
                return $item_details;
            })
            ->addColumn('warehouse_details',function($row){
                $warehouse_details=  $row->warehouses->name ;
  
                return $warehouse_details;
            })
            ->addColumn('bookings_details',function($row){
                $client_details= 'Quantity : ' . $row->bookings->quantity . ' <br>' .
                'Unit : ' . $row->bookings->units . '<br>';
                return $client_details;
            })
            ->addColumn('action',function($row){
                $btn=" <a href='javascript:void(0)' class='edit btn btn-warning btn-sm'>Edit</a>
                <a href='javascript:void(0)' onClick='removeWarehouse(".$row->id.")' class='delete btn btn-danger btn-sm'>Remove</a>";  
                return $btn;
            })
            ->rawColumns(['client_details','item_details','warehouse_details','bookings_details','action'])
            ->make(true);
        }
        return view('admin.dashboard.checkins.index');
    }


    public function clientCheckIns()
    {
        $user = Auth::guard('user')->user();
        $data=WarehouseAssignment::with(['users','bookings','items','warehouses'])
        ->where('is_checked_out','=',0)
        ->where('user_id','=',$user->id)
        ->latest()->get();
        return DataTables::of($data)->addIndexColumn()
        ->addColumn('client_details',function($row){
            $client_details= 'Name : ' . $row->users->name . ' <br>' .
            'Phone : ' . $row->users->phone_no . '<br>' .
            'Email : '   .  $row->users->email ;
            return $client_details;
        })
        ->addColumn('item_details',function($row){
            $item_details=  $row->items->item_name ;

            return $item_details;
        })
        ->addColumn('warehouse_details',function($row){
            $warehouse_details=  $row->warehouses->name ;

            return $warehouse_details;
        })
        ->addColumn('bookings_details',function($row){
            $client_details= 'Quantity : ' . $row->bookings->quantity . ' <br>' .
            'Unit : ' . $row->bookings->units . '<br>';
            return $client_details;
        })
        ->addColumn('action',function($row){
            $btn="
            <a href='javascript:void(0)' onClick='makePayment(".$row->id.",".$row->total_charge.")' class='delete btn btn-primary btn-sm'>Make Payment</a>";  
            return $btn;
        })
        ->rawColumns(['client_details','item_details','warehouse_details','bookings_details','action'])
        ->make(true);
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
        $validator = Validator::make($request->all(),[
            'warehouse_id' => 'required|max:255',
            'charge_plan' => 'required|max:255',
            'check_in_date' => 'required',
            'check_out_date' => 'required|max:255'
        ]);
        if($validator->passes())
        {
            $booking = Booking::find($request->hidden_booking_id);
            $charge = Charge::where('charge_plan',$request->charge_plan)
            ->where('unit',$booking->units)->first();
            $check_in_date = $request->check_in_date;
            $check_out_date = $request->check_out_date;
            $diff = strtotime($check_in_date) - strtotime($check_out_date);
            $diff_days = abs(round($diff / 86400));
            // return $booking;
            $total_charge= $charge->cost_charge * $diff_days;
            $warehouse =  WarehouseAssignment::create([
            'booking_id' => $request->hidden_booking_id,
            'warehouse_id' => $request->warehouse_id,
            'user_id' => $request->hidden_user_id,
            'item_id' => $request->hidden_item_id,
            'charge_plan' => $request->charge_plan,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_charge' => $total_charge,
            'no_days' => $diff_days,
            'is_checked_out'=>0
          ]);
           
          // $accessToken = $user->createToken('authToken')->accessToken;
          
          return response()->json(['warehouse'=>$warehouse,'success'=>'Item Successfully Received']);
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
