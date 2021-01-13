# api_evn_npc
api lấy dữ liệu đồng hồ điện lực miền bắc
- các bạn tải lên host hoặc cài apache trên server của bạn để chạy file api_evn_npc.php
- tiếp đến sửa thông tin 2 dòng sau thành thông tin của bạn:

$makhachhang = "MaKhachHang"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="MatKhauAPP";  // mật khẩu đăng nhập app của bạn
  - ví dụ:
  
$makhachhang = "PA23VG0098765"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="12345678";  // mật khẩu đăng nhập app của bạn

các api lấy dữ liệu ở đây:

      CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang", //API lấy thông tin khách hàng
    # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/usage_capture_schedules",  
    # CURLOPT_URL => "$host_api/api/v1/customerindex?code=$makhachhang&month=12&year=2020&size=24",
    # CURLOPT_URL => "$host_api/api/v1/customerinfo", //Username/Mã Khách Hàng
    # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/invoices?per=$thanggannhat", //Tra cứu các tháng gần nhất

Cấu hình trên hass:

    - platform: rest  
      name: "evn_info"
      resource: http://192.168.97.17/evn/evn_info.php
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

UI:

    type: horizontal-stack
    cards:
      - type: markdown
        content: >
          <center>Thông Tin Đồng Hồ Điện</center> - Tên Khách Hàng:
          {{state_attr('sensor.evn_info','name')}}<br> - Mã Khách Hàng:
          {{state_attr('sensor.evn_info','id')}}<br> - SĐT: {{
          state_attr('sensor.evn_info','phone')}}<br> - Loại Điện :
          {{state_attr('sensor.evn_info','loai_hop_dong')}}<br> - Ngày Dùng :
          {{state_attr('sensor.evn_info','ngay_ki')}}<hr> - Nơi Đăng Ký:
          {{state_attr('sensor.evn_info','electricity_company').name}}<br> - Địa
          Chỉ: {{state_attr('sensor.evn_info','electricity_company').address}}
