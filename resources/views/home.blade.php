<x-layout>
    <x-slot:title>Home</x-slot:title>
    <h1>Home</h1>

    @if( $cart && $countOrder > 0)
        <a href="{{ route('home.products.show.cart') }}">
            <span>CART ({{ $countOrder }})</span>
        </a>
        <br>
        <a href="{{ route('home.products.clear.cart') }}">
            <span>Clear cart</span>
        </a>
    @endif

    @if(isset($info))
        <div style="color: red;">{{ $info }}</div>
    @endif

    <div class="container text-center">
        <div class="row row-cols-6">

            @foreach($products as $product)
                <div class="col">
                    @if( isset($product->image))
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="Изображение" width="150" height="150"></td>
                    @else
                        <td><br><br>No image</td><br><br><br><br>
                    @endif
                        <p>ID: {{ $product->id }}</p>
                        <p>Name: {{ $product->name }}</p>
                        <p>Brand: {{ $product->brand }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Currency: {{ $product->currency }}</p>
                        <p>Status: {{ $product->status }}</p>
                        <a href="{{ route('home.products.addToCart', ['productId' => $product->id]) }}">Add to cart</a>
                </div>
            @endforeach

        </div>
    </div>
    <div>
        {{ $products->links() }}
    </div>

</x-layout>
