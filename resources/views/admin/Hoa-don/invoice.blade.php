<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>In hóa đơn</title>
    <style>

    </style>
</head>
<body >
    <style>body{
        font-family: DejaVu Sans;
    }
    .table-styling{
        border:1px solid #000;
    }
    .table-styling tbody tr td{
        border:1px solid #000;
    }
    
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    width: 18cm;
    overflow:hidden;
    min-height:50mm;
    padding: 2.5cm;
    margin-left:auto;
    margin-right:auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}
 @page {
 size: A4;
 margin: 0;
}
button {
    width:100px;
    height: 24px;
}
.header {
    overflow:hidden;
}
.logo {
    background-color:#FFFFFF;
    text-align:left;
    float:left;
}
.company {
    padding-top:24px;
    text-transform:uppercase;
    background-color:#FFFFFF;
    text-align:right;
    float:right;
    font-size:16px;
}
.title {

    position:relative;
    color:#ff0000;
    font-size: 30px;
    top:1px;
    text-align: center;
    right: 30px;  
}
.h5
{
  margin: auto;
  width: 60%;
  border: 3px solid purple;
  padding: 10px;
}
.footer-left {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    float:left;
    font-size: 12px;
    bottom:1px;
}
.footer-right {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    font-size: 12px;
    float:right;
    bottom:1px;
}
.TableData {
    background:#ffffff;
    font: 11px;
    margin: auto;
    width: 90%;
    text-align:center;
    border-collapse:collapse;
    
    font-size:12px;
    border:thin solid #d3d3d3;

}
.TableData TH {
    background: rgba(0,0,255,0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}
.TableData TR {
    height: 24px;
    border:thin solid #d3d3d3;
}
.TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border:thin solid #d3d3d3;
}
.TableData TR:hover {
    background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
    text-align:center;
    width: 10%;
}
.TableData .cotTenSanPham {
    text-align:left;
    width: 40%;
}
.TableData .cotHangSanXuat {
    text-align:left;
    width: 20%;
}
.TableData .cotGia {
    text-align:right;
    width: 120px;
}
.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}
.TableData .cotSo {
    text-align: right;
    width: 120px;
}
.TableData .tong {
    text-align: right;
    font-weight:bold;
    text-transform:uppercase;
    padding-right: 4px;
}
.TableData .cotSoLuong input {
    text-align: center;
}
@media print {
 @page {
 margin: 0;
 border: initial;
 border-radius: initial;
 width: initial;
 min-height: initial;
 box-shadow: initial;
 background: initial;
 page-break-after: always;
}
}
    </style>
    
    <h4><center>Công ty TNHH một thành viên Smarket</center></h4>
    
     
      <div class="title">
        
 
            HÓA ĐƠN THANH TOÁN
            <br/>
            -------oOo-------
      </div>
      <br/>
      <br/>
      <h5 style=" margin: auto; width: 97%;">(*) Tên khách hàng : {{$hoadon->khachdathang->ten}} </h5>
      <h5 style=" margin: auto; width: 97%;"> (*) Số điện thoại  :  {{$hoadon->khachdathang->sdt}} </h5>
      <h5 style=" margin: auto; width: 97%;">  (*) Địa chỉ        : {{$hoadon->khachdathang->dia_chi}}</h5>
      <h5 style=" margin: auto; width: 97%;"> (*) Giới tính      : {{$hoadon->khachdathang->gioi_tinh}}</h5>
      <table class="TableData">
    
        <tr>
          <th>Mã hóa đơn</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Đơn giá</th>
          <th>Thành tiền</th>
          <th>Địa chỉ nhận</th>
          <th>Ngày đặt hàng</th>
        </tr>
        <tbody>
            @foreach($chitiethoadon as $data)
            <tr>
                <td>{{$hoadon->ma_hd }}</td>             
                <td>{{ $data->sanpham->chi_tiet_sp->ten_sp}}</td>
                <td>{{ $data->so_luong }}</td>
                <td>{{ number_format($data->don_gia,0,",",".")}} VNĐ</td>
                <td>{{ number_format($data->thanh_tien,0,",",".") }} VNĐ</td>
                <td>{{ $hoadon->dia_chi_nhan }}</td>
                <td>{{$hoadon->ngay_dat }}</td>   
            </tr>
            @endforeach
    </tbody>
        
      </table>
      <div class="footer-left"> ....., ngày ... tháng ... năm .....<br/>
        Khách hàng </div>
      <div class="footer-right"> ....., ngày ... tháng ... năm .....<br/>
        Nhân viên </div>
    </div>

</body >
</html>