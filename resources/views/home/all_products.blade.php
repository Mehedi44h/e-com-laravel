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
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
       
      </div>
     
      
      <!-- product section -->
      @include('home.product_view')
      <!-- end product section -->


      {{-- for comment section start --}}

      <div style="text-align: center; padding-bottom:30px;">
         <h1 style="font-size:30px; text-align:center; padding-top:20px; padding-bottom:20px;">Comment</h1>
         <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea name="comment" style="height: 150px; width:600px;" placeholder="comment here" ></textarea>
         <br>
         <input type="submit" value="Comment" class="btn btn-primary">
         </form>
      </div>

      <div style="padding-left: 20% ;">
         <h1 style="font-size: 20px; padding-bottom:20px;">All comments</h1>
        
        @foreach ($comment as $item)
            <div>
            <b>{{$item->name}}</b>
            <p>{{$item->comment}}</p>
            <a class="btn btn-success"  href="javascript::void(0);" data-Commentid="{{$item->id}}" onclick="reply(this)" >Reply Comment</a>
           
           @foreach($reply as $items)
           @if($items->comment_id==$item->id)
            <div style="padding-left: 3%; padding-top:10px; padding-bottom:10px;">
            <b>{{$items->name}}</b>

            <p>{{$items->reply}}</p>

            <a class="btn btn-success"  href="javascript::void(0);" data-Commentid="{{$item->id}}" onclick="reply(this)" >Reply Comment</a>

            </div>
            @endif
            @endforeach
         </div>
        @endforeach
         
       </div>
<br>

<div style="display:none;" class="replyDiv" >

<form action="{{url('add_reply')}}" method="POST">
   @csrf
<input type="text" id="comID" name="comID" hidden=''>
   <textarea style="height: 100px; width:500px;" name="reply" placeholder="write something here" id="" ></textarea>
   <br>
   {{-- <a href="" class="btn btn-primary">Reply</a> --}}
   <button style="color: black" type="submit" class="btn btn-primary">Reply</button>
   <a href="javascript::void(0);" class="btn btn-danger"  onclick="reply_close(this)">Cancel</a>

</form>

</div>
{{-- comment reply end  --}}

      
      <!-- footer start -->
     @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">Mehedi Hasan</a>
         
         </p>
      </div>
      <script type="text/javascript">
      function reply(caller){
         document.getElementById('comID').value=$(caller).attr('data-Commentid');
         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
      }
      function reply_close(caller){
         $('.replyDiv').hide();
      }
      </script>

       <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
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