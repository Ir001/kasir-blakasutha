<?php 
function upload_image($data = array()){
  $nama_file = $data['nama_file'];
  $ukuran_file = $data['ukuran_file'];
  $tipe_file = $data['tipe_file'];
  $tmp_file = $data['tmp_file'];
  $trx_code = $data['trx_code'];
  $type = $data['type'];

  $path = "../".$data['lokasi']."/".$trx_code."_".$type.".jpg";

  if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
    if($ukuran_file <= 2500000){ 
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
        'message' => 'Ukuran file harus kurang dari 2MB!',
        'image' => $path,
      ); 
    }
  }else{
    $msg = array(
      'success' => false,
      'message' => 'Tipe file tidak diijinkan!',
      'image' => $path,

    ); 
  }
  return @$msg;
}
?>