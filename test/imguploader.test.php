<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>DigiGem Dev</title>
	</head>
	<body>
		<p>
			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				include '../ImgUploader.class.php';
				
				$img = new imgUploader($_FILES['file']);
				$time = time();
				$thumb = $img->upload('imgupload/test/images/', $time.'_thumb', 100,100);
				$small = $img->upload('imgupload/test/images/', $time.'_small', 400,400);
				$full = $img->upload_unscaled('imgupload/test/images/', $time);
				if($thumb && $small && $full)
				  echo '<img src="'.$thumb.'" alt="aPicture" /> <img src="'.$small.'" alt="aPicture" /> <img src="'.$full.'" alt="aPicture" />';
				else
				  echo 'ERROR! '.$img->getError();


			} else echo 'Upload an Image';
			?>
		</p>
		<form action="" method="POST" enctype="multipart/form-data">
			<p>
				<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
				<input type="file" name="file" />
				<input type="submit" value="Upload File" />
			</p>
		</form>
	</body>
</html>
