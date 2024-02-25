@extends('admin.masterAdmin')
@section('main')

<section>
 <style>
    button {
        border: none;
    }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
        
    }
    .button:hover{
        background-color: #218838;
        color: black;
    }
    td .actions {
        display: inline-block;
        justify-content: space-around;
    }

 </style>
<title>Quản lý Sản phẩm</title>
    <h1>Quản lý Sản phẩm</h1>
    <table>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên Sản phẩm</th>
            <th>Loại Sản phẩm</th>
            <th>Ảnh Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
        @forelse ($products as $item)
            <tr>
            <td>{{$item->MaSP}}</td>
            <td>{{$item->TenSP}}</td>
            <td>{{$item->LoaiSP}}</td>
            <td><img src="{{ url('images/'.$item->AnhSP) }}" alt="" width="120"></td>
            <td>{{$item->Gia}}</td>
            <td>{{$item->SoLuong}}</td>
            <td>       
                <a class="button " href="{{ route('product.edit',['product'=>$item->MaSP]) }} "><i class="fa fa-solid fa-pen-to-square"></i></a>
                <a class="button " href="{{ route('product.show',['product'=>$item->MaSP]) }}"  ><i class="fa-solid fa-circle-info"></i></a>
                <form action="{{ route('product.destroy',['product'=>$item->MaSP]) }}" method="post">
                    @csrf
                    @method('delete')
                <button type="submit" class="button " ><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
            </tr>
            @empty
                <span>Chưa có dữ liệu</span>
        @endforelse
      
    </table>
    <a href="{{ route('product.create') }}" class="button ">Thêm sản phẩm</a>
   
</section>
@endsection
