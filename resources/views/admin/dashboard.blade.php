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
        
        <a href="{{ route('product.create') }}" class="button ">Thêm sản phẩm</a>
    </section>

    <table id="myTable" class="display" style="width:100%">
        <thead>
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
        </thead>
    </table>
@endsection

@section('customjs')
    <script>
        $('#myTable').on('click', '.delete-btn', function(e) {
            e.preventDefault();

            const form = $(this).closest("form");

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
                        form.submit();
                    }
                });
        });


        $(document).ready(function() {
            $('#myTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ route('product.index') }}',
                columns: [{
                        data: 'MaSP',
                        name: 'MaSP'
                    },
                    {
                        data: 'TenSP',
                        name: 'TenSP'
                    },
                    {
                        data: 'LoaiSP',
                        name: 'LoaiSP'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'AnhSP',
                        name: 'AnhSP',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'Gia',
                        name: 'Gia'
                    },
                    {
                        data: 'SoLuong',
                        name: 'SoLuong'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                pageLength: 6
            });
        });
    </script>
@endsection
