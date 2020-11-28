<?php
session_start();
require("../database.php");
include("header.php");
?>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<?php

extract($_POST);

echo "<BR>";
if (!isset($_SESSION[alogin]))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}
echo "<BR><h3 class=head1>Subject Add </h3>";

echo "<table width=100%>";
echo "<tr><td align=center></table>";
if(isset($submit))
{
$rs=mysqli_query($cn,"select * from code_subjects where name='$langname'");
if (mysqli_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>Subject is Already Exists</div>";
	exit;
}
mysqli_query($cn,"insert into code_subjects(name,description) values ('$langname','$langdescription')") or die(mysqli_error());
echo "<p align=center>Subject  <b> \"$langname \"</b> Added Successfully.</p>";
$submit="";
}
?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.subname.value;
if (mt.length<1) {
alert("Please Enter Tutorial Name");
document.form1.subname.focus();
return false;
}
return true;
}
</script>
<div>

<title>Add Tutorial</title><form name="form1" method="post" onSubmit="return check();">
  <table width="41%"  border="0" align="center">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Language Name </strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="langname" type="text" id="langname" required>
   
        <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Description </strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="langdescription"  type="text" id="langdescription" multiple="multiple" >
    <tr>
        <td height="26"> </td>
        <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
</div>
<div align="center">

  
<table border = "1"  style="width:90%;" > 
  <tr> 
    <th>slo</th> 
    <th>Laguage</th>  
    <th>Description</th> 
    <th>Action</th> 
  </tr> 
  <?php 
  $result=mysqli_query($cn,"select * from code_subjects order by name");
  if (mysqli_num_rows($result)<1)
  {
      echo "<br><br><br><div class=head1> No datas Exists</div>";
     
  }
  $i=1;
  while($row=mysqli_fetch_array($result)){
      echo "<tr><td>".$i."</td>";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[2]."</td>";
      echo "<td>".'<p align="center" class="style7"><a href=subadd.php?id='.$row[0].'>Add Syntax</a></p>'."</td>";
      echo "</tr>";
      $i=++$i;
  }
  ?>

</table> 
</div>
<p>&nbsp; </p>
