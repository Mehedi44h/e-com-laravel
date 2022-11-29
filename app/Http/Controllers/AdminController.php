<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use App\Models\Products;
use App\Models\Order;



class AdminController extends Controller
{
    public function view_catagory()
    {
        $data = catagory::all();
        return view('admin.catagory', compact('data'));
    }

    public function add_catagory(Request $request)
    {
        $data = new catagory;

        $data->catagory_name = $request->catagory;

        $data->save();

        return redirect()->back()->with('message', 'Catagory added successfully');
    }

    public function delete_catagory($id){
        $deldata=catagory::find($id);
        $deldata->delete();
        return redirect()->back()->with('message', 'Catagory Deleted ');
        
    }

    public function view_product(){
        
        $catagory=catagory::all();
        return view('admin.product',compact('catagory'));
    }

    public function add_product(Request $request)
    {
       $product=new products;
       $product->title=$request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->quantity;
        
        $product->catagory = $request->catagory;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product_img',$imagename);
        $product->image=$imagename;
        $product->save();
        return redirect()->back()->with('message', 'Product added successfully');
    }

    public function show_product(){
        $product=Products::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id){
        $delproduct = Products::find($id);
        $delproduct->delete();
        return redirect()->back()->with('message', 'Product Deleted ');
    }
    public function update_product($id){
        
        $product =Products::find($id);
        $catagory=catagory::all();

        return view("admin.update_product",compact('product','catagory'));
    }

    public function update_product_confirm(Request $request, $id){
        $updproduct=Products::find($id);
        // left side come from db table col name and right side come from update_product page name field 
        $updproduct->title=$request->title;
        $updproduct->description = $request->description;
        $updproduct->price = $request->price;
        $updproduct->discount_price = $request->dis_price;
        $updproduct->catagory = $request->catagory;
        $updproduct->quantity = $request->quantity;
        
        $image = $request->image;
        if($image){
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product_img', $imagename);
            $updproduct->image = $imagename;
        }
        $updproduct->save();
        return redirect()->back()->with('message', 'Product updated successfully');

        
        
    }

    public function order(){
        $order=order::all();
        return view('admin.order',compact('order'));
    }

    public function update_delivery_status($id){
        $order=order::find($id);
        $order->deleviry_status="Delevired";
        $order->payment_status="Paid";
        $order->save();
        return redirect()->back();
    }
    
}