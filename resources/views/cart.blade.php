<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container col-md-10" style="padding-top: 20px">
        <div class="card shadow">
            <div class="card-header text-center">{{ __('CART') }} </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset('storage/Image/'.$item->image)}}" alt="Error" style="height: 90px" ></td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>Rp. {{$item->price}}</td>
                                @if($item->quantity > 0)
                                <form action="{{route('addCart')}}" method="POST">
                                    @CSRF
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <td><input type="number" name="quantity" id="" value="1" min="0" max="{{$item->quantity}}"></td>
                                    <td><input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address')}}"/></td>
                                    <td><input type="text" class="form-control" name="post_code" placeholder="Post Code" value="{{old('post_code')}}"/></td>
                                    <td><button type="submit" class="btn btn-danger col-md">Add</button></td>
                                    <td>
                                        @error('address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                       
                                    @enderror
                                    </td>
                                    <td>
                                    @error('post_code')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                       
                                    @enderror
                                    </td>
                                </form>
                                @elseif($item->quantity <= 0)
                                <td colspan="6">Barang sudah habis, silahkan tunggu hingga barang di-restock ulang</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <form action="{{route('addInvoice')}}" method="POST">
                            @CSRF
                            <tr>
                                <input type="text" class="form-control" name="address_target" placeholder="Invoice Address" value="{{old('address_target')}}"/>
                            </tr>
                            <tr>
                                <input type="text" class="form-control" name="post_code_target" placeholder="Target Post Code" value="{{old('post_code_target')}}"/>
                            </tr>
                            <br>
                            <tr>
                                <button type="submit" class="btn btn-primary col-md">Create Invoice</button>
                            </tr>
                            <tr>
                            @error('address_target')
                            <div class="text-danger">
                                {{ $message }}
                            </div>                       
                            @enderror
                            </tr>
                            <tr>
                            @error('post_code_target')
                            <div class="text-danger">
                                {{ $message }}
                            </div>                       
                            @enderror
                            </tr>
                        </form>
                    </table>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="font-weight-bold">{{Auth::user()->name}}</th>
                                <th class="font-weight-bold">Subtotal</th>
                                <th class="font-weight-bold">Address</th>
                                <th class="font-weight-bold">Post Code</th>
                            </tr>
                        </tbody>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td>{{$cart->item->category->name}}-{{$cart->item->name}} x{{$cart->quantity}}</td>
                                <td>Rp.{{$cart->item->price*$cart->quantity}}</td>
                                <td>{{$cart->address}}</td>
                                <td>{{$cart->post_code}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>