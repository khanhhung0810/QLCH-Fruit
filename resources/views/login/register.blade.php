@extends('login.master')
@section('main')
    <section class="vh-100" style="background-color: #4CAF50;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form id="form-signup" class="mx-1 mx-md-4" action="{{ route('register.store') }}"
                                        method="POST">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Your Name" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="email" name="email" class="form-control"
                                                    placeholder="Your Email" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="password" name="password" class="form-control"
                                                    placeholder="Password" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4cd" name="password_confirmation"
                                                    class="form-control" placeholder="Repeat your password" />
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customjs')
    <script>
        //1. Listen form submit event
        // $('#form-signup').on('submit', function(event) {
        //     event.preventDefault() //2. Chặn event submit
        //     //3. Lấy data đã nhập từ form
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: $('#form-signup').attr('action'),
        //         method: $('#form-signup').attr('method'),
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             alert(response.message);
        //             console.log(response);
        //         },
        //         error: function(xhr, status, error) {
        //             alert(response.message);
        //             console.error(xhr.responseText);
        //         }
        //     });
        //     // console.log(formData.get('MaSP'));
        // })

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