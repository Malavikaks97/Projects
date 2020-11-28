<?php
session_start();
require("../database.php");
include("header.php");
?>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<?php
extract($_GET);
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
if($submit=='submit' || strlen($subname)>0 )
{
$rs=mysqli_query($cn,"select * from code_syntax where syntax_name='$syntaxname'");
if (mysqli_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1> Already Exists</div>";
	exit;
}

mysqli_query($cn,"INSERT INTO code_syntax
( lang_id, syntax_name, syntax, example, description) 
VALUES ('$id','$syntaxname','$syntax','$description','$example')") 
 or die(mysqli_error());
echo "<p align=center>  <b> \"$syntaxname \"</b> Added Successfully.</p>";
$submit="";
}
?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.subname.value;
if (mt.length<1) {
alert("Please Enter Subject Name");
document.form1.subname.focus();
return false;
}
return true;
}
</script>


<title>Add Subject</title><form name="form1" method="post" onSubmit="return check();">
  <table width="41%"  border="0" align="center">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Syntax Name</strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="syntaxname" type="text" id="subname">
    </tr>
        <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Syntax</strong></div></td>
      <td width="2%" height="5">  

      <td><textarea name="syntax" cols="60" rows="2" id="addsyntax"></textarea></td>
       
    </tr>
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Descrption</strong></div></td>
      <td width="2%" height="5">  

      <td><textarea name="description" cols="60" rows="2" id="description"></textarea></td>
       
    </tr>
     <tr>
      <td width="45%" height="32"><div align="center"><strong>Example</strong></div></td>
      <td width="2%" height="5">  

      <td><textarea name="example" cols="60" rows="2" id="addexample"></textarea></td>
       
    </tr>
    <tr>
        <td height="26"> </td>
        <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="submit" ></td>
    </tr>
  </table>
</form>


<div align="center">

  
<table border = "1"  style="width:90%;" > 
  <tr> 
    <th>slo</th> 
    <th>name</th>  
    <th>Syntax</th> 
    <th>Description</th> 
    <th>Example</th> 
  </tr> 
  <?php 

  $result=mysqli_query($cn,"select * from code_syntax where lang_id='$id' order by syntax_name");
  if (mysqli_num_rows($result)<1)
  {
      echo "<br><br><br><div class=head1> No datas Exists</div>";
     
  }
  
  $i=1;
  while($row=mysqli_fetch_array($result)){
      
      echo "<tr><td>".$i."</td>";
      echo "<td>".$row[2]."</td>";
      echo "<td>".$row[3]."</td>";
      echo "<td>".$row[5]."</td>";
      echo "<td>".$row[4]."</td>";
      echo "</tr>";
      $i=++$i;
  }

  ?>
 
</table> 
</div>


<p>&nbsp; </p>
