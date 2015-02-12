<?php 
$date = date("d_m_Y");
header('Content-Description: File Transfer');
header('Content-Type: application/csv');
header("Content-Disposition: attachment; filename=$tablename"."_$date".".csv");
echo file_get_contents($file);
exit();
?>