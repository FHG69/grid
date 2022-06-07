<!DOCTYPE html>
<html lang='nl'>
<head>
<link href="includes/font-awesome/css/font-awesome.min.css"  rel="stylesheet">
<link href="includes/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="includes/css/style.css" rel="stylesheet" >
<script src="includes/js/jquery-1.11.1.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script type="text/javascript" src="includes/js/xlsx.full.min.js"></script>
<script src="includes/js/scripts.js"></script>

<meta charset="utf-8">

<title>Dynamic listview</title>

</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/db/db.php');
include("includes/db/functions.php");
?>

<div class="container">
   <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="logo"><img src="includes/img/logo.png"  width="60"></span><i class="fa fa-database " ></i> FHG</h3>
                <div class="pull-right"><i class="fa fa-search fa-lg" aria-hidden="true" ></i>
				<input style="color:black;" onclick="remove(this)"  type="search" id="myInput" placeholder="Quick search..." title="Quick search..." autocomplete="off">
		        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button>
                </div>
            </div>
            <table id="myTable" class="table">
                <thead>
                    <tr class="filters">
<?php
	$dataset=array();
	$qry_dataset="SELECT
					tbl_p_trailer.trailer, LEFT(CONVERT(varchar,tbl_p_pendels.planning_t),5) AS Planning, tbl_p_handelingen.handeling, tbl_p_lading.lading
					FROM tbl_p_pendels INNER JOIN tbl_p_trailer ON tbl_p_pendels.id_trailer = tbl_p_trailer.id INNER JOIN
					tbl_p_handelingen ON tbl_p_pendels.id_handeling = tbl_p_handelingen.id INNER JOIN
					tbl_p_lading ON tbl_p_pendels.id_lading = tbl_p_lading.id order by tbl_p_pendels.planning_t";
	$dataset=getdata($qry_dataset);
    $numColumns = count($dataset[0]); //Aantal kolommen in Array
    $numRows = count($dataset); //Aantal rows in Arry
    $columnsNames = array_keys($dataset[0]); //Kolomnamen uit Array naar aparte Array
	for ($k=0;$k< $numColumns;$k++) // Loop kolomnamen 
		{
		echo  "<th><input type=\"text\" class=\"form-control\" placeholder=\"".strtoupper($columnsNames[$k])."\" disabled></th>\r\n";
		}
	echo "</tr>\r\n<tr>\r\n";
	for ($k=0;$k< $numColumns;$k++) // Loop kolomnamen 
		{
		echo  "<td style=\"display:none;\">".ucfirst($columnsNames[$k])."</td>\r\n"; // Deze bestaat alleen om de kolomnamen in export te krijgen.
		}
	echo "</tr>\r\n</thead>\r\n<tbody>\r\n";
	
	
	for ($j=0;$j<$numRows;$j++) // Loop rows
		{
			echo "<tr>";
			for ($k=0;$k< $numColumns;$k++) // Loop kolommen
				{
				/*Minimale dataweergave*/
				echo "<TD onclick=\"copyToClipboard(this.innerText)\">".$dataset[$j][$columnsNames[$k]]."</TD>"; //Minimale dataweergave
				
				  
				/*Freewheelen met data, rekenen, kleuren, ed.*/
				/* if($dataset[$j][$columnsNames[$k]]=="Lege RC")	
					{
					echo "<td class=\"red\">".$dataset[$j][$columnsNames[$k]]."</td>";	
					}
					ELSE
					{
					echo "<td>".$dataset[$j][$columnsNames[$k]]."</td>";
					} */
				/*Tot hier*/
				}
				echo "</tr>\r\n";
			}
?>
</tbody>

</table>
</div>
</div>
</div>
<button onclick="scrolltop()" id="myBtn" title="Go  to top">Top</button>
<a name="scroll"></a>
<button onclick="ExportToExcel('xlsx')" id="myBtn2Excel"><img src="includes/img/export2excel.png" height="30"></button>
<script>

// moet einde DOM anders bestaat #myInput nog niet
document.querySelector('#myInput').addEventListener('keyup', filterTable, false);
var elem = document.getElementById('myInput');
elem.value='ddc';
filterTable('myInput');
</script>
</body>
</html>