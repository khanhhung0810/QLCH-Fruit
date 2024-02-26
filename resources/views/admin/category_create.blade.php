@extends('admin.masterAdmin')
@section('main')
<form id="form-category" action="{{ route('categories.store') }}" method="post">
    @csrf
    <h1 class="mb-3 text-center">Thêm mới danh mục</h1>
    <div class="mb-3">
      <label for="name" class="form-label">Tên danh mục</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" aria-describedby="nameHelp">
      @error('name')
        <span class="error text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Trạng thái</label>
        
        <select class="form-select" id="status" name="status"  aria-label="Default select example">
            <option selected>Chọn trạng thái</option>
            <option value="0">Trạng thái 0</option>
            <option value="1">Trạng thái 1</option>
        </select>
        @error('status')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-3">Thêm danh mục</button>
  </form>
  <a href="{{ route('categories.index') }}" class="btn btn-primary mt-5 ">Quay lại</a>
@endsection

@section('customjs')
<script>
    $('#form-category').on('submit', function(envent){
        envent.preventDefault()
        var formData = new FormData(this);
        $.ajax({
            url: $('#form-category').attr('action'),
            method: $('#form-category').attr('method'), 
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              alert('Thêm danh mục thành công !!');
                console.log(response);
            },
            error: function(xhr, status, error) {
              alert('Thêm danh mục thất bại !!');
                console.error(xhr.responseText);
            }
        });
    })
</script>
@endsection