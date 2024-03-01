@extends('admin.masterAdmin')
@section('main')
<h1>Thêm mới sản phẩm</h1>
<form id="form-product" action="{{ route('product.store')}}" method="POST" enctype='multipart/form-data'>
    @csrf
    <table>
      <tr>
        <th>Mã sản phẩm</th>
        <td><input type="text" name="MaSP" value="{{ old('MaSP') }}" placeholder="e.g SP0.." >
          @error('MaSP')
            <span class="error">{{ $message }}</span>
          @enderror</td>
      </tr>
      <tr>
        <th>Tên sản phẩm</th>
        <td><input type="text" name="TenSP" value="{{ old('TenSP') }} " >
          @error('TenSP')
            <span class="error">{{ $message }}</span>
          @enderror
        </td>
      </tr>
      <tr>
        <th>Loại sản phẩm</th>
        <td>
          <select name="LoaiSP[]" multiple="true" >
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <th>Ảnh sản phẩm</th>
        <td><input type="file" name="AnhSP">
          
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
    .error{
      color:red;
      font-size:12px;
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

    th, td {
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
  $('#form-product').on('submit', function(event){
    event.preventDefault() //2. Chặn event submit
    //3. Lấy data đã nhập từ form
    var formData= new FormData(this);
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
</script>
@endsection