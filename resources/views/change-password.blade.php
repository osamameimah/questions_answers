@extends('layouts.default')

@section('title', 'Edit Profile')

@section('content')


    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <form action="{{ route('password.store') }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label for="current_password">{{ __('Current Password') }}</label>
                <div>
                    <input type="password" placeholder="Current Password" id="current_password"
                        class="form-control @error('current_password') is-invalid @enderror" name="current_password" />

                    @error('current_password')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password">{{ __('New Password') }}</label>
                <div>
                    <input type="password" placeholder="New Password" id="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" />

                    @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <div>
                    <input type="password" placeholder="New Password" id="password_confirmation"
                        class="form-control @error('password') is-invalid @enderror" name="password_confirmation" />

                    @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
            </div>

        </form>
    </div>
    </div>

@endsection
