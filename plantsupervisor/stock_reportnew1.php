<?php
session_start();
if (!isset($_SESSION['sessionadmin'])) {
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
}  else {
	$logid = $_SESSION['logid'];
}

require_once("../include/config.php");
require_once("../include/connection.php");

 $connnew = mysqli_connect("172.16.16.52", "root", "kvy782dragon201") or die("Error:" . mysqli_error($connnew));
 $dbnew = mysqli_select_db($connnew, "seedtracwms_hyd") or die("Error:" . mysqli_error($connnew));

// empty table
$truncate_query = "DELETE FROM tmp_pmstrep WHERE replogid = '$logid'";
mysqli_query($link, $truncate_query) or die(mysqli_error($link));

$crop = $_REQUEST['txtcrop'];
$variety = $_REQUEST['txtvariety'];
$slchk = $_REQUEST['slchk'];
$slchk2 = $_REQUEST['slchk2'];
$sdate = $_REQUEST['sdate'];
$txtplant = $_REQUEST['txtplant'];

if (!isset($crop) || !isset($variety)) {
	die("Crop ID or Variety ID is not set.");
}

$condition = "1=1";

if ($crop != "ALL") {
	$condition .= " AND crop.cropid = $crop";
}

if ($variety != "ALL") {
	$condition .= " AND variety.varietyid = $variety";
}


$query = "SELECT 
		crop.cropid, 
		crop.cropname, 
		variety.varietyid, 
		variety.popularname,
		crop.croptype
	FROM tblcrop AS crop 
	JOIN tblvariety AS variety ON variety.cropname = crop.cropid 
	WHERE $condition
	GROUP BY crop.cropid, variety.varietyid";

$sqlcrop = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($sqlcrop) === 0) {
	die("No records found for the given Crop ID and Variety ID.");
}

