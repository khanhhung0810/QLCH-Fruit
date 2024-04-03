@extends('admin.masterAdmin')
@section('main')
    <h1>
        Thêm mới sản phẩm</h1>
    <form id="form-product" action="{{ route('product.store') }}" method="POST" enctype='multipart/form-data'>
        @csrf
        <table>
            <tr>
                <th>Mã sản phẩm</th>
                <td><input type="text" name="MaSP" value="{{ old('MaSP') }}" placeholder="e.g SP0..">
                    @error('MaSP')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Tên sản phẩm</th>
                <td><input type="text" name="TenSP" value="{{ old('TenSP') }} ">
                    @error('TenSP')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Loại sản phẩm</th>
                <td>
                    <select name="LoaiSP[]" multiple="true">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>Mô tả sản phẩm</th>
                <td>
                    <textarea rows="5" cols="50" name="description"></textarea>
                </td>
            </tr>
            <tr>
                <th>Ảnh sản phẩm</th>
                <td>
                    <input type="file" name="AnhSP[]" multiple>
                    {{-- <div id="my-element">
                        <div class="dz-message needsclick">Drop files here or click to upload.<BR></div>
                    </div> --}}
                </td>
            </tr>
            <tr>
                <th>Giá</th>
                <td><input type="number" name="Gia" value="{{ old('Gia') }}"></td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td><input type="number" name="SoLuong" value="{{ old('SoLuong') }}"></td>
            </tr>
        </table>
        <br>
        

        <input type="submit" value="Thêm sản phẩm">
    </form>
    <a href="{{ route('product.index') }}" class="button ">Quay lại</a>

    <style>
        #my-element {
            background: rgb(243, 244, 245);
            border-radius: 5px;
            border: 3px dashed #4CAF50;
            border-image: none;
            max-width: 500px;   
            margin-left: auto;
            margin-right: auto;
            height: 100px;
            text-align: center;
        }
        .dz-message{
            margin-top: 9%;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            
        }

        h2 {
            text-align: center;
        }

        table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a:hover {
            color: #a06045;
        }
    </style>
@endsection

@section('customjs')
    <script>
        //1. Listen form submit event
        $('#form-product').on('submit', function(event) {
            event.preventDefault() //2. Chặn event submit
            //3. Lấy data đã nhập từ form
            var formData = new FormData(this);
            $.ajax({
                url: $('#form-product').attr('action'),
                method: $('#form-product').attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    alert(response.message);
                    console.error(xhr.responseText);
                }
            });
            // console.log(formData.get('MaSP'));
        })

        //         let myDropzone = Dropzone("#my-element", {
        //   addedfile: file => {
        //     // ONLY DO THIS IF YOU KNOW WHAT YOU'RE DOING!
        //   }
        // });

        const dropzone = new Dropzone("div#my-element", {
            url: "/file/post",
            maxFiles: 100,
            uploadMultiple: true,
        });

        // Dropzone.options.photo = {

        //     // The camelized version of the ID of the form element

        //     // The configuration we’ve talked about above
        //     paramName: “inputFiles”,
        //     autoDiscover: false,
        //     autoProcessQueue: false,
        //     uploadMultiple: true,
        //     parallelUploads: 100,
        //     maxFiles: 100,
        //     dictDefaultMessage: “Bạn có thể kéo ảnh hoặc click để chọn”,
        //     previewsContainer: “#photo > .modal - body”,

        //     // The setting up of the dropzone
        //     init: function() {
        //         var myDropzone = this;

        //         // First change the button to actually tell Dropzone to process the queue.
        //         this.element.querySelector(“button[type = submit]“).addEventListener(“click“, function(e) {
        //             // Make sure that the form isn’t actually being sent.
        //             e.preventDefault();
        //             e.stopPropagation();
        //             myDropzone.processQueue();
        //         });

        //         // Listen to the sendingmultiple event. In this case, it’s the sendingmultiple event instead
        //         // of the sending event because uploadMultiple is set to true.
        //         this.on(“sendingmultiple“, function() {
        //             // Gets triggered when the form is actually being sent.
        //             // Hide the success button or the complete form.
        //         });
        //         this.on(“successmultiple“, function(files, response) {
        //             location.reload();
        //         });
        //         this.on(“errormultiple“, function(files, response) {
        //             // Gets triggered when there was an error sending the files.
        //             // Maybe show form again, and notify user of error
        //         });
        //     }

        // }
    </script>
@endsection
