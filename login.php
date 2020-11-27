<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Adminstrative</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("header.php");
extract($_POST);
include("../database.php");
if(isset($submit))
{
	
	$rs=mysqli_query($cn,"select * from mst_admin where loginid='$loginid' and pass='$pass'") or die(mysqli_error());
	if(mysqli_num_rows($rs)<1)
	{
		echo "<BR><BR><BR><BR><div class=head1> Invalid User Name or Password<div>";
		exit;
		
	}
	$_SESSION['alogin']="true";
	
}
else if(!isset($_SESSION['alogin']))
{
	echo "<BR><BR><BR><BR><div class=head1> Your are not logged in<br> Please <a href=index.php>Login</a><div>";
		exit;
}
?>

<p class="head1">Welcome to Admistrative Area </p>
<p align="center" class="head1">&nbsp;</p>
<p class="head1">Tutorials</p>
<p align="center" class="style7"><a href="Addtutorial.php">Tutorials</a></p>
<p align="center" class="style7"><a href="comparitivestudy.php">Comparitive Study</a></p>
<p align="center" class="head1">&nbsp;</p>
<p class="head1">Exam Area </p>
<!-- <p align="center" class="style7"><a href="subadd.php">Add Subject</a></p> -->

<p align="center" class="style7"><a href="testadd.php">Add Test</a></p>
<p align="center" class="style7"><a href="questionadd.php">Add Question </a></p>
<p class="head1"> </p>

</body>
<div align="center">

  
<table border = "1"  style="width:90%;" > 
  <tr> 
    <th>slo</th> 
    <th>Username</th>  
    <th>Address</th> 
    <th>City</th> 
    <th>Phone</th>
    <th>Email</th> 
    <th>Login</th> 
    <th>Password</th>  
     <th>ExamScore</th> 
    <th>Performace</th> 
    <th>Rating</th> 
  </tr> 
  <?php 

  $result=mysqli_query($cn,"select * from mst_user order by username");
  if (mysqli_num_rows($result)<1)
  {
      echo "<br><br><br><div class=head1> No datas Exists</div>";
     
  }
  
  $i=1;
  while($row=mysqli_fetch_array($result)){
      $score=0;
      $performance=0;
      $user=$row[1];
      echo "<tr><td>".$i."</td>";
      echo "<td>".$row[3]."</td>";
      echo "<td>".$row[4]."</td>";
      echo "<td>".$row[5]."</td>";
      echo "<td>".$row[6]."</td>";
      echo "<td>".$row[7]."</td>";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[2]."</td>";
      $result2=mysqli_query($cn,"select score from mst_result where login='$user'");
      if (mysqli_num_rows($result2)>0)
      {
          
          while($row2=mysqli_fetch_array($result2)){
              $score=$score+$row2[0];
          }
          
      }
      
      $result2=mysqli_query($cn,"select login from user_login_count where user_id='$user'");
      if (mysqli_num_rows($result2)>0)
      {
          
          while($row2=mysqli_fetch_array($result2)){
              $performance=$performance+$row2[0];
          }
          
      }
     
      $rating=(($i+$performance+$score)/5);
      echo "<td>".$score."</td>";
      echo "<td>".$performance."</td>";
      echo "<td>".$rating."</td>";
      echo "</tr>";
      $i=++$i;
  }

  ?>
 
</table> 
</div>
</html>
