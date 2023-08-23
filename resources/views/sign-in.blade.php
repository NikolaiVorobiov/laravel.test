<x-layout>
    <x-slot:title>Sign-in</x-slot:title>

    <h1>Sign-in</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>{{ $info }}</p>

    <form method="post" action="{{ route('login.form') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" minlength="8" maxlength="30">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        <hr>

        <div style="width: 30px; height: 30px">
            <a href="{{ url('auth/google') }}" class="google-btn">
                <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                <span style="color: black;">Login with Google</span>
            </a>
        </div>
    </form>

</x-layout>
