<?php require_once('../Connections/dbmrov.php'); ?>
<?php
        if(isset($_POST['searchbtn'])){
                $mainsearch = mysql_escape_string($_POST['mainsearch']);
                $sqlsearch = mysql_query("SELECT * FROM file where (series_no Like '%".$mainsearch."') || (title Like '%".$mainsearch."') || (file_date Like '%".$mainsearch."') || (purpose Like '%".$mainsearch."') || (agency Like '%".$mainsearch."')");
                $countresult = mysql_num_rows($sqlsearch);
                
                if($sqlsearch){
                        if($countresult > 0){
                       while($rows = mysql_fetch_array($sqlsearch)){
                        $series_no=$rows['series_no'];
                        $title=$rows['title'];
                        $file_date=$rows['file_date'];
                        $purpose=$rows['purpose'];
                        $agency=$rows['agency'];

                        echo "<table>";
                        echo "<td>". $series_no."</td>";
                        echo "<td>". $title."</td>";
                        echo "<td>". $file_date."</td>";
                        echo "<td>". $purpose."</td>";
                        echo "<td>". $agency."</td>";
                        echo "</table>";
                       }
                }
                        else{
                                echo "No Result";
                        }

                }
                else{
                        echo mysql_error();
                }
        }
?>