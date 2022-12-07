<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catagory;
use App\Models\Products;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    public function view_catagory()
    {
        if (Auth::id()) {
            $data = catagory::all();
            return view('admin.catagory', compact('data'));
        } else {
            return redirect('login');
        }
    }

    public function add_catagory(Request $request)
    {
        if (Auth::id()) {

            $data = new catagory;

            $data->catagory_name = $request->catagory;

            $data->save();

            return redirect()->back()->with('message', 'Catagory added successfully');
        } else {
            return redirect('login');
        }
    }

    public function delete_catagory($id)
    {
        if (Auth::id()) {

            $deldata = catagory::find($id);
            $deldata->delete();
            return redirect()->back()->with('message', 'Catagory Deleted ');
        } else {
            return redirect('login');
        }
    }


    public function view_product()
    {
        if (Auth::id()) {

            $catagory = catagory::all();
            return view('admin.product', compact('catagory'));
        }
         else {
            return redirect('login');
        }
    }

    public function add_product(Request $request)
    {
        if (Auth::id()) {

            $product = new products;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->dis_price;
            $product->quantity = $request->quantity;

            $product->catagory = $request->catagory;

            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product_img', $imagename);
            $product->image = $imagename;
            $product->save();
            return redirect()->back()->with('message', 'Product added successfully');
        } 
        else {
            return redirect('login');
        }

        
        
      
    }

    public function show_product()
    {
        $product = Products::all();
        return view('admin.show_product', compact('product'));
    }
    public function delete_product($id)
    {
        $delproduct = Products::find($id);
        $delproduct->delete();
        return redirect()->back()->with('message', 'Product Deleted ');
    }
    public function update_product($id)
    {

        $product = Products::find($id);
        $catagory = catagory::all();

        return view("admin.update_product", compact('product', 'catagory'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $updproduct = Products::find($id);
        // left side come from db table col name and right side come from update_product page name field 
        $updproduct->title = $request->title;
        $updproduct->description = $request->description;
        $updproduct->price = $request->price;
        $updproduct->discount_price = $request->dis_price;
        $updproduct->catagory = $request->catagory;
        $updproduct->quantity = $request->quantity;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product_img', $imagename);
            $updproduct->image = $imagename;
        }
        $updproduct->save();
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function order()
    {
        $order = order::all();
        return view('admin.order', compact('order'));
    }

    public function update_delivery_status($id)
    {
        $order = order::find($id);
        $order->deleviry_status = "Delevired";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id)
    {

        $order = order::find($id);

        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id)
    {
        $order = order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request, $id)
    {
        $order = order::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,


        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }


    public function searchdata(Request $request)
    {


        $searchtxt = $request['search'] ?? "";
        if ($searchtxt != "") {
            $order = order::where('name', 'LIKE', "%$searchtxt%")->orwhere('email', 'LIKE', "%$searchtxt%")->orwhere('phone', 'LIKE', "%$searchtxt%")->get();
        } else {
            $order = order::all();
        }
        $data = compact('order', 'searchtxt');
        return view('admin.order')->with($data);
    }
}