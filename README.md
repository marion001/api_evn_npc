# api_evn_npc
api lấy dữ liệu đồng hồ điện lực miền bắc
- các bạn tải lên host hoặc (cài apache và cài php, cài thêm cả các php common extensions trên server của bạn) để chạy file api_evn_npc.php
- tiếp đến sửa thông tin 2 dòng sau thành thông tin của bạn:

$makhachhang = "MaKhachHang"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="MatKhauAPP";  // mật khẩu đăng nhập app của bạn
  - ví dụ:
  
$makhachhang = "PA23VG0098765"; // tài khoản/mã khách hàng đăng nhập app của bạn

$matkhau ="12345678";  // mật khẩu đăng nhập app của bạn

các api lấy dữ liệu ở đây:
các bạn dùng api nào thì bỏ dấu # ở đầu api đó đi, và api nào không dùng thì thêm dấu # vào trước api đó nhé

      CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang", //API lấy thông tin khách hàng
    # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/usage_capture_schedules",  
    # CURLOPT_URL => "$host_api/api/v1/customerindex?code=$makhachhang&month=12&year=2020&size=24",
    # CURLOPT_URL => "$host_api/api/v1/customerinfo", //Username/Mã Khách Hàng
    # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/invoices?per=$thanggannhat", //Tra cứu các tháng gần nhất

Cấu hình trên has demo:

    - platform: rest  
      name: "EVN Thông Tin"
      resource: http://192.168.97.17/evn/evn_info.php
      value_template: '{{ value_json.name }}'
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
        - electricity_company
        - usage_counter_id
        - ngay_ki
        - loai_hop_dong
        - gia_ban_dien
        - geoPath

Demo UI:

    type: horizontal-stack
    cards:
      - type: markdown
        content: >
          <center><b>Thông Tin Đồng Hồ Điện</b></center>
          - Chủ Hộ: {{ state_attr('sensor.evn_thong_tin','name')}} <br/>
          - Mã Khách Hàng: {{ state_attr('sensor.evn_thong_tin','id')}}<br/>
          - SĐT: {{ state_attr('sensor.evn_thong_tin','phone')}} <br/>
          - Địa Chỉ: {{ state_attr('sensor.evn_thong_tin','address')}} <br/>
          - Loại Điện: {{ state_attr('sensor.evn_thong_tin','loai_hop_dong')}} <br/>
          - Ngày Đăng Ký: {{ state_attr('sensor.evn_thong_tin','ngay_ki')}} <hr/>
          - Nơi Đăng Ký: {{state_attr('sensor.evn_thong_tin','electricity_company').name}} <br/>
          - Địa Chỉ: {{state_attr('sensor.evn_thong_tin','electricity_company').address}} <br/>

![alt](https://scontent.fhan5-5.fna.fbcdn.net/v/t1.0-9/137065606_2551878698447309_4679071614484975340_n.jpg?_nc_cat=101&ccb=2&_nc_sid=dbeb18&_nc_ohc=heVhn0w3lOoAX9AV-iG&_nc_ht=scontent.fhan5-5.fna&oh=c829e5560495d8b63d904239663708c7&oe=602C022A)
