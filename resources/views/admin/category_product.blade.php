@extends('admin.masterAdmin')
@section('main')
<section>
    <h1>Quản lý danh mục</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>

        @forelse ($categories as $item)
        <tr>
            <td>{{ $stt++ }}</td>
            <td>{{$item->name}}</td>
            <td>
                @if($item->status == 0)
                Đã hiển thị danh mục
                @else
                Ẩn hiển thị danh mục
                @endif
            </td>
            <td>
                <a class="button col-md-4 " href="{{ route('categories.edit',['categories'=>$item->id]) }} "><i class="fa fa-solid fa-pen-to-square"></i></a>
                <form id="myCategories" action="{{ route('categories.destroy',['categories'=>$item->id]) }}" method="post">
                    @csrf
                    @method('delete')
                <button type="submit" class="button col-md-4 delete-btn" ><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
            @empty
                <span>Chưa có dữ liệu</span>
        @endforelse
    </table>
    <a href="{{ route('categories.create') }}" class="button ">Thêm danh mục</a>
</section>
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
@endsection

@section('customjs')
<script>
    $('#myCategories').on('click', '.delete-btn', function(e) {
            e.preventDefault();

            const form = $(this).closest("form");

            swal({
                    title: "Bạn có chắc muốn xóa danh mục?",
                    text: "Khi xóa, bạn sẽ không khôi phục lại được",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Bạn đã xóa danh mục thành công", {
                            icon: "success",
                        });
                        // If user clicks on Yes, submit the form
                        form.submit();
                    }
                });
        });
</script>
@endsection