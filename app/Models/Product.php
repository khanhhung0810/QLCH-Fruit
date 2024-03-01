<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; //Khai báo tên bảng
    protected $primaryKey = 'MaSP'; // Khai báo tên Primary key nếu ko phải là id
    protected $keyType = 'string'; // Khai báo kiểu dữ liệu của primaryKey, nếu không phải mặt định là key
    protected $fillable = ['MaSP', 'TenSP', 'AnhSP', 'Gia', 'SoLuong',]; // Khai báo những trường trong DB được phép lưu khi use lưu một khối DB
    public $timestamps = false;
    public $incrementing = false;
    public $casts  = ['MaSP' => 'string'];
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product',  'product_id', 'category_id');
        // return $this->belongsTo(Category::class, 'LoaiSP', 'id);

    }
}
