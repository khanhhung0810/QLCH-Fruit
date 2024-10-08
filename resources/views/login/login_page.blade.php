@extends('login.master')
@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('login_error'))
        <div class="alert alert-danger">
            {{ session('login_error') }}
           
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Sign in</h3>
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control form-control-lg"
                                    placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg"
                                    placeholder="Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3">
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            <hr class="my-4">
                            <a href="{{ route('register') }}" class="btn btn-lg btn-block btn-primary"
                                style="background-color: #4540d9;" type="submit"><i class="fa-solid fa-user-plus"></i> Sign
                                up with form</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('customjs')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var usernameInput = document.getElementById("email");
            var defaultPlaceholder = "Email";

            // Xử lý sự kiện khi ô input được focus
            usernameInput.addEventListener("focus", function() {
                if (this.value === defaultPlaceholder) {
                    this.value = "";
                }
            });

            // Xử lý sự kiện khi ô input mất focus
            usernameInput.addEventListener("blur", function() {
                if (this.value === "") {
                    this.value = defaultPlaceholder;
                }
            });
        });
    </script>
@endsection
