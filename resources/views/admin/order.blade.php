


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
    <style >
        .title-deg{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
 padding-bottom: 50px;


        }
.table_deg{
 border: 2px solid white;
 width:100%;
 margin: auto;
 text-align: center;

}
.th_deg{
    background: gray;
 border: 2px solid white;
    
}
.td_deg{
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
            <h1 class="title-deg">Orders</h1>

            <div style="padding-bottom: 30px; padding-left:400px">
              <form action="{{url('/search')}}" method="get">
                @csrf
                <input style="color: black;" type="text" name="search" value="{{$searchtxt}}" placeholder="Search">
                <input class="btn btn-primary" type="submit" value="Search">

              </form>
            </div>

            <table class="table_deg">
                <tr class="th_deg">
                    <th class="td_deg">Name</th>
                    <th class="td_deg">Email</th>
                    <th class="td_deg">Address</th>
                    <th class="td_deg">Phone</th>
                    <th class="td_deg">Product_title</th>
                    <th class="td_deg">Quantity</th>
                    <th class="td_deg">Price</th>
                    <th class="td_deg">Payment Status </th>
                    <th class="td_deg">Delivery Status</th>
                    <th class="td_deg">Image</th>
                    <th class="td_deg">Status</th>
                    <th class="td_deg">Print Pdf</th>
                    <th class="td_deg">Send Email</th>



                  </tr>

                @forelse ($order as $item)
                    <tr class="td_deg">
                    <td class="td_deg">{{$item->name}}</td>
                    <td class="td_deg">{{$item->email}}</td>
                    <td class="td_deg">{{$item->address}}</td>
                    <td class="td_deg">{{$item->phone}}</td>
                    <td class="td_deg">{{$item->product_title}}</td>
                    <td class="td_deg">{{$item->quantity}}</td>

                    <td class="td_deg">{{$item->price}}</td>

                     <td class="td_deg">{{$item->payment_status}}</td>
                    <td class="td_deg">{{$item->deleviry_status}}</td>

                    <td class="td_deg">
                      <img height="100px" width="200px" src="/product_img/{{$item->image}}" alt="">
                    </td>

                    <td>
                      @if($item->deleviry_status=='processing')
                    <a class="btn btn-primary" href="{{url('update_delivery_status',$item->id)}}" onclick="return confirem('Are you sure to delivered this product')">Delevered</a>
                         
                      @else
                        <p style="color: grey;"  >Delivered</p>

                        @endif 
                    </td>

                    <td class="td_deg">
                      <a class="btn btn-danger btn-sm" href="{{url('print_pdf',$item->id)}}">Print PDF</a>
                    </td>

                    <td class="td_deg">
                      <a class="btn btn-danger btn-sm" href="{{url('send_email',$item->id)}}">Send email</a>
                    </td>
                    
               </tr>
               @empty
               
        <div >
          <tr >
            <td  colspan="20">
              No Data Found
            </td>
          </tr>
        </div>
                   
               
                @endforelse
                
            </table>
          </div>
 </div>
       
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