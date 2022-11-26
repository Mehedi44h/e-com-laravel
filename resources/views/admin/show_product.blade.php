


<!DOCTYPE html>
<html lang="en">
  <head>
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
    <style>
        .center{
            margin:auto;
            width: 60%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
         
        }
        .font_size{
            font-size: 40px;
            text-align: center;
        }
        .th-deg{
            background: blueviolet
        }
        .t-header{
            padding: 30px;
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
            <h1 class="font_size">All product</h1>
          <table class="center">
             <tr class="th-deg">
        
            <th class="t-header">Product title</th>
        <th class="t-header"> description</th>
        <th class="t-header"> price</th>
        <th class="t-header"> discount price</th>
        <th class="t-header"> quantity</th>
        <th class="t-header"> Catagory</th>
        <th class="t-header"> image</th>
        <th class="t-header"> Delete</th>
        <th class="t-header"> Edit</th>

       
        

    </tr>
    <tr>
        @foreach ($product as $item)
             <td>{{$item->title}}</td>
             <td>{{$item->description}}</td>
             <td>{{$item->price}}</td>
             <td>{{$item->discount_price}}</td>
             <td>{{$item->quantity}}</td>
             <td>{{$item->catagory}}</td>
             <td>
            <img class="img_size" src="/product_img/{{$item->image}}" alt="">    
            </td>
            <td > 
              <a class="btn btn-danger" onclick="return confirm('Are you sure to delete the data?')" href="{{url('delete_product',$item->id)}}">Delete</a>
            </td>
            <td>
              <a class="btn btn-primary" href="{{url('update_product',$item->id)}}">Edit</a>
            </td>


       </tr>
     @endforeach

</table>


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