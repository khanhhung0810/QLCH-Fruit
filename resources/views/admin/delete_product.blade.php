@extends('admin.masterAdmin')
@section('main')

<title>Xác nhận xóa sản phẩm</title>
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
        text-align: center;
    }

    .btn {
        background-color: #f44336;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #d32f2f;
    }
</style>

<h2>Xác nhận xóa sản phẩm</h2>

<div class="container">
    <p>Bạn có chắc chắn muốn xóa sản phẩm này?</p>
    <form action="{{route ('delete')}}" method="POST">
        <input type="hidden" name="MaSP" value="123"> 
        <button type="submit" value="Xóa" class="btn">Xóa</button>
        <a href="{{ route('admin.dashboard') }}" class="btn">Hủy</a>
    </form>
</div>
@endsection