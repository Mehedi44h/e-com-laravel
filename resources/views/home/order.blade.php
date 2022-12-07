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
      <style>
        .center{
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;

        }
        .table_deg{
 border: 2px solid black;
 width:100%;
 margin: auto;
 text-align: center;

}
        .td_deg{
 border: 2px solid black;

}
.imge{
    
    margin: auto;
}
.th_deg{
    background: bisque;
 border: 2px solid black;
    
}
      </style>
   </head>
   <body>
      
         <!-- header section strats -->
         @include('home.header')
        <div class="center">
            <table class="table_deg">
                <tr class="th_deg">
                    <th class="td_deg">Product Title</th>
                    <th class="td_deg">quantity</th>
                    <th class="td_deg">Price</th>
                    <th class="td_deg">Payment Status</th>
                    <th class="td_deg">Delivery Status</th>
                    <th class="td_deg">Image</th>
                    <th class="td_deg">Cancel Order</th>


                </tr>
                 @foreach ($order as $item)
                <tr >
                   
                <td class="td_deg">{{$item->product_title}}</td>
                <td class="td_deg">{{$item->quantity}}</td>
                 <td class="td_deg">{{$item->price}}</td>
                <td class="td_deg">{{$item->payment_status}}</td>
                <td class="td_deg">{{$item->deleviry_status}}</td>
                <td class="td_deg">
                    <img class="imge" height="100px" width="200px" src="product_img/{{$item->image}}" alt="">
                </td>
                <td class="td_deg">
                    @if($item->deleviry_status=='processing')
                    
                    <a class="btn btn-danger " href="{{url('cancel_order',$item->id)}}" onclick="return confirm('Are you want to cancel the order?') ">Cancel Order</a>

                    
                    
                        
                    @else
                           <p style="color: red;" >Not allowed</p>

                    @endif
                </td>
                
                </tr>
                @endforeach
                
                

            </table>
        </div>
        
      
    
      <!-- footer end -->
      
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