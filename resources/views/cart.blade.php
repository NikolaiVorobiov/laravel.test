<x-layout>
    <x-slot:title>Cart</x-slot:title>

    <h1>Cart</h1>

    <a href="{{ route('home.products.pay') }}" style="padding-left: 30px;">
        <span>Pay</span>
    </a>

    <a href="{{ route('home.products.clear.cart') }}" style="display: block; text-align: right; padding-right: 150px;">
        <span>Clear cart</span>
    </a>
    <br>

    <table style="border:1px solid black; width:100%;">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Currency</th>
            <th>Status</th>
            <th>Delete</th>
{{--            <th>Edit</th>--}}

        </tr>

        @foreach( $orderedProducts as $product)
            <tr>

                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand }}</td>

                @if( isset($product->image))
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="Изображение" width="30" height="30"></td>
                @else
                    <td>No image</td>
                @endif

{{--                TODO move to controller--}}
               @foreach( $orders as $order )
                   @if( $order['productId'] == $product->id )
                      <td> {{ $order['price'] }} </td>
                        <td>{{ $order['quantity'] }}</td>
                   @endif
               @endforeach


                <td>{{ $product->currency }}</td>
                <td>{{ $product->status }}</td>
                <td><a href="{{ route('home.products.destroy', ['productId' =>  $product->id]) }}">Delete</a></td>
                {{--                <td><a href="{{ route('admin.products.edit', ['productId' =>  $product->id]) }}">Edit</a></td>--}}

            </tr>
        @endforeach

    </table>
    <div>
        Total price: {{ $totalPrice }}
    </div>


</x-layout>
