<x-layout>

    <x-slot:title>Sign-up</x-slot:title>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Sign-up</h1>
    <p>{{ $info }}</p>

    <form method="GET" action="{{ route('sign-up') }}">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" minlength="8" maxlength="30" required>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
