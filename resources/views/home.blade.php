<x-layout>
    <x-slot:title>Home</x-slot:title>
    <h1>Home</h1>

    <div class="container text-center">
        <div class="row row-cols-6">

            @foreach($products as $product)
                <div class="col">
                    @if( isset($product->image))
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="Изображение" width="150" height="150"></td>
                    @else
                        <td><br><br>No image</td><br><br><br><br>
                    @endif
                        <p>Name: {{ $product->name }}</p>
                        <p>Brand: {{ $product->brand }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Currency: {{ $product->currency }}</p>
                        <p>Status: {{ $product->status }}</p>
                </div>
            @endforeach

        </div>
    </div>
    <div>
        {{ $products->links() }}
    </div>

</x-layout>