$table = [];
foreach ($sqlcrop as $rowcrop) {

	//Deorjhal
	
	$djl_query = "SELECT 
		SUM(CASE WHEN t1.lotldg_sstage = 'Raw' THEN t1.lotldg_balqty ELSE 0 END) AS raw_balqty,
		SUM(CASE WHEN t1.lotldg_sstage = 'Condition' THEN t1.lotldg_balqty ELSE 0 END) AS condition_balqty
	FROM 
		tbl_lot_ldg t1
	JOIN (
		SELECT 
			lotldg_lotno,
			lotldg_subbinid,
			MAX(lotldg_id) AS max_lotldg_id
		FROM 
			tbl_lot_ldg
		WHERE 
			plantcode = 'D' AND
			lotldg_crop = $rowcrop[cropid] AND
			lotldg_variety = $rowcrop[varietyid] AND
			lotldg_sstage IN ('Raw', 'Condition')
		GROUP BY 
			lotldg_lotno, 
			lotldg_subbinid
	) t2 
	ON 
		t1.lotldg_lotno = t2.lotldg_lotno
		AND t1.lotldg_subbinid = t2.lotldg_subbinid
		AND t1.lotldg_id = t2.max_lotldg_id
	WHERE 
		t1.plantcode = 'D'
		AND t1.lotldg_crop = $rowcrop[cropid]
		AND t1.lotldg_variety = $rowcrop[varietyid]
		AND t1.lotldg_sstage IN ('Raw', 'Condition')";

	$djl_result = mysqli_query($link, $djl_query) or die(mysqli_error($link));
	if (mysqli_num_rows($djl_result) > 0) {
		$row = mysqli_fetch_assoc($djl_result);
		if($row['raw_balqty']>0){$djl_raw_balqty = $row['raw_balqty'];} else { $djl_raw_balqty = 0;}
		if($row['condition_balqty']>0){$djl_condition_balqty = $row['condition_balqty'];} else { $djl_condition_balqty = 0;}
		//$djl_condition_balqty = $row['condition_balqty'] ?? 0;
	} else {
		$djl_raw_balqty = 0;
		$djl_condition_balqty = 0;
	}

	$djl_query = "SELECT 
		SUM(t1.balqty) AS balqty
	FROM
		tbl_lot_ldg_pack t1
	JOIN (
		SELECT 
			lotno,
			subbinid,
			MAX(lotdgp_id) AS lotdgp_id
		FROM 
			tbl_lot_ldg_pack
		WHERE 
			plantcode = 'D' AND
			lotldg_crop = $rowcrop[cropid] AND
			lotldg_variety = $rowcrop[varietyid]
		GROUP BY 
			lotno, 
			subbinid
	) t2
	ON 
		t1.lotno = t2.lotno
		AND t1.subbinid = t2.subbinid
		AND t1.lotdgp_id = t2.lotdgp_id
	WHERE 
		t1.plantcode = 'D'
		AND t1.lotldg_crop = $rowcrop[cropid]
		AND t1.lotldg_variety = $rowcrop[varietyid]";

	$djl_result = mysqli_query($link, $djl_query) or die(mysqli_error($link));
	if (mysqli_num_rows($djl_result) > 0) {
		$row = mysqli_fetch_assoc($djl_result);
		if($row['balqty']>0){$djl_pack_balqty = $row['balqty'];} else { $djl_pack_balqty = 0;}
		//$djl_pack_balqty = $row['balqty'] ?? 0;
	} else {
		$djl_pack_balqty = 0;
	}
	

	$djl_query = "SELECT 
		SUM(t3.salesrss_qty) AS total_salesrss_qty
	FROM
		tbl_salesrv_sub t1
	JOIN
		tbl_salesrv_sub t2 ON t1.salesrs_orlot = t2.salesrs_orlot
	JOIN
		tbl_salesrvsub_sub t3 ON t2.salesrs_id = t3.salesrs_id
	LEFT JOIN
		tbl_srrevalidate t4 ON t4.srrv_lotno = t1.salesrs_orlot
	LEFT JOIN
		tbl_unpsp2c t5 ON t5.unp_lotno = t1.salesrs_orlot
	WHERE 
		t1.salesrs_crop = $rowcrop[cropid] 
		AND t1.salesrs_variety = $rowcrop[varietyid] 
		AND t1.plantcode = 'D'
		AND t1.salesrs_rettype = 'P2P' 
		AND t3.salesrss_qty > 0
		AND t4.srrv_lotno IS NULL
		AND t5.unp_lotno IS NULL";

	$djl_result = mysqli_query($link, $djl_query) or die(mysqli_error($link));

	if (mysqli_num_rows($djl_result) > 0) {
		$row = mysqli_fetch_assoc($djl_result);
		if($row['total_salesrss_qty']>0){$djl_srs_qty = $row['total_salesrss_qty'];} else { $djl_srs_qty = 0;}
		//$djl_srs_qty = $row['total_salesrss_qty'] ?? 0;
	} else {
		$djl_srs_qty = 0;
	}

	if ($rowcrop['croptype'] == 'Field Crop') {

		//Boriya

		$boriya_query = "SELECT 
			SUM(CASE WHEN t1.lotldg_sstage = 'Raw' THEN t1.lotldg_balqty ELSE 0 END) AS raw_balqty,
			SUM(CASE WHEN t1.lotldg_sstage = 'Condition' THEN t1.lotldg_balqty ELSE 0 END) AS condition_balqty
		FROM 
			tbl_lot_ldg t1
		JOIN (
			SELECT 
				lotldg_lotno,
				lotldg_subbinid,
				MAX(lotldg_id) AS max_lotldg_id
			FROM 
				tbl_lot_ldg
			WHERE 
				plantcode = 'B' AND
				lotldg_crop = $rowcrop[cropid] AND
				lotldg_variety = $rowcrop[varietyid] AND
				lotldg_sstage IN ('Raw', 'Condition')
			GROUP BY 
				lotldg_lotno, 
				lotldg_subbinid
		) t2 
		ON 
			t1.lotldg_lotno = t2.lotldg_lotno
			AND t1.lotldg_subbinid = t2.lotldg_subbinid
			AND t1.lotldg_id = t2.max_lotldg_id
		WHERE 
			t1.plantcode = 'B'
			AND t1.lotldg_crop = $rowcrop[cropid]
			AND t1.lotldg_variety = $rowcrop[varietyid]
			AND t1.lotldg_sstage IN ('Raw', 'Condition')";

		$boriya_result = mysqli_query($link, $boriya_query) or die(mysqli_error($link));
		if (mysqli_num_rows($boriya_result) > 0) {
			$row = mysqli_fetch_assoc($boriya_result);
			if($row['raw_balqty']>0){$boriya_raw_balqty = $row['raw_balqty'];} else { $boriya_raw_balqty = 0;}
			if($row['condition_balqty']>0){$boriya_condition_balqty = $row['condition_balqty'];} else { $boriya_condition_balqty = 0;}
			//$boriya_raw_balqty = $row['raw_balqty'] ?? 0;
			//$boriya_condition_balqty = $row['condition_balqty'] ?? 0;
		} else {
			$boriya_raw_balqty = 0;
			$boriya_condition_balqty = 0;
		}

		$boriya_query = "SELECT 
			SUM(t1.balqty) AS balqty
		FROM
			tbl_lot_ldg_pack t1
		JOIN (
			SELECT 
				lotno,
				subbinid,
				MAX(lotdgp_id) AS lotdgp_id
			FROM 
				tbl_lot_ldg_pack
			WHERE 
				plantcode = 'B' AND
				lotldg_crop = $rowcrop[cropid] AND
				lotldg_variety = $rowcrop[varietyid]
			GROUP BY 
				lotno, 
				subbinid
		) t2
		ON 
			t1.lotno = t2.lotno
			AND t1.subbinid = t2.subbinid
			AND t1.lotdgp_id = t2.lotdgp_id
		WHERE 
			t1.plantcode = 'B'
			AND t1.lotldg_crop = $rowcrop[cropid]
			AND t1.lotldg_variety = $rowcrop[varietyid]";

		$boriya_result = mysqli_query($link, $boriya_query) or die(mysqli_error($link));
		if (mysqli_num_rows($boriya_result) > 0) {
			$row = mysqli_fetch_assoc($boriya_result);
			if($row['balqty']>0){$boriya_pack_balqty = $row['balqty'];} else { $boriya_pack_balqty = 0;}
			//$boriya_pack_balqty = $row['balqty'] ?? 0;
		} else {
			$boriya_pack_balqty = 0;
		}
		

		$boriya_query = "SELECT 
			SUM(t3.salesrss_qty) AS total_salesrss_qty
		FROM
			tbl_salesrv_sub t1
		JOIN
			tbl_salesrv_sub t2 ON t1.salesrs_orlot = t2.salesrs_orlot
		JOIN
			tbl_salesrvsub_sub t3 ON t2.salesrs_id = t3.salesrs_id
		LEFT JOIN
			tbl_srrevalidate t4 ON t4.srrv_lotno = t1.salesrs_orlot
		LEFT JOIN
			tbl_unpsp2c t5 ON t5.unp_lotno = t1.salesrs_orlot
		WHERE 
			t1.salesrs_crop = $rowcrop[cropid] 
			AND t1.salesrs_variety = $rowcrop[varietyid] 
			AND t1.plantcode = 'B'
			AND t1.salesrs_rettype = 'P2P' 
			AND t3.salesrss_qty > 0
			AND t4.srrv_lotno IS NULL
			AND t5.unp_lotno IS NULL";
		$boriya_result = mysqli_query($link, $boriya_query) or die(mysqli_error($link));
		if (mysqli_num_rows($boriya_result) > 0) {
			$row = mysqli_fetch_assoc($boriya_result);
			if($row['total_salesrss_qty']>0){$boriya_srs_qty = $row['total_salesrss_qty'];} else { $boriya_srs_qty = 0;}
			//$boriya_srs_qty = $row['total_salesrss_qty'] ?? 0;
		} else {
			$boriya_srs_qty = 0;
		}

		//Hyd

		if(isset($connnew))
		{

			echo $hyd_query = "SELECT 
				SUM(CASE WHEN t1.lotldg_sstage = 'Raw' THEN t1.lotldg_balqty ELSE 0 END) AS raw_balqty,
				SUM(CASE WHEN t1.lotldg_sstage = 'Condition' THEN t1.lotldg_balqty ELSE 0 END) AS condition_balqty
			FROM 
				tbl_lot_ldg t1
			JOIN (
				SELECT 
					lotldg_lotno,
					lotldg_subbinid,
					MAX(lotldg_id) AS max_lotldg_id
				FROM 
					tbl_lot_ldg
				WHERE 
					lotldg_crop = $rowcrop[cropid] AND
					lotldg_variety = $rowcrop[varietyid] AND
					lotldg_sstage IN ('Raw', 'Condition')
				GROUP BY 
					lotldg_lotno, 
					lotldg_subbinid
			) t2 
			ON 
				t1.lotldg_lotno = t2.lotldg_lotno
				AND t1.lotldg_subbinid = t2.lotldg_subbinid
				AND t1.lotldg_id = t2.max_lotldg_id
			WHERE 
				t1.lotldg_crop = $rowcrop[cropid]
				AND t1.lotldg_variety = $rowcrop[varietyid]
				AND t1.lotldg_sstage IN ('Raw', 'Condition')";

			$hyd_result = mysqli_query($connnew, $hyd_query) or die(mysqli_error($connnew));
			if (mysqli_num_rows($hyd_result) > 0) {
				$row = mysqli_fetch_assoc($hyd_result);
				if($row['raw_balqty']>0){$hyd_raw_balqty = $row['raw_balqty'];} else { $hyd_raw_balqty = 0;}
				if($row['condition_balqty']>0){$hyd_condition_balqty = $row['condition_balqty'];} else { $hyd_condition_balqty = 0;}
				//$hyd_raw_balqty = $row['raw_balqty'] ?? 0;
				//$hyd_condition_balqty = $row['condition_balqty'] ?? 0;
			} else {
				$hyd_raw_balqty = 0;
				$hyd_condition_balqty = 0;
			}

			$hyd_query = "SELECT 
				SUM(t1.balqty) AS balqty
			FROM
				tbl_lot_ldg_pack t1
			JOIN (
				SELECT 
					lotno,
					subbinid,
					MAX(lotdgp_id) AS lotdgp_id
				FROM 
					tbl_lot_ldg_pack
				WHERE 
					lotldg_crop = $rowcrop[cropid] AND
					lotldg_variety = $rowcrop[varietyid]
				GROUP BY 
					lotno, 
					subbinid
			) t2
			ON 
				t1.lotno = t2.lotno
				AND t1.subbinid = t2.subbinid
				AND t1.lotdgp_id = t2.lotdgp_id
			WHERE 
				t1.lotldg_crop = $rowcrop[cropid]
				AND t1.lotldg_variety = $rowcrop[varietyid]";

			$hyd_result = mysqli_query($connnew, $hyd_query) or die(mysqli_error($connnew));
			if (mysqli_num_rows($hyd_result) > 0) {
				$row = mysqli_fetch_assoc($hyd_result);
				if($row['balqty']>0){$hyd_pack_balqty = $row['balqty'];} else { $hyd_pack_balqty = 0;}
				//$hyd_pack_balqty = $row['balqty'] ?? 0 ;
			} else {
				$hyd_pack_balqty = 0;
			}
			

			$hyd_query = "SELECT 
				SUM(t3.salesrss_qty) AS total_salesrss_qty
			FROM
				tbl_salesrv_sub t1
			JOIN
				tbl_salesrv_sub t2 ON t1.salesrs_orlot = t2.salesrs_orlot
			JOIN
				tbl_salesrvsub_sub t3 ON t2.salesrs_id = t3.salesrs_id
			LEFT JOIN
				tbl_srrevalidate t4 ON t4.srrv_lotno = t1.salesrs_orlot
			LEFT JOIN
				tbl_unpsp2c t5 ON t5.unp_lotno = t1.salesrs_orlot
			WHERE 
				t1.salesrs_crop = $rowcrop[cropid] 
				AND t1.salesrs_variety = $rowcrop[varietyid] 
				AND t1.salesrs_rettype = 'P2P' 
				AND t3.salesrss_qty > 0
				AND t4.srrv_lotno IS NULL
				AND t5.unp_lotno IS NULL";
			$hyd_result = mysqli_query($connnew, $hyd_query) or die(mysqli_error($connnew));
			if (mysqli_num_rows($hyd_result) > 0) {
				$row = mysqli_fetch_assoc($hyd_result);
				if($row['total_salesrss_qty']>0){$hyd_srs_qty = $row['total_salesrss_qty'];} else { $hyd_srs_qty = 0;}
				//$hyd_srs_qty = $row['total_salesrss_qty'] ?? 0;
			} else {
				$hyd_srs_qty = 0;
			}

		} else {
			$hyd_raw_balqty = 0;
			$hyd_condition_balqty = 0;
			$hyd_pack_balqty = 0;
			$hyd_srs_qty = 0;
		}


	} else {
		$boriya_raw_balqty = 0;
		$boriya_condition_balqty = 0;
		$boriya_pack_balqty = 0;
		$boriya_srs_qty = 0;

		$hyd_raw_balqty = 0;
		$hyd_condition_balqty = 0;
		$hyd_pack_balqty = 0;
		$hyd_srs_qty = 0;
	}


	$djl_total = $djl_raw_balqty + $djl_condition_balqty + $djl_pack_balqty + $djl_srs_qty;
	$boriya_total = $boriya_raw_balqty + $boriya_condition_balqty + $boriya_pack_balqty + $boriya_srs_qty;
	$hyd_total = $hyd_raw_balqty + $hyd_condition_balqty + $hyd_pack_balqty + $hyd_srs_qty;

	$total_raw_balqty = $djl_raw_balqty + $boriya_raw_balqty + $hyd_raw_balqty;
	$total_condition_balqty = $djl_condition_balqty + $boriya_condition_balqty + $hyd_condition_balqty;
	$total_pack_balqty = $djl_pack_balqty + $boriya_pack_balqty + $hyd_pack_balqty;
	$total_srs_qty = $djl_srs_qty + $boriya_srs_qty + $hyd_srs_qty;
	$total_qty = $djl_total + $boriya_total + $hyd_total;


	$table[] = [
		'cropid' => $rowcrop['cropid'],
		'cropname' => $rowcrop['cropname'],
		'varietyid' => $rowcrop['varietyid'],
		'popularname' => $rowcrop['popularname'],
		'djl_raw_balqty' => $djl_raw_balqty,
		'djl_condition_balqty' => $djl_condition_balqty,
		'djl_pack_balqty' => $djl_pack_balqty,
		'djl_srs_qty' => $djl_srs_qty,
		'djl_total' => $djl_total,
		'boriya_raw_balqty' => $boriya_raw_balqty,
		'boriya_condition_balqty' => $boriya_condition_balqty,
		'boriya_pack_balqty' => $boriya_pack_balqty,
		'boriya_srs_qty' => $boriya_srs_qty,
		'boriya_total' => $boriya_total,
		'hyd_raw_balqty' => $hyd_raw_balqty,
		'hyd_condition_balqty' => $hyd_condition_balqty,
		'hyd_pack_balqty' => $hyd_pack_balqty,
		'hyd_srs_qty' => $hyd_srs_qty,
		'hyd_total' => $hyd_total,
		'total_raw_balqty' => $djl_raw_balqty + $boriya_raw_balqty + $hyd_raw_balqty,
		'total_condition_balqty' => $djl_condition_balqty + $boriya_condition_balqty + $hyd_condition_balqty,
		'total_pack_balqty' => $djl_pack_balqty + $boriya_pack_balqty + $hyd_pack_balqty,
		'total_srs_qty' => $djl_srs_qty + $boriya_srs_qty + $hyd_srs_qty,
		'total_qty' => $djl_total + $boriya_total + $hyd_total,
	];

	// $sql_rep = "Insert into tmp_pmstrep (crop, variety, drawqty, dconqty, dpackqty, dsrqty, dtotalqty, brawqty, bconqty, bpackqty, bsrqty, btoaltqty, hrawqty, hconqty, hpackqty, hsrqty, htotalqty, grawqty, gconqty, gpackqty, gsrqty, gtotalqty, repflg, replogid) values ('$crop_name', '$verty', '$dtotrqty', '$dtotcqty', '$dtotpqty', '$dtotsrqty', '$dtqty', '$btotrqty', '$btotcqty', '$btotpqty', '$btotsrqty', '$btqty', '$htotrqty', '$htotcqty', '$htotpqty', '$htotsrqty', '$htqty', '$grandtotrqty', '$grandtotcqty', '$grandtotpqty', '$grandtotsrqty', '$grandtotqty', '1', '$logid')";

	// insert
	$insert_query = "Insert into tmp_pmstrep (crop, variety, drawqty, dconqty, dpackqty, dsrqty, dtotalqty, brawqty, bconqty, bpackqty, bsrqty, btoaltqty, hrawqty, hconqty, hpackqty, hsrqty, htotalqty, grawqty, gconqty, gpackqty, gsrqty, gtotalqty, repflg, replogid) values ('$rowcrop[cropname]', '$rowcrop[popularname]', '$djl_raw_balqty', '$djl_condition_balqty', '$djl_pack_balqty', '$djl_srs_qty', '$djl_total', '$boriya_raw_balqty', '$boriya_condition_balqty', '$boriya_pack_balqty', '$boriya_srs_qty', '$boriya_total', '$hyd_raw_balqty', '$hyd_condition_balqty', '$hyd_pack_balqty', '$hyd_srs_qty', '$hyd_total', '$total_raw_balqty', '$total_condition_balqty', '$total_pack_balqty', '$total_srs_qty', '$total_qty', '1', '$logid')";

	mysqli_query($link, $insert_query) or die(mysqli_error($link));
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Plant Manager-Report - Stock Report as on <?php echo date("d-m-Y H:i:s"); ?></title>
    <link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
    <link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
    <style>
    .smalltblheading {
        background-color: #A2CEF9 !important;
    }

    .tblsubtitle .fixed {
        min-width: 150px !important;
		z-index: 3 !important;
		text-align: center;
    }

	.tblsubtitle .fixed:first{
        max-width: 50px !important;
    }

    .tbl_data {
        background-color: #FFFFFF !important;
        color: #000000 !important;
        font-size: 12px !important;
        font-family: Arial, Helvetica, sans-serif !important;
    }

    .tblsubtitle {
        background-color: #A2CEF9 !important;
        color: #000000 !important;
        font-size: 12px !important;
        font-family: Arial, Helvetica, sans-serif !important;
    }

    #table_responsive {
        width: 970px;
        overflow-x: auto;
        /* align center */
        text-align: center;
    }

    .tblsubheading {
        min-width: 100px;
    }

    @media (min-width: 768px) {

        /* Sticky Column 1 */
        tbody td:first-child,
        thead th:first-child {
            position: sticky;
            left: 0;
            z-index: 2;
            background: #A2CEF9;
            /* Optional: keep background solid */
        }

        /* Sticky Column 2 */
        tbody td:nth-child(2),
        thead th:nth-child(2) {
            position: sticky;
            left: 150px;
            z-index: 2;
            background: #A2CEF9;
        }

        /* Sticky Column 3 */
        tbody td:nth-child(3),
        thead th:nth-child(3) {
            position: sticky;
            left: 300px;
            z-index: 2;
            background: #A2CEF9;
        }
    }
    </style>
