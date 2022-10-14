<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Item;
use DataTables;
use Auth;
use Illuminate\Support\Str;

class ItemController extends Controller
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
            
            $data=Item::with('brands')->latest()->get();
            return  DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
               
                $btn="<div class='dropdown custom-dropdown'>
                <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-horizontal'><circle cx='12' cy='12' r='1'></circle><circle cx='19' cy='12' r='1'></circle><circle cx='5' cy='12' r='1'></circle></svg>
                </a>

                <div class='dropdown-menu' aria-labelledby='dropdownMenuLink1'>
                    <a class='dropdown-item' href='". route('items.edit',$row->id)."'>Edit</a>
                    <a class='dropdown-item' href='javascript:void(0);' onClick='removeItem(".$row->id.")'>Delete</a>
                    
                </div>";  
                return $btn;
            })
            ->addColumn('date',function($row2){
                return $row2->created_at->diffForHumans();
            })
            ->rawColumns(['action','date'])
            ->make(true);
        }
        return view('admin.dashboard.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.items.create');
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
            'item_name' => 'required|max:255|unique:items',
            'brand_id' => 'required|max:255',
            'description' => 'required',
            'unit' => 'required',
            
        ],[
            'item_name.unique' => 'Item Name Already Exists'
        ]);
       
        if($validator->passes())
        {
         $item =  Item::create([
            'item_name' => $request->item_name,
            'unit' =>$request->unit,
            'slug'=>Str::slug($request->item_name,"-"),
            'brand_id'=>$request->brand_id,
            'description'=> $request->description
          ]);

          
          return response()->json(['item'=>$item,'success'=>'Item Successfully Added']);
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
