<?php

/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */

class DB_Functions {

  //  private $conn_main;
//	private $conn_vnr;
	private $conn_ps;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
		$db_ps = new Db_Connect();
        $this->conn_ps = $db_ps->connect_ps();
    }

    // destructor
    function __destruct() {
        
    }
	
	/**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode($password);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($password) {

        $hash = base64_encode($password);

        return $hash;
    }

	public function fetchAssocStatement($stmt)
	{
		if($stmt->num_rows>0)
		{
			$result = array();
			$md = $stmt->result_metadata();
			//print_r($md);
			$params = array();
			while($field = $md->fetch_field()) {
				$params[] = &$result[$field->name];
			}
			call_user_func_array(array($stmt, 'bind_result'), $params);
			if($stmt->fetch())
			//print_r($result);
				return $result;
		}
	
		return NULL;
	}
		
    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password, $sessionid, $deviceid) {
		$user='';
		$stmtm = $this->conn_ps->prepare("SELECT * FROM tbluser WHERE loginid = ?");
        $stmtm->bind_param("s", $email);
        $stmtm->execute();
		$stmtm->store_result();
		if ($stmtm->num_rows > 0) {
			//$user = $stmt->get_result()->fetch_assoc();
			$user = $this->fetchAssocStatement($stmtm);
			$stmtm->close();
					
			// verifying user password
			if($password!="")
			{
				$encrypted_password = $user['password'];
				$hash = $password;
				// check for password equality
				if ($encrypted_password == $hash) 
				{
					// user authentication details are correct
					return $user;
				}
				else
				{
					return false;
				}
			}
		}
		if($user!='') 
		{
			return $user;
		}
		else
		{
			return false;
		}
			
       
    }
	
	public function getUserdetails($email, $password) {
        $stmt = $this->conn_ps->prepare("SELECT * FROM tblopr WHERE login = ? AND pass = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
			$resusers = $this->fetchAssocStatement($stmt);
			//$username=$resusers['name']; 
            $stmt->close();
            return $resusers;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

	public function getPlantcode($scode) {
        $pcode='';
		$stmt_plant = $this->conn_ps->prepare("SELECT plantcode  FROM tbluser WHERE scode=? ");
		$stmt_plant->bind_param("s", $scode);
		$result_plant=$stmt_plant->execute();
		$stmt_plant->store_result();
		if ($stmt_plant->num_rows > 0) {
			$stmt_plant->bind_result($rec_pcode);
			//looping through all the records 
			$stmt_plant->fetch();
			$pcode=$rec_pcode; 
			$stmt_plant->close();
		}
		return $pcode;
    }
	
	
	public function getPlantdetails($scode) {
        $pcode='';
		$plantcode = $this->getPlantcode($scode);
		$stmt_plant = $this->conn_ps->prepare("SELECT code  FROM tbl_parameters WHERE plantcode=? ");
		$stmt_plant->bind_param("s", $plantcode);
		$result_plant=$stmt_plant->execute();
		$stmt_plant->store_result();
		if ($stmt_plant->num_rows > 0) {
			$stmt_plant->bind_result($rec_pcode);
			//looping through all the records 
			$stmt_plant->fetch();
			$pcode=$rec_pcode; 
			$stmt_plant->close();
		}
		return $pcode;
    }
	
	public function isUserExisted($scode) {
        $stmt = $this->conn_ps->prepare("SELECT * FROM tbluser WHERE scode=?");

        $stmt->bind_param("s", $scode);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }






	/*public function GetTrList($lasttrid) {
		//$plantcode = $this->getPlantcode($scode);
	//return "Testing ";	
		$mainarray=array(); $userSR = array(); $user24=array(); $barcd='';
		if($lasttrid>0)
		{
			$stmt = $this->conn_ps->prepare("SELECT disp_id, disp_date, disp_partytype, disp_state, disp_location, disp_party, disp_dodc FROM tbl_disp WHERE disp_id=? and disp_tflg=1 and disp_partytype IN ('Branch','C&F','Dealer')  ORDER BY disp_id ASC");
			$stmt->bind_param("i", $lasttrid);
		}
		else
		{
			 $stmt = $this->conn_ps->prepare("SELECT disp_id, disp_date, disp_partytype, disp_state, disp_location, disp_party, disp_dodc FROM tbl_disp WHERE disp_tflg=1 and disp_partytype IN ('Branch','C&F','Dealer')  ORDER BY disp_id ASC");
			//$stmt->bind_param("ss", $email, $password);
		}
        $stmt->execute();
        $stmt->store_result();
	//return "Test ".$stmt->num_rows;	
		$disp_id=0; $disp_date=''; $disp_partytype=''; $disp_state=''; $disp_location=''; $disp_party=''; $disp_dodc='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($disp_id, $disp_date, $disp_partytype, $disp_state, $disp_location, $disp_party, $disp_dodc);
			while($stmt->fetch())
			{
				if($disp_date==NULL){$disp_date='';} if($disp_partytype==NULL){$disp_partytype='';} if($disp_state==NULL){$disp_state='';} if($disp_location==NULL){$disp_location='';} if($disp_party==NULL){$disp_party='';} if($disp_dodc==NULL){$disp_dodc='';} 
				if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
				{
					$disp_date1=explode("-",$disp_date);
					$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
				}
				if($disp_dodc!='' && $disp_dodc!='0000-00-00' && $disp_dodc!=NULL)
				{
					$disp_dodc1=explode("-",$disp_dodc);
					$disp_dodc=$disp_dodc1[2]."-".$disp_dodc1[1]."-".$disp_dodc1[0];
				}
				
				$partyname='';
				if($disp_party!=''){
					$stmt_variety = $this->conn_ps->prepare("SELECT business_name, city, state, classification FROM tbl_partymaser WHERE p_id = ? ");
					$stmt_variety->bind_param("i", $disp_party);
					$result_variety=$stmt_variety->execute();
					$stmt_variety->store_result();
					if ($stmt_variety->num_rows > 0) {
						$stmt_variety->bind_result($partyname, $city, $state, $classification);
						//looping through all the records 
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
				
				$location='';
				if($disp_location!=''){
					$stmt_variety = $this->conn_ps->prepare("SELECT productionlocation, state FROM tblproductionlocation WHERE productionlocationid = ? ");
					$stmt_variety->bind_param("i", $disp_location);
					$result_variety=$stmt_variety->execute();
					$stmt_variety->store_result();
					if ($stmt_variety->num_rows > 0) {
						$stmt_variety->bind_result($productionlocation, $locstate);
						//looping through all the records 
						$stmt_variety->fetch();
						$location=$productionlocation;
						$stmt_variety->close();
					}
				}
				
				
				$pper=''; $ploc=''; $lotstate='';
				$stmt_2 = $this->conn_ps->prepare("SELECT dpss_barcode, dpss_crop, dpss_variety, dpss_ups, dpss_lotno, dpss_qty, dpss_grosswt, dpss_dov, dpss_qc, dpss_dot  FROM tbl_dispsub_sub WHERE disp_id = ? order by dpss_crop, dpss_variety, dpss_ups, dpss_lotno");
				$stmt_2->bind_param("i", $disp_id);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				return $stmt_2->num_rows;
				if ($stmt_2->num_rows == 0) {
					$dpss_barcode=''; $dpss_crop=''; $dpss_variety=''; $dpss_ups=''; $dpss_lotno=''; $dpss_qty=''; $dpss_grosswt=''; $dpss_dov=''; $dpss_qc=''; $dpss_dot=''; $wbavailable=''; $cropname=''; $popularname=''; $croptype=''; $dop='';
					$temp=array();
					if($croptype=="Field Crop" || $croptype=="Vegetable Crop")
					{
						$temp["disp_id"] = $disp_id;
						$temp["disp_date"] = $disp_dodc;
						$temp["disp_partytype"] = $disp_partytype;
						$temp["partyname"] = $partyname;
						$temp["location"] = $location;
						$temp["disp_date"] = $disp_date;
						$temp["croptype"] = $croptype;
						$temp["cropname"] = $cropname;
						$temp["varietyname"] = $popularname;
						$temp["dpss_ups"] = $dpss_ups;
						$temp["dpss_lotno"] = $dpss_lotno;
						$temp["dpss_qty"] = $dpss_qty;
						$temp["dpss_grosswt"] = $dpss_grosswt;
						$temp["dpss_dov"] = $dpss_dov;
						$temp["dpss_qc"] = $dpss_qc;
						$temp["dpss_dot"] = $dpss_dot;
						$temp["dpss_dop"] = $dop;
						$temp["wbavailable"] = $wbavailable;
						$temp["dpss_barcode"] = $dpss_barcode;
						array_push($user24,$temp);
					}
					//$stmt_2->close();
	
				} else {
					$stmt_2->bind_result($dpss_barcode, $dpss_crop, $dpss_variety, $dpss_ups, $dpss_lotno, $dpss_qty, $dpss_grosswt, $dpss_dov, $dpss_qc, $dpss_dot);
					//looping through all the records
					while($stmt_2->fetch())
					{
						$temp=array();
						
						if($dpss_crop!=''){
							$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, croptype FROM tblcrop WHERE cropid = ? ");
							$stmt_crop->bind_param("i", $dpss_crop);
							$result_crop=$stmt_crop->execute();
							$stmt_crop->store_result();
							if ($stmt_crop->num_rows > 0) {
								$stmt_crop->bind_result($cropid, $cropname, $croptype);
								//looping through all the records 
								$stmt_crop->fetch();
								$stmt_crop->close();
							}
						}
						
						if($dpss_variety!=''){
							$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
							$stmt_variety->bind_param("i", $dpss_variety);
							$result_variety=$stmt_variety->execute();
							$stmt_variety->store_result();
							if ($stmt_variety->num_rows > 0) {
								$stmt_variety->bind_result($varietyid, $popularname);
								//looping through all the records 
								$stmt_variety->fetch();
								$stmt_variety->close();
							}
						}

						$dop='';
						if($dpss_lotno!=''){
							$stmt_ldgpack = $this->conn_ps->prepare("SELECT lotldg_dop FROM tbl_lot_ldg_pack WHERE lotno = ? ");
							$stmt_ldgpack->bind_param("s", $dpss_lotno);
							$result_ldgpack=$stmt_ldgpack->execute();
							$stmt_ldgpack->store_result();
							if ($stmt_ldgpack->num_rows > 0) {
								$stmt_ldgpack->bind_result($lotldg_dop);
								//looping through all the records 
								$stmt_ldgpack->fetch();
								if($lotldg_dop!='' && $lotldg_dop!='0000-00-00' && $lotldg_dop!=NULL)
								{
									$lotldg_dop1=explode("-",$lotldg_dop);
									$dop=$lotldg_dop1[2]."-".$lotldg_dop1[1]."-".$lotldg_dop1[0];
								}
								$stmt_ldgpack->close();
							}
						}
						
						$wbavailable='No'; $wbmpqrcode='';
						$stmt_wbqrcode = $this->conn_ps->prepare("SELECT wb_mpbarcode, wb_mpqrcode FROM tbl_wbqrcode WHERE wb_mpbarcode = ? ");
						$stmt_wbqrcode->bind_param("i", $dpss_barcode);
						$result_wbqrcode=$stmt_wbqrcode->execute();
						$stmt_wbqrcode->store_result();
						if ($stmt_wbqrcode->num_rows > 0) {
							$stmt_wbqrcode->bind_result($wb_mpbarcode, $wbmpqrcode);
							//looping through all the records 
							$stmt_wbqrcode->fetch();
							$wbavailable='Yes';
							if($barcd!=""){$barcd=$barcd.",".$wb_mpbarcode;} else {$barcd=$wb_mpbarcode;}
							$stmt_wbqrcode->close();
						}
						
						$diq2=explode(" ",$dpss_ups);
						$diq=explode(".",$diq2[0]);
						if($diq[1]==000){$difq=$diq[0];}else{$difq=$$diq2[0];}
						$dpss_ups=$difq." ".$diq2[1];
						
						if($croptype=="Field Crop" || $croptype=="Vegetable Crop")
						{
							$temp["disp_id"] = $disp_id;
							$temp["disp_date"] = $disp_dodc;
							$temp["disp_partytype"] = $disp_partytype;
							$temp["partyname"] = $partyname;
							$temp["location"] = $location;
							$temp["disp_date"] = $disp_date;
							$temp["croptype"] = $croptype;
							$temp["cropname"] = $cropname;
							$temp["varietyname"] = $popularname;
							$temp["dpss_ups"] = $dpss_ups;
							$temp["dpss_lotno"] = $dpss_lotno;
							$temp["dpss_qty"] = $dpss_qty;
							$temp["dpss_grosswt"] = $dpss_grosswt;
							$temp["dpss_dov"] = $dpss_dov;
							$temp["dpss_qc"] = $dpss_qc;
							$temp["dpss_dot"] = $dpss_dot;
							$temp["dpss_dop"] = $dop;
							$temp["wbavailable"] = $wbavailable;
							$temp["dpss_barcode"] = $dpss_barcode;
							$temp["wb_mpqrcode"] = $wbmpqrcode;
							
							array_push($user24,$temp);
						}
						//$stmt_2->close();
					}
				}
				$stmt_2->close();
				
			}
			$stmt->close();
			
           // return $resusers;
        } else {
            // user not existed
			$userSR = array();
            $stmt->close();
           // return false;
        }
		
		//array_push($mainarray,$user24);
		$mainarray['MParray']=$user24;
		
		if($barcd!="")
		{
			$barcod=explode(",",$barcd);
			foreach($barcod as $barcods)
			{
				if($barcods<>"")
				{
				
					$stmt_wbqrcode = $this->conn_ps->prepare("SELECT wb_intqrcode, wb_extqrcode, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_mpwt, wb_mpgrosswt  FROM tbl_wbqrcode WHERE wb_mpbarcode = ? ");
					$stmt_wbqrcode->bind_param("i", $barcods);
					$result_wbqrcode=$stmt_wbqrcode->execute();
					$stmt_wbqrcode->store_result();
					if ($stmt_wbqrcode->num_rows > 0) {
						$stmt_wbqrcode->bind_result($wb_intqrcode, $wb_extqrcode, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_mpwt, $wb_mpgrosswt);
						//looping through all the records 
						while($stmt_wbqrcode->fetch())
						{
						
							if($wb_crop!=''){
								$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, croptype FROM tblcrop WHERE cropid = ? ");
								$stmt_crop->bind_param("i", $wb_crop);
								$result_crop=$stmt_crop->execute();
								$stmt_crop->store_result();
								if ($stmt_crop->num_rows > 0) {
									$stmt_crop->bind_result($cropid, $cropname, $croptype);
									//looping through all the records 
									$stmt_crop->fetch();
									$stmt_crop->close();
								}
							}
							
							if($wb_variety!=''){
								$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
								$stmt_variety->bind_param("i", $wb_variety);
								$result_variety=$stmt_variety->execute();
								$stmt_variety->store_result();
								if ($stmt_variety->num_rows > 0) {
									$stmt_variety->bind_result($varietyid, $popularname);
									//looping through all the records 
									$stmt_variety->fetch();
									$stmt_variety->close();
								}
							}
							$pnpslipsub_wbinmp=0;
							if($wb_lotno!=''){
								$stmt_pnpsub = $this->conn_ps->prepare("SELECT pnpslipsub_wbinmp FROM tbl_pnpslipsub WHERE pnpslipsub_plotno = ? ");
								$stmt_pnpsub->bind_param("s", $wb_lotno);
								$result_pnpsub=$stmt_pnpsub->execute();
								$stmt_pnpsub->store_result();
								if ($stmt_pnpsub->num_rows > 0) {
									$stmt_pnpsub->bind_result($pnpslipsub_wbinmp);
									//looping through all the records 
									$stmt_pnpsub->fetch();
									$stmt_pnpsub->close();
								}
							}
							
							$dop='';
							if($wb_lotno!=''){
								$stmt_ldgpack = $this->conn_ps->prepare("SELECT lotldg_dop FROM tbl_lot_ldg_pack WHERE lotno = ? ");
								$stmt_ldgpack->bind_param("s", $wb_lotno);
								$result_ldgpack=$stmt_ldgpack->execute();
								$stmt_ldgpack->store_result();
								if ($stmt_ldgpack->num_rows > 0) {
									$stmt_ldgpack->bind_result($lotldg_dop);
									//looping through all the records 
									$stmt_ldgpack->fetch();
									if($lotldg_dop!='' && $lotldg_dop!='0000-00-00' && $lotldg_dop!=NULL)
									{
										$lotldg_dop1=explode("-",$lotldg_dop);
										$dop=$lotldg_dop1[2]."-".$lotldg_dop1[1]."-".$lotldg_dop1[0];
									}
									$stmt_ldgpack->close();
								}
							}
							
							$disp_id=0; $dpss_lotno=''; $dpss_qty=''; $dpss_grosswt=''; $dpss_dov=''; $dpss_qc=''; $dpss_dot=''; $disp_date=''; $disp_partytype=''; $disp_state=''; $disp_location=''; $disp_party=''; $disp_dodc=''; $dpss_ups='';
							$stmt_dispsub = $this->conn_ps->prepare("SELECT disp_id, dpss_lotno, dpss_qty, dpss_grosswt, dpss_dov, dpss_qc, dpss_dot, dpss_ups FROM tbl_dispsub_sub WHERE dpss_barcode = ? ");
							$stmt_dispsub->bind_param("s", $wb_mpbarcode);
							$result_dispsub=$stmt_dispsub->execute();
							$stmt_dispsub->store_result();
							if ($stmt_dispsub->num_rows > 0) {
								$stmt_dispsub->bind_result($disp_id, $dpss_lotno, $dpss_qty, $dpss_grosswt, $dpss_dov, $dpss_qc, $dpss_dot, $dpss_ups);
								//looping through all the records 
								$stmt_dispsub->fetch();
								$stmt_dispsub->close();
							
							
								$stmt_dispmain = $this->conn_ps->prepare("SELECT disp_id, disp_date, disp_partytype, disp_state, disp_location, disp_party, disp_dodc FROM tbl_disp WHERE disp_id = ? ");
								$stmt_dispmain->bind_param("i", $disp_id);
								$result_dispmain=$stmt_dispmain->execute();
								$stmt_dispmain->store_result();
								if ($stmt_dispmain->num_rows > 0) {
									$stmt_dispmain->bind_result($disp_id, $disp_date, $disp_partytype, $disp_state, $disp_location, $disp_party, $disp_dodc);
									//looping through all the records 
									$stmt_dispmain->fetch();
									
									if($disp_date==NULL){$disp_date='';} if($disp_partytype==NULL){$disp_partytype='';} if($disp_state==NULL){$disp_state='';} if($disp_location==NULL){$disp_location='';} if($disp_party==NULL){$disp_party='';} if($disp_dodc==NULL){$disp_dodc='';} 
									if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
									{
										$disp_date1=explode("-",$disp_date);
										$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
									}
									if($disp_dodc!='' && $disp_dodc!='0000-00-00' && $disp_dodc!=NULL)
									{
										$disp_dodc1=explode("-",$disp_dodc);
										$disp_dodc=$disp_dodc1[2]."-".$disp_dodc1[1]."-".$disp_dodc1[0];
									}
									
									$stmt_dispmain->close();
								}
							}
							
							$diq2=explode(" ",$dpss_ups);
							$diq=explode(".",$diq2[0]);
							if($diq[1]==000){$difq=$diq[0];}else{$difq=$$diq2[0];}
							$dpss_ups=$difq." ".$diq2[1];
							
							
							$temp=array();
							if($croptype=="Field Crop" || $croptype=="Vegetable Crop")
							{
								$temp["disp_id"] = $disp_id;
								$temp["disp_date"] = $disp_dodc;
								$temp["disp_partytype"] = $disp_partytype;
								$temp["partyname"] = $partyname;
								$temp["location"] = $location;
								$temp["disp_date"] = $disp_date;
								$temp["croptype"] = $croptype;
								$temp["cropname"] = $cropname;
								$temp["varietyname"] = $popularname;
								$temp["dpss_ups"] = $dpss_ups;
								$temp["dpss_lotno"] = $dpss_lotno;
								$temp["dpss_qty"] = $dpss_qty;
								$temp["dpss_grosswt"] = $dpss_grosswt;
								$temp["dpss_dov"] = $dpss_dov;
								$temp["dpss_qc"] = $dpss_qc;
								$temp["dpss_dot"] = $dpss_dot;
								$temp["dpss_dop"] = $dop;
								$temp["wb_intqrcode"] = $wb_intqrcode;
								$temp["wb_extqrcode"] = $wb_extqrcode;
								$temp["wb_mpqrcode"] = $wb_mpqrcode;
								$temp["dpss_barcode"] = $dpss_barcode;
								$temp["nop_inwb"] = $wb_nop;
								$temp["wb_weight"] = $wb_qty;
								$temp["wb_inmp"] = $pnpslipsub_wbinmp;
								
								array_push($userSR,$temp);
							}
						}
						$stmt_wbqrcode->close();
					}
				
				}
			}
		}
		//array_push($mainarray,$userSR);
		$mainarray['WBarray']=$userSR;
		if(empty($mainarray))
		{return false;}
		else
		{return $mainarray;}
    }*/

	public function GetNextMinDispatchID($d_id) {
	
		$stmt = $this->conn_ps->prepare("SELECT d.disp_id, crp.croptype, w.wb_mpqrcode
			FROM tbl_disp d
			LEFT JOIN tbl_dispsub_sub dp ON d.disp_id = dp.disp_id
			LEFT JOIN tbl_wbqrcode w ON dp.dpss_barcode = w.wb_mpbarcode
			LEFT JOIN tblcrop crp ON dp.dpss_crop = crp.cropid
			WHERE d.disp_tflg = 1 AND d.disp_dodc>='2024-02-01' AND d.disp_partytype IN ('Branch', 'C&F', 'Dealer') AND d.disp_id>? AND crp.croptype in ('Field Crop','Vegetable Crop')  GROUP BY  d.disp_id having ((crp.croptype = 'Field Crop') OR (crp.croptype = 'Vegetable Crop' AND w.wb_mpqrcode!='' AND w.wb_mpqrcode IS NOT NULL)) order by d.disp_id ASC ");
		$stmt->bind_param("i", $d_id);
		$result_dispmain=$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($disp_id, $croptype, $wb_mpqrcode);
			$stmt->fetch();
			$stmt->close();
			//return "ID - ".$disp_id;
		}
		else
		{
			$disp_id=$d_id+1;
		}	
		return $disp_id;
	}





	public function GetTrList($lasttrid) {
		//$plantcode = $this->getPlantcode($scode);
		$mainarray=array(); $userSR = array(); $user24=array(); $barcd='';
		//$min_disp_id = $lasttrid + 5;

		$min_disp_id = $this->GetNextMinDispatchID($lasttrid);
		$max_disp_id = $min_disp_id + 2;

//return "SELECT d.disp_id, d.disp_date, d.disp_partytype, d.disp_state, d.disp_location, d.disp_party, d.disp_dodc,
//			dp.dpss_barcode, dp.dpss_crop, dp.dpss_variety, dp.dpss_ups, dp.dpss_lotno, dp.dpss_qty, dp.dpss_grosswt, dp.dpss_dov, dp.dpss_qc, dp.dpss_dot,
//			w.wb_mpbarcode, w.wb_mpqrcode, p.business_name, l.productionlocation, crp.cropname, crp.croptype, vr.popularname, lot.lotldg_dop, pnp.pnpslipsub_wbinmp
//			FROM tbl_disp d
//			LEFT JOIN tbl_dispsub_sub dp ON d.disp_id = dp.disp_id
//			LEFT JOIN tbl_wbqrcode w ON dp.dpss_barcode = w.wb_mpbarcode
//			LEFT JOIN tbl_partymaser p ON d.disp_party = p.p_id
//			LEFT JOIN tblproductionlocation l ON d.disp_location = l.productionlocationid
//			LEFT JOIN tblcrop crp ON dp.dpss_crop = crp.cropid
//			LEFT JOIN tblvariety vr ON dp.dpss_variety = vr.varietyid
//			LEFT JOIN tbl_lot_ldg_pack lot ON dp.dpss_lotno = lot.lotno
//			LEFT JOIN tbl_pnpslipsub pnp ON dp.dpss_lotno = pnp.pnpslipsub_plotno
//			WHERE d.disp_tflg = 1 AND d.disp_partytype IN ('Branch', 'C&F', 'Dealer') AND (d.disp_id BETWEEN $min_disp_id AND $max_disp_id) GROUP BY dp.dpss_barcode ";

		$stmt = $this->conn_ps->prepare("SELECT d.disp_id, d.disp_date, d.disp_partytype, d.disp_state, d.disp_location, d.disp_party, d.disp_dodc,
			dp.dpss_barcode, dp.dpss_crop, dp.dpss_variety, dp.dpss_ups, dp.dpss_lotno, dp.dpss_qty, dp.dpss_grosswt, dp.dpss_dov, dp.dpss_qc, dp.dpss_dot,
			w.wb_mpbarcode, w.wb_mpqrcode, p.business_name, l.productionlocation, crp.cropname, crp.croptype, vr.popularname, lot.lotldg_dop, lot.orlot, pnp.pnpslipsub_wbinmp
			FROM tbl_disp d
			LEFT JOIN tbl_dispsub_sub dp ON d.disp_id = dp.disp_id
			LEFT JOIN tbl_wbqrcode w ON dp.dpss_barcode = w.wb_mpbarcode
			LEFT JOIN tbl_partymaser p ON d.disp_party = p.p_id
			LEFT JOIN tblproductionlocation l ON d.disp_location = l.productionlocationid
			LEFT JOIN tblcrop crp ON dp.dpss_crop = crp.cropid
			LEFT JOIN tblvariety vr ON dp.dpss_variety = vr.varietyid
			LEFT JOIN tbl_lot_ldg_pack lot ON dp.dpss_lotno = lot.lotno
			LEFT JOIN tbl_pnpslipsub pnp ON dp.dpss_lotno = pnp.pnpslipsub_plotno
			WHERE d.disp_tflg = 1 AND disp_dodc>='2024-02-01' AND d.disp_partytype IN ('Branch', 'C&F', 'Dealer') AND (d.disp_id  BETWEEN $min_disp_id AND $max_disp_id) AND crp.croptype in ('Field Crop','Vegetable Crop') AND (dp.dpss_barcode!='' AND dp.dpss_barcode IS NOT NULL)  GROUP BY dp.dpss_barcode ");
		//$stmt->bind_param("i", $lasttrid); 
		$stmt->execute();
		$stmt->store_result();
		
		$disp_id=0; $disp_date=''; $disp_partytype=''; $disp_state=''; $disp_location=''; $disp_party=''; $disp_dodc=''; $partyname=''; $location=''; 	$pper=''; $ploc=''; $lotstate=''; $wbmpqrcode=''; $dpss_barcode=''; $dpss_crop=''; $dpss_variety=''; $dpss_ups=''; $dpss_lotno=''; $dpss_qty=''; $dpss_grosswt=''; $dpss_dov=''; $dpss_qc=''; $dpss_dot=''; $wbavailable=''; $cropname=''; $popularname=''; $croptype=''; $dop=''; $pnpslipsub_wbinmp=''; $orlot='';
//	return $stmt->num_rows;	
        if ($stmt->num_rows > 0) {
            // user existed 
		$stmt->bind_result($disp_id, $disp_date, $disp_partytype, $disp_state, $disp_location, $disp_party, $disp_dodc, $dpss_barcode, $dpss_crop, $dpss_variety, $dpss_ups, $dpss_lotno, $dpss_qty, $dpss_grosswt, $dpss_dov, $dpss_qc, $dpss_dot, $wb_mpbarcode, $wb_mpqrcode, $partyname, $productionlocation, $cropname, $croptype, $popularname, $lotldg_dop, $orlot, $pnpslipsub_wbinmp);
		
		while($stmt->fetch())
		{
			//if($disp_date==NULL){$disp_date='';} if($disp_partytype==NULL){$disp_partytype='';} if($disp_state==NULL){$disp_state='';} if($disp_location==NULL){$disp_location='';} if($disp_party==NULL){$disp_party='';} if($disp_dodc==NULL){$disp_dodc='';} 
			
			
			/*if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
			{
				$disp_date1=explode("-",$disp_date);
				$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
			}
			if($disp_dodc!='' && $disp_dodc!='0000-00-00' && $disp_dodc!=NULL)
			{
				$disp_dodc1=explode("-",$disp_dodc);
				$disp_dodc=$disp_dodc1[2]."-".$disp_dodc1[1]."-".$disp_dodc1[0];
			}
			
			if($lotldg_dop!='' && $lotldg_dop!='0000-00-00' && $lotldg_dop!=NULL)
			{
				$lotldg_dop1=explode("-",$lotldg_dop);
				$dop=$lotldg_dop1[2]."-".$lotldg_dop1[1]."-".$lotldg_dop1[0];
			}*/
			
			$wbavailable='No'; 
			if($wb_mpqrcode!='' && $wb_mpqrcode!=NULL )
			{
				$wbavailable='Yes';
				if($barcd!=""){$barcd=$barcd.",".$wb_mpbarcode;} else {$barcd=$wb_mpbarcode;}
			}
			
			$temp=array();
	
			$diq2=explode(" ",$dpss_ups);

			if($partyname=="VNR Seeds Private Limited-Tatibandh" || $partyname=="VNR Seeds Pvt Ltd-Raipur_Old Branch" || $partyname=="VNR Seeds Private Limited-Raipur Depot" || $partyname=="VNR Seeds Private Limited-Tekari(Godown)" || $partyname=="Trial Pack-All Party") {$partyname="VNR Seeds Pvt Ltd-Raipur";}
	
			if($croptype=="Field Crop" || $croptype=="Vegetable Crop")
			{
				if($croptype=="Field Crop" && $dpss_barcode!='' &&  $dpss_barcode!=NULL)
				{				
					$temp["disp_id"] = $disp_id;
					$temp["disp_date"] = $disp_dodc;
					$temp["disp_partytype"] = $disp_partytype;
					$temp["partyname"] = $partyname;
					$temp["location"] = $productionlocation;
					$temp["state"] = $disp_state;
					$temp["disp_date"] = $disp_date;
					$temp["croptype"] = $croptype;
					$temp["cropname"] = $cropname;
					$temp["varietyname"] = $popularname;
					$temp["dpss_ups"] = $diq2[0];
					$temp["dpss_upsunit"] = $diq2[1];
					$temp["dpss_lotno"] = $orlot;
					$temp["dpss_qty"] = $dpss_qty;
					$temp["dpss_grosswt"] = $dpss_grosswt;
					$temp["dpss_dov"] = $dpss_dov;
					$temp["dpss_qc"] = $dpss_qc;
					$temp["dpss_dot"] = $dpss_dot;
					$temp["dpss_dop"] = $lotldg_dop;
					$temp["wbavailable"] = $wbavailable;
					$temp["dpss_barcode"] = $dpss_barcode;
					$temp["wb_mpqrcode"] = $wb_mpqrcode;
					$temp["wb_inmp"] = $pnpslipsub_wbinmp;
					array_push($user24,$temp);
				}
				
//return "Test - ".$wb_mpqrcode;
				if($croptype=="Vegetable Crop" && $wb_mpqrcode!='' && $wb_mpqrcode!=NULL)
				{				
					$temp["disp_id"] = $disp_id;
					$temp["disp_date"] = $disp_dodc;
					$temp["disp_partytype"] = $disp_partytype;
					$temp["partyname"] = $partyname;
					$temp["location"] = $productionlocation;
					$temp["state"] = $disp_state;
					$temp["disp_date"] = $disp_date;
					$temp["croptype"] = $croptype;
					$temp["cropname"] = $cropname;
					$temp["varietyname"] = $popularname;
					$temp["dpss_ups"] = $diq2[0];
					$temp["dpss_upsunit"] = $diq2[1];
					$temp["dpss_lotno"] = $orlot;
					$temp["dpss_qty"] = $dpss_qty;
					$temp["dpss_grosswt"] = $dpss_grosswt;
					$temp["dpss_dov"] = $dpss_dov;
					$temp["dpss_qc"] = $dpss_qc;
					$temp["dpss_dot"] = $dpss_dot;
					$temp["dpss_dop"] = $lotldg_dop;
					$temp["wbavailable"] = $wbavailable;
					$temp["dpss_barcode"] = $dpss_barcode;
					$temp["wb_mpqrcode"] = $wb_mpqrcode;
					$temp["wb_inmp"] = $pnpslipsub_wbinmp;
					array_push($user24,$temp);
				}
			}

			
		}
		$stmt->close();
			
           
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		//array_push($mainarray,$user24);
		$mainarray['MParray']=$user24;
	//return $barcd;	
		if($barcd!="")
		{
			$barcod=explode(",",$barcd);
			foreach($barcod as $barcods)
			{
				if($barcods<>"")
				{
//return "SELECT d.wb_intqrcode, d.wb_extqrcode, d.wb_crop, d.wb_variety, d.wb_ups, d.wb_lotno, d.wb_nop, d.wb_qty, d.wb_mptype, d.wb_mpqrcode, d.wb_mpbarcode, d.wb_mpwt, d.wb_mpgrosswt, crp.cropname, crp.croptype, vr.popularname, pnp.pnpslipsub_wbinmp, lot.lotldg_dop,
//					dp.disp_id, dp.dpss_lotno, dp.dpss_qty, dp.dpss_grosswt, dp.dpss_dov, dp.dpss_qc, dp.dpss_dot, dp.dpss_ups, 	
//					dm.disp_date, dm.disp_partytype, dm.disp_state, dm.disp_location, dm.disp_party, dm.disp_dodc, p.business_name, l.productionlocation
//					FROM tbl_wbqrcode d
//					LEFT JOIN tblcrop crp ON d.wb_crop = crp.cropid
//					LEFT JOIN tblvariety vr ON d.wb_variety = vr.varietyid
//					LEFT JOIN tbl_pnpslipsub pnp ON d.wb_lotno = pnp.pnpslipsub_plotno
//					LEFT JOIN tbl_lot_ldg_pack lot ON d.wb_lotno = lot.lotno
//					LEFT JOIN tbl_dispsub_sub dp ON d.wb_mpbarcode = dp.dpss_barcode
//					LEFT JOIN tbl_disp dm ON dp.disp_id = dm.disp_id
//					LEFT JOIN tbl_partymaser p ON dm.disp_party = p.p_id
//					LEFT JOIN tblproductionlocation l ON dm.disp_location = l.productionlocationid
//					WHERE d.wb_mpbarcode=$barcods";
				
					
					$stmt_wbqrcode = $this->conn_ps->prepare("SELECT d.wb_intqrcode, d.wb_extqrcode, d.wb_crop, d.wb_variety, d.wb_ups, d.wb_lotno, d.wb_nop, d.wb_qty, d.wb_mptype, d.wb_mpqrcode, d.wb_mpbarcode, d.wb_mpwt, d.wb_mpgrosswt, crp.cropname, crp.croptype, vr.popularname, pnp.pnpslipsub_wbinmp, lot.lotldg_dop, lot.orlot,
					dp.disp_id, dp.dpss_lotno, dp.dpss_qty, dp.dpss_grosswt, dp.dpss_dov, dp.dpss_qc, dp.dpss_dot, dp.dpss_ups, 	
					dm.disp_date, dm.disp_partytype, dm.disp_state, dm.disp_location, dm.disp_party, dm.disp_dodc, p.business_name, l.productionlocation
					FROM tbl_wbqrcode d
					LEFT JOIN tblcrop crp ON d.wb_crop = crp.cropid
					LEFT JOIN tblvariety vr ON d.wb_variety = vr.varietyid
					LEFT JOIN tbl_pnpslipsub pnp ON d.wb_lotno = pnp.pnpslipsub_plotno
					LEFT JOIN tbl_lot_ldg_pack lot ON d.wb_lotno = lot.lotno
					LEFT JOIN tbl_dispsub_sub dp ON d.wb_mpbarcode = dp.dpss_barcode
					LEFT JOIN tbl_disp dm ON dp.disp_id = dm.disp_id
					LEFT JOIN tbl_partymaser p ON dm.disp_party = p.p_id
					LEFT JOIN tblproductionlocation l ON dm.disp_location = l.productionlocationid
					WHERE d.wb_mpbarcode='$barcods' group by wb_intqrcode");
				
					
					
					$pnpslipsub_wbinmp=0; $dop=''; $disp_id=0; $dpss_lotno=''; $dpss_qty=''; $dpss_grosswt=''; $dpss_dov=''; $dpss_qc=''; $dpss_dot=''; $disp_date=''; $disp_partytype='';  $disp_state=''; $disp_location=''; $disp_party=''; $disp_dodc=''; $dpss_ups=''; $orlot='';
					//$stmt_wbqrcode = $this->conn_ps->prepare("SELECT wb_intqrcode, wb_extqrcode, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_mpwt, wb_mpgrosswt  FROM tbl_wbqrcode WHERE wb_mpbarcode = ? ");
					//$stmt_wbqrcode->bind_param("s", $barcods);
					$result_wbqrcode=$stmt_wbqrcode->execute();
					$stmt_wbqrcode->store_result();
//return $stmt_wbqrcode->num_rows;
					if ($stmt_wbqrcode->num_rows > 0) {
						$stmt_wbqrcode->bind_result($wb_intqrcode, $wb_extqrcode, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_mpwt, $wb_mpgrosswt, $cropname, $croptype, $popularname, $pnpslipsub_wbinmp, $lotldg_dop, $orlot, $disp_id, $dpss_lotno, $dpss_qty, $dpss_grosswt, $dpss_dov, $dpss_qc, $dpss_dot, $dpss_ups, $disp_date, $disp_partytype, $disp_state, $disp_location, $disp_party, $disp_dodc, $partyname, $productionlocation);
						//looping through all the records 
						while($stmt_wbqrcode->fetch())
						{
						//return $wb_mpbarcode;
							/*if($lotldg_dop!='' && $lotldg_dop!='0000-00-00' && $lotldg_dop!=NULL)
							{
								$lotldg_dop1=explode("-",$lotldg_dop);
								$dop=$lotldg_dop1[2]."-".$lotldg_dop1[1]."-".$lotldg_dop1[0];
							}
									
							
							if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
							{
								$disp_date1=explode("-",$disp_date);
								$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
							}
							if($disp_dodc!='' && $disp_dodc!='0000-00-00' && $disp_dodc!=NULL)
							{
								$disp_dodc1=explode("-",$disp_dodc);
								$disp_dodc=$disp_dodc1[2]."-".$disp_dodc1[1]."-".$disp_dodc1[0];
							}*/
									
							
							$diq2=explode(" ",$dpss_ups);
							if($partyname=="VNR Seeds Private Limited-Tatibandh" || $partyname=="VNR Seeds Pvt Ltd-Raipur_Old Branch" || $partyname=="VNR Seeds Private Limited-Raipur Depot" || $partyname=="VNR Seeds Private Limited-Tekari(Godown)" || $partyname=="Trial Pack-All Party") {$partyname="VNR Seeds Pvt Ltd-Raipur";}
							$temp=array();
							//if($croptype=="Field Crop" || $croptype=="Vegetable Crop")
							if($wb_mpqrcode!='' && $wb_mpqrcode!=NULL )
							{
								$temp["disp_id"] = $disp_id;
								$temp["disp_date"] = $disp_dodc;
								$temp["disp_partytype"] = $disp_partytype;
								$temp["partyname"] = $partyname;
								$temp["location"] = $productionlocation;
								$temp["state"] = $disp_state;
								$temp["disp_date"] = $disp_date;
								$temp["croptype"] = $croptype;
								$temp["cropname"] = $cropname;
								$temp["varietyname"] = $popularname;
								$temp["dpss_ups"] = $diq2[0];
								$temp["dpss_upsunit"] = $diq2[1];
								$temp["dpss_lotno"] = $orlot;
								$temp["dpss_qty"] = $dpss_qty;
								$temp["dpss_grosswt"] = $dpss_grosswt;
								$temp["dpss_dov"] = $dpss_dov;
								$temp["dpss_qc"] = $dpss_qc;
								$temp["dpss_dot"] = $dpss_dot;
								$temp["dpss_dop"] = $lotldg_dop;
								$temp["wb_intqrcode"] = $wb_intqrcode;
								$temp["wb_extqrcode"] = $wb_extqrcode;
								$temp["wb_mpqrcode"] = $wb_mpqrcode;
								$temp["dpss_barcode"] = $wb_mpbarcode;
								$temp["nop_inwb"] = $wb_nop;
								$temp["wb_weight"] = $wb_qty;
								
								
								array_push($userSR,$temp);
							}
						}
						
					}
					$stmt_wbqrcode->close();
				}
			}
		}
		//array_push($mainarray,$userSR);
		$mainarray['WBarray']=$userSR;
		
		if(empty($mainarray))
		{return false;}
		else
		{return $mainarray;}
    }






	
	
}// Main Class close
?>
