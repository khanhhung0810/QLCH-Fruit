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
    <form action="{{ route('product.update', $products->MaSP) }}" method="POST">
        <label for="product_code">Mã sản phẩm:</label>
        <input type="text"  name="MaSP" value={{$products->MaSP}}>

        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" name="TenSP" value={{$products->TenSP}}>

        {{-- <label for="product_type">Loại sản phẩm:</label>
        <select id="product_type" name="product_type">
            <option value="type1">Củ</option>
            <option value="type2">Quả</option>
        </select> --}}

        <label for="product_image">Ảnh sản phẩm:</label>
        <input type="text"  name="AnhSP" value={{$products->AnhSP}}>

        <label for="product_price">Giá:</label>
        <input type="number"  name="Gia" value={{$products->Gia}}>

        <label for="product_quantity">Số lượng:</label>
        <input type="number"  name="SoLuong" value={{$products->SoLuong}}>

        <br>
        <button type="button" class="btn" onclick="window.history.back();">Quay về</button>
    </form>
</div>
</body>
@endsection