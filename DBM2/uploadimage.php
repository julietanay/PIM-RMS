<?php require_once('../Connections/dbmrov.php'); ?>
<?php $conn = new mysqli('localhost', 'root', '', 'dbmrov_db') 
or die ('Cannot connect to db');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
									<form action ="uploadimage.php" method="post" enctype="multipart/form-data">
											<table>
												<tr>
												<td><input type="file" name="file_img" id="file_img" /></td>
												<td><input type="submit" name="btn_upload" id="btn_upload" value="upload"></td>
												</tr>
												</table>
									</form>
												<?php 
												ini_set('memory_limit', '1024M');
												if(isset($_POST['btn_upload']))
												{
													$filetmp = $_FILES["file_img"] ["tmp_name"];
													$filename = $_FILES["file_img"] ["name"];
													$filetype = $_FILES["file_img"] ["type"];
													$filesize = $_FILES["file_img"] ["size"];
													$filepath = "profile/".$filename;
													$extension = explode(".", $filename);	
													$fileExt = $extension[1];
												 if (!preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)){
														echo "image only please!!!";
												}else if ($filesize < 1048576 ){
															$filetmp2 = mysql_real_escape_string(file_get_contents($_FILES["file_img"]["tmp_name"]));
															//echo $filetmp2;
															$sql= "insert into profile_pics (picname, image, picType, perId) values ('".$filename."', '".$filetmp2."', '".$filetype."', 77)";
															$result= mysql_query($sql);
															if($result)
																{
																	echo "inserted";
																}
															else 
																{
																	echo "fail"; 
																}
												}else{
													//$filetmp2 = mysql_real_escape_string(file_get_contents($_FILES["file_img"]["tmp_name"]));
													$maxDim = 1000;
													list($width, $height) = getimagesize($filetmp);
													if ( $width > $maxDim || $height > $maxDim ) 
													{
														$ratio = $width/$height;
														if( $ratio > 1) 
														{
															$new_width = $maxDim;
															$new_height = $maxDim/$ratio;
															echo ' <p></p> '.$new_width;
															echo ' <p></p> '.$new_height;
														}
														else 
														{
															$new_width = $maxDim*$ratio;
															$new_height = $maxDim;
															echo ' <p></p> '.$new_width;
															echo ' <p></p> '.$new_height;
														}
														$img=" ";
														if($fileExt == "gif" || $fileExt == "GIF"){
															$img = imagecreatefromgif($filetmp);
														}else if($fileExt == "png" || $fileExt == "PNG") {
															$img = imagecreatefrompng($filetmp);
														}else if($fileExt == "jpg" || $fileExt == "JPG") {
															$img = imagecreatefromjpeg($filetmp);
														}
																
														$tci= imagecreatetruecolor($new_width,$new_height);
														imagecopyresampled ($tci, $img, 0,0,0,0,$new_width, $new_height, $width, $height  );
														imagedestroy($img);
														imagejpeg($tci, $filetmp, 80 );
														$filetmp3 = mysql_real_escape_string(file_get_contents($filetmp));	
														$sql= "insert into profile_pics (picname, image, picType, perId) values ('".$filename."', '".$filetmp3."', '".$filetype."', 77)";
															$result= mysql_query($sql);
															if($result)
																{
																	echo "inserted";
																}
															else 
																{
																	echo "fail"; 
																}
												}
												}
												}
														?>
															
														
					
							
														
														
</body>
</html> 