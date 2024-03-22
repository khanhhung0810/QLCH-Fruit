@extends('admin.masterAdmin')
@section('main')
    <form method="POST" id="form-profile" action="{{ route('profilePage.update', $user->id) }}" enctype="multipart/form-data"
        class="mt-3">
        @csrf
        @php
            $profileImages = $user->avatar;
        @endphp
        @method('PUT')

        <section class="vh-50">
            <div class="container py-50 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-6 mb-4 mb-lg-0">
                        <div class="card mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                    <h5>{{ $user->name }}</h5>
                                    <p>Admin</p>
                                    @php
                                        use Jenssegers\Agent\Agent;
                                        $agent = new Agent();
                                    @endphp

                                    @if ($agent->isMobile())
                                        <a class="button "
                                            href="{{ route('profilePage.edit', ['profilePage' => $user->id]) }} "><i
                                                class="far fa-edit mb-5"></i></a>
                                    @else
                                        <!-- Button trigger modal -->
                                        <a type="button" class="button" href="#" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="far fa-edit mb-5"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="name"
                                                                    class="col-form-label custom-class">Username:</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ old('name', $user->name) }}">
                                                                @error('name')
                                                                    <span class="error">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="phone"
                                                                    class="col-form-label custom-class">Phone:</label>
                                                                <input type="text" class="form-control" id="phone"
                                                                    name="phone" value="{{ old('phone', $user->phone) }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="address"
                                                                    class="col-form-label custom-class">Address</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    name="address"
                                                                    value="{{ old('address', $user->address) }}">
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>My Profile</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-7 mb-3">
                                                <h6>Email</h6>
                                                <p class="text-muted">{{ $user->email }}</p>


                                                <a id="verify-email" data-href="{{ route('verify')}}" href="#" class="btn btn-primary">Verify Email</a>


                                            </div>
                                            <hr class="mt-0 mb-4">
                                            <div class="col-6 mb-3">
                                                <h6>Phone</h6>
                                                <p class="text-muted">{{ $user->phone }}</p>
                                            </div>
                                        </div>

                                        <hr class="mt-0 mb-4">
                                        <div class=" pt-1">
                                            <div class=" mb-3">
                                                <h6>Address</h6>
                                                <p class="text-muted">{{ $user->address }}</p>
                                            </div>
                                            {{-- <div class="col-6 mb-3">
                                                    <h6>Most Viewed</h6>
                                                    <p class="text-muted">Dolor sit amet</p>
                                                </div> --}}
                                        </div>
                                        <hr class="mt-0 mb-4">
                                        <div class="d-flex justify-content-start">
                                            <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                            <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <style>
        .custom-class {
            margin-right: 80%;
        }

        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
@endsection

@section('customjs')
    <script>
        //1. Listen form submit event
        $('#form-profile').on('submit', function(event) {
            event.preventDefault() //2. Chặn event submit
            //3. Lấy data đã nhập từ form
            var formData = new FormData(this);
            $.ajax({
                url: $('#form-profile').attr('action'),
                method: $('#form-profile').attr('method'),
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    alert(response.message);
                    console.log(response);
                },

                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    // Gỡ bỏ lớp is-invalid và thông báo hợp lệ cũ
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    //key: name, phone, address
                    //value: Mảng chứa các thông báo lỗi -> input
                    $.each(errors, function(key, value) {
                        $('#' + key).addClass(
                            'is-invalid'); //Thêm class ứng với tên trường trong key
                        $('#' + key).after('<div class="invalid-feedback">' + value[0] +
                            '</div>');
                        // Thêm một div với lớp invalid-feedback chứa thông báo lỗi sau trường input.
                        // Chỉ lấy value[0] vì muốn hiển thị một lỗi duy nhất cho mỗi trường input.
                    });
                }


            });

        })
$(document).ready(function(){

    $('#verify-email').on('click', function(event){
     $.ajax({
         url: $(this).attr('data-href'),
         method: 'GET',
         success: function(response){
             alert(response.message);

         },
         error: function(xhr){
             alert("Fail");
         }

     });

    });
})
    </script>
@endsection
