<?php
  if(isset($_POST['categories'])) {
    $json = $_POST['categories'];
    //var_dump($json);
    var_dump(json_decode($json, true));
    
    $monfichier = fopen('test.json', 'w+');
    fputs($monfichier, $json); 

    
  } else {
    echo "Noooooooob";
  }
?>
