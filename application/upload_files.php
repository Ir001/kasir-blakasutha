<?php 
function upload_image($data = array()){
  $nama_file = $data['nama_file'];
  $ukuran_file = $data['ukuran_file'];
  $tipe_file = $data['tipe_file'];
  $tmp_file = $data['tmp_file'];
  $trx_code = $data['trx_code'];

  $path = "../".$data['lokasi']."/".$trx_code.".jpg";

  if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
    if($ukuran_file <= 1000000){ 
      if(move_uploaded_file($tmp_file, $path)){ 
        $msg = array(
          'success' => true,
          'message' => 'Berhasil upload!',
          'image' => $path,
        );  

      }else{
        $msg = array(
          'success' => false,
          'message' => 'Terjadi kesalahan saat upload!',
          'image' => $path,

        ); 
      }
    }else{
      $msg = array(
        'success' => false,
        'message' => 'Ukuran file terlalu besar!',
        'image' => $path,
      ); 
    }
  }else{
    $msg = array(
      'success' => false,
      'message' => 'File upload tidak berfungsi!',
      'image' => $path,

    ); 
  }
  return @$msg;
}
?>