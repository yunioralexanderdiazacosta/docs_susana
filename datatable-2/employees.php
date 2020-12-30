<?php
require('connect_db.php');
$table = 'employees';
if($_GET['paramIni'] != '' && $_GET['paramEnd'] != ''){
   $start = $_GET['paramIni'];
   $end = $_GET['paramEnd'];
   unset($_GET['paramIni'],$_GET['paramEnd']);
}
else{
   $start='';
   $end='';
   unset($_GET['paramIni'],$_GET['paramEnd']);
}


$primaryKey = 'id';

$columns = array(
   array( 'db' => 'name',      'dt' => 'name', 'field' => 'name' ),
   array( 'db' => 'position',  'dt' => 'position', 'field' => 'position' ),
   array( 'db' => 'office',    'dt' => 'office', 'field' => 'office' ),
   array( 'db' => 'age',       'dt' => 'age',  'field' => 'age' ),
   array( 'db' => 'startdate', 'dt' => 'startdate', 'field' => 'startdate' ),
   array( 'db' => 'id',  'dt' => 'id', 'field' => 'id' )

);

$sql_details = array(
   'user' => $user,
   'pass' => $pass,
   'db'   => $db,
   'host' => $host
);

require('ssp.customized.class.php' );

if($start=='' &&  $end==''){
   $extraWhere = '';
}
else
{
   $extraWhere = "startdate between '".$start."' AND '".$end."'";
}
 
echo json_encode(
   SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, NULL, $extraWhere)
);
?>