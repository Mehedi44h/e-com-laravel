<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Order in pdf file</h1>
    <h3>{{$order->name}}</h3>
    <h3>{{$order->email}}</h3>
    <h3>{{$order->phone}}</h3>
    <h3>{{$order->address}}</h3>
    <h3>{{$order->product_title}}</h3>
    <h3>{{$order->quantity}}</h3>
    <h3>{{$order->price}}</h3>
    <img src="pruduct_img/{{$order->image}}" alt="">

</body>
</html>