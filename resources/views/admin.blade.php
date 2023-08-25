<x-layout>
    <x-slot:title>Admin</x-slot:title>
    <h1>Admin. Adding the product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p style="color: red;">{{ $info }}</p>

    <form method="post" action="{{ route('product.form.save') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name">
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input value="{{ old('brand'}}" type="text" name="brand" class="form-control" id="brand" >
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image" >
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input value="{{ old('price') }}" type="number" name="price" class="form-control" id="price" >
        </div>


        <div class="mb-3">
            <label for="dollar" class="form-label">Dollar $</label>
            <input type="radio" name="currency"  value="Dollar" id="dollar" >

            <label for="euro" class="form-label">Euro </label>
            <input type="radio" name="currency" value="Euro" id="euro" >

            <label for="grivna" class="form-label">Grivna </label>
            <input type="radio" name="currency" value="Grivna" id="grivna" >
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Active</label>
            <input type="checkbox" name="status"id="status" >
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

</x-layout>
