<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Image Gallery</title>
  <link rel="stylesheet" href="lightbox/css/jquery.lightbox-0.5.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <div id="container">
    <div id="heading">
      <h1>A jQuery Gallery</h1>
    </div>
    <div id="gallery">
<?php
  // Name of directory containing the images we want to use in our image gallery
  $directory = 'img';
  // The allowed file formats
  $allowed_types = ['jpg','jpeg','gif','png'];
  $file_parts = [];
  $ext = $title = $nomargin = '';
  $i = 0;

  // Open the directory containing the images
  $dir_handle = @opendir($directory) or die("The $directory folder does not exist");

  // Loop through the files in the opened directory

  while($file = readdir($dir_handle)){
    // Skip links to the current directory and the parent directory
    if($file == '.' || $file == '..')continue;
    // Separate the file name into name and extension and insert into the file_parts array
    $file_parts = explode('.',$file);


    // Store the extension name in the $ext variable
    $ext = strtolower(array_pop($file_parts));

    // Extract the file name,make it html-safe and store the resulting string in the $title variable
    $title = htmlspecialchars(implode('.',$file_parts));


    // Check if this extension is part of allowed extensions
    if(in_array($ext,$allowed_types)){
      if (($i+1)%4==0) {$nomargin='nomargin';}
    // Paste the images in HTML as links in a DIV
        $html = <<<HTML
      <div class = "pic $nomargin" style = "background:url($directory/$file) no-repeat 50% 50%">
        <a href = "$directory/$file" title = "$title" target = "_blank">$title</a>
      </div>

HTML;
    echo $html;

    $i++;
    }

  }
  //Close the directory handle
    closedir($dir_handle);

?>
        <div class="clear"></div>
    </div>
  </div>
<script src="http://localhost/local_CDN/jquery-3.1.1.min.js"></script>
<script src="lightbox/js/jquery.lightbox-0.5.pack.js"></script>
<script src="js/index.js"></script>
</body>

</html>