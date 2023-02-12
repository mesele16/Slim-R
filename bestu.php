<?php 

// connect and login to FTP server
$ftp_server = "ftpupload.net";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, 'epiz_33405341', "mMV8BXAESL9asPD");
ftp_pasv($ftp_conn, true);



// $file = "vendor/autoload.php";
  ftp_chdir($ftp_conn,"htdocs");
  ftp_rename($ftp_conn, "vendor", "vendor".uniqid());

  // echo ftp_pwd($ftp_conn);
// return;

  echo "working";

function uploadM($connection ,$path="vendor"){
  // return;
  if (is_dir($path)) {
    if (ftp_mkdir ($connection ,$path )){
          // echo "successfully created $path \n ";
        }
        else{
          echo "make dir fails.";
        }
        $d = dir($path);
        // print_r($d);

        while (( $entry = $d -> read()) !== FALSE ) {
          if (( $entry !="." )&& ($entry != ".." )) {
            if (is_dir($path."/".$entry)) {
              // print_r($path."/".$entry."</br>");
              uploadM ($connection ,$path."/".$entry );
            }
            else{
              if (ftp_put ($connection ,$path."/".$entry, $path."/".$entry ,FTP_BINARY )) {
                // echo "upload file $path /$entry sucess \n" ;
              }
              else{
                // echo "upload file $path /$entry fail \n" ;
              }
            }
          }
        }
  }
  else {
    if (ftp_put ( $connection, $path, $path, FTP_BINARY )){
      echo "upload file $path $path sucess \n" ;}
      else{
        echo "upload file $path $path fail \n ";}
      }
}


uploadM($ftp_conn,"vendor");



 ?>