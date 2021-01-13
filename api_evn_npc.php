<?php
#Code By: Marion001
#Youtube: https://www.youtube.com/c/Marion001
#Fb: https://www.facebook.com/TWFyaW9uMDAx
#Page: https://www.facebook.com/Party.Marion002
#######################################################################################
$makhachhang = "MaKhachHang"; // tài khoản/mã khách hàng đăng nhập app của bạn.########
$matkhau = "MatKhauAPP";  // mật khẩu đăng nhập app của bạn                    ########
#######################################################################################
$thanggannhat = "6"; // Tra cứu tiền điện các tháng gần nhất, đặt 6 là 6 tháng gần nhất, đặt 10 là 10 tháng gần nhất
$host_api = "http://116.212.40.6"; // Hoặc http://appapiauth.cskh.npc.com.vn
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "$host_api/oauth/token?grant_type=password&username=$makhachhang&password=$matkhau",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
"Content-Length: 0",
"Host: appapiauth.cskh.npc.com.vn",
"Connection: Keep-Alive",
"Accept-Encoding: gzip",
"User-Agent: okhttp/3.8.0",
"Accept: application/json;charset=UTF-8",
"Content-Type: application/x-www-form-urlencoded",
"Authorization: Basic dGVzdGp3dGNsaWVudGlkOlhZN2ttem9OemwxMDA=",
"X-Channel-Id: android"),));
$dulieu = curl_exec($curl);
$loi1 = curl_error($curl);
curl_close($curl);
if ($loi1) {
  echo "cURL POST L&#7895;i L&#7845;y Token #:" . $loi1;
} else { //echo $dulieu; 
}
$tachchuoi = explode('{"access_token":"', $dulieu);
$tachchuoi1 = explode('","token_type":"bearer","', $tachchuoi[1]);  
$curl1 = curl_init();
curl_setopt_array($curl1, array(
  CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang", //API lấy thông tin khách hàng
 # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/usage_capture_schedules",  
 # CURLOPT_URL => "$host_api/api/v1/customerindex?code=$makhachhang&month=12&year=2020&size=24",
 # CURLOPT_URL => "$host_api/api/v1/customerinfo", //Username/Mã Khách Hàng
 # CURLOPT_URL => "$host_api/api/mw/customers/$makhachhang/invoices?per=$thanggannhat", //Tra cứu các tháng gần nhất
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
  "Host: appapiauth.cskh.npc.com.vn",
  "Connection: Keep-Alive",
  "Accept-Encoding: gzip",
  "User-Agent: okhttp/3.8.0",
  "Accept: application/json;charset=UTF-8",
  "Content-Type: application/x-www-form-urlencoded",
  "Authorization: Bearer $tachchuoi1[0]",
  "X-Channel-Id: android",
  ),
));
$ketquajson = curl_exec($curl1);
$loi = curl_error($curl1);
curl_close($curl1);
if ($loi) {
  echo "cURL Get L&#7895;i L&#7845;y Th&#244;ng Tin D&#7919; Li&#7879;u #:" . $loi;
} else { echo $ketquajson; }

?>
