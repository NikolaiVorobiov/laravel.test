<x-layout>
    <x-slot:title>Admin</x-slot:title>
    <h1>Add the product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('info'))
        <p style="color: red;">{{ session('info') }}</p>
    @endif

    <form method="post" action="{{ !isset($product) ? route('admin.products.store') : route('admin.products.update', ['productId' => $product->id]) }}" enctype="multipart/form-data">

        @csrf

        <input value="{{ isset($product) ? $product->id : '' }}" type="hidden" name="id" >

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ old('name', isset($product) ? $product->name : '') }}" type="text" name="name" class="form-control" id="name">
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input value="{{ old('brand', isset($product) ? $product->brand : '') }}" type="text" name="brand" class="form-control" id="brand" >
        </div>

        <div class="mb-3">
            @if( isset($product->image) )
                <img src="{{ asset('storage/' . $product->image) }}" alt="Нет изображения" width="30" height="30">
            @endif
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image" >
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input value="{{ old('price', isset($product) ? $product->price : '') }}" type="number" name="price" class="form-control" id="price" >
        </div>

        <div class="mb-3">
            <label for="dollar" class="form-label">Dollar $</label>
            <input type="radio" name="currency"  value="Dollar" id="dollar"  {{ ((old('currency') === 'Dollar') || ((isset($product)) && ($product->currency === 'Dollar'))) ? 'checked' : '' }}>

            <label for="euro" class="form-label">Euro </label>
            <input type="radio" name="currency" value="Euro" id="euro"  {{ ((old('currency') === 'Euro') || ((isset($product)) && ($product->currency === 'Euro'))) ? 'checked' : '' }}>

            <label for="grivna" class="form-label">Grivna </label>
            <input type="radio" name="currency" value="Grivna" id="grivna" {{ ((old('currency') === 'Grivna') || ((isset($product)) && ($product->currency === 'Grivna'))) ? 'checked' : '' }}>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Active</label>
            <input type="checkbox" name="status" id="status" {{ (old('status') || ((isset($product)) && ($product->status === 1))) ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</x-layout>
