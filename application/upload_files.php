<?php 
function upload_image($data = array()){
  $nama_file = $data['nama_file'];
  $ukuran_file = $data['ukuran_file'];
  $tipe_file = $data['tipe_file'];
  $tmp_file = $data['tmp_file'];
  $trx_code = $data['trx_code'];
  $extensi = explode('.', $nama_file);
  $ext = end($extensi);

  $path = "../".$data['lokasi']."/".$trx_code.".$ext";
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
  return @$msg;
}
?>