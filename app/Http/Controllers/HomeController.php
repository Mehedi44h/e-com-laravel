<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\products;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Commetn;
use App\Models\Reply;

use Stripe;
use  Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;











class HomeController extends Controller
{
    public function index()
    {
        $product = products::paginate(4);
        $comment = Commetn::orderby('id', 'desc')->get();

        $reply = Reply::all();

        return view('home.userpage', compact('product','comment','reply'));
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            
            $total_products=products::all()->count();
            $total_orders=Order::all()->count();
            $total_customers = user::all()->count();
            $order=Order::all();
            $total_revinue=0;
            foreach($order as $item){
               $total_revinue=$total_revinue+$item->price ;
            }

            $total_delivered=Order::where('deleviry_status','=','delevired')->get()->count();
            $total_processing = Order::where('deleviry_status', '=', 'processing')->get()->count();
            

            return view('admin.home',compact('total_products','total_orders','total_customers','total_revinue','total_delivered','total_processing'));
        } 
        else {
            $product = products::paginate(6);
            $comment = Commetn::orderby('id','desc')->get();
            $reply = Reply::all();
            $user=Auth()->user();
            $count=Cart::where('phone',$user->phone)->count();


            return view('home.userpage', compact('product','comment','reply', 'count'));
        }
    }

    public function product_details($id)
    {
        $product = products::find($id);

        return view('home.product_details', compact('product'));
    }


    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = products::find($id);
            $userid=$user->id;
            $product_exist_id=Cart::where('Product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            if($product_exist_id)
                {
                            $cart=Cart::find($product_exist_id)->first();
                            $quantity=$cart->quantitiy;
                            $cart->quantitiy=$quantity+$request->quantity;
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price *  $cart->quantitiy;
                } else {
                    $cart->price = $product->price *  $cart->quantitiy;
                }
                            $cart->save();

                Alert::success('Product Added Successfull', 'you have added product to the cart');

                            return redirect()->back();
                            // ->with('message','Product added successfully')
                }
            else{
                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantitiy = $request->quantity;



                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }


                $cart->save();
                Alert::success('Product Added Successfull','you have added product to the cart');
                return redirect()->back();
                // ->with('message', 'Product added successfully')

                
                }
                
          
        } 
        else {
            return redirect('login');
        }
    }
    

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            $user = Auth()->user();
            $count = Cart::where('phone', $user->phone)->count();
            
            return view('home.show_cart', compact('cart','count'));
        } else {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        Alert::success('Product deleted Successfull', 'you have added product to the cart');
        
        return redirect()->back();
    }

    public function cash_order()
    {

        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', '=', $userid)->get();
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantitiy;
            $order->image = $data->image;
            $order->price = $data->price;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'cash on delivery';
            $order->deleviry_status = 'processing';

            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'Product order successfully received');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripepost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', '=', $userid)->get();
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantitiy;
            $order->image = $data->image;
            $order->price = $data->price;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'Paid';
            $order->deleviry_status = 'Processing';

            $order->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        
        Session::flash('success', 'Payment successful!');

        return back();
    }

public function show_order(){
    
   if(Auth::id()){
    $user=Auth::user();
    $userid=$user->id;
    $order=Order::where('user_id','=',$userid)->get();
            $user = Auth()->user();
            $count = Cart::where('phone', $user->phone)->count();
         return view('home.order',compact('order','count'));

        }
        else{
            return redirect('login');
        }
}

public function cancel_order($id){
    $order=Order::find($id);
    $order->deleviry_status='You canceled the order';
    $order->save();
    return redirect()->back();
}

public function add_comment(Request $request){
    if(Auth::id())
    {
       
        $comment=new commetn;
        $comment->name=Auth::user()->name;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();

        
    }
    else
    {
    
        return redirect('login');
    }
}

public function add_reply(Request $request){
    
   if(Auth::id()){
            $reply=new reply();
        
            $reply->name = Auth::user()->name;
            $reply->comment_id = $request->comID;
            $reply->reply = $request->reply;

           $reply->user_id = Auth::user()->id;
            $reply->save();
            return redirect()->back();


    
    
}
else{
    
    return redirect('login');
}
    
}


public function product_search(Request $request){
        $comment = Commetn::orderby('id', 'desc')->get();
        $reply = Reply::all();
    $search_text=$request->search;
    $product=products::where('title','LIKE', "%$search_text%")-> orWhere('catagory', 'LIKE', "%$search_text%")->paginate(10);
      


        return view('home.userpage', compact('product', 'comment', 'reply'));
}

public function products(){
        $product = products::paginate(4);
        $comment = Commetn::orderby('id', 'desc')->get();

        $reply = Reply::all();

        return view('home.all_products', compact('product', 'comment', 'reply'));
   
}

    public function search_product(Request $request)
    {
        $comment = Commetn::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = products::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "%$search_text%")->paginate(10);



        return view('home.all_products', compact('product', 'comment', 'reply'));
    }

}