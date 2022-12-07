<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Laravel-Ecommerce project</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <style type="text/css">
.center{
    margin: auto;
    width: 70%; 
    text-align: center;
    padding: 40px;
}
table,th,td{
    border: 2px solid green;
}
.th_deg{
    font-size: 20px;
    padding: 5px;
    background: grey

}
.img_deg{
    height: 100px;
    width: 200px;
}
.price_deg{
   font-size: 25px;
   padding: 40px; 
}
      </style>
   </head>
   <body>
     @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         
      @if (session()->has('message'))
            
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
            @endif
      
    <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product title</th>
                <th class="th_deg">Product quantity</th>
                <th class="th_deg">price</th>
                <th class="th_deg">image</th>
                <th class="th_deg">Action</th>
             </tr>
<?php $totalprice=0;?>
             @foreach ($cart as $cart)
                 
            
            <tr>
            <td>{{$cart->product_title}}</td>
            <td>
                {{-- <div class="col-md-4">
                    <input type="number" name="quantity" value="1" min="1">

                </div> --}}
            {{$cart->quantitiy}}
            </td>
            <td>${{$cart->price}}</td>
             <td> <img class="img_deg" src="/product_img/{{$cart->image}}" alt=""></td>

                <td> 
                    <a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}" onclick="return confirm('are you sure to remove this product?')">Remove</a>
                </td>
            </tr>
            <?php $totalprice= $totalprice + $cart->price ?>
             @endforeach
        </table>
        <div>
            <h1 class="price_deg">Total Price: $ {{$totalprice}}</h1>
        </div>
     <div>
        <h1 style="font-size: 25px; padding:15px">Proced to order</h1>
        <a class="btn btn-danger" href="{{url('cash_order')}}">Cash on Delevery</a>
        <a class="btn btn-danger" href="{{url('stripe',$totalprice)}}">Pay using Card</a>

     </div>


    </div>
      
    
      {{-- <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">Mehedi Hasan</a>
         
         </p>
      </div> --}}
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>