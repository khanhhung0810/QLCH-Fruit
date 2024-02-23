{{-- Cách 1
<h1>Shop có ?php echo $data['Cach1'] ?> sản phẩm</h1>
Cách 2
<h1>Shop có @php
    echo $data['Cach2'];

@endphp sản phẩm</h1>
Cách 3
<h1>Shop có {{$data['Cach3']}} sản phẩm</h1> --}}


@foreach ($data as $key => $value)
    <p>{{$key}}: Shop có {{ $value }} sản phẩm</p>
@endforeach

