


<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style type="text/css">
        .fonts{
            font-size: 30px;
            padding-bottom: 40px;
        }
        .inpute_color{
            color: black;
        }
        .center{
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
          border: 2px solid white;
        }
        label{
          display: inline-block;
          width: 200px;
        }
        .div_design{
          padding-bottom: 15px;
        }
        .text_color{
          color: black;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial sedebar end-->
      
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial navbar end -->

        {{-- partial main panel start --}}
        <div class="main-panel">
          <div class="content-wrapper">
            @if (session()->has('message'))
            
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
            @endif
                
            


             <div class="text-center pt-5">
                <h1 class="fonts">Update Product</h1>
                <form action="{{url('/update_product_confirm',$product->id) }}" method="POST"  enctype="multipart/form-data">
                  @csrf
                  <div class="div_design">
                    <label>Product title:</label>
                     <input type="text" class="inpute_color" name="title" id="product" placeholder="write product title" value={{$product->title}} required>
                     
                  </div>
                  <div class="div_design">
                    <label>Product description:</label>
                     <input type="text" class="inpute_color" name="description" id="description" placeholder="write product description" value={{$product->description}} required>
                     
                  </div>
                  <div class="div_design">
                    <label>Product Price:</label>
                     <input type="number" class="inpute_color" name="price" id="price" placeholder="write product price" value={{$product->price}} required>
                     
                  </div>
                  <div class="div_design">
                    <label>Discount price:</label>
                     <input type="number" class="inpute_color" name="dis_price" id="discount_price" placeholder="write discount price" value={{$product->discount_price}} >
                     
                  </div>
                  <div class="div_design">
                    <label>Product Quantity:</label>
                     <input type="number" class="inpute_color" name="quantity" id="quantity" placeholder="write product Quantity" value={{$product->quantity}} required>
                     
                  </div>
                  <div class="div_design">
                    <label>Product Catagory:</label>
                    <select class="text_color" name="catagory" id="catagory"  required> 
                      <option value={{$product->catagory}} selected> {{$product->catagory}}</option>
                      @foreach ($catagory as $item)
                          <option value="{{$item->catagory_name}}"> {{$item->catagory_name}}</option>
                      @endforeach
                   </select>
                    

                     
                  </div>
                  <div class="div_design">
                    <label>Current Product Image:</label>
                   <img style="margin: auto;" height="100px" width="100px" src="/product_img/{{$product->image}}" alt="">
                     
                  </div>

                   <div class="div_design">
                    <label>Chenge Product Image:</label>
                   <input type="file" name="image" >
                     
                  </div>

                    <input type="submit" class="btn btn-primary m-4 " name="submit" id="submit" value="Update Product">
                  
                   
                </form>
             </div>
          </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>