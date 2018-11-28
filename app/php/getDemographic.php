<?php 
include("dbconn.php");
$query ="select 
  concat(10*floor(age/10), '-', 10*floor(age/10) + 9) as `age_range`
     , sum( case when user_gender = 'M' then 1 else 0 end )  as male
     , sum( case when user_gender = 'F' then 1 else 0 end )    as female
from 
(select *, TIMESTAMPDIFF(YEAR,user_birthdate,CURDATE()) AS age from User where user_role='U') as t group by `age_range`
	

";

$result = mysqli_query($link,$query) or die(mysqli_error($link));
$demographic=array();
while($row = mysqli_fetch_assoc($result))
{
	array_push($demographic,$row);
}
?>