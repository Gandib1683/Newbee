<?php
$server='localhost';
$username='root';
$password= '';
$dbname='signuppage';
$con= mysqli_connect($server,$username,$password,$dbname);
if (!$con)
{
echo "Could not connect";
}
else{
    //connnecting code here
    $email=$_POST['email']??null;
    $passwd=$_POST['passwd']??null;
   $sql="INSERT INTO `signuptable`(`email`, `password`) VALUES ('[$email]','[$password]')";
   $result = mysqli_query($con,$sql);
   if($result)
   {
    echo "Data inserted successfully";
   }
   else{
    echo "Error: ";
 }
}
?>