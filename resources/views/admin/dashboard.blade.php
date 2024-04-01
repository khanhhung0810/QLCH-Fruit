@extends('admin.masterAdmin')
@section('main')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Auth::user()?->name . ', ' . session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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

            table,
            th,
            td {
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

            .button:hover {
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
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Mô tả sản phẩm</th>
                <th>Ảnh Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Chức năng</th>
            </tr>
            @forelse ($products as $item)
                <tr>
                    <td>{{ $item->MaSP }}</td>
                    <td>{{ $item->TenSP }}</td>
                    <td>
                        @foreach ($item->category as $category)
                            {{ $category->name }}
                            @if (!$loop->last)
                                , <!-- Đưa ra dấu phẩy nếu không phải là danh mục cuối cùng -->
                            @endif
                        @endforeach
                    </td>
                    {{-- 
          (1)   Truy cập vào mảng $categories dựa trên giá trị của $item->LoaiSP.
                $item->LoaiSP có thể là một khóa (key) trong mảng $categories, và giá trị tương ứng với khóa này sẽ được lấy ra.
        
          (2)   " ?? '' ": Đây là toán tử null coalescing trong PHP. Kiểm tra xem giá trị bên trái có tồn tại không.
                Nếu tồn tại, thì giá trị đó được trả về; nếu không, thì giá trị bên phải (trong trường hợp này là chuỗi rỗng '') sẽ được trả về. 
        --}}

                    <td>{{ $item->description }}</td>


                    <td>
                        @php
                            $productImages = json_decode($item->AnhSP);
                        @endphp
                        <img src="{{ url('images/' . Arr::first($productImages)) }}" alt="" width="120">
                    </td>
                    {{-- @dd(json_decode($item->AnhSP)) --}}

                    <td>{{ number_format($item->Gia, 0) }}₫</td>
                    <td>{{ $item->SoLuong }}</td>
                    <td>
                        <form action="{{ route('product.destroy', $item->MaSP) }}" method="post">
                            @csrf
                            @method('delete')

                            <a class="button " href="{{ route('product.edit', ['product' => $item->MaSP]) }} "><i
                                    class="fa fa-solid fa-pen-to-square"></i></a>
                            <a class="button " href="{{ route('product.show', ['product' => $item->MaSP]) }}"><i
                                    class="fa-solid fa-circle-info"></i></a>

                            <button type="submit" class="button"><i class="fa-solid fa-trash"></i></button>
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

@section('customjs')
    <script>
        $('button[type="submit"]').on('click', function(e) {
            e.preventDefault();

            swal({
                    title: "Bạn có chắc muốn xóa sản phẩm?",
                    text: "Khi xóa, bạn sẽ không khôi phục lại được",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Bạn đã xóa sản phẩm thành công", {
                            icon: "success",
                        });
                        // If user clicks on Yes, submit the form
                        $(this).closest("form").submit();
                    }
                });
        });
    </script>
@endsection