</head>

<body>

    <div id="table_responsive">
        <table align="center" border="1" cellspacing="0" cellpadding="0" width="100%" bordercolor="#2e81c1"
            style="border-collapse:collapse">
            <thead>
                <tr class="tblsubtitle" height="20">
                    <th align="center" valign="middle" width="20" class="smalltblheading fixed" rowspan="2">#</th>
                    <th align="center" valign="middle" class="smalltblheading fixed" rowspan="2">Crop</th>
                    <th align="center" valign="middle" class="smalltblheading fixed" rowspan="2">Variety</th>
                    <th align="center" valign="middle" class="smalltblheading" colspan="5">Deorjhal Plant</th>
                    <th align="center" valign="middle" class="smalltblheading" colspan="5">Boriya Plant</th>
                    <th align="center" valign="middle" class="smalltblheading" colspan="5">Bandamailaram Plant</th>
                    <th align="center" valign="middle" class="smalltblheading" colspan="5">All Plant Total</th>
                </tr>
                <tr class="tblsubtitle" height="20">
                    <th align="center" valign="middle" class="tblsubheading">Raw Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Condition Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Pack Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Sales Return Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Total Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Raw Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Condition Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Pack Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Sales Return Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Total Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Raw Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Condition Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Pack Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Sales Return Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Total Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Raw Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Condition Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Pack Seed Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Sales Return Qty</th>
                    <th align="center" valign="middle" class="tblsubheading">Total Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php
			$i = 1;
			foreach ($table as $row) {
				echo "<tr class='tblsubtitle' height='20'>";
				echo "<td align='center' valign='middle' class='smalltblheading'>$i</td>";
				echo "<td align='left' valign='middle' class='smalltblheading'>{$row['cropname']}</td>";
				echo "<td align='left' valign='middle' class='smalltblheading'>{$row['popularname']}</td>";

				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['djl_raw_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['djl_condition_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['djl_pack_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['djl_srs_qty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['djl_total'], 3) . "</td>";

				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['boriya_raw_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['boriya_condition_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['boriya_pack_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['boriya_srs_qty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['boriya_total'], 3) . "</td>";

				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['hyd_raw_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['hyd_condition_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['hyd_pack_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['hyd_srs_qty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['hyd_total'], 3) . "</td>";

				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['total_raw_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['total_condition_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['total_pack_balqty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['total_srs_qty'], 3) . "</td>";
				echo "<td align='right' valign='middle' class='tbl_data'>" . number_format($row['total_qty'], 3) . "</td>";
				echo "</tr>";
				$i++;
			}
			?>
            </tbody>
        </table>
    </div>
    <a href="excel_stockreportnew.php?txtcrop=<?php echo $_REQUEST['txtcrop'] ?>&txtvariety=<?php echo $_REQUEST['txtvariety'] ?>&slchk=<?php echo $slchk; ?>&slchk2=<?php echo $slchk2; ?>&sdate=<?php echo $sdate; ?>&txtplant=<?php echo $txtplant; ?>"
        target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn"
            alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>
</body>
<html>