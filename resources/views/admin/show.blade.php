@extends('admin.masterAdmin')
@section('main')
    <title>Xem chi tiết thông tin sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        .container {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
            color: aqua;
        }
    </style>

    <body>
        <h2>Xem chi tiết thông tin sản phẩm</h2>

        <div class="container">
            <form action="{{ route('product.show', $product->MaSP) }} "method="POST">
                @csrf
                @php
                    $productImages = json_decode($product->AnhSP);
                @endphp
                <label for="product_code">Mã sản phẩm:</label>
                <input type="text" name="MaSP" value={{ $product->MaSP }} @readonly(true)>

                <label for="product_name">Tên sản phẩm:</label>
                <input type="text" name="TenSP" value="{{ $product->TenSP }}" @readonly(true)>

                <label for="product_type">Loại sản phẩm:</label>
                <select id="product_type" name="LoaiSP[]" multiple="true">
                    @foreach ($categories as $category)
                        @php
                            $isSelect = in_array($category->id, $productCategoryIds);
                        @endphp
                        <option value="{{ $category->id }}" @if ($isSelect) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" name="LoaiSP" value="{{ $category->name }}" readonly> --}}

                <label for="product_description">Mô tả sản phẩm:</label>
                <textarea rows="5" cols="50" name="description" readonly>{{ $product->description }}</textarea>

                <label for="product_image">Ảnh sản phẩm:</label>
                @foreach ($productImages as $productImage)
                    <img src="{{ url('images/' . $productImage) }}" alt="" width="120">
                @endforeach
                <label for="product_price">Giá:</label>
                <input type="number" name="Gia" value={{ $product->Gia }} @readonly(true)>

                <label for="product_quantity">Số lượng:</label>
                <input type="number" name="SoLuong" value={{ $product->SoLuong }} @readonly(true)>

                <br>
                <button type="button" class="btn" onclick="window.history.back();">Quay về</button>
            </form>
        </div>
    </body>
@endsection
