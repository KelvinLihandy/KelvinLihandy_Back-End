<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container col-md-10" style="padding-top: 20px">
        <div class="card shadow">
            <div class="card-header text-center">{{ __('INVOICE') }}</div>
                <div class="card-body">
                    <div class="col-md-6" style="">
                        <h6>Invoice Number : {{$invoice}}</h6>
                        <h6>{{Auth::User()->name}}</h6>
                        <p>Address&nbsp;&nbsp;&nbsp;&nbsp;: {{$address}}</p>
                        <p>Post Code&nbsp;: {{$post_code}}</p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Item</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sum = 0;
                            @endphp
                            @foreach($carts as $cart)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$cart->item->name}}</td>
                                <td>{{$cart->item->category->name}}</td>
                                <td>{{$cart->quantity}}</td>
                                <td>Rp.{{$cart->item->price*$cart->quantity}}</td>
                                @php
                                $sum += $cart->item->price*$cart->quantity;
                                @endphp
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                            <h5>Total Price : Rp. {{$sum}}</h5>
                        </tbody>
                    </table>
                    <table>
                        <form action="{{route('saveInvoice', ['invoiceNumber' => $invoice])}}" method="POST">
                            @CSRF
                            @method('PATCH')
                            <tr>
                                <input type="hidden" name="sum" value="{{$sum}}">
                                <input type="hidden" name="address" value="{{$address}}">
                                <input type="hidden" name="post_code" value="{{$post_code}}">
                                </tr>
                            <tr>
                                <button type="submit" class="btn btn-success col-md">Save Invoice</button>
                            </tr>
                        </form>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>