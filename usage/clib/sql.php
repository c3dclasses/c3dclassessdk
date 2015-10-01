<?php
$conn = new mysqli("localhost", "root", "", "c3dclassessdk");
$result = $conn->query("SELECT * FROM cdatabasememory");			
$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
if ($outp != "[") {$outp .= ",";}
$outp .= '{"m_strname":"' . $rs["m_strname"] . '",';
$outp .= '"m_value":"' . $rs["m_value"] . '",';
$outp .= '"m_strtype":"'. $rs["m_strtype"] . '"}';
}
$outp .="]";
$conn->close();		
echo($outp);
?>