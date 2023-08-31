<x-layout>
    <x-slot:title>Products</x-slot:title>
    <h1>Products</h1>
    <a class="nav-link" href="/admin/products/create" style="display: block; text-align: right; margin-right: 90px; color: blue;">Add product</a>

    @if(session('info'))
        <p style="color: red;">{{ session('info') }}</p>
    @endif

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
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach( $products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand }}</td>

                @if( isset($product->image))
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="Изображение" width="30" height="30"></td>
                @else
                    <td>No image</td>
                @endif

                <td>{{ $product->price }}</td>
                <td>{{ $product->currency }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td><a href="{{ route('admin.products.edit', ['productId' =>  $product->id]) }}">Edit</a></td>
                <td><a href="{{ route('admin.products.destroy', ['productId' =>  $product->id]) }}">Delete</a></td>

            </tr>
        @endforeach

    </table>
    <div>
        {{ $products->links() }}
    </div>

</x-layout>
