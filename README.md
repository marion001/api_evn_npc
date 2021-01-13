# api_evn_npc
api lấy dữ liệu đồng hồ điện lực miền bắc
- các bạn tải lên host hoặc cài apache trên server của bạn để chạy file api_evn_npc.php
- tiếp đến sửa thông tin 2 dòng sau thành thông tin của bạn:

$makhachhang = "MaKhachHang"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="MatKhauAPP";  // mật khẩu đăng nhập app của bạn
  - ví dụ:
  
$makhachhang = "PA23VG0098765"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="12345678";  // mật khẩu đăng nhập app của bạn


Cấu hình trên hass:

  - platform: rest  
  
    name: "evn_info"
    
    resource: http://192.168.97.17/evn/evn_info.php?makhachhang=PA23VG0053140&matkhau=tuyenvk
    
    timeout: 60
    
    scan_interval:
    
        minutes: 720
      
    force_update: true
    
    json_attributes:
      - id
      - name
      - address
      - phone
      - contract_id
      - usage_counter_id
      - ngay_ki
      - loai_hop_dong
      - gia_ban_dien
      - electricity_company
