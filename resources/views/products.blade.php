<x-layout>
    <x-slot:title>Products</x-slot:title>
    <h1>Products</h1>

    <table style="border:1px solid black; width:100%;">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Image</th>
            <th>Price</th>
            <th>Currency</th>
            <th>Status</th>
            <th>AddedAt</th>
            <th>EditedAt</th>
        </tr>

        @foreach( $products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand }}</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="Нет изображения" width="30" height="30"></td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->currency }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
            </tr>
        @endforeach

    </table>
    <div>
        {{ $products->links() }}
    </div>

</x-layout>
