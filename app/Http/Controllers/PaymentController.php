<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Repair;
use App\Models\IssueRepair;
use App\Models\ProductRepair;
use App\Models\Product;
use App\Models\Device;
use App\Models\Admin;
use App\Models\Payment;
use DataTables;
use Auth;

class PaymentController extends Controller
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
        $data = Payment::with(['repairs','repairs.devices','repairs.users'])->get();
        return  DataTables::of($data)->addIndexColumn()
        ->addColumn('client_details',function($row){
            $client_details= 'Name : ' . $row->repairs[0]->users[0]['name'] . ' <br>' .
            'Phone : ' . $row->repairs[0]->users[0]['phone_no'] . '<br>' .
            'Email : '   .  $row->repairs[0]->users[0]['email'] ;
            return $client_details;
        })
        ->addColumn('device_details',function($row){
            $device_details= 'Device No : ' . $row->repairs[0]->devices[0]['device_serial_no'] . ' <br>' .
            'Model : ' . $row->repairs[0]->devices[0]['model'] . '<br>' .
            'Brand : '   .  $row->repairs[0]->devices[0]['brand'] ;
            return $device_details;
        })
        ->addColumn('action',function($row){
            $btn='
            <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Remove" class="remove-repair btn btn-danger btn-sm"><i class="far fa fa-trash-alt"></i>Delete</a>';  
            return $btn;
        })
        ->rawColumns(['client_details','device_details','action'])
        ->make(true);
       }
       return view('admin.dashboard.payments.index');
    }
    
    public function clientPaymentList(Request $request)
    {
    //
        
      
       if($request->ajax())
       {
        $data = Payment::with(['repairs','devices'])
        ->whereHas('devices',function($query){
            $user = Auth::guard('user')->user();
            $query->where('user_id','=',$user->id);
        })->get();
        return  DataTables::of($data)->addIndexColumn()
        ->addColumn('device_details',function($row){
            $device_details= 'Device No : ' . $row->repairs[0]->devices[0]['device_serial_no'] . ' <br>' .
            'Model : ' . $row->repairs[0]->devices[0]['model'] . '<br>' .
            'Brand : '   .  $row->repairs[0]->devices[0]['brand'] ;
            return $device_details;
        })
        
        ->rawColumns(['device_details'])
        ->make(true);
       }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.payments.create');

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
            'amount_paid' =>'required|max:255',
            'mode_payment' =>'required|max:255',
        ]);
        if($validator->passes())
        {
            $amount_due = $request->amount_due;
            $amount_paid = $request->amount_paid;
            $balance = $amount_due - $amount_paid;
            $hidden_payment_issue_id = explode(',',$request->hidden_payment_issue_id);
            $hidden_payment_spare_id = explode(',',$request->hidden_payment_spare_id);
            $payment = Payment::create([
                'repair_id'=> $request->hidden_payment_repair_id,
                'amount_paid'=> $request->amount_paid,
                'balance'=>$balance,
                'mode_payment'=>$request->mode_payment,
                'mpesa_code'=>$request->mpesa_code,
                'payment_description'=>$request->payment_description,
                'payment_status' => "Approved"
            ]);

            if($payment)
            {
               if($balance==0)
               {
                    $update_data = array(
                        "payment_status" => "PAID"
                    );
               }
               else if($balance>0)
               {
                $update_data = array(
                    "payment_status" => "PARTIALLY"
                );
               }
               if(!empty($hidden_payment_issue_id))
               {
                
                  for($i=0; $i< count($hidden_payment_issue_id);$i++)
                  {
                     IssueRepair::where('id','=',$hidden_payment_issue_id[$i])->update($update_data);
                  }
               }
               if(!empty($hidden_payment_spare_id))
               {
                 for($i=0; $i< count($hidden_payment_spare_id);$i++)
                 {
                    ProductRepair::where('id','=',$hidden_payment_spare_id[$i])->update($update_data);
                 }
               }
               return response()->json(['success'=>'Payment Successfully Added']);

            }

        }
        else {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }

    /**
     * Add Client Payment
     */
    public function clientPayment(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'amount_paid' =>'required|max:255',
            'mpesa_code' =>'required|max:255',
        ]);
        if($validator->passes())
        {
            $amount_due = $request->amount_due;
            $amount_paid = $request->amount_paid;
            $balance = $amount_due - $amount_paid;
            $hidden_payment_issue_id = explode(',',$request->hidden_payment_issue_id);
            $hidden_payment_spare_id = explode(',',$request->hidden_payment_spare_id);
            $payment = Payment::create([
                'repair_id'=> $request->hidden_payment_repair_id,
                'amount_paid'=> $request->amount_paid,
                'balance'=>$balance,
                'mode_payment'=>"MPESA",
                'mpesa_code'=>$request->mpesa_code,
                'payment_description'=>"Payment Via MPESA",
                'payment_status' => "Pending"
            ]);

            if($payment)
            {
               if($balance==0)
               {
                    $update_data = array(
                        "payment_status" => "PAID"
                    );
               }
               else if($balance>0)
               {
                $update_data = array(
                    "payment_status" => "PARTIALLY"
                );
               }
               if(!empty($hidden_payment_issue_id))
               {
                
                  for($i=0; $i< count($hidden_payment_issue_id);$i++)
                  {
                     IssueRepair::where('id','=',$hidden_payment_issue_id[$i])->update($update_data);
                  }
               }
               if(!empty($hidden_payment_spare_id))
               {
                 for($i=0; $i< count($hidden_payment_spare_id);$i++)
                 {
                    ProductRepair::where('id','=',$hidden_payment_spare_id[$i])->update($update_data);
                 }
               }
               return response()->json(['success'=>'Payment Successfully Added']);

            }

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