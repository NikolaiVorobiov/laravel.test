<x-layout>
    <x-slot:title>Enter email</x-slot:title>

    <h3>Enter email for purchase</h3>

    <form method="post" action="{{ route('email.save') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <hr>

    </form>

</x-layout>
