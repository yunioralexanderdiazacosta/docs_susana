<?php
$table = 'employees';
if($_GET['paramIni'] != '' && $_GET['paramEnd'] != ''){
   $start = $_GET['paramIni'];
   $end = $_GET['paramEnd'];
   unset($_GET['paramIni'],$_GET['paramEnd']);
}
else{
   $start='';
   $end='';
   unset($_GET['start'],$_GET['end']);
}
$primaryKey = 'id';

$columns = array(
   array( 'db' => '`a`.`name`',      'dt' => 'name', 'field' => 'name' ),
   array( 'db' => '`b`.`position`',  'dt' => 'position', 'field' => 'position' ),
   array( 'db' => '`a`.`office`',    'dt' => 'office', 'field' => 'office' ),
   array( 'db' => '`a`.`age`',       'dt' => 'age',  'field' => 'age' ),
   array( 'db' => '`a`.`startdate`', 'dt' => 'startdate', 'field' => 'startdate' ),
   array( 'db' => '`b`.`salary`',    'dt' => 'salary', 'field' => 'salary' )

);

$sql_details = array(
   'user' => 'root',
   'pass' => 'root',
   'db'   => 'datatable2',
   'host' => 'localhost'
);

require('ssp.customized.class.php' );
$joinQuery = "FROM `employees` AS `a` JOIN `employee_details` AS `b` ON (`b`.`id_employee` = `a`.`id`)";
if($start=='' &&  $end==''){
   $extraWhere = '';
}
else
{
   $extraWhere = "startdate between '".$start."' AND '".$end."'";
}

echo json_encode(
   SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);

?>