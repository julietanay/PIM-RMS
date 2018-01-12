
 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" href="css/theme.css" rel="stylesheet">
    </head>
<style type="text/css">
    .row > .column {
  padding: 20px 20px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
 
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-image: url("rmsicons/bg.png");
}

/* Modal Content */
.modal-content {
  position: relative;
  background-image: url("rmsicons/bg2.png");
  margin: auto;
  padding: 50px;
  width: 90%;
  height: 1200px;
  max-width: 1000px;
  max-height: 2000px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

img.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
body{
width: 1250px;
height: 100%;
background-image: url("rmsicons/bg.png");
background-size: cover;
background-repeat: no-repeat;
display: table;
top: 0;
}

</style>
        
        
        <title>Edmin</title>       
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/styleLink.css" rel="stylesheet" rel='stylesheet'>
        <link type="text/css" href="css/styleLink.css" rel='stylesheet'>
<body>

            
          
     
 <?php require_once('../Connections/dbmrov.php'); ?>
 <?php
  if (isset($_GET['fileid'])){
    $file_id=$_GET['fileid'];
    $query=mysql_query("SELECT * FROM file WHERE file_id='$file_id'");
    $file=mysql_fetch_assoc($query);
    $type_id=$file['type_id'];
    $subtype_id=$file['subtype_id'];
    $series_no=$file['series_no'];
    $title=$file['title'];
    $agency=$file['agency'];
?>
          
            
               
                  <div class="module-head">
                  <a href='javascript:history.back(1);'><button class="btn btn-primary">Back
                  </button></a>
                              
<?php
    echo "<center><h2> Title: ".$title."</h2>";
    echo "<h3 class='text-muted'>Series No: ".$series_no."</h3></center>";
    ?>
      <a class="nav pull-right">
                         <img src="rmsicons/rms.png" class="nav-avatar" />
                    </a>
                      </div>
                 
            
        

<?php
    $sql=mysql_query("SELECT * FROM file_image WHERE file_id='$file_id'");
    $count=mysql_num_rows($sql);
    if($count > 0){
    $page=0;
    echo "<div class='row'>";
    while($res=mysql_fetch_array($sql)){
        $f_image=$res['f_image'];
  $page++;
  echo "<div class='column'>";
  echo "<img src='scanned/".$f_image."' height='400px' onclick='openModal();currentSlide(".$page.")' class='hover-shadow'>";
  echo "<h4>Page".$page."</h4>";
  echo "</div>";
  
    }
    echo "</div>";
  

 
 $file_id=$_GET['fileid'];
           echo "<form action='uploadnew.php?file_id=$file_id' method='POST' enctype='multipart/form-data' >";
             ?> 
            <center>
            <br><br>
                    <div>
                      <label class="control-label" for="basicinput">Upload new File</label>
                      <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
                    </div>
                   <br><br>
                <button name="newim" class="btn btn-success span2">Upload</button>
            </center>
           

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

 <?php
  if (isset($_GET['fileid'])){
    $file_id=$_GET['fileid'];
    $sql=mysql_query("SELECT * FROM file_image WHERE file_id='$file_id'");
    $num=0;
    while($res=mysql_fetch_array($sql)){
        $f_image=$res['f_image'];
        $num++;
    echo "<div class='mySlides'>";
    echo "<div class='numbertext'> Page ".$num."</div>";
    echo "<center><img src='scanned/".$f_image."' width='80%' height='100%'></center>";
    echo "</div>";
    }
  }

 ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

  

  </div>
</div>
 </form>
<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<?php
}

    else{
         $file_id=$_GET['fileid'];
           echo "<form action='uploadnew.php?file_id=$file_id' method='POST' enctype='multipart/form-data' >";
             ?> 
            <center>
            <br><br>
                    <div>
                      <label class="control-label" for="basicinput">Upload new File</label>
                      <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
                    </div>
                   <br><br>
                <button name="newim" class="btn btn-success span2">Upload</button>
            </center>
            </form>
<?php
    }
}
?>
</body>
</html>