<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\User;
use DataTables;
use Auth;

class ClientController extends Controller
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
            
            $data=User::latest()->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $btn=' <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Edit" class="donate btn btn-warning btn-sm">Edit</a>
                <a href="javascript:void(0)" data-toggle="tooltip"  id="'.$row->id.'"  data-original-title="Donate" class="donate btn btn-primary btn-sm">Delete</a>';  
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.dashboard.clients.index');
    }

    /**
     * Clients Dropdown List
     * @return \Illuminate\Http\Json Response
     */

     public function clientList()
     {
        $clients = User::latest()->get();
        return response()->json($clients);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.clients.create');

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
            'client_name' => 'required|max:255',
            'email' => 'required|unique:users',
            'client_phone_no' => 'required|max:255'
        ]);
        if($validator->passes())
        {
         $user =  User::create([
            'name' => $request->client_name,
            'email' => $request->email,
            'phone_no' => $request->client_phone_no,
            'password' => bcrypt($request->client_phone_no)
          ]);

          // $accessToken = $user->createToken('authToken')->accessToken;
          
          return response()->json(['user'=>$user,'success'=>'Client Successfully Added']);
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
