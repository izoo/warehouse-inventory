<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Validator;
use App\Models\User;
use App\Models\Booking;
class BookingController extends Controller
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
            $data= Booking::with(['users','items'])->get();
            return  DataTables::of($data)->addIndexColumn()
            ->addColumn('client_details',function($row){
                $client_details= 'Name : ' . $row->users->name . ' <br>' .
                'Phone : ' . $row->users->phone_no . '<br>' .
                'Email : '   .  $row->users->email ;
                return $client_details;
            })
            ->addColumn('item_details',function($row){
                $item_details=  $row->items->name ;
  
                return $item_details;
            })
            ->addColumn('action',function($row){
                $btn='
                <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Receive" onClick="receiveItem('.$row->id.','.$row->user_id.','.$row->item_id.')" class="receive btn btn-warning btn-sm">Receive</a>';
                return $btn;
            })
            ->rawColumns(['client_details','item_details','action'])
            ->make(true);
        }

        return view('admin.dashboard.appointments.index');

    }
    
    public function clientBookings()
    {
        $user = Auth::guard('user')->user();
        $data= Booking::with(['users','items'])->where('user_id','=',$user->id)->get();
        return  DataTables::of($data)->addIndexColumn()
        ->addColumn('client_details',function($row){
            $client_details= 'Name : ' . $row->users->name . ' <br>' .
            'Phone : ' . $row->users->phone_no . '<br>' .
            'Email : '   .  $row->users->email ;
            return $client_details;
        })
        ->addColumn('item_details',function($row){
            $item_details=  $row->items->name ;

            return $item_details;
        })
        ->addColumn('action',function($row){
            $btn='
            ';
            return $btn;
        })
        ->rawColumns(['client_details','item_details','action'])
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
        if(Auth::guard('user')->user())
        {
            $validator = Validator::make($request->all(),[
                'item' => 'required|max:255',
                'quantity' => 'required|max:255',
                'unit' => 'required|max:255',
                'address' => 'required|max:255',
                'time' => 'required|max:255',
                'date'=>'required|max:255'
                
            ]);
        }
        else
        {

            $validator = Validator::make($request->all(),[
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'phone_no' => 'required|max:255',
                'item' => 'required|max:255',
                'quantity' => 'required|max:255',
                'unit' => 'required|max:255',
                'address' => 'required|max:255',
                'time' => 'required|max:255',
                'date'=>'required|max:255'
            ]);
             
        } 
        
        if($validator->passes())
        {
            if(Auth::guard('user')->user())
            {
                $user = Auth::guard('user')->user();
            }
            else
            {
               $user = User::where('email','=',$request->email)->first();
               if(isset($user->id) && !empty($user->id))
               {
                 $user = User::where('email','=',$request->email)->first();
               }
               else
               {
                    $user =  User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone_no' => $request->phone_no,
                        'password' => bcrypt($request->phone_no)
                    ]);
                    
               }
                 
            } 
         $appointment =  Booking::create([
            'user_id'=>$user->id,
            'item_id'=>$request->item,
            'date_booked'=>$request->date,
            'time_booked'=>$request->time,
            'quantity'=>$request->quantity,
            'location'=> $request->address,
            'units'=> $request->unit,
            'status'=>'NOT ASSIGNED'
          ]);

          
          return response()->json(['appointment'=>$appointment,'success'=>'Appointment Successfully Booked']);
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
