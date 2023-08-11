<x-layout>
    <x-slot:title>Sign-in</x-slot:title>

    <h1>Sign-in</h1>
    <p>{{ $info }}</p>

    <form method="GET" action="{{ route('sign-in') }}">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" minlength="8" maxlength="30" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
