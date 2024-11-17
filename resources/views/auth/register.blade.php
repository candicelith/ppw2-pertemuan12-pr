@extends('auth.layouts')

@section('content')
    <div class="container">

        <div class="card w-50 position-absolute top-50 start-50 translate-middle">
            <div class="card-header bg-beige text-navy">
                Registration
            </div>
            <div class="card-body">

                <form action="{{ route('regis.store') }}" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" />

                        @if ($errors->has('name'))
                            <span class="tetx-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                            <span class="tetx-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" />
                        @if ($errors->has('password'))
                            <span class="tetx-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" class="form-control" id="password_confirmation"
                            name="password_confirmation" />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4">Register</button>

                </form>

            </div>
        </div>


    </div>
@endsection
