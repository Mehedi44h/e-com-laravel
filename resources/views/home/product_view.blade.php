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
   </head>
   <body class="sub_page">
       
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Search  <span> products</span>
               </h2>
               <br><br>
              
               <div>
                  <form action="{{url('search_product')}}" method="GET">
                     @csrf
                     <input style="width: 500px;" type="text" name="search" placeholder="search for products">
                     <input type="submit" name="" id="" value="search">
                  </form>
               </div>
            </div>
             @if (session()->has('message'))
            
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
            @endif 
            <div class="row">
               @foreach ($product as $products)
                   <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$products->id)}}" class="option1">
                           Product details
                           </a>
                          

                          <form action="{{url('add_cart',$products->id)}} " method="POST">
                           @csrf
                           <div class="row">

                              <div class="col-md-4">
                           <input type="number" name="quantity" value="1" min="1">

                              </div>

                           <div class="col-md-4">
                              <input type="submit" value="Add to cart">

                           </div>

                           </div>

                          </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product_img/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>
                        @if($products->discount_price!=null)
                        <h6>
                           ${{$products->discount_price}}
                        </h6>
                        <h6 style="text-decoration:line-through;color:red;">
                           ${{$products->price}}
                        </h6>
                        @else
                         <h6 style="color:green;">
                           ${{$products->price}}
                        </h6>
                       
                       @endif
                        
                       
                     </div>
                  </div>
               </div>
              
          
               @endforeach
              <span>
               {!! $product->withQueryString()->links('pagination::bootstrap-5')!!}
              </span>
         </div>
      </section>
      
      <!-- footer section -->
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>