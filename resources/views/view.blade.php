<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIEW ITEMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">
            <div class="card-header text-center">{{ __('ITEM LIST') }} </div>
                <div class="card-body">
                    <div class="col-md-6 d-flex gap-5" style="">
                        @if(Auth::user()->role == 'admin')
                        <form action="{{route('createItemPage')}}" method="GET">
                            @CSRF
                            <button type="submit" class="btn btn-success col-md">Create</button>
                        </form>
                        @endif
                        <form action="{{route('cartPage')}}" method="GET">
                            @CSRF
                            <button type="submit" class="btn btn-primary col-md">Cart</button>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                @if(Auth::user()->role == 'admin')
                                <th scope="col">Action</th>
                                @endif
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
                                <td>{{$item->quantity}}</td>
                                @if(Auth::user()->role == 'admin')
                                <td>
                                    <a href="/update/{{$item->id}}"><button type="submit" class="btn btn-success col-md">Edit</button></a>
                                </td>
                                <td>
                                    <form action="{{route('deleteItem', ['id'=>$item->id])}}" method="POST">
                                        @CSRF
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger col-md">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>