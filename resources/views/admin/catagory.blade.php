


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
        <div class="main-panel">
          <div class="content-wrapper">
            @if (session()->has('message'))
            
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                {{session()->get('message')}}
              </div>
            @endif
                
            


             <div class="text-center pt-5">
                <h1 class="fonts">Add catagory</h1>
                <form action="{{url('/add_catagory') }}" method="POST" >
                  @csrf
                     <input type="text" class="inpute_color" name="catagory" id="catagory" placeholder="write catagory name">
                    <input type="submit" class="btn btn-primary " name="submit" id="submit" value="Add to Catagory">
                  
                   
                </form>
             </div>

             <table class="center">
              <tr>
                <td>
                  Catagory name
                </td>
                 <td>
                  Action
                </td>
              </tr>
              @foreach ($data as $data)
                  <tr>
                <td>
                  {{$data->catagory_name}}
                </td>
                 <td>
                  <a class="btn btn-danger" href="{{url('delete_catagory',$data->id)}}">Delete</a>
                </td>
              </tr>
              @endforeach
              
             </table>
          </div>
        </div>
      

             
        {{-- partial main panel start --}}
        {{-- @include('admin.body') --}}
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