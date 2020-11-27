<?php
session_start();
require("../database.php");
include("header.php");
?>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<?php

extract($_POST);

echo "<BR>";
if (!isset($_SESSION['alogin']))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}


echo "<table width=100%>";
echo "<tr><td align=center></table>";
extract($_GET);
if(isset($submit))
{
    if(($from==$to)||$syntax1==""||$syntax2==""){
        echo "<br><br><br><div class=head1>Both From and To languages are same.
                 Or Check Selected language has a Syntax Added</div>";
        exit;
    }
   
$rs=mysqli_query($cn,"select * from code_match where (syntax_from=$syntax1 and syntax_to=$syntax2)or
(syntax_from=$syntax2 and syntax_to=$syntax1)");
if (mysqli_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>Subject is Already Exists</div>";
	exit;
}
mysqli_query($cn,"INSERT INTO `code_match`( `lang_from`, `lang_to`, `syntax_from`, `syntax_to`)
 VALUES ($from,$to,$syntax1,$syntax2)") or die(mysqli_error());
echo "<br><br><br><div class=head1>New matching is added.<a href=\"comparitivestudy.php\">Back</a> </div>";
exit;
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

<title>Add A Comparitive Study </title>

    
    <?php 
   extract($_GET);
    if(isset($_GET['search'])){
        
        
        ?>
       
        <h3 class=head1>Add a New Syntax Matching</h3>
       <?php echo "'<form name=form2 method=POST action=comparitivestudy1.php?from=".$from."&to=". $to.">'";?>
    <table width="41%"  border="0" align="center">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Match </strong></div></td>
      
        <?php 
        $i=0;
    $sql="SELECT * FROM code_syntax where lang_id=$from";
    $rs=mysqli_query($cn,$sql);
   
    if(mysqli_num_rows($rs)>0){?>
    <td width="50%" height="32">
        <select name="syntax1" style="width:100%;">
        <?php 
        while($row=mysqli_fetch_array($rs)){
            
            echo "<option value=".$row[0].">".$row[2]."</option>";
            
            
        }
        echo "</select></td></tr>";
    }
    
        else{
            $i=1;
            echo "<td style:width=40%;><div align=center><strong>Please Add Syntax </strong></div></td></tr>"; 
        }
        $sql="SELECT * FROM code_syntax where lang_id=$to";
        $rs=mysqli_query($cn,$sql);?>
        <tr>
        <td width="50%" height="32"><div align="center"><strong>To</strong></div></td>
       <?php  if(mysqli_num_rows($rs)>0){?>
   
     
      <td width="50%" height="32">
     
       <select name="syntax2" style="width:100%;">ss
        <?php
        while($row=mysqli_fetch_array($rs)){
            
            echo "<option value=".$row[0].">".$row[2]."</option>";
            
            
        }
        echo "</select></td></tr>";
    }
    
        else{
            $i=1;
            echo "<td style:width=40%;><div align=center><strong>Please Add Syntax </strong></div></td></tr>"; 
        }
        
    
    if($i==0){
    ?>
    
    <td height="26"></td>
      <td>&nbsp;</td>
      <td width="45%"><input type="submit" name="submit" value="Submit" style="background-color: activeborder; width:100%"></td>
    </td></tr>
    <tr height="50">
    </tr>
    <?php }?>
  </table>
</form>
<?php }?>
</div>
<div align="center">

  
<table border = "1"  style="width:90%;" > 
  <tr> 
    <th>slo</th> 
    <th>Laguage</th>  
    <th>Keyword</th> 
    <th>Syntax</th> 
    <th>Example</th>
    <th>Laguage</th>  
    <th>Keyword</th> 
    <th>Syntax</th>
    <th>Example</th> 
  </tr> 
  <?php 
  $result=mysqli_query($cn,"SELECT * from code_match  where (lang_from=$from and lang_to=$to) or(lang_to=$from and lang_from=$to)");
  if (mysqli_num_rows($result)<1)
  {
      echo "<br><br><br><div class=head1> No datas Exists</div>";
     
  }
  $i=1;
  while($row=mysqli_fetch_array($result)){
     
      echo "<tr><td>".$i."</td>";
      $lang_from=$row[1];
      $result1=mysqli_query($cn,"SELECT * from code_subjects  where id=$lang_from");
      if (mysqli_num_rows($result1)>=1)
      {
      
      while($row1=mysqli_fetch_array($result1)){
      echo "<td>".$row1[1]."</td>";
      
      }}else{
          echo "<td>"."</td>";
      }
      $lang_from=$row[3];
      $result1=mysqli_query($cn,"SELECT * from code_syntax  where id=$lang_from");
      if (mysqli_num_rows($result1)>=1)
      {
          
          while($row1=mysqli_fetch_array($result1)){
              echo "<td>".$row1[2]."</td>";
              echo "<td>".$row1[3]."</td>";
              echo "<td>".$row1[4]."</td>";
          }}else{
              echo "<td>"."</td>";
              echo "<td>"."</td>";
              echo "<td>"."</td>";
          }
          $lang_from=$row[2];
          
          $result1=mysqli_query($cn,"SELECT * from code_subjects  where id=$lang_from");
          if (mysqli_num_rows($result1)>=1)
          {
              
              while($row1=mysqli_fetch_array($result1)){
                  echo "<td>".$row1[1]."</td>";
                  
              }}else{
                  echo "<td>"."</td>";
              }
              $lang_from=$row[4];
              $result1=mysqli_query($cn,"SELECT * from code_syntax  where id=$lang_from");
              if (mysqli_num_rows($result1)>=1)
              {
                  
                  while($row1=mysqli_fetch_array($result1)){
                      echo "<td>".$row1[2]."</td>";
                      echo "<td>".$row1[3]."</td>";
                      echo "<td>".$row1[4]."</td>";
                  }}else{
                      echo "<td>"."</td>";
                      echo "<td>"."</td>";
                      echo "<td>"."</td>";
                  }
//       echo "<td>".$row[2]."</td>";
//       echo "<td>".'<p align="center" class="style7"><a href=subadd.php?id='.$row[0].'>Add Syntax</a></p>'."</td>";
      echo "</tr>";
      $i=++$i;
      
  }
  ?>

</table> 
</div>
<p>&nbsp; </p>
