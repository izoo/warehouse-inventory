<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Brand;
use DataTables;
use Auth;
use Illuminate\Support\Str;
class BrandController extends Controller
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
            
            $data=Brand::latest()->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action',function($row){
                $btn="
                <a href='". route('brands.edit',$row->id)."' data-toggle='tooltip' data-placement='top' title='Edit'>
                <svg xmlns='http://www.w3.org/2000/svg' 
                width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' 
                stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'>
                <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                </a>
                <a href='javascript:void(0)' onClick='removeBrand(".$row->id.")' data-toggle='tooltip' data-placement='top' title='Delete'>
                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'>
                <polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'>
                </path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>

                </a>";  
                return $btn;
            })
            ->addColumn('date',function($row2){
                return $row2->created_at->diffForHumans();
            })
            ->rawColumns(['action','date'])
            ->make(true);
        }
        return view('admin.dashboard.brands.index');
    }

    /**
     * Dropdown Brands List 
     */

    public function brandList()
    {
       $brands=Brand::latest()->get();
       return response()->json($brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dashboard.brands.create');

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
            'name' => 'required|max:255|unique:brands'
        ]);
        if($validator->passes())
        {
         $brand =  Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,"-"),
            'category_id' => $request->category_id,
          ]);

          // $accessToken = $brand->createToken('authToken')->accessToken;
          
          return response()->json(['brand'=>$brand,'success'=>'Brand Successfully Added']);
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
        $brand = Brand::findOrFail($id);
        return view('admin.dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'brand_name' => 'required|max:255'
        ]);
        if($validator->passes())
        {
         $brand =  Brand::where('id','=',$request->hidden_brand_id)->update([
            'name' => $request->brand_name,
            'slug' => Str::slug($request->brand_name,"-"),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword
          ]);

          // $accessToken = $brand->createToken('authToken')->accessToken;
          
          return response()->json(['brand'=>$brand,'success'=>'Brand Successfully Updated']);
        }
        else {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->id;
        $product = Brand::find($id)->delete();
        return response()->json(['success'=>'Brand Successfully Removed']);
    }
}
