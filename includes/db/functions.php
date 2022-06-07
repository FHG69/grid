<?php
function getdata($query,$parameter=""){

	include('includes/db/db.php');

   
    if( $conn ) {
        // echo "Connection established.<br />";
    }else{
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
    }



        $sqlfunctie=$query;
        $params = array($parameter);
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $query , $params, $options );
        $result=array();
        $row_count = sqlsrv_num_rows( $stmt );


            if ($row_count === false)
            echo "Error";
            else

            $i=0;
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                $result[$i]=$row;
                $i++;
            }

            return $result;
			sqlsrv_close($conn);
    }
  
 ?>
