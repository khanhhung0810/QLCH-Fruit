@extends('admin.masterAdmin')
@section('main')
<form action="{{ route('categories.update', $categoryEdit->id)}}" method="POST">
  @csrf
  @method('PUT')
  <h1 class="mb-3 text-center">Sửa thông tin danh mục</h1>
    <div class="form-group">
      <label for="category_name">Tên danh mục</label>
      <input type="text"  name="name" class="form-control" value="{{$categoryEdit->name}}">
    </div>
    <div class="form-group">
      <label for="status" class="form-label">Trạng thái</label>
        <select class="form-select" id="status" name="status"  aria-label="Default select example" value={{$categoryEdit->status}}>
            <option selected>Chọn trạng thái</option>
            <option value="0">Hiển thị danh mục</option>
            <option value="1">Ẩn danh mục</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Lưu</button>
    <button type="button" class="btn" onclick="window.history.back();">Hủy</button>
  </form>
@endsection