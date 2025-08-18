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
	
	public function isBarCodeExisted($barcode) {
        $stmt = $this->conn_ps->prepare("SELECT mpmain_barcode FROM tbl_mpmain WHERE mpmain_barcode=?");

        $stmt->bind_param("s", $barcode);

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
	
	public function GetTrList($scode, $mobile1) {
		$plantcode = $this->getPlantcode($scode);
         $stmt = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_date, pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_ttype FROM tbl_pnpslipmain WHERE pnpslipmain_tflag=2 and pnpslipmain_trtype='wb' AND pnpslipmain_wbactflag=0 AND plantcode=? ORDER BY pnpslipmain_id ASC");
        $stmt->bind_param("s", $plantcode);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$pnpslipmain_id=''; $pnpslipmain_date=''; $pnpslipmain_crop=''; $pnpslipmain_variety=''; $pnpslipmain_promachcode=''; $pnpslipmain_proopr=''; $pnpslipmain_treattype=''; $pnpslipmain_ttype=''; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($pnpslipmain_id, $pnpslipmain_date, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipmain_promachcode, $pnpslipmain_proopr, $pnpslipmain_treattype, $pnpslipmain_ttype);
			while($stmt->fetch())
			{
			if($pnpslipmain_date==NULL){$pnpslipmain_date='';} if($pnpslipmain_crop==NULL){$pnpslipmain_crop='';} if($pnpslipmain_variety==NULL){$pnpslipmain_variety='';} if($pnpslipmain_promachcode==NULL){$pnpslipmain_promachcode='';} if($pnpslipmain_proopr==NULL){$pnpslipmain_proopr='';} if($pnpslipmain_treattype==NULL){$pnpslipmain_treattype='';} if($pnpslipmain_ttype==NULL){$pnpslipmain_ttype='';} 
			if($pnpslipmain_date!='' && $pnpslipmain_date!='0000-00-00' && $pnpslipmain_date!=NULL)
			{
				$pnpslipmain_date1=explode("-",$pnpslipmain_date);
				$pnpslipmain_date=$pnpslipmain_date1[2]."-".$pnpslipmain_date1[1]."-".$pnpslipmain_date1[0];
			}
			$trtyp='SMC';
			if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NMC";}
			
			
			if($pnpslipmain_crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $pnpslipmain_crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			$promachname='';
			if($pnpslipmain_promachcode!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT promac_id, promac_mac, promac_macid, promac_type FROM tbl_rm_promac WHERE promac_id = ? ");
				$stmt_variety->bind_param("i", $pnpslipmain_promachcode);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($promac_id, $promac_mac, $promac_macid, $promac_type);
					//looping through all the records 
					$stmt_variety->fetch();
					$promachname=$promac_mac.$promac_macid;
					$stmt_variety->close();
				}
			}
			
			if($pnpslipmain_variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $pnpslipmain_variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			$userSR["mobile1"] = $mobile1;
			$userSR["trid"] = $pnpslipmain_id;
			$userSR["trdate"] = $pnpslipmain_date;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["promachcode"] = $promachname;
			$userSR["trtype"] = $trtyp;
			
			$pnpslipsub_lotno=''; $pnpslipsub_pickpqty='0.00'; $pnpslipsub_ups=''; $pnpslipsub_wtmp='0'; $pnpslipsub_nop='0'; $pnpslipsub_wbnop='0'; $pnpslipsub_wbwt='0';  $pnpslipsub_wbinmp='0';
			$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipsub_lotno, pnpslipsub_pickpqty, pnpslipsub_ups, pnpslipsub_wtmp, pnpslipsub_nop, pnpslipsub_wbnop, pnpslipsub_wbwt, pnpslipsub_wbinmp  FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
			$stmt_2->bind_param("i", $pnpslipmain_id);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
				$userSR["lotno"] = $pnpslipsub_lotno;
				$userSR["pickpqty"] = $pnpslipsub_pickpqty;
				$userSR["ups"] = $pnpslipsub_ups;
				$userSR["wtmp"] = $pnpslipsub_wtmp;
				$userSR["nop"] = $pnpslipsub_nop;
				$userSR["wbnop"] = $pnpslipsub_wbnop;
				$userSR["wbwt"] = $pnpslipsub_wbwt;
				$userSR["wbinmp"] = $pnpslipsub_wbinmp;
				$stmt_2->close();

			} else {
				$stmt_2->bind_result($pnpslipsub_lotno, $pnpslipsub_pickpqty, $pnpslipsub_ups, $pnpslipsub_wtmp, $pnpslipsub_nop, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $pnpslipsub_wbinmp);
				//looping through all the records
				$stmt_2->fetch();
				if($pnpslipsub_lotno==NULL){$pnpslipsub_lotno='';} if($pnpslipsub_pickpqty==NULL){$pnpslipsub_pickpqty='0.00';} if($pnpslipsub_ups==NULL){$pnpslipsub_ups='';} if($pnpslipsub_wtmp==NULL){$pnpslipsub_wtmp='0';} if($pnpslipsub_nop==NULL){$pnpslipsub_nop='0';} if($pnpslipsub_wbnop==NULL){$pnpslipsub_wbnop='0';} if($pnpslipsub_wbwt==NULL){$pnpslipsub_wbwt='0';}  if($pnpslipsub_wbinmp==NULL){$pnpslipsub_wbinmp='0';} 
				
				$userSR["lotno"] = $pnpslipsub_lotno;
				$userSR["pickpqty"] = $pnpslipsub_pickpqty;
				$userSR["ups"] = $pnpslipsub_ups;
				$userSR["wtmp"] = $pnpslipsub_wtmp;
				$userSR["nop"] = $pnpslipsub_nop;
				$userSR["wbnop"] = $pnpslipsub_wbnop;
				$userSR["wbwt"] = $pnpslipsub_wbwt;
				$userSR["wbinmp"] = $pnpslipsub_wbinmp;
				$stmt_2->close();
			}
			
			$slocs='';
			$stmt_pnpss = $this->conn_ps->prepare("SELECT pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_pqty FROM tbl_pnpslipsubsub WHERE pnpslipmain_id = ? ");
			$stmt_pnpss->bind_param("i", $pnpslipmain_id);
			$result_pnpss=$stmt_pnpss->execute();
			$stmt_pnpss->store_result();
			if ($stmt_pnpss->num_rows > 0) {
				$stmt_pnpss->bind_result($pnpslipsubsub_wh, $pnpslipsubsub_bin, $pnpslipsubsub_subbin, $pnpslipsubsub_pqty);
				//looping through all the records 
				while($stmt_pnpss->fetch())
				{
					
					$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
					$stmt_wh->bind_param("ss", $pnpslipsubsub_wh, $plantcode);
					$result_wh=$stmt_wh->execute();
					$stmt_wh->store_result();
					if ($stmt_wh->num_rows > 0) {
						$stmt_wh->bind_result($whperticulars,$whid);
						//looping through all the records 
						$stmt_wh->fetch();
						$stmt_wh->close();
			
						$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
						$stmt_bin->bind_param("iss", $pnpslipsubsub_wh, $pnpslipsubsub_bin, $plantcode);
						$result_bin=$stmt_bin->execute();
						$stmt_bin->store_result();
						if ($stmt_bin->num_rows > 0) {
							$stmt_bin->bind_result($binname, $binid);
							//looping through all the records
							$stmt_bin->fetch();
							$stmt_bin->close();
							
							$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
							$stmt_sbin->bind_param("iiss", $pnpslipsubsub_wh, $pnpslipsubsub_bin, $pnpslipsubsub_subbin, $plantcode);
							$result2=$stmt_sbin->execute();
							$stmt_sbin->store_result();
							if ($stmt_sbin->num_rows > 0) {
								$stmt_sbin->bind_result($subbinname, $subbinid);
								//looping through all the records
								$stmt_sbin->fetch();
								$stmt_sbin->close();
							}
						}
						
						if($slocs!="")
						$slocs=$slocs.",".$whperticulars."-".$binname."-".$subbinname;
						else
						$slocs=$whperticulars."-".$binname."-".$subbinname;
					}
				
				}
				$stmt_pnpss->close();
			}
			$userSR["sloc"] = $slocs;
			
			array_push($user24,$userSR);
			}
			$stmt->close();
			
           // return $resusers;
        } else {
            // user not existed
			$userSR = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }

	public function GetTranSetupInit($scode,$dispdate,$dcdate,$dcno) {
		$plantcode = $this->getPlantcode($scode);
		$dt=date("Y-m-d");
		if($dispdate!='') {
		$tdate=explode("-",$dispdate);
		$dispdate=$tdate[2]."-".$tdate[1]."-".$tdate[0]; }
		if($dcdate!='') {
		$tdate=explode("-",$dcdate);
		$dcdate=$tdate[2]."-".$tdate[1]."-".$tdate[0]; }
		
		$userSR=array();
		$arrcode=0; $ycode=''; $year1=''; $years=''; $baryearcode=''; $trtype='Fresh Seed with PDN'; $stage='Raw';
		$stmt_yer = $this->conn_ps->prepare("SELECT ycode, years, year1, baryrcode  FROM tblyears WHERE years_flg != 0 and years_status='a' ");
		//$stmt_yer->bind_param("i", $arrival_id);
		$result_yer=$stmt_yer->execute();
		$stmt_yer->store_result();
		if ($stmt_yer->num_rows > 0) {
			$stmt_yer->bind_result($rec_ycode, $rec_years, $rec_year1, $rec_baryrcode);
			//looping through all the records 
			$stmt_yer->fetch();
			$ycode=$rec_ycode; 
			$year1=$rec_year1; 
			$years=$rec_years; 
			$baryearcode=$rec_baryrcode;
			$stmt_yer->close();
		}
        $stmt = $this->conn_ps->prepare("SELECT MAX(arrival_code) FROM tblarrival_unld WHERE arrival_type = ? AND yearcode = ? AND plantcode=?");
        $stmt->bind_param("sss", $trtype, $ycode, $plantcode);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_code);
			$stmt->fetch();
			$arrivalcode=$arrival_code+1;
			$stmt->close();
        } else {
            // user not existed
			$arrivalcode=1;
            $stmt->close();
        }
		if($scode!="" && $dispdate!="")
		{
			$stpflg=2;
			$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_unld (arrival_type, arrival_code, arrsetup_date, disp_date, dc_date, dcno, sstage, yearcode, arrsetupflag, setuplogid, arr_role, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt60->bind_param("sissssssisss", $trtype, $arrivalcode, $dt, $dispdate, $dcdate, $dcno, $stage, $ycode, $stpflg, $scode, $scode, $plantcode);
			$result60 = $stmt60->execute();
			//echo $barcode."  -  ".$scanby."  -  ".$opr_id."  -  ".$sp_id."  -  ".$schpoints."  -  ".$opr_state."  -  ".$sch_name."  -  ".$qrcode."  -  ".$dt."  -  ".$role;
			if($result60)
			{
				$trid=$stmt60->insert_id;
				$userSR["trid"] = $trid;
				$stmt60->close();
			}
			else
			{
				$trid=0;
				$userSR["trid"] = $trid;
				$stmt60->close();
			}
		}
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	
	public function GetTranSetupYrCode() {
	
		$user10=array(); $ycode=''; $ycode2='';
		$stmt_2 = $this->conn_ps->prepare("SELECT ycode, yearsid FROM tblyears WHERE years_flg != 0 and years_status='a' ");
		//$stmt_2->bind_param("s", $pdate);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($ycode, $yearsid);
			//looping through all the records
			$stmt_2->fetch();
			$stmt_2->close();
		}
		$yid=$yearsid-1;
		$stmt_23 = $this->conn_ps->prepare("SELECT ycode, yearsid FROM tblyears WHERE years_flg = 0 and years_status='c' and yearsid = ? ");
		$stmt_23->bind_param("i", $yid);
		$result23=$stmt_23->execute();
		$stmt_23->store_result();
		if ($stmt_23->num_rows > 0) {
			$stmt_23->bind_result($ycode2, $yearsid2);
			//looping through all the records
			$stmt_23->fetch();
			$stmt_23->close();
		}
		$m=date("m");
		if($m>=6)
		{
			array_push($user10, $ycode);
			array_push($user10, $ycode2);
		}
		else
		{
			array_push($user10, $ycode2);
			array_push($user10, $ycode);
		}
		if(empty($user10))
		{return false;}
		else
		{return $user10;}		
	}		
	
	public function GetTranSetupLotchklist() {
		$m=date("m");$de=date("d");$y=date("Y");
		$pdate=date('Y-m-d', mktime(0,0,0,($m-6),$de,$y)); 
		$user10=array();
		//return "SELECT lotnumber  FROM tbllotimp WHERE trid=0 AND lotimpdate >= '$pdate' AND lotimpflg=0 ";
		$stmt_2 = $this->conn_ps->prepare("SELECT lotnumber  FROM tbllotimp WHERE trid=0 AND lotimpdate >= ? AND lotimpflg=0 ");
		$stmt_2->bind_param("s", $pdate);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($lotnumber);
			//looping through all the records
			while($stmt_2->fetch())
			{
				$ct=0;
				/*$stmt_23 = $this->conn_ps->prepare("SELECT old FROM tblarrival_sub_unld WHERE old=? ");
				$stmt_23->bind_param("s", $lotnumber);
				$stmt_23->execute();
				//$stmt_23->store_result();
				if ($stmt_23->num_rows > 0){$ct++;}
				$stmt_23->close();	
				
				$stmt_3 = $this->conn_ps->prepare("SELECT old FROM tblarrival_sub WHERE old=? ");
				$stmt_3->bind_param("s", $lotnumber);
				$stmt_3->execute();
			//	$stmt_3->store_result();
				if ($stmt_3->num_rows > 0){$ct++;}
				$stmt_3->close();	
				*/
				if ($ct==0) { array_push($user10, $lotnumber);}
				
				
				//array_push($user10, $lotnumber);
			}
			$stmt_2->close();
		}
		if(empty($user10))
		{return false;}
		else
		{return $user10;}		
	}		
	
		
	public function GetTranSetupLotIns($scode,$trid,$lotno,$nobdc,$qtydc,$tarewt,$arrsub_id,$setuptype) {
		$plantcode = $this->getPlantcode($scode);
		$userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; $stage2='R';
		$stmt = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
		//return $stmt->num_rows;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_id);
			$stmt->fetch();
			$stmt->close();
        
			$lotimpid=0; $lotcrop=''; $lotspcodef=''; $lotspcodem=''; $lotploc=''; $lotstate=''; $lotpper=''; $lotorganiser=''; $lotfarmer=''; $lotplotno=''; $pdnno=''; $pdndate=''; $sstage='Raw'; $prodtype='';
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotimpid, lotcrop, lotspcodef, lotspcodem, lotploc, lotstate, lotpper, lotorganiser, lotfarmer, lotplotno, pdnno, pdndate, prodtype  FROM tbllotimp WHERE trid=0 AND lotnumber = ? ");
			$stmt_lotimp->bind_param("s", $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			//return "SELECT lotimpid, lotcrop, lotspcodef, lotspcodem, lotploc, lotstate, lotpper, lotorganiser, lotfarmer, lotplotno, pdnno, pdndate, prodtype  FROM tbllotimp WHERE trid=0 AND lotnumber = '$lotno' ";
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotimpid, $lotcrop, $lotspcodef, $lotspcodem, $lotploc, $lotstate, $lotpper, $lotorganiser, $lotfarmer, $lotplotno, $pdnno, $pdndate, $prodtype);
				//looping through all the records 
				$stmt_lotimp->fetch();
				$stmt_lotimp->close();
			
				$popularname=$lotcrop."-Coded";
				$stmt_spc = $this->conn_ps->prepare("SELECT variety, crop FROM tblspcodes WHERE spcodef = ? AND spcodem = ? ");
				$stmt_spc->bind_param("ss", $lotspcodef, $lotspcodem);
				$result_spc=$stmt_spc->execute();
				$stmt_spc->store_result();
				if ($stmt_spc->num_rows > 0) {
					$stmt_spc->bind_result($spcvariety, $spccrop);
					//looping through all the records 
					$stmt_spc->fetch();
					$stmt_spc->close();
				
					$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
					$stmt_variety->bind_param("i", $spcvariety);
					$result_variety=$stmt_variety->execute();
					$stmt_variety->store_result();
					if ($stmt_variety->num_rows > 0) {
						$stmt_variety->bind_result($varietyid, $popularname);
						//looping through all the records 
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
				$pcode='';
				//$plantcode = $this->getPlantcode($scode);
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
				
				if($arrival_id==$trid)
				{
					$lotn=$pcode.$lotno."/00000/00".$stage2; $orlot=$pcode.$lotno."/00000/00";
					
					if($setuptype=="Add")
					{
						$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_sub_unld (arrival_id, lotimpid, lotcrop, lotvariety, qty, act1, tarewt, lotno, orlot, old, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, sstage, prodtype, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssssssssssssssssssss", $arrival_id, $lotimpid, $lotcrop, $popularname, $qtydc, $nobdc, $tarewt, $lotn, $orlot, $lotno, $pdndate, $pdnno, $lotspcodef, $lotspcodem, $lotorganiser, $lotfarmer, $lotploc, $lotstate, $lotpper, $lotplotno, $stage, $prodtype, $plantcode);
					}
					else if($setuptype=="Edit")
					{
						$stmt60 = $this->conn_ps->prepare("UPDATE tblarrival_sub_unld SET qty=?, act1=? where arrsub_id=?");
						$stmt60->bind_param("sii", $qtydc, $nobdc, $arrsub_id);
					}
					else
					{
						$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_sub_unld (arrival_id, lotimpid, lotcrop, lotvariety, qty, act1, tarewt, lotno, orlot, old, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, sstage, prodtype, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssssssssssssssssssss", $arrival_id, $lotimpid, $lotcrop, $popularname, $qtydc, $nobdc, $tarewt, $lotn, $orlot, $lotno, $pdndate, $pdnno, $lotspcodef, $lotspcodem, $lotorganiser, $lotfarmer, $lotploc, $lotstate, $lotpper, $lotplotno, $stage, $prodtype, $plantcode);
					}
					$result60 = $stmt60->execute();
					//echo $barcode."  -  ".$scanby."  -  ".$opr_id."  -  ".$sp_id."  -  ".$schpoints."  -  ".$opr_state."  -  ".$sch_name."  -  ".$qrcode."  -  ".$dt."  -  ".$role;
					if($result60)
					{
						//$trid=$stmt60->insert_id;
						$stmt_lotimpt = $this->conn_ps->prepare("Update tbllotimp SET lotimpflg=2 where lotnumber = ? ");
						$stmt_lotimpt->bind_param("s", $lotno);
						$result_lotimpt = $stmt_lotimpt->execute();
						$stmt_lotimpt->close();
						
						$userSR["trid"] = $arrival_id;
					}
					else
					{
						$userSR["trid"] = $arrival_id;
					}
					$stmt60->close();
				}
			}
		} 
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }


	
	
	public function GetTranSetupLotBagsList($scode,$trid) {
		$plantcode = $this->getPlantcode($scode);
		$userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw';
		$stmt = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_id);
			$stmt->fetch();
			$stmt->close();
        
			$lotcrop=''; $lotvariety=''; $lotno=''; $orlot=''; $qty=0; $act1=0; $tarewt=0; $old='';   $user10=array();
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotcrop, lotvariety, lotno, orlot, qty, act1, old, arrsub_id, spcodef, spcodem FROM tblarrival_sub_unld WHERE arrival_id = ? ");
			$stmt_lotimp->bind_param("i", $trid);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotcrop, $lotvariety, $lotno, $orlot, $qty, $act1, $old, $arrsub_id, $spcodef, $spcodem);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$nnob=0; $grwt=0; $ntwt=0; $actntqty=0;  $actgrqty=0; $actnob=0; $grsswt=0; $lasttarewt=0; $bagsarray=array();
					$stmt_2 = $this->conn_ps->prepare("SELECT grosswt, netwt, tarewt, arrsubsub_id  FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? order by arrsubsub_id ASC");
					$stmt_2->bind_param("ii", $arrival_id, $arrsub_id);
					$result2=$stmt_2->execute();
					$stmt_2->store_result();
					if ($stmt_2->num_rows > 0) {
						$stmt_2->bind_result($grosswt, $netwt, $tarewt, $arrsubsub_id);
						//looping through all the records
						while($stmt_2->fetch())
						{
							$nnob=$nnob+1;
							$grwt=$grwt+$grosswt;
							$ntwt=$ntwt+$netwt;
							$grsswt=$grosswt;
							$lasttarewt=$tarewt;
							$temp=array('bagid'=>$arrsubsub_id, 'bag'=>$grosswt, 'tarewt'=>$tarewt);
							array_push($bagsarray, $temp);
							//$bagsarray=array('bagid'=> $arrsubsub_id;
							//$bagsarray["bag"] = $grosswt;
						}
						$actntqty=$actntqty+$ntwt;  
						$actgrqty=$actgrqty+$grwt; 
						$actnob=$actnob+$nnob;
					}
					$stmt_2->close();
					$slflg=0; $slocs='';
					$stmt_arrsloc = $this->conn_ps->prepare("SELECT arrsloc_id, whid, binid, subbin  FROM tblarr_sloc_unld WHERE arr_tr_id = ? and arr_id = ? ");
					$stmt_arrsloc->bind_param("ii", $arrival_id, $arrsub_id);
					$result_arrsloc=$stmt_arrsloc->execute();
					$stmt_arrsloc->store_result();
					if ($stmt_arrsloc->num_rows > 0) {
						$stmt_arrsloc->bind_result($arrsloc_id, $owhid, $obinid, $osubbin);
						//looping through all the records
						while($stmt_arrsloc->fetch())
						{
							
							$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
							$stmt_wh->bind_param("ss", $owhid, $plantcode);
							$result_wh=$stmt_wh->execute();
							$stmt_wh->store_result();
							if ($stmt_wh->num_rows > 0) {
								$stmt_wh->bind_result($whperticulars,$whid);
								//looping through all the records 
								$stmt_wh->fetch();
								$stmt_wh->close();
					
								$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
								$stmt_bin->bind_param("iss", $owhid, $obinid, $plantcode);
								$result_bin=$stmt_bin->execute();
								$stmt_bin->store_result();
								if ($stmt_bin->num_rows > 0) {
									$stmt_bin->bind_result($binname, $binid);
									//looping through all the records
									$stmt_bin->fetch();
									$stmt_bin->close();
									
									$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
									$stmt_sbin->bind_param("iiss", $owhid, $obinid, $osubbin, $plantcode);
									$result2=$stmt_sbin->execute();
									$stmt_sbin->store_result();
									if ($stmt_sbin->num_rows > 0) {
										$stmt_sbin->bind_result($subbinname, $subbinid);
										//looping through all the records
										$stmt_sbin->fetch();
										$stmt_sbin->close();
									}
								}
								
								if($slocs!="")
								$slocs=$slocs.",".$whperticulars."-".$binname."-".$subbinname;
								else
								$slocs=$whperticulars."-".$binname."-".$subbinname;
							}
							
							$slflg++;
						}
						$stmt_arrsloc->close();
					}
					
					
					$trwt=$tarewt*$act1;
					$qtynt=$qty-$trwt;
					$user10["crop"] = $lotcrop;
					$user10["variety"] = $lotvariety;
					$user10["lotno"] = stripslashes($lotno);
					$user10["orlot"] = $orlot;
					$user10["dcnob"] = $act1;
					$user10["dcgrqty"] = $qty;
					$user10["dcntqty"] = $qtynt;
					$user10["tarewt"] = $lasttarewt;
					$user10["oldlot"] = $old;
					$user10["actnob"] = $actnob;
					$user10["actntqty"] = $actntqty;
					$user10["actgrqty"] = $actgrqty;
					$user10["lastbagwt"] = $grsswt;
					$user10["slocflg"] = $slflg;
					$user10["sloc"] = $slocs;
					$user10["bagsarray"] = $bagsarray;
					array_push($userSR,$user10);
				}
				
				$stmt_lotimp->close();
			}
		} 
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }


public function GetTranSetupLotyrcodelist() {
	
		$userSR=array(); $blank='';
		$stmt = $this->conn_ps->prepare("SELECT ycode FROM tblyears WHERE ycode != ? order by yearsid DESC LIMIT 0,2");
        $stmt->bind_param("s", $blank);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($ycode);
			while($stmt->fetch())
			{
				//$user10["lotyear"] = $ycode;
				array_push($userSR,$ycode);
			}		
			$stmt->close();
       } 
	
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }



	public function GetTranSetupLotList($scode,$trid) {
	
		$userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw';
		$stmt = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_id);
			$stmt->fetch();
			$stmt->close();
        
			$lotcrop=''; $lotvariety=''; $lotno=''; $orlot=''; $qty=0; $act1=0; $tarewt=0; $old='';   $user10=array();
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotcrop, lotvariety, lotno, orlot, qty, act1, old, arrsub_id, spcodef, spcodem FROM tblarrival_sub_unld WHERE arrival_id = ? ");
			$stmt_lotimp->bind_param("i", $trid);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotcrop, $lotvariety, $lotno, $orlot, $qty, $act1, $old, $arrsub_id, $spcodef, $spcodem);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$nnob=0; $grwt=0; $ntwt=0; $actntqty=0;  $actgrqty=0; $actnob=0; $grsswt=0; $lasttarewt=0; 
					$stmt_2 = $this->conn_ps->prepare("SELECT grosswt, netwt, tarewt FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? order by arrsubsub_id ASC");
					$stmt_2->bind_param("ii", $arrival_id, $arrsub_id);
					$result2=$stmt_2->execute();
					$stmt_2->store_result();
					if ($stmt_2->num_rows > 0) {
						$stmt_2->bind_result($grosswt, $netwt, $tarewt);
						//looping through all the records
						while($stmt_2->fetch())
						{
							$nnob=$nnob+1;
							$grwt=$grwt+$grosswt;
							$ntwt=$ntwt+$netwt;
							$grsswt=$grosswt;
							$lasttarewt=$tarewt;
						}
						$actntqty=$actntqty+$ntwt;  
						$actgrqty=$actgrqty+$grwt; 
						$actnob=$actnob+$nnob;
					}
					$stmt_2->close();
					$slflg=0; $slocs='';
					$stmt_arrsloc = $this->conn_ps->prepare("SELECT arrsloc_id, whid, binid, subbin  FROM tblarr_sloc_unld WHERE arr_tr_id = ? and arr_id = ? ");
					$stmt_arrsloc->bind_param("ii", $arrival_id, $arrsub_id);
					$result_arrsloc=$stmt_arrsloc->execute();
					$stmt_arrsloc->store_result();
					if ($stmt_arrsloc->num_rows > 0) {
						$stmt_arrsloc->bind_result($arrsloc_id, $owhid, $obinid, $osubbin);
						//looping through all the records
						while($stmt_arrsloc->fetch())
						{
							
							$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ?");
							$stmt_wh->bind_param("s", $owhid);
							$result_wh=$stmt_wh->execute();
							$stmt_wh->store_result();
							if ($stmt_wh->num_rows > 0) {
								$stmt_wh->bind_result($whperticulars,$whid);
								//looping through all the records 
								$stmt_wh->fetch();
								$stmt_wh->close();
					
								$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? ");
								$stmt_bin->bind_param("is", $owhid, $obinid);
								$result_bin=$stmt_bin->execute();
								$stmt_bin->store_result();
								if ($stmt_bin->num_rows > 0) {
									$stmt_bin->bind_result($binname, $binid);
									//looping through all the records
									$stmt_bin->fetch();
									$stmt_bin->close();
									
									$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? order by sname ASC");
									$stmt_sbin->bind_param("iis", $owhid, $obinid, $osubbin);
									$result2=$stmt_sbin->execute();
									$stmt_sbin->store_result();
									if ($stmt_sbin->num_rows > 0) {
										$stmt_sbin->bind_result($subbinname, $subbinid);
										//looping through all the records
										$stmt_sbin->fetch();
										$stmt_sbin->close();
									}
								}
								
								if($slocs!="")
								$slocs=$slocs.",".$whperticulars."-".$binname."-".$subbinname;
								else
								$slocs=$whperticulars."-".$binname."-".$subbinname;
							}
							
							$slflg++;
						}
						$stmt_arrsloc->close();
					}
					
					
					$trwt=$tarewt*$act1;
					$qtynt=$qty-$trwt;
					
					$user10["arrsub_id"] = $arrsub_id;
					$user10["crop"] = $lotcrop;
					$user10["variety"] = $lotvariety;
					$user10["lotno"] = stripslashes($lotno);
					$user10["spcodef"] = $spcodef;
					$user10["spcodem"] = $spcodem;
					$user10["orlot"] = $orlot;
					$user10["dcnob"] = $act1;
					$user10["dcgrqty"] = $qty;
					$user10["dcntqty"] = $qtynt;
					$user10["tarewt"] = $lasttarewt;
					$user10["oldlot"] = $old;
					$user10["actnob"] = $actnob;
					$user10["actntqty"] = $actntqty;
					$user10["actgrqty"] = $actgrqty;
					$user10["lastbagwt"] = $grsswt;
					$user10["slocflg"] = $slflg;
					$user10["sloc"] = $slocs;
					array_push($userSR,$user10);
				}
				
				$stmt_lotimp->close();
			}
		} 
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }




	public function GetTranSetupFinalize($trid) {
	
		$flg=0;
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrsetupflag=1 where arrival_id = ? ");
			$stmt60->bind_param("i", $arrival_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
			
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}		
	
	
	
	public function GetTranUnldInit($scode,$trid,$transname,$vehno,$lrno,$paymode,$disploc,$passinno) {
	
		$flg=0; $dt=date("Y-m-d");
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrsetupflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			$tmode='Transport';
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrival_date=?, arrunldflag=2, unldlogid=?, tmode=?, trans_name=?, trans_lorryrepno=?, trans_vehno=?, trans_paymode=?, disploc=?, passinno=? where arrival_id = ? ");
			$stmt60->bind_param("sssssssssi", $dt, $scode, $tmode, $transname, $lrno, $vehno, $paymode, $disploc, $passinno, $arrival_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}  
			$stmt60->close();
			
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}		
	
	
	public function GetTranUnldLotWtIns($scode,$trid,$lotno,$qtyact,$tarewt) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0;
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrsetupflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotno, orlot, old, arrsub_id FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
			$stmt_lotimp->bind_param("is", $trid, $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($nlotno, $orlot, $old, $arrsub_id);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$ntwt=$qtyact-$tarewt;
					$stmt60 = $this->conn_ps->prepare("Insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt, plantcode) Values(?,?,?,?,?,?,?) ");
					$stmt60->bind_param("iisssss", $trid, $arrsub_id, $old, $qtyact, $ntwt, $tarewt, $plantcode);
					$result60 = $stmt60->execute();
					if($result60){$flg=1;} 
					$stmt60->close(); 
				}
			}	
			$stmt_lotimp->close();
				
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}		
	
	public function GetTranUnldFinalize($trid) {
	
		$flg=0;
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrunldflag=1 where arrival_id = ? ");
			$stmt60->bind_param("i", $arrival_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
			
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}		
	
	
	public function GetTranFinLotSel($scode,$trid,$lotno) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id, dc_date, arrival_code FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id, $dc_date, $arrival_code);
			//looping through all the records
			$stmt_2->fetch();
			
			if($dc_date!='' && $dc_date!='0000-00-00' && $dc_date!=NULL)
			{
				$dc_date1=explode("-",$dc_date);
				$dc_date=$dc_date1[2]."-".$dc_date1[1]."-".$dc_date1[0];
			}
			$userSR["dcdate"]=$dc_date;
			$userSR["arrival_code"] = "AF".$arrival_code;
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotcrop, lotvariety, old, arrsub_id, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, harvestdate, gi, got, sstatus, moisture, gemp, vchk, remarks, qc, qcstatus, leupto, got1, leduration FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
			$stmt_lotimp->bind_param("is", $trid, $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotcrop, $lotvariety, $old, $arrsub_id, $pdndate, $pdnno, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $plotno, $harvestdate, $gi, $got, $sstatus, $moisture, $gemp, $vchk, $remarks, $qc, $qcstatus, $leupto, $got1, $ledurationsel);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$codvarety=$lotcrop."-Coded";
					
					if($pdndate!='' && $pdndate!='0000-00-00' && $pdndate!=NULL)
					{
						$pdndate1=explode("-",$pdndate);
						$pdndate=$pdndate1[2]."-".$pdndate1[1]."-".$pdndate1[0];
					}
					$userSR["pdndate"]=$pdndate;
					$userSR["pdnno"]=$pdnno;
					$userSR["spcodef"]=$spcodef;
					$userSR["spcodem"]=$spcodem;
					$userSR["organiser"]=$organiser;
					$userSR["farmer"]=$farmer;
					$userSR["ploc"]=$ploc;
					$userSR["lotstate"]=$lotstate;
					$userSR["pper"]=$pper;
					$userSR["plotno"]=$plotno;
					
					if($lotvariety!=$codvarety)
					{
						$stmt_variety = $this->conn_ps->prepare("SELECT leduration, opt FROM tblvariety WHERE popularname = ? AND cropid = ? ");
						$stmt_variety->bind_param("ss", $lotvariety, $lotcrop);
						$result_variety=$stmt_variety->execute();
						$stmt_variety->store_result();
						if ($stmt_variety->num_rows > 0) {
							$stmt_variety->bind_result($leduration, $opt);
							//looping through all the records 
							$stmt_variety->fetch();
							$ledur=array();
							for($i=$leduration; $i>0; $i--)
							{
								array_push($ledur,$i);
							}
							
							//return $ledur;
							$userSR["leduration"]=$ledur;
							//$userSR["leduration"]=$leduration;
							$userSR["opt"]=$opt;
						}	
						else{
							$leduration=36;
							$ledur=array();
							for($i=$leduration; $i>0; $i--)
							{
								array_push($ledur,$i);
							}

							$opt='Optional';
							$userSR["leduration"]=$ledur;
							$userSR["opt"]=$opt;
						}
						$stmt_variety->close();
					}
					else
					{
						$leduration=36;
						$ledur=array();
						for($i=$leduration; $i>0; $i--)
						{
							array_push($ledur,$i);
						}

						$opt='Optional';
						$userSR["leduration"]=$ledur;
						$userSR["opt"]=$opt;
					}
					
					if($harvestdate!='' && $harvestdate!='0000-00-00' && $harvestdate!=NULL)
					{
						$harvestdate1=explode("-",$harvestdate);
						$harvestdate=$harvestdate1[2]."-".$harvestdate1[1]."-".$harvestdate1[0];
					}
					if($leupto!='' && $leupto!='0000-00-00' && $leupto!=NULL)
					{
						$leupto1=explode("-",$leupto);
						$leupto=$leupto1[2]."-".$leupto1[1]."-".$leupto1[0];
					}
					$userSR["lotno"]=$old;
					$userSR["lotcrop"]=$lotcrop;
					$userSR["lotvariety"]=$lotvariety;
					$userSR["harvestdate"]=$harvestdate;
					$userSR["geoindex"]=$gi;
					$userSR["gottype"]=$got;
					$userSR["seedstatus"]=$sstatus;
					$userSR["moisture"]=$moisture;
					$userSR["purity"]=$vchk;
					$userSR["remark"]=$remarks;
					$userSR["qcstatus"]=$qc;
					$userSR["ledurationsel"]=$ledurationsel;
					$userSR["ledate"]=$leupto;
					$userSR["arrstatus"]=$opt;
					$userSR["gotstatus"]=$got1;
					$userSR["stage"]="Raw";
					
					$cct=0; $wh_name=''; $bin_name=''; $subbin_name=''; $slocnob=''; $slocqty='';  $wh_name1=''; $bin_name1=''; $subbin_name1=''; $slocnob1=''; $slocqty1='';
					$stmt_sloc = $this->conn_ps->prepare("SELECT whid, binid, subbin, qty, bags, balqty, balbags FROM tblarr_sloc_unld where arr_tr_id = ? and arr_id = ? order by arrsloc_id ASC");
					$stmt_sloc->bind_param("ii", $trid, $arrsub_id);
					$result_sloc=$stmt_sloc->execute();
					$stmt_sloc->store_result();
					if ($stmt_sloc->num_rows ==0) {
								$userSR["whname"]=$wh_name;
								$userSR["binname"]=$bin_name;
								$userSR["subbinname"]=$subbin_name;
								$userSR["slocnob"]=$slocnob;
								$userSR["slocqty"]=$slocqty;
								$userSR["whname1"]=$wh_name1;
								$userSR["binname1"]=$bin_name1;
								$userSR["subbinname1"]=$subbin_name1;
								$userSR["slocnob1"]=$slocnob1;
								$userSR["slocqty1"]=$slocqty1;
								$user10=array();$user11=array();$user12=array();
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse where plantcode=? order by perticulars ASC");
								$stmt_wharr->bind_param("s", $plantcode);
								$result_wharr=$stmt_wharr->execute();
								$stmt_wharr->store_result();
								if ($stmt_wharr->num_rows > 0) {
									$stmt_wharr->bind_result($wharrperticulars, $arrwhid);
									//looping through all the records 
									while($stmt_wharr->fetch())
									{
										array_push($user10,$wharrperticulars);
									}
									$userSR["wharray"]=$user10;
									$stmt_wharr->close();
								}	
								$userSR["binarray"]=$user11;
								$userSR["subbinarray"]=$user12;
								$user13=array();$user14=array();$user15=array();	
								$userSR["wharray1"]=$user10;		
								$userSR["binarray1"]=$user14;
								$userSR["subbinarray1"]=$user15;
					}
					else{
						$stmt_sloc->bind_result($owhid, $obinid, $osubbin, $qty, $bags, $balqty, $balbags);
						//looping through all the records 
						//$userSR["numrows"]=$stmt_sloc->num_rows;
						//return $userSR;
						while($stmt_sloc->fetch())
						{
							$user10=array();$user11=array();$user12=array();
					
							$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ?");
							$stmt_wh->bind_param("i", $owhid);
							$result_wh=$stmt_wh->execute();
							$stmt_wh->store_result();
							if ($stmt_wh->num_rows > 0) {
								$stmt_wh->bind_result($whperticulars,$whid);
								//looping through all the records 
								$stmt_wh->fetch();
								$stmt_wh->close();
							}
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? ");
							$stmt_bin->bind_param("ii", $owhid, $obinid);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
							}	
							$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? order by sname ASC");
							$stmt_sbin->bind_param("iii", $owhid, $obinid, $osubbin);
							$result2=$stmt_sbin->execute();
							$stmt_sbin->store_result();
							if ($stmt_sbin->num_rows > 0) {
								$stmt_sbin->bind_result($subbinname, $subbinid);
								//looping through all the records
								$stmt_sbin->fetch();
								$stmt_sbin->close();
							}
								
							
							if($cct==0)
							{
								$wh_name=$whperticulars; 
								$bin_name=$binname; 
								$subbin_name=$subbinname; 
								$slocnob=$balbags; 
								$slocqty=$balqty;
								$userSR["whname"]=$wh_name;
								$userSR["binname"]=$bin_name;
								$userSR["subbinname"]=$subbin_name;
								$userSR["slocnob"]=$balbags;
								$userSR["slocqty"]=$balqty;
								$userSR["whname1"]=$wh_name1;
								$userSR["binname1"]=$bin_name1;
								$userSR["subbinname1"]=$subbin_name1;
								$userSR["slocnob1"]=$slocnob1;
								$userSR["slocqty1"]=$slocqty1;
								
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse WHERE plantcode=? order by perticulars ASC");
								$stmt_wharr->bind_param("s", $plantcode);
								$result_wharr=$stmt_wharr->execute();
								$stmt_wharr->store_result();
								if ($stmt_wharr->num_rows > 0) {
									$stmt_wharr->bind_result($wharrperticulars, $arrwhid);
									//looping through all the records 
									while($stmt_wharr->fetch())
									{
										array_push($user10,$wharrperticulars);
									}
									$userSR["wharray"]=$user10;
									$stmt_wharr->close();
								}	
								$stmt_binarr = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? order by binname ASC");
								$stmt_binarr->bind_param("i", $owhid);
								$result_binarr=$stmt_binarr->execute();
								$stmt_binarr->store_result();
								if ($stmt_binarr->num_rows > 0) {
									$stmt_binarr->bind_result($arrbinname, $arrbinid);
									//looping through all the records 
									while($stmt_binarr->fetch())
									{
										array_push($user11,$arrbinname);
									}
									$userSR["binarray"]=$user11;
									$stmt_binarr->close();
								}		
								$stmt_sbinarr = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? order by sname ASC");
								$stmt_sbinarr->bind_param("ii", $owhid, $obinid);
								$result_sbinarr=$stmt_sbinarr->execute();
								$stmt_sbinarr->store_result();
								if ($stmt_sbinarr->num_rows > 0) {
									$stmt_sbinarr->bind_result($arrsubbinname, $arrsubbinid);
									//looping through all the records 
									while($stmt_sbinarr->fetch())
									{
										array_push($user12,$arrsubbinname);
									}
									
									$userSR["subbinarray"]=$user12;
									$stmt_sbinarr->close();	
								}	
								$user13=array();$user14=array();$user15=array();	
								$userSR["wharray1"]=$user10;		
								$userSR["binarray1"]=$user14;
								$userSR["subbinarray1"]=$user15;
							}
							if($cct==1)
							{
								$whname1=$whperticulars; 
								$binname1=$binname; 
								$subbinname1=$subbinname; 
								$slocnob1=$balbags; 
								$slocqty1=$balqty;
								$userSR["whname1"]=$whname1;
								$userSR["binname1"]=$binname1;
								$userSR["subbinname1"]=$subbinname1;
								$userSR["slocnob1"]=$slocnob1;
								$userSR["slocqty1"]=$slocqty1;
								
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse WHERE plantcode=? order by perticulars ASC");
								$stmt_wharr->bind_param("s", $plantcode);
								$result_wharr=$stmt_wharr->execute();
								$stmt_wharr->store_result();
								if ($stmt_wharr->num_rows > 0) {
									$stmt_wharr->bind_result($wharrperticulars, $arrwhid);
									//looping through all the records 
									while($stmt_wharr->fetch())
									{
										array_push($user10,$wharrperticulars);
									}
									$userSR["wharray1"]=$user10;
									$stmt_wharr->close();
								}	
								$stmt_binarr = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? order by binname ASC");
								$stmt_binarr->bind_param("i", $owhid);
								$result_binarr=$stmt_binarr->execute();
								$stmt_binarr->store_result();
								if ($stmt_binarr->num_rows > 0) {
									$stmt_binarr->bind_result($arrbinname, $arrbinid);
									//looping through all the records 
									while($stmt_binarr->fetch())
									{
										array_push($user11,$arrbinname);
									}
									$userSR["binarray1"]=$user11;
									$stmt_binarr->close();
								}		
								$stmt_sbinarr = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? order by sname ASC");
								$stmt_sbinarr->bind_param("ii", $owhid, $obinid);
								$result_sbinarr=$stmt_sbinarr->execute();
								$stmt_sbinarr->store_result();
								if ($stmt_sbinarr->num_rows > 0) {
									$stmt_sbinarr->bind_result($arrsubbinname, $arrsubbinid);
									//looping through all the records 
									while($stmt_sbinarr->fetch())
									{
										array_push($user12,$arrsubbinname);
									}
									
									$userSR["subbinarray1"]=$user12;
									$stmt_sbinarr->close();	
								}		
							}
							$cct++;
						}
						$stmt_sloc->close();
					}
				}
			}	
			$stmt_lotimp->close();
				
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}		
	}	
	
	
	
	
	public function GetTranFinLotSelEdit($scode,$trid,$lotno) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();$user10=array();
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id, dc_date, arrival_code FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id, $dc_date, $arrival_code);
			//looping through all the records
			$stmt_2->fetch();
			
			if($dc_date!='' && $dc_date!='0000-00-00' && $dc_date!=NULL)
			{
				$dc_date1=explode("-",$dc_date);
				$dc_date=$dc_date1[2]."-".$dc_date1[1]."-".$dc_date1[0];
			}
			$userSR["dcdate"]=$dc_date;
			$userSR["arrival_code"] = "AF".$arrival_code;
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotcrop, lotvariety, old, arrsub_id, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
			$stmt_lotimp->bind_param("is", $trid, $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotcrop, $lotvariety, $old, $arrsub_id, $pdndate, $pdnno, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $plotno);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$codvarety=$lotcrop."-Coded";
					
					if($pdndate!='' && $pdndate!='0000-00-00' && $pdndate!=NULL)
					{
						$pdndate1=explode("-",$pdndate);
						$pdndate=$pdndate1[2]."-".$pdndate1[1]."-".$pdndate1[0];
					}
					
					$userSR["pdndate"]=$pdndate;
					$userSR["pdnno"]=$pdnno;
					$userSR["spcodef"]=$spcodef;
					$userSR["spcodem"]=$spcodem;
					$userSR["organiser"]=$organiser;
					$userSR["farmer"]=$farmer;
					$userSR["ploc"]=$ploc;
					$userSR["lotstate"]=$lotstate;
					$userSR["pper"]=$pper;
					$userSR["plotno"]=$plotno;
					
					if($lotvariety!=$codvarety)
					{
						$stmt_variety = $this->conn_ps->prepare("SELECT leduration, opt FROM tblvariety WHERE popularname = ? AND cropid = ? ");
						$stmt_variety->bind_param("is", $lotvariety, $lotcrop);
						$result_variety=$stmt_variety->execute();
						$stmt_variety->store_result();
						if ($stmt_variety->num_rows > 0) {
							$stmt_variety->bind_result($leduration, $opt);
							//looping through all the records 
							$stmt_variety->fetch();
							$ledur=array();
							for($i=$leduration; $i>0; $i--)
							{
								array_push($ledur,$i);
							}
							//return $ledur;
							$userSR["leduration"]=$ledur;
							//$userSR["leduration"]=$leduration;
							$userSR["opt"]=$opt;
						}	
						else{
							$leduration=36;
							$ledur=array();
							for($i=$leduration; $i>0; $i--)
							{
								array_push($ledur,$i);
							}

							$opt='Optional';
							$userSR["leduration"]=$ledur;
							$userSR["opt"]=$opt;
						}
						$stmt_variety->close();
					}
					else{
						$leduration=36;
						$ledur=array();
						for($i=$leduration; $i>0; $i--)
						{
							array_push($ledur,$i);
						}

						$opt='Optional';
						$userSR["leduration"]=$ledur;
						$userSR["opt"]=$opt;
					}
					
					$stmt_wh = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse WHERE plantcode=? order by perticulars ASC");
					$stmt_wh->bind_param("s", $plantcode);
					$result_wh=$stmt_wh->execute();
					$stmt_wh->store_result();
					if ($stmt_wh->num_rows > 0) {
						$stmt_wh->bind_result($whperticulars, $whid);
						//looping through all the records 
						while($stmt_wh->fetch())
						{
							array_push($user10,$whperticulars);
						}
						//array_push($userSR,$user10);
						//return $user10;
					}	
					$userSR["wharray"]=$user10;
					$stmt_wh->close();
					/*$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrtrflag=2, logid=? where arrival_id = ? ");
					$stmt60->bind_param("si", $scode, $arrival_id);
					$result60 = $stmt60->execute();
					if($result60){$flg=1;}  
					$stmt60->close();*/
				}
			}	
			$stmt_lotimp->close();
				
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}		
	}	
	
	
	
	
	public function GetTranFinBinSel($scode,$whname) {
		$plantcode = $this->getPlantcode($scode);
		$user10=array();
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? AND plantcode=?");
		$stmt_wh->bind_param("ss", $whname, $plantcode);
		$result_wh=$stmt_wh->execute();
		$stmt_wh->store_result();
		if ($stmt_wh->num_rows > 0) {
			$stmt_wh->bind_result($whperticulars,$whid);
			//looping through all the records 
			$stmt_wh->fetch();

			$stmt_2 = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? order by binname ASC");
			$stmt_2->bind_param("s", $whid);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows > 0) {
				$stmt_2->bind_result($binname, $binid);
				//looping through all the records
				while($stmt_2->fetch())
				{
					array_push($user10, $binname);
				}
				$stmt_2->close();
			}
			$stmt_wh->close();
		}
		if(empty($user10))
		{return false;}
		else
		{return $user10;}		
	}		
	
	public function GetTranFinSubBinSel($scode,$whname,$binname) {
		$plantcode = $this->getPlantcode($scode);
		$user10=array();
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? AND plantcode=?");
		$stmt_wh->bind_param("ss", $whname, $plantcode);
		$result_wh=$stmt_wh->execute();
		$stmt_wh->store_result();
		if ($stmt_wh->num_rows > 0) {
			$stmt_wh->bind_result($whperticulars,$whid);
			//looping through all the records 
			$stmt_wh->fetch();
			$stmt_wh->close();

			$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
			$stmt_bin->bind_param("is", $whid, $binname);
			$result_bin=$stmt_bin->execute();
			$stmt_bin->store_result();
			if ($stmt_bin->num_rows > 0) {
				$stmt_bin->bind_result($binname, $binid);
				//looping through all the records
				$stmt_bin->fetch();
				$stmt_bin->close();
				
				$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? order by sname ASC");
				$stmt_sbin->bind_param("ii", $whid, $binid);
				$result2=$stmt_sbin->execute();
				$stmt_sbin->store_result();
				if ($stmt_sbin->num_rows > 0) {
					$stmt_sbin->bind_result($subbinname, $subbinid);
					//looping through all the records
					while($stmt_sbin->fetch())
					{
						array_push($user10, $subbinname);
					}
					$stmt_sbin->close();
				}
			
			}
			
		}
		if(empty($user10))
		{return false;}
		else
		{return $user10;}		
	}	
	
	
	public function GetCropList($scode, $mobile1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array(); $zero=0; $one=1; $two=2;
		
		$stmt_2 = $this->conn_ps->prepare("SELECT distinct pnpslipmain_crop FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' ");
		//$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($cropid);
			//looping through all the records
			while($stmt_2->fetch())
			{
				$trtyp=NULL;
					
				$stmtqrchk = $this->conn_ps->prepare("SELECT wb_crop, wb_variety, wb_ups, wb_id, wb_extqrcode FROM tbl_wbqrcode WHERE wb_mpqlinkflg=2 and wb_linklogid=?");
				$stmtqrchk->bind_param("s", $scode);
				$result_qrchk=$stmtqrchk->execute();
				$stmtqrchk->store_result();
				if ($stmtqrchk->num_rows > 0) {
					$stmtqrchk->bind_result($cropname, $varietyname, $ups, $wb_id, $qrcode);
					while($stmtqrchk->fetch())
					{
						$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mptype=?, wb_mpqrcode=?, wb_mpbarcode=?, wb_mpwt=?, wb_mpqlinkflg=?, wb_mpblinkflg=?, wb_mpgrosswt=? where wb_id=?  ");
						$stmt60->bind_param("sssiiisi", $trtyp, $trtyp, $trtyp, $zero, $zero, $zero, $trtyp, $wb_id);
						$result60 = $stmt60->execute();
						$stmt60->close();
					}
				}
				
				$stmt_pnps = $this->conn_ps->prepare("SELECT cropid, croptype, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_pnps->bind_param("i", $cropid);
				$result_pnps=$stmt_pnps->execute();
				$stmt_pnps->store_result();
				if ($stmt_pnps->num_rows > 0) {
					$stmt_pnps->bind_result($cropid, $croptype, $cropname);
					//looping through all the records 
					$stmt_pnps->fetch();
					array_push($userSR, $cropname);
					$stmt_pnps->close();
				}
			
			}
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{
		array_unique($userSR);
		return $userSR;
		}		
	}
	
	
	public function GetVarietyList($scode, $mobile1, $cropname) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		$stmt_crop = $this->conn_ps->prepare("SELECT cropid, croptype, cropname FROM tblcrop WHERE cropname = ? ");
		$stmt_crop->bind_param("s", $cropname);
		$result_crop=$stmt_crop->execute();
		$stmt_crop->store_result();
		if ($stmt_crop->num_rows > 0) {
			$stmt_crop->bind_result($cropid, $croptype, $cropname);
			//looping through all the records 
			$stmt_crop->fetch();
			$stmt_crop->close();
		}
		
		$stmt_2 = $this->conn_ps->prepare("SELECT distinct pnpslipmain_variety FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' and pnpslipmain_crop=? ");
		$stmt_2->bind_param("i", $cropid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($varid);
			//looping through all the records
			while($stmt_2->fetch())
			{
				$stmt_pnps = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_pnps->bind_param("i", $varid);
				$result_pnps=$stmt_pnps->execute();
				$stmt_pnps->store_result();
				if ($stmt_pnps->num_rows > 0) {
					$stmt_pnps->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_pnps->fetch();
					array_push($userSR, $popularname);
					$stmt_pnps->close();
				}
			
			}
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{
		array_unique($userSR);
		return $userSR;
		}			
	}
	
	public function GetUPSList($scode, $mobile1, $cropname, $varietyname, $mptype) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		$stmt_crop = $this->conn_ps->prepare("SELECT cropid, croptype, cropname FROM tblcrop WHERE cropname = ? ");
		$stmt_crop->bind_param("s", $cropname);
		$result_crop=$stmt_crop->execute();
		$stmt_crop->store_result();
		if ($stmt_crop->num_rows > 0) {
			$stmt_crop->bind_result($cropid, $croptype, $cropname);
			//looping through all the records 
			$stmt_crop->fetch();
			$stmt_crop->close();
		}
		$stmt_ver = $this->conn_ps->prepare("SELECT varietyid, popularname, gm, wtmp, nowb FROM tblvariety WHERE popularname = ? ");
		$stmt_ver->bind_param("s", $varietyname);
		$result_ver=$stmt_ver->execute();
		$stmt_ver->store_result();
		if ($stmt_ver->num_rows > 0) {
			$stmt_ver->bind_result($varietyid, $popularname, $gm, $wtmp, $nowb);
			//looping through all the records 
			$stmt_ver->fetch();
			$stmt_ver->close();
		}
		
		/*
		$stmt_ups = $this->conn_ps->prepare("SELECT wt, ups, uom, uid FROM tblups WHERE uid IN($gm) ");
		//$stmt_ups->bind_param("s", $gm);
		$result_ups=$stmt_ups->execute();
		$stmt_ups->store_result();
		if ($stmt_ups->num_rows > 0) {
			$stmt_ups->bind_result($wt, $ups, $uom, $uid);
			//looping through all the records 
			while($stmt_ups->fetch()){
				$g=explode(",",$gm);
				$m=explode(",",$wtmp);
				$w=explode(",",$nowb);
				for($i=0; $i<count($g); $i++){
					$gmm=$g[$i];
					if($gmm<>""){
						if($gmm==$uid){ 
							$mpwt=$m[$i];
							$wbinmp=$w[$i];
							//if($mpwt==""){$mpwt=0;}
							$u=explode(".",$ups);
							$x=count($u);
							if($x>1){ if($u[1]>0){$ups=$u[0].".".$u[1];}} else { $ups=$u[0].".000"; }
							$ups2=$ups." ".$wt;
							$temp['ups']=$ups2;
							$temp['wtmp']=$mpwt;
							$temp['wbinmp']=$wbinmp;
							array_push($userSR, $temp);
						}
					}
				}
			}
			
			$stmt_ups->close();
		}
		*/
		$ptype='Packing Slip';  $upsarr=array();
		if($mptype=="LMC")
		{
			$ptype='Packing Slip';
			$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_ttype FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' and pnpslipmain_crop=? and pnpslipmain_variety=? and pnpslipmain_tflag=1 and pnpslipmain_ttype=?");
			$stmt_2->bind_param("iis", $cropid, $varietyid, $ptype);
		}
		if($mptype=="NLC")
		{
			$ptype='NST Packing Slip';
			$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_ttype FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' and pnpslipmain_crop=? and pnpslipmain_variety=? and pnpslipmain_tflag=1 and pnpslipmain_ttype=?");
			$stmt_2->bind_param("iis", $cropid, $varietyid, $ptype);
		}
		if($mptype=="LWB")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_ttype FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' and pnpslipmain_crop=? and pnpslipmain_variety=? and pnpslipmain_tflag=1 ");
			$stmt_2->bind_param("ii", $cropid, $varietyid);
		}
		//$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_ttype FROM tbl_pnpslipmain WHERE pnpslipmain_trtype = 'wb' and pnpslipmain_crop=? and pnpslipmain_variety=? and pnpslipmain_tflag=1 and pnpslipmain_ttype=?");
		//$stmt_2->bind_param("iis", $cropid, $varietyid, $ptype);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($pnpslipmain_id, $pnpslipmain_ttype);
			//looping through all the records
			while($stmt_2->fetch())
			{
				$upstype="ST";
				if($pnpslipmain_ttype=="Packing Slip") {$upstype="ST";}
				if($pnpslipmain_ttype=="NST Packing Slip") {$upstype="NST";}
				$stmt_pnps = $this->conn_ps->prepare("SELECT pnpslipsub_ups, pnpslipsub_wtmp, pnpslipsub_wbinmp, pnpslipsub_wbnop FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
				$stmt_pnps->bind_param("i", $pnpslipmain_id);
				$result_pnps=$stmt_pnps->execute();
				$stmt_pnps->store_result();
				if ($stmt_pnps->num_rows > 0) {
					$stmt_pnps->bind_result($pnpslipsub_ups, $pnpslipsub_wtmp, $pnpslipsub_wbinmp, $pnpslipsub_wbnop);
					//looping through all the records 
					$stmt_pnps->fetch();
					$temp['ups']=$pnpslipsub_ups;
					$temp['wtmp']=$pnpslipsub_wtmp;
					$temp['wbinmp']=$pnpslipsub_wbinmp;
					$temp['nopinwb']=$pnpslipsub_wbnop;
					$temp['upstype']=$upstype;
					
					if(!in_array($pnpslipsub_ups,$upsarr))
					{array_push($upsarr, $pnpslipsub_ups); array_push($userSR, $temp);}
					$stmt_pnps->close();
				}
			}
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{
			//array_unique($userSR);
			return $userSR;
		}			
	}
	
	
	
	
	
	public function GetLotList($scode, $mobile1, $cropname, $varietyname, $ups, $packtype) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array(); $user10=array();
		$stmt_crop = $this->conn_ps->prepare("SELECT cropid, croptype, cropname FROM tblcrop WHERE cropname = ? ");
		$stmt_crop->bind_param("s", $cropname);
		$result_crop=$stmt_crop->execute();
		$stmt_crop->store_result();
		if ($stmt_crop->num_rows > 0) {
			$stmt_crop->bind_result($cropid, $croptype, $cropname);
			//looping through all the records 
			$stmt_crop->fetch();
			$stmt_crop->close();
		}
		$stmt_ver = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
		$stmt_ver->bind_param("s", $varietyname);
		$result_ver=$stmt_ver->execute();
		$stmt_ver->store_result();
		if ($stmt_ver->num_rows > 0) {
			$stmt_ver->bind_result($varietyid, $popularname);
			//looping through all the records 
			$stmt_ver->fetch();
			$stmt_ver->close();
		}
		
		$stmt_2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE packtype=? and lotldg_crop=? and lotldg_variety=? AND plantcode=? ");
		$stmt_2->bind_param("siis", $ups, $cropid, $varietyid, $plantcode);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($lotno3);
			//looping through all the records
			while($stmt_2->fetch())
			{
				
				$balqty=0;	
				
				//return "SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE lotldg_variety = $varietyid and subbinid = $subbinid ";
				$stmt_ldgraw8 = $this->conn_ps->prepare("SELECT distinct subbinid FROM tbl_lot_ldg_pack WHERE lotno = ? AND packtype=? and lotldg_crop=? and lotldg_variety=? AND plantcode=? ");
				$stmt_ldgraw8->bind_param("ssiis", $lotno3, $ups, $cropid, $varietyid, $plantcode);
				$result2=$stmt_ldgraw8->execute();
				$stmt_ldgraw8->store_result();
				if ($stmt_ldgraw8->num_rows > 0) {
					$stmt_ldgraw8->bind_result($subbinid);
					//looping through all the records
					while($stmt_ldgraw8->fetch())
					{
						$stmt_ldgraw9 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? AND packtype=? and lotldg_crop=? and lotldg_variety=?  and plantcode=?");
						$stmt_ldgraw9->bind_param("isiiss", $subbinid, $lotno3, $ups, $cropid, $varietyid, $plantcode);
						$result2=$stmt_ldgraw9->execute();
						$stmt_ldgraw9->store_result();
						if ($stmt_ldgraw9->num_rows > 0) {
							$stmt_ldgraw9->bind_result($lotldgid4);
							//looping through all the records
							while($stmt_ldgraw9->fetch())
							{
								$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT wtinmp, balnomp, balqty FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");
								$stmt_ldgraw0->bind_param("is", $lotldgid4, $plantcode);
								$result2=$stmt_ldgraw0->execute();
								$stmt_ldgraw0->store_result();
								if ($stmt_ldgraw0->num_rows > 0) {
									$stmt_ldgraw0->bind_result($wtinmp, $balnomp, $balqty);
									//looping through all the records
									$stmt_ldgraw0->fetch();
									
									$nompqty=$wtinmp*$balnomp;
									
									$balqty=$balqty-$nompqty;
									//$cnt2++;
								}
								$stmt_ldgraw0->close();
							}
						}
						$stmt_ldgraw9->close();
					}
				}
				$stmt_ldgraw8->close();
				
				if($balqty>0)
				{
					$upsize=explode(" ",$ups);
					if($upsize[1]=="Gms")
					{ 
						$ptp=(1000/$upsize[0]);
						$ptp1=($upsize[0]/1000);
					}
					else
					{
						$ptp=$upsize[0];
						$ptp1=$upsize[0];
					}
					
					$pch=$balqty*$ptp;
					$user10["lotno"]=$lotno3;
					$user10["pouches"]=$pch;
					array_push($userSR,$user10);
				}
			
			}
			$stmt_2->close();
		}
		
		if(empty($userSR))
		{return false;}
		else
		{
			//sort($userSR);
			return $userSR;
		}			
	}
	
	
	
	
	
	
	
	
	
	
	public function GetLblNoUpdate($scode, $trid, $lbltype, $lblno) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0;
		
		$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipmain_id FROM tbl_pnpslipmain WHERE pnpslipmain_id = ? and pnpslipmain_dop='0000-00-00' ");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			$dt=date("Y-m-d");
			$stmt60 = $this->conn_ps->prepare("Update tbl_pnpslipmain SET pnpslipmain_dop=? where pnpslipmain_id = ? ");
			$stmt60->bind_param("si", $dt, $trid);
			$result60 = $stmt60->execute();
			//if($result60){$flg=1;}
			$stmt60->close();
			
			$stmt_2->close();
		}
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT pnpslipsub_id, pnpslipsub_slabelno, pnpslipsub_elabelno FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
		$stmt_pnps->bind_param("i", $trid);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($pnpslipsub_id, $pnpslipsub_slabelno, $pnpslipsub_elabelno);
			//looping through all the records 
			$stmt_pnps->fetch();
			$stmt_pnps->close();
		}
		
		if($lbltype=="start")
		{
			if($pnpslipsub_slabelno!="" && $pnpslipsub_slabelno!=NULL)
			{$slblno=$pnpslipsub_slabelno.",".$lblno;}
			else
			{$slblno=$lblno;}
			$stmt6 = $this->conn_ps->prepare("Update tbl_pnpslipsub SET pnpslipsub_slabelno=?, pnpslipsub_lblflg=1 where pnpslipmain_id = ? ");
			$stmt6->bind_param("si", $slblno, $trid);
		}
		else
		{
			if($pnpslipsub_elabelno!="" && $pnpslipsub_elabelno!=NULL)
			{$elblno=$pnpslipsub_elabelno.",".$lblno;}
			else
			{$elblno=$lblno;}
			$stmt6 = $this->conn_ps->prepare("Update tbl_pnpslipsub SET pnpslipsub_elabelno=?, pnpslipsub_lblflg=0 where pnpslipmain_id = ? ");
			$stmt6->bind_param("si", $elblno, $trid);
		}
		
		$result6 = $stmt6->execute();
		if($result6){$flg=1;}
		$stmt6->close();
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}	
	

	public function GetTranDetails($scode,$trid, $mobile1) {
	
		$userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; $user24=array();
		$stmt = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_date, pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_trtype, pnpslipmain_dop FROM tbl_pnpslipmain WHERE pnpslipmain_id = ?");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
		$pnpslipmain_id=''; $pnpslipmain_date=''; $pnpslipmain_crop=''; $pnpslipmain_variety=''; $pnpslipmain_promachcode=''; $pnpslipmain_proopr=''; $pnpslipmain_treattype=''; $pnpslipmain_ttype=''; $pnpslipmain_dop='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($pnpslipmain_id, $pnpslipmain_date, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipmain_promachcode, $pnpslipmain_proopr, $pnpslipmain_treattype, $pnpslipmain_ttype, $pnpslipmain_dop);
			$stmt->fetch();
			if($pnpslipmain_date==NULL){$pnpslipmain_date='';} if($pnpslipmain_crop==NULL){$pnpslipmain_crop='';} if($pnpslipmain_variety==NULL){$pnpslipmain_variety='';} if($pnpslipmain_promachcode==NULL){$pnpslipmain_promachcode='';} if($pnpslipmain_proopr==NULL){$pnpslipmain_proopr='';} if($pnpslipmain_treattype==NULL){$pnpslipmain_treattype='';} if($pnpslipmain_ttype==NULL){$pnpslipmain_ttype='';}  if($pnpslipmain_dop==NULL){$pnpslipmain_dop='';} 
			if($pnpslipmain_date!='' && $pnpslipmain_date!='0000-00-00' && $pnpslipmain_date!=NULL)
			{
				$pnpslipmain_date1=explode("-",$pnpslipmain_date);
				$pnpslipmain_date=$pnpslipmain_date1[2]."-".$pnpslipmain_date1[1]."-".$pnpslipmain_date1[0];
			}
			if($pnpslipmain_dop!='' && $pnpslipmain_dop!='0000-00-00' && $pnpslipmain_dop!=NULL)
			{
				$pnpslipmain_dop1=explode("-",$pnpslipmain_dop);
				$pnpslipmain_dop=$pnpslipmain_dop1[2]."-".$pnpslipmain_dop1[1]."-".$pnpslipmain_dop1[0];
			}
			$trtyp='SMC';
			if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NMC";}
			
			if($pnpslipmain_crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $pnpslipmain_crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($pnpslipmain_variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $pnpslipmain_variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			$userSR["mobile1"] = $mobile1;
			$userSR["trid"] = $pnpslipmain_id;
			$userSR["trdate"] = $pnpslipmain_date;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["promachcode"] = $pnpslipmain_promachcode;
			$userSR["trtype"] = $trtyp;
			$userSR["dop"] = $pnpslipmain_dop;
			
			$pnpslipsub_lotno=''; $pnpslipsub_pickpqty=''; $pnpslipsub_ups=''; $pnpslipsub_wtmp=''; $pnpslipsub_nop=''; $pnpslipsub_wbnop=''; $pnpslipsub_wbwt='';  $pnpslipsub_wbinmp=''; $pnpslipsub_remarks=''; $pnpslipsub_qcdot=''; $pnpslipsub_valupto=''; $pnpslipsub_pouchccqty=0; $pnpslipsub_pouchmrp=0.00;  $pnpslipsub_gmmrp=0.00; $pnpslipsub_lblflg=0; $pnpslipsub_slabelno=''; $pnpslipsub_elabelno=''; $pnpslipsub_plotno='';
			$stmt_2 = $this->conn_ps->prepare("SELECT pnpslipsub_lotno, pnpslipsub_pickpqty, pnpslipsub_ups, pnpslipsub_wtmp, pnpslipsub_nop, pnpslipsub_wbnop, pnpslipsub_wbwt, pnpslipsub_wbinmp, pnpslipsub_remarks, pnpslipsub_qcdot, pnpslipsub_valupto, pnpslipsub_pouchccqty, pnpslipsub_pouchmrp, pnpslipsub_gmmrp, pnpslipsub_lblflg, pnpslipsub_slabelno, pnpslipsub_elabelno, pnpslipsub_plotno  FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
			$stmt_2->bind_param("i", $pnpslipmain_id);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
				$userSR["lotno"] = $pnpslipsub_lotno;
				$userSR["plotno"] = $pnpslipsub_plotno;
				$userSR["pickpqty"] = $pnpslipsub_pickpqty;
				$userSR["ups"] = $pnpslipsub_ups;
				$userSR["wtmp"] = $pnpslipsub_wtmp;
				$userSR["nop"] = $pnpslipsub_nop;
				$userSR["wbnop"] = $pnpslipsub_wbnop;
				$userSR["wbwt"] = $pnpslipsub_wbwt;
				$userSR["wbinmp"] = $pnpslipsub_wbinmp;
				$userSR["remarks"] = $pnpslipsub_remarks;
				$userSR["dot"] = $pnpslipsub_qcdot;
				$userSR["dov"] = $pnpslipsub_valupto;
				$userSR["pouchcc"] = $pnpslipsub_pouchccqty;
				$userSR["pouchmrp"] = $pnpslipsub_pouchmrp;
				$userSR["mrppergm"] = $pnpslipsub_gmmrp;
				$userSR["shiftflg"] = $pnpslipsub_lblflg;
				$userSR["slabelno"] = $pnpslipsub_slabelno;
				$userSR["elabelno"] = $pnpslipsub_elabelno;
				$stmt_2->close();

			} else {
				$stmt_2->bind_result($pnpslipsub_lotno, $pnpslipsub_pickpqty, $pnpslipsub_ups, $pnpslipsub_wtmp, $pnpslipsub_nop, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $pnpslipsub_wbinmp, $pnpslipsub_remarks, $pnpslipsub_qcdot, $pnpslipsub_valupto, $pnpslipsub_pouchccqty, $pnpslipsub_pouchmrp, $pnpslipsub_gmmrp, $pnpslipsub_lblflg,  $pnpslipsub_slabelno, $pnpslipsub_elabelno, $pnpslipsub_plotno);
				//looping through all the records
				$stmt_2->fetch();
				if($pnpslipsub_lotno==NULL){$pnpslipsub_lotno='';} if($pnpslipsub_pickpqty==NULL){$pnpslipsub_pickpqty='';} if($pnpslipsub_ups==NULL){$pnpslipsub_ups='';} if($pnpslipsub_wtmp==NULL){$pnpslipsub_wtmp='';} if($pnpslipsub_nop==NULL){$pnpslipsub_nop='';} if($pnpslipsub_wbnop==NULL){$pnpslipsub_wbnop='';} if($pnpslipsub_wbwt==NULL){$pnpslipsub_wbwt='';}  if($pnpslipsub_wbinmp==NULL){$pnpslipsub_wbinmp='';}  if($pnpslipsub_remarks==NULL){$pnpslipsub_remarks='';}  if($pnpslipsub_qcdot==NULL){$pnpslipsub_qcdot='';}  if($pnpslipsub_valupto==NULL){$pnpslipsub_valupto='';}  if($pnpslipsub_slabelno==NULL){$pnpslipsub_slabelno='';}  if($pnpslipsub_elabelno==NULL){$pnpslipsub_elabelno='';}  if($pnpslipsub_plotno==NULL){$pnpslipsub_plotno='';} 
				
				if($pnpslipsub_qcdot!='' && $pnpslipsub_qcdot!='0000-00-00' && $pnpslipsub_qcdot!=NULL)
				{
					$pnpslipsub_qcdot1=explode("-",$pnpslipsub_qcdot);
					$pnpslipsub_qcdot=$pnpslipsub_qcdot1[2]."-".$pnpslipsub_qcdot1[1]."-".$pnpslipsub_qcdot1[0];
				}
				if($pnpslipsub_valupto!='' && $pnpslipsub_valupto!='0000-00-00' && $pnpslipsub_valupto!=NULL)
				{
					$pnpslipsub_valupto1=explode("-",$pnpslipsub_valupto);
					$pnpslipsub_valupto=$pnpslipsub_valupto1[2]."-".$pnpslipsub_valupto1[1]."-".$pnpslipsub_valupto1[0];
				}
				$userSR["lotno"] = $pnpslipsub_lotno;
				$userSR["plotno"] = $pnpslipsub_plotno;
				$userSR["pickpqty"] = $pnpslipsub_pickpqty;
				$userSR["ups"] = $pnpslipsub_ups;
				$userSR["wtmp"] = $pnpslipsub_wtmp;
				$userSR["nop"] = $pnpslipsub_nop;
				$userSR["wbnop"] = $pnpslipsub_wbnop;
				$userSR["wbwt"] = $pnpslipsub_wbwt;
				$userSR["wbinmp"] = $pnpslipsub_wbinmp;
				$userSR["remarks"] = $pnpslipsub_remarks;
				$userSR["dot"] = $pnpslipsub_qcdot;
				$userSR["dov"] = $pnpslipsub_valupto;
				$userSR["pouchcc"] = $pnpslipsub_pouchccqty;
				$userSR["pouchmrp"] = $pnpslipsub_pouchmrp;
				$userSR["mrppergm"] = $pnpslipsub_gmmrp;
				$userSR["shiftflg"] = $pnpslipsub_lblflg;
				$userSR["slabelno"] = $pnpslipsub_slabelno;
				$userSR["elabelno"] = $pnpslipsub_elabelno;
				$stmt_2->close();
			}
			
			$wbcnt=0; $mpcnt=0; $wbwt=0; $wtmp=0; $totwbcnt=0;  $mpqrcflg=0; $mpbarcflg=0; $wb_mpqlinkflg=0; $wb_mpblinkflg=0; $xflg=0; $mpb=0; $mpq=0;
			$wb_actdate=''; $wb_linkdate=''; $wb_intqrcode=''; $wb_extqrcode=''; $wb_type=''; $wb_crop='';  $wb_variety=''; $wb_ups=''; $wb_lotno=''; $wb_nop=''; 
			$wb_qty=''; $wb_totwt=''; $wb_mptype=''; $wb_mpqrcode=''; $wb_mpbarcode=''; $wb_actflg=''; $pouchimg=''; $wb_mpwt='';
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_actdate, wb_linkdate, wb_intqrcode, wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_totwt, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_actflg, wb_mpwt, wb_mpqlinkflg, wb_mpblinkflg FROM tbl_wbqrcode WHERE wb_pnptrid = ? ");
			$stmt_2->bind_param("i", $pnpslipmain_id);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
				$userSR["wbcnt"] = $wbcnt;
				$userSR["mpcnt"] = $mpcnt;
				$userSR["pouchimg"] = $pouchimg;
				$userSR["wbwt"] = $wbwt;
				$userSR["wtmp"] = $wtmp;
				$userSR["totwbcnt"] = $totwbcnt;
				$userSR["mpqlinkflg"] = $wb_mpqlinkflg;
				$userSR["mpblinkflg"] = $wb_mpblinkflg;
				$stmt_2->close();

			} else {
				$stmt_2->bind_result($wb_actdate, $wb_linkdate, $wb_intqrcode, $wb_extqrcode, $wb_type, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_totwt, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_actflg, $wb_mpwt, $wb_mpqlinkflg, $wb_mpblinkflg);
				//looping through all the records
				while($stmt_2->fetch())
				{
					if($wb_mpbarcode=="")
					{$wbcnt=$wbcnt+1;}
					if($wb_mpqrcode!="")
					{$mpq=$mpq+1;}
					if($wb_mpbarcode!="")
					{$mpb=$mpb+1;}
					$wbwt=$wbwt+$wb_qty;
					$totwbcnt=$totwbcnt+1;
				}
				$stmt_3 = $this->conn_ps->prepare("SELECT DISTINCT wb_mpbarcode FROM tbl_wbqrcode WHERE wb_pnptrid = ? ");
				$stmt_3->bind_param("i", $pnpslipmain_id);
				$result3=$stmt_3->execute();
				$stmt_3->store_result();
				$stmt_3->bind_result($wb_mpqrcode);
				while($stmt_3->fetch())
				{
					if($wb_mpqrcode!="")
					{
						$stmt_4 = $this->conn_ps->prepare("SELECT wb_mpwt FROM tbl_wbqrcode WHERE wb_pnptrid = ? and wb_mpbarcode=?");
						$stmt_4->bind_param("is", $pnpslipmain_id, $wb_mpqrcode);
						$result4=$stmt_4->execute();
						$stmt_4->store_result();
						$stmt_4->bind_result($wb_mpwt);
						while($stmt_4->fetch())
						{
							$wtmp=$wtmp+$wb_mpwt;
						}
						$stmt_4->close();
						$mpcnt=$mpcnt+1;
					}
				}
				$stmt_3->close();
				
				if($wbcnt>0 && $wbcnt>=$pnpslipsub_wbinmp)
				{
					if($mpq>$mpb)
					{
						$wb_mpqlinkflg=1; 
						$wb_mpblinkflg=0;
					}
					if($mpq==$mpb)
					{
						$wb_mpqlinkflg=0; 
						$wb_mpblinkflg=0;
					}
				}
				else
				{
					if($mpq>$mpb)
					{
						$wb_mpqlinkflg=1; 
						$wb_mpblinkflg=0;
					}
					if($mpq==$mpb)
					{
						$wb_mpqlinkflg=0; 
						$wb_mpblinkflg=0;
					}
				}
				$userSR["wbcnt"] = $wbcnt;
				$userSR["mpcnt"] = $mpcnt;
				$userSR["pouchimg"] = $pouchimg;
				$userSR["wbwt"] = $wbwt;
				$userSR["wtmp"] = $wtmp;
				$userSR["totwbcnt"] = $totwbcnt;
				$userSR["mpqlinkflg"] = $wb_mpqlinkflg;
				$userSR["mpblinkflg"] = $wb_mpblinkflg;
				$stmt_2->close();
			}
			
			array_push($user24,$userSR);
		}
		$stmt->close();
		 
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	
	
	
	public function GetQRcodeUpdate($scode, $trid, $scantype, $qrcode) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0;
		
		$stmtm = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_date, pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_trtype, pnpslipmain_dop FROM tbl_pnpslipmain WHERE pnpslipmain_id = ?");
		$stmtm->bind_param("i", $trid);
		$stmtm->execute();
		$stmtm->store_result();
		$arrivalcode=0;
		$pnpslipmain_id=''; $pnpslipmain_date=''; $pnpslipmain_crop=''; $pnpslipmain_variety=''; $pnpslipmain_promachcode=''; $pnpslipmain_proopr=''; $pnpslipmain_treattype=''; $pnpslipmain_ttype=''; $pnpslipmain_dop='';
		if ($stmtm->num_rows > 0) {
			// user existed 
			$stmtm->bind_result($pnpslipmain_id, $pnpslipmain_date, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipmain_promachcode, $pnpslipmain_proopr, $pnpslipmain_treattype, $pnpslipmain_ttype, $pnpslipmain_dop);
			$stmtm->fetch();
		}
		$stmtm->close();
		
		$stmt = $this->conn_ps->prepare("SELECT pnpslipsub_lotno, pnpslipsub_pickpqty, pnpslipsub_ups, pnpslipsub_wtmp, pnpslipsub_nop, pnpslipsub_wbnop, pnpslipsub_wbwt, pnpslipsub_wbinmp, pnpslipsub_remarks, pnpslipsub_qcdot, pnpslipsub_valupto, pnpslipsub_pouchccqty, pnpslipsub_pouchmrp, pnpslipsub_gmmrp, pnpslipsub_lblflg, pnpslipsub_slabelno, pnpslipsub_elabelno, pnpslipsub_plotno  FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
		$stmt->bind_param("i", $pnpslipmain_id);
		$result=$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($pnpslipsub_lotno, $pnpslipsub_pickpqty, $pnpslipsub_ups, $pnpslipsub_wtmp, $pnpslipsub_nop, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $pnpslipsub_wbinmp, $pnpslipsub_remarks, $pnpslipsub_qcdot, $pnpslipsub_valupto, $pnpslipsub_pouchccqty, $pnpslipsub_pouchmrp, $pnpslipsub_gmmrp, $pnpslipsub_lblflg,  $pnpslipsub_slabelno, $pnpslipsub_elabelno, $pnpslipsub_plotno);
			//looping through all the records
			$stmt->fetch();
		}	
		$stmt->close();
		
		
		if($scantype=="wbqrcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_mpqlinkflg=0 and wb_actflg=0 ");
		
			$stmt_2->bind_param("s", $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows > 0) {

				$trtyp='SWB';
				if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NWB";}
				$stmtqrchk = $this->conn_ps->prepare("SELECT wb_extqrcode, wb_id FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_actflg=0");
				$stmtqrchk->bind_param("s", $qrcode);
				$result_qrchk=$stmtqrchk->execute();
				$stmtqrchk->store_result();
				if ($stmtqrchk->num_rows > 0) {
					$stmtqrchk->bind_result($wb_extqrcode, $wb_id);
					$stmtqrchk->fetch();
					
					$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_actdate=?, wb_type=?, wb_pnptrid=?, wb_crop=?, wb_variety=?, wb_ups=?, wb_lotno=?, wb_nop=?, wb_qty=?, wb_actflg=?, wb_actlogid=? where wb_extqrcode=?  ");
					$stmt60->bind_param("ssissssssiss", $dt, $trtyp, $trid, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipsub_ups, $pnpslipsub_plotno, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $one, $scode, $qrcode);
					$result60 = $stmt60->execute();
					if($result60)
					{
						$flg=1; 
						$trtyp2='SMC';
						if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp2="NMC";}
				
						$stmt_wbqrsub = $this->conn_ps->prepare("insert into tbl_wbqrcode_sub (wb_id, wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype)  Values(?,?,?,?,?,?,?,?,?,?) ");
						$stmt_wbqrsub->bind_param("issssssiss", $wb_id, $qrcode, $trtyp, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipsub_ups, $pnpslipsub_plotno, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $trtyp2);
						$result_wbqrsub = $stmt_wbqrsub->execute();
						$stmt_wbqrsub->close();
					}
					$stmt60->close();
				}
			}
		}
		else if($scantype=="mpqrcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_mpqrcode FROM tbl_wbqrcode WHERE wb_mpqrcode = ? and wb_extqrcode=? and wb_intqrcode=?");
			$stmt_2->bind_param("sss", $qrcode, $qrcode, $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
			
				$trtyp='SMC';
				if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NMC";}
				
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_linkdate=?, wb_mptype=?, wb_mpqrcode=?, wb_mpqlinkflg=?, wb_mpwt=? where wb_pnptrid=? and wb_lotno=? and wb_mpqlinkflg=0 ");
				$stmt60->bind_param("ssssiis", $dt, $trtyp, $qrcode, $one, $pnpslipsub_wtmp, $trid, $pnpslipsub_plotno);
				$result60 = $stmt60->execute();
				if($result60){$flg=1;} 
				$stmt60->close();
			}
		}
		else if($scantype=="mpbarcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_mpbarcode FROM tbl_wbqrcode WHERE wb_mpbarcode = ? ");
			$stmt_2->bind_param("s", $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
			
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mpbarcode=?, wb_mpblinkflg=? where wb_pnptrid=? and wb_lotno=? and wb_mpblinkflg=0 and wb_mpqlinkflg=1 ");
				$stmt60->bind_param("siis", $qrcode, $one, $trid, $pnpslipsub_plotno);
				$result60 = $stmt60->execute();
				if($result60){$flg=1;} 
				$stmt60->close();
			}
		}
		else
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? ");
			$stmt_2->bind_param("s", $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows > 0) {

				$trtyp='SWB';
				if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NWB";}
				$stmtqrchk = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_actflg=0");
				$stmtqrchk->bind_param("s", $qrcode);
				$result_qrchk=$stmtqrchk->execute();
				$stmtqrchk->store_result();
				if ($stmtqrchk->num_rows > 0) {
				
					$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_actdate=?, wb_type=?, wb_pnptrid=?, wb_crop=?, wb_variety=?, wb_ups=?, wb_lotno=?, wb_nop=?, wb_qty=?, wb_actflg=? where wb_extqrcode=?  ");
					$stmt60->bind_param("ssissssssis", $dt, $trtyp, $trid, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipsub_ups, $pnpslipsub_lotno, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $one, $qrcode);
					$result60 = $stmt60->execute();
					if($result60){$flg=1;} 
					$stmt60->close();
				}
			}
		}
				
			$stmt_2->close();
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}	
	
	




	
	
	
	public function GetLMCQRcodeUpdate($scode, $trid, $scantype, $qrcode, $cropname, $varietyname, $ups, $grosswt, $mptype, $mpwt) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0; $flag=0;
		
		if($cropname!=''){
			$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropname = ? ");
			$stmt_crop->bind_param("s", $cropname);
			$result_crop=$stmt_crop->execute();
			$stmt_crop->store_result();
			if ($stmt_crop->num_rows > 0) {
				$stmt_crop->bind_result($cropid, $crop_name);
				//looping through all the records 
				$stmt_crop->fetch();
				$stmt_crop->close();
			}
			else
			{
				$flg=1;
			}
		}
		if($varietyname!=''){
			$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
			$stmt_variety->bind_param("s", $varietyname);
			$result_variety=$stmt_variety->execute();
			$stmt_variety->store_result();
			if ($stmt_variety->num_rows > 0) {
				$stmt_variety->bind_result($varietyid, $popular_name);
				//looping through all the records 
				$stmt_variety->fetch();
				$stmt_variety->close();
			}
			else
			{
				$flg=2;
			}
		}
		
		if($scantype=="wbqrcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_crop=? and wb_variety=? and wb_ups=? and wb_mpqlinkflg=0 and wb_mpblinkflg=0 and wb_actflg=1");
		
			$stmt_2->bind_param("ssss", $qrcode, $cropid, $varietyid, $ups);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows > 0) {

				//$trtyp='SWB';
				//if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NWB";}
				$stmtqrchk = $this->conn_ps->prepare("SELECT wb_id, wb_mpqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_mpqlinkflg=0");
				$stmtqrchk->bind_param("s", $qrcode);
				$result_qrchk=$stmtqrchk->execute();
				$stmtqrchk->store_result();
				if ($stmtqrchk->num_rows > 0) {
					
					$stmtqrchk->bind_result($wb_id, $wb_mpqrcode);
					$stmtqrchk->fetch();
					
					$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mpqlinkflg=?, wb_linklogid=? where wb_extqrcode=?  ");
					$stmt60->bind_param("iss", $two, $scode, $qrcode);
					$result60 = $stmt60->execute();
					if($result60)
					{
						$stmt_wbqrsub = $this->conn_ps->prepare("update tbl_wbqrcode_sub SET wb_mptype=? WHERE wb_id=? ");
						$stmt_wbqrsub->bind_param("si", $mptype, $wb_id);
						$result_wbqrsub = $stmt_wbqrsub->execute();
						$stmt_wbqrsub->close();
					}
					$stmt60->close();
				}
				else
				{
					$flg=4;
				}
			}
			else
			{
				$flg=3;
			}
		}
		else if($scantype=="mpqrcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_mpqrcode FROM tbl_wbqrcode WHERE wb_mpqrcode = ?  and wb_extqrcode=? and wb_intqrcode=?");
			$stmt_2->bind_param("sss", $qrcode, $qrcode, $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
			
				$trtyp='LMC';
				//if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="NLC";}
				$wtmp=0;
				$stmt_4 = $this->conn_ps->prepare("SELECT wb_type, wb_nop, wb_qty FROM tbl_wbqrcode WHERE wb_linklogid=? and wb_mpqlinkflg=2 and wb_crop=? and wb_variety=? and wb_ups=?");
				$stmt_4->bind_param("ssss", $scode, $cropid, $varietyid, $ups);
				$result4=$stmt_4->execute();
				$stmt_4->store_result();
				$stmt_4->bind_result($wb_type, $wb_nop, $wb_qty);
				while($stmt_4->fetch())
				{
					if($wb_type!="LWB")
					{
						$wtmp=$wtmp+$wb_qty;
					}
					else
					{
						$wbqt=explode(",",$wb_qty);
						foreach($wbqt as $wbqts)
						{
							if($wbqts<>"")
							{
								$wtmp=$wtmp+$wbqts;
							}
						}
					}
				}
				$stmt_4->close();
				//$mpcnt=$mpcnt+1;
				
				
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_linkdate=?, wb_mptype=?, wb_mpqrcode=?, wb_mpqlinkflg=?, wb_mpwt=? where wb_linklogid=? and wb_mpqlinkflg=2  ");
				$stmt60->bind_param("ssssss", $dt, $trtyp, $qrcode, $two, $mpwt, $scode);
				$result60 = $stmt60->execute();
				if($result60){$flag=1;} 
				$stmt60->close();
			}
			else
			{
				$flg=5;
			}
		}
		else if($scantype=="mpbarcode")
		{
			$stmt_2 = $this->conn_ps->prepare("SELECT wb_mpbarcode FROM tbl_wbqrcode WHERE wb_mpbarcode = ? ");
			$stmt_2->bind_param("s", $qrcode);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
			
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mpbarcode=?, wb_mpblinkflg=?, wb_mpgrosswt=? where wb_mpblinkflg=0 and wb_mpqlinkflg=2 and wb_linklogid=? ");
				$stmt60->bind_param("siss", $qrcode, $two, $grosswt, $scode);
				$result60 = $stmt60->execute();
				if($result60){$flag=1;} 
				$stmt60->close();
			}
			else
			{
				$flg=6;
			}
		}
		else
		{
			$flg=7;
		}
			 
			$stmt_2->close();
		
		if($flag==0)
		{return $flg;}
		else
		{return $flg;}		
	}	
	
	
	public function GetLMCWBDetails($scode, $cropname, $varietyname, $ups) {
		$userSR=array(); 
		$wbcnt=0; $mpcnt=0; $wbwt=0; $wtmp=0; $totwbcnt=0; 
		if($cropname!=''){
			$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropname = ? ");
			$stmt_crop->bind_param("s", $cropname);
			$result_crop=$stmt_crop->execute();
			$stmt_crop->store_result();
			if ($stmt_crop->num_rows > 0) {
				$stmt_crop->bind_result($cropid, $crop_name);
				//looping through all the records 
				$stmt_crop->fetch();
				$stmt_crop->close();
			}
			else
			{
				$flg=1;
			}
		}
		if($varietyname!=''){
			$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
			$stmt_variety->bind_param("s", $varietyname);
			$result_variety=$stmt_variety->execute();
			$stmt_variety->store_result();
			if ($stmt_variety->num_rows > 0) {
				$stmt_variety->bind_result($varietyid, $popular_name);
				//looping through all the records 
				$stmt_variety->fetch();
				$stmt_variety->close();
			}
			else
			{
				$flg=2;
			}
		}

		$wb_actdate=''; $wb_linkdate=''; $wb_intqrcode=''; $wb_extqrcode=''; $wb_type=''; $wb_crop='';  $wb_variety=''; $wb_ups=''; $wb_lotno=''; $wb_nop=''; 
		$wb_qty=''; $wb_totwt=''; $wb_mptype=''; $wb_mpqrcode=''; $wb_mpbarcode=''; $wb_actflg=''; $pouchimg=''; $wb_mpwt='';
		$stmt_2 = $this->conn_ps->prepare("SELECT wb_actdate, wb_linkdate, wb_intqrcode, wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_totwt, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_actflg, wb_mpwt FROM tbl_wbqrcode WHERE wb_linklogid=? and wb_mpqlinkflg=2 and wb_crop=? and wb_variety=? and wb_ups=? ");
		$stmt_2->bind_param("ssss", $scode, $cropid, $varietyid, $ups);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows == 0) {
			$userSR["wbcnt"] = $wbcnt;
			$userSR["mpcnt"] = $mpcnt;
			$userSR["pouchimg"] = $pouchimg;
			$userSR["wbwt"] = $wbwt;
			$userSR["wtmp"] = $wtmp;
			$userSR["totwbcnt"] = $totwbcnt;
			$stmt_2->close();

		} else {
			$stmt_2->bind_result($wb_actdate, $wb_linkdate, $wb_intqrcode, $wb_extqrcode, $wb_type, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_totwt, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_actflg, $wb_mpwt);
			//looping through all the records
			while($stmt_2->fetch())
			{
				if($wb_mpbarcode=="")
				{$wbcnt=$wbcnt+1;}
				//if( $wb_mpqrcode!="")
				//{$mpcnt=$mpcnt+1;}
				
				$totwbcnt=$totwbcnt+1;
				
				if($wb_type!="LWB")
				{
					$wtmp=$wtmp+$wb_qty;
					$wbwt=$wbwt+$wb_qty;
				}
				else
				{
					$wbqt=explode(",",$wb_qty);
					foreach($wbqt as $wbqts)
					{
						if($wbqts<>"")
						{
							$wtmp=$wtmp+$wbqts;
							$wbwt=$wbwt+$wbqts;
						}
					}
				}
			}
			
			$userSR["wbcnt"] = $wbcnt;
			$userSR["mpcnt"] = $mpcnt;
			$userSR["pouchimg"] = $pouchimg;
			$userSR["wbwt"] = $wbwt;
			$userSR["wtmp"] = $wtmp;
			$userSR["totwbcnt"] = $totwbcnt;
			$stmt_2->close();
		}
	
	//$stmt_2->close();
	
	if(empty($userSR))
	{return false;}
	else
	{return $userSR;}
	
	}
	

	
	
	
	
	public function GetLWBFinalize($scode, $qrcode, $lotarray) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0;
		//return "test - ".$lotarray[0];	exit;	
		$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? ");
		$stmt_2->bind_param("s", $qrcode);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
//return "SELECT wb_extqrcode, wb_id FROM tbl_wbqrcode WHERE wb_extqrcode = '$qrcode' and wb_actflg=0";
			$trtyp='LWB';
			//if($pnpslipmain_ttype=="NST Packing Slip"){$trtyp="LWB";}
			$stmtqrchk = $this->conn_ps->prepare("SELECT wb_extqrcode, wb_id FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_actflg=0");
			$stmtqrchk->bind_param("s", $qrcode);
			$result_qrchk=$stmtqrchk->execute();
			$stmtqrchk->store_result();

			if ($stmtqrchk->num_rows > 0) {
			
				$stmtqrchk->bind_result($wb_extqrcode, $wb_id);
				$stmtqrchk->fetch();
				$phpArray = json_decode($lotarray, true); 
				$lots=''; $pch=''; $qty='';
				//$lotar=explode(",", $lotarray);
				foreach($phpArray as $lotary)
				{
					$lts=''; $poch=''; $qt='';					
					foreach ($lotary as $sub_key => $sub_val) 
					{
						$skey=$sub_key;	
						$sval=$sub_val;
					
						if($sub_key!='srno')
						{
							if($sub_key=='lotno')
							{
								$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT packtype, lotldg_crop, lotldg_variety FROM tbl_lot_ldg_pack WHERE lotno = ? order by lotdgp_id DESC LIMIT 0,1 ");
								$stmt_ldgraw0->bind_param("s", $sval);
								$result2=$stmt_ldgraw0->execute();
								$stmt_ldgraw0->store_result();
								if ($stmt_ldgraw0->num_rows > 0) {
									$stmt_ldgraw0->bind_result($packtype, $lotldg_crop, $lotldg_variety);
									//looping through all the records
									$stmt_ldgraw0->fetch();
									//$nompqty=$wtinmp*$balnomp;
									//$balqty=$balqty-$nompqty;
								}
								$stmt_ldgraw0->close();
								
								$upsize=explode(" ",$packtype);
								if($upsize[1]=="Gms")
								{ 
									$ptp=(1000/$upsize[0]);
									$ptp1=($upsize[0]/1000);
								}
								else
								{
									$ptp=$upsize[0];
									$ptp1=$upsize[0];
								}
								$lts=$sval;
								if($lots!="") { $lots=$lots.",".$lts; } else { $lots=$lts; }
							}
							if($sub_key=='entered_pouches')
							{
								$poch=$sval;
								if($pch!="") { $pch=$pch.",".$poch; } else { $pch=$poch; }
							/*}						
							if($sub_key=='entered_pouches')
							{*/	
								$pchqty=$ptp1*$sval;
								$qt=$pchqty;
								if($qty!="") { $qty=$qty.",".$pchqty; } else { $qty=$pchqty; }
								
								$trtyp2='LMC';
						
								$stmt_wbqrsub = $this->conn_ps->prepare("insert into tbl_wbqrcode_sub (wb_id, wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype)  Values(?,?,?,?,?,?,?,?,?,?) ");
								$stmt_wbqrsub->bind_param("issssssiss", $wb_id, $qrcode, $trtyp, $lotldg_crop, $lotldg_variety, $packtype, $lts, $poch, $pchqty, $trtyp2);
								$result_wbqrsub = $stmt_wbqrsub->execute();
								$stmt_wbqrsub->close();
							}
						}
					}
				}
				
				$trid=0;
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_actdate=?, wb_type=?, wb_pnptrid=?, wb_crop=?, wb_variety=?, wb_ups=?, wb_lotno=?, wb_nop=?, wb_qty=?, wb_actflg=? where wb_extqrcode=?  ");
				$stmt60->bind_param("ssissssssis", $dt, $trtyp, $trid, $lotldg_crop, $lotldg_variety, $packtype, $lots, $pch, $qty, $one, $qrcode);
				$result60 = $stmt60->execute();
				if($result60){$flg=1;} 
				$stmt60->close();
				
			}
		}
		$stmt_2->close();
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}	
	
	
	
	
	
	
	public function GetWBDetails($trid) {
		$userSR=array(); 
		
		$stmtm = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_date, pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_trtype, pnpslipmain_dop FROM tbl_pnpslipmain WHERE pnpslipmain_id = ?");
		$stmtm->bind_param("i", $trid);
		$stmtm->execute();
		$stmtm->store_result();
		$arrivalcode=0;
		$pnpslipmain_id=''; $pnpslipmain_date=''; $pnpslipmain_crop=''; $pnpslipmain_variety=''; $pnpslipmain_promachcode=''; $pnpslipmain_proopr=''; $pnpslipmain_treattype=''; $pnpslipmain_ttype=''; $pnpslipmain_dop='';
		if ($stmtm->num_rows > 0) {
			// user existed 
			$stmtm->bind_result($pnpslipmain_id, $pnpslipmain_date, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipmain_promachcode, $pnpslipmain_proopr, $pnpslipmain_treattype, $pnpslipmain_ttype, $pnpslipmain_dop);
			$stmtm->fetch();
		}
		$stmtm->close();
		if($pnpslipmain_date!='' && $pnpslipmain_date!='0000-00-00' && $pnpslipmain_date!=NULL)
		{
			$pnpslipmain_date1=explode("-",$pnpslipmain_date);
			$pnpslipmain_date=$pnpslipmain_date1[2]."-".$pnpslipmain_date1[1]."-".$pnpslipmain_date1[0];
		}
		if($pnpslipmain_dop!='' && $pnpslipmain_dop!='0000-00-00' && $pnpslipmain_dop!=NULL)
		{
			$pnpslipmain_dop1=explode("-",$pnpslipmain_dop);
			$pnpslipmain_dop=$pnpslipmain_dop1[2]."-".$pnpslipmain_dop1[1]."-".$pnpslipmain_dop1[0];
		}
		
		$wbcnt=0; $mpcnt=0; $wbwt=0; $wtmp=0; $totwbcnt=0; 
		$wb_actdate=''; $wb_linkdate=''; $wb_intqrcode=''; $wb_extqrcode=''; $wb_type=''; $wb_crop='';  $wb_variety=''; $wb_ups=''; $wb_lotno=''; $wb_nop=''; 
		$wb_qty=''; $wb_totwt=''; $wb_mptype=''; $wb_mpqrcode=''; $wb_mpbarcode=''; $wb_actflg=''; $pouchimg=''; $wb_mpwt='';
		$stmt_2 = $this->conn_ps->prepare("SELECT wb_actdate, wb_linkdate, wb_intqrcode, wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_totwt, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_actflg, wb_mpwt FROM tbl_wbqrcode WHERE wb_pnptrid = ? ");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows == 0) {
			$userSR["dop"] = $pnpslipmain_dop;
			$userSR["wbcnt"] = $wbcnt;
			$userSR["mpcnt"] = $mpcnt;
			$userSR["pouchimg"] = $pouchimg;
			$userSR["wbwt"] = $wbwt;
			$userSR["wtmp"] = $wtmp;
			$userSR["totwbcnt"] = $totwbcnt;
			$stmt_2->close();

		} else {
			$stmt_2->bind_result($wb_actdate, $wb_linkdate, $wb_intqrcode, $wb_extqrcode, $wb_type, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_totwt, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_actflg, $wb_mpwt);
			//looping through all the records
			while($stmt_2->fetch())
			{
				if($wb_mpbarcode=="")
				{$wbcnt=$wbcnt+1;}
				//if( $wb_mpqrcode!="")
				//{$mpcnt=$mpcnt+1;}
				$wbwt=$wbwt+$wb_qty;
				$totwbcnt=$totwbcnt+1;
			}
			$stmt_3 = $this->conn_ps->prepare("SELECT DISTINCT wb_mpbarcode FROM tbl_wbqrcode WHERE wb_pnptrid = ? ");
			$stmt_3->bind_param("i", $trid);
			$result3=$stmt_3->execute();
			$stmt_3->store_result();
			$stmt_3->bind_result($wb_mpqrcode);
			while($stmt_3->fetch())
			{
				if($wb_mpqrcode!="")
				{
					$stmt_4 = $this->conn_ps->prepare("SELECT wb_mpwt FROM tbl_wbqrcode WHERE wb_pnptrid = ? and wb_mpbarcode=?");
					$stmt_4->bind_param("is", $trid, $wb_mpqrcode);
					$result4=$stmt_4->execute();
					$stmt_4->store_result();
					$stmt_4->bind_result($wb_mpwt);
					while($stmt_4->fetch())
					{
						$wtmp=$wtmp+$wb_mpwt;
					}
					$stmt_4->close();
					$mpcnt=$mpcnt+1;
				}
			}
			$stmt_3->close();
			
			$userSR["dop"] = $pnpslipmain_dop;
			$userSR["wbcnt"] = $wbcnt;
			$userSR["mpcnt"] = $mpcnt;
			$userSR["pouchimg"] = $pouchimg;
			$userSR["wbwt"] = $wbwt;
			$userSR["wtmp"] = $wtmp;
			$userSR["totwbcnt"] = $totwbcnt;
			$stmt_2->close();
		}
	
	if(empty($userSR))
	{return false;}
	else
	{return $userSR;}
	
	}
	
	
	public function GetDomMacDetails() {
	
		$user10=array(); 
		$stmt_dommac = $this->conn_ps->prepare("SELECT dom_mcode FROM tbl_rm_dommac order by dom_mcode ASC ");
		//$stmt_dommac->bind_param("i", $pnpslipmain_variety);
		$result_dommac=$stmt_dommac->execute();
		$stmt_dommac->store_result();
		if ($stmt_dommac->num_rows > 0) {
			$stmt_dommac->bind_result($dom_mcode);
			//looping through all the records 
			while($stmt_dommac->fetch())
			{
				//$temp["dommcode"] = $dom_mcode;
				array_push($user10,$dom_mcode);
			}
		}
		$stmt_dommac->close();
		if(empty($user10))
		{return false;}
		else
		{return $user10;}
	}
	
	
	function GetQRScanningFinalize($scode, $trid, $loosepouches)
	{
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0;
		
		$stmtm = $this->conn_ps->prepare("SELECT pnpslipmain_id, pnpslipmain_date, pnpslipmain_crop, pnpslipmain_variety, pnpslipmain_promachcode, pnpslipmain_proopr, pnpslipmain_treattype, pnpslipmain_trtype, pnpslipmain_dop FROM tbl_pnpslipmain WHERE pnpslipmain_id = ?");
		$stmtm->bind_param("i", $trid);
		$stmtm->execute();
		$stmtm->store_result();
		$arrivalcode=0;
		$pnpslipmain_id=''; $pnpslipmain_date=''; $pnpslipmain_crop=''; $pnpslipmain_variety=''; $pnpslipmain_promachcode=''; $pnpslipmain_proopr=''; $pnpslipmain_treattype=''; $pnpslipmain_ttype=''; $pnpslipmain_dop='';
		if ($stmtm->num_rows > 0) {
			// user existed 
			$stmtm->bind_result($pnpslipmain_id, $pnpslipmain_date, $pnpslipmain_crop, $pnpslipmain_variety, $pnpslipmain_promachcode, $pnpslipmain_proopr, $pnpslipmain_treattype, $pnpslipmain_ttype, $pnpslipmain_dop);
			$stmtm->fetch();
		}
		$stmtm->close();
		
		$stmt = $this->conn_ps->prepare("SELECT pnpslipsub_lotno, pnpslipsub_pickpqty, pnpslipsub_ups, pnpslipsub_wtmp, pnpslipsub_nop, pnpslipsub_wbnop, pnpslipsub_wbwt, pnpslipsub_wbinmp, pnpslipsub_remarks, pnpslipsub_qcdot, pnpslipsub_valupto, pnpslipsub_pouchccqty, pnpslipsub_pouchmrp, pnpslipsub_gmmrp, pnpslipsub_lblflg, pnpslipsub_slabelno, pnpslipsub_elabelno  FROM tbl_pnpslipsub WHERE pnpslipmain_id = ? ");
		$stmt->bind_param("i", $pnpslipmain_id);
		$result=$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($pnpslipsub_lotno, $pnpslipsub_pickpqty, $pnpslipsub_ups, $pnpslipsub_wtmp, $pnpslipsub_nop, $pnpslipsub_wbnop, $pnpslipsub_wbwt, $pnpslipsub_wbinmp, $pnpslipsub_remarks, $pnpslipsub_qcdot, $pnpslipsub_valupto, $pnpslipsub_pouchccqty, $pnpslipsub_pouchmrp, $pnpslipsub_gmmrp, $pnpslipsub_lblflg,  $pnpslipsub_slabelno, $pnpslipsub_elabelno);
			//looping through all the records
			$stmt->fetch();
			
			
				$stmt60 = $this->conn_ps->prepare("UPDATE tbl_pnpslipsub SET pnpslipsub_loosepouches=?, pnpslipsub_lblflg=?  where pnpslipmain_id=?  ");
				$stmt60->bind_param("sii", $loosepouches, $zero, $trid);
				$result60 = $stmt60->execute();
				if($result60)
				{
					$stmt6 = $this->conn_ps->prepare("UPDATE tbl_pnpslipmain SET pnpslipmain_wbactflag=? where pnpslipmain_id=?  ");
					$stmt6->bind_param("ii", $one, $trid);
					$result6 = $stmt6->execute();
					if($result6){$flg=1;} 
					$stmt6->close();
				//$flg=1;
				} 
				$stmt60->close();
		}	
		$stmt->close();
		
			
		if($flg==0)
		{return false;}
		else
		{return true;}	
		
	}
	
	public function GetTranLastBagDetails($scode,$trid) {
	
		$user10=array(); $lotno=''; $grosswt=''; $qty=0; $nob='';  
		$stmt_2 = $this->conn_ps->prepare("SELECT Max(arrsubsub_id) FROM tblarrsub_sub_unld WHERE arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrsubsub_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotno, grosswt FROM tblarrsub_sub_unld WHERE arrsubsub_id = ? ");
			$stmt_lotimp->bind_param("i", $arrsubsub_id);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotno, $grosswt);
				//looping through all the records 
				$stmt_lotimp->fetch();
				$stmt_lotimp->close();
				
				$stmt_arsubs = $this->conn_ps->prepare("SELECT lotno FROM tblarrsub_sub_unld WHERE arrival_id = ? and lotno = ?");
				$stmt_arsubs->bind_param("is", $trid, $lotno);
				$result_arsubs=$stmt_arsubs->execute();
				$stmt_arsubs->store_result();
				$nob=$stmt_arsubs->num_rows;
				$stmt_arsubs->close();
			}	
		}

		$user10["lotno"] = $lotno;
		$user10["grosswt"] = $grosswt;
		$user10["bagno"] = $nob;
		
		if(empty($user10))
		{return false;}
		else
		{return $user10;}
    }
	
	
	public function GetTranFinSubBinchk($scode,$whname,$binname,$subbinname,$varietyname,$cropname,$trid) {
		$plantcode = $this->getPlantcode($scode);
		$sbflg=0; $estage="Raw"; $user10=array(); $existview="Empty";
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? AND plantcode=?");
		$stmt_wh->bind_param("ss", $whname, $plantcode);
		$result_wh=$stmt_wh->execute();
		$stmt_wh->store_result();
		if ($stmt_wh->num_rows > 0) {
			$stmt_wh->bind_result($whperticulars,$whid);
			//looping through all the records 
			$stmt_wh->fetch();
			$stmt_wh->close();

			$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
			$stmt_bin->bind_param("is", $whid, $binname);
			$result_bin=$stmt_bin->execute();
			$stmt_bin->store_result();
			if ($stmt_bin->num_rows > 0) {
				$stmt_bin->bind_result($binname, $binid);
				//looping through all the records
				$stmt_bin->fetch();
				$stmt_bin->close();
				
				$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? order by sname ASC");
				$stmt_sbin->bind_param("iis", $whid, $binid, $subbinname);
				$result2=$stmt_sbin->execute();
				$stmt_sbin->store_result();
				if ($stmt_sbin->num_rows > 0) {
					$stmt_sbin->bind_result($subbinname, $subbinid);
					//looping through all the records
					$stmt_sbin->fetch();
					$stmt_sbin->close();
				}
			}
		}
		
		$varietyid=0; $popularname=$varietyname;
		$stmt_var = $this->conn_ps->prepare("SELECT popularname, varietyid  FROM tblvariety WHERE popularname=? and actstatus='Active' and vertype='PV' order by popularname ASC");
		$stmt_var->bind_param("s", $varietyname);
		$result2=$stmt_var->execute();
		$stmt_var->store_result();
		if ($stmt_var->num_rows > 0) {
			$stmt_var->bind_result($popularname, $varietyid);
			//looping through all the records
			$stmt_var->fetch();
			$stmt_var->close();
		}
		//return $whid." - ".$binid." - ".$subbinid." - ".$popularname." - ".$cropname." - ".$trid;
		$stmt_arsub = $this->conn_ps->prepare("SELECT lotvariety, lotcrop  FROM tblarr_sloc_unld WHERE arr_tr_id = ? and lotvariety = ? and subbin = ?");
		$stmt_arsub->bind_param("isi", $trid, $popularname, $subbinid);
		$result2=$stmt_arsub->execute();
		$stmt_arsub->store_result();
		//return $stmt_arsub->num_rows;
		if ($stmt_arsub->num_rows > 0) {
			$stmt_arsub->bind_result($lotvariety, $lotcrop);
			//looping through all the records
			$sbflg=0; $existview="Allowed";
			$stmt_arsub->fetch();
		}
		else
		{ 
			$stmt_arss = $this->conn_ps->prepare("SELECT lotvariety, lotcrop  FROM tblarr_sloc_unld WHERE lotvariety != ? and subbin = ? ");
			$stmt_arss->bind_param("si", $popularname, $subbinid);
			$result2=$stmt_arss->execute();
			$stmt_arss->store_result();
			//return "SELECT lotvariety, lotcrop  FROM tblarr_sloc_unld WHERE lotvariety != '$popularname' and subbin = $subbinid ";
			if ($stmt_arss->num_rows > 0) {
				$stmt_arss->bind_result($lotvariety, $lotcrop);
				//looping through all the records
				$sbflg=1; $existview="Occupied with Different Variety ".$lotcrop." - ".$lotvariety;
				$stmt_arss->fetch();
			}
			else
			{
				$cnt=0; $cnt1=0; $cnt2=0; 
				$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_variety) FROM tbl_lot_ldg WHERE lotldg_variety != ? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw->bind_param("sis", $popularname, $subbinid, $plantcode);
				$result2=$stmt_ldgraw->execute();
				$stmt_ldgraw->store_result();
				if ($stmt_ldgraw->num_rows > 0) {
					$stmt_ldgraw->bind_result($varietyname);
					//looping through all the records
					while($stmt_ldgraw->fetch())
					{
						$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? and plantcode=? ");
						$stmt_ldgraw2->bind_param("sis", $varietyname, $subbinid, $plantcode);
						$result2=$stmt_ldgraw2->execute();
						$stmt_ldgraw2->store_result();
						if ($stmt_ldgraw2->num_rows > 0) {
							$stmt_ldgraw2->bind_result($lotno);
							//looping through all the records
							while($stmt_ldgraw2->fetch())
							{
								$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
								$stmt_ldgraw3->bind_param("siss", $varietyname, $subbinid, $lotno, $plantcode);
								$result2=$stmt_ldgraw3->execute();
								$stmt_ldgraw3->store_result();
								if ($stmt_ldgraw3->num_rows > 0) {
									$stmt_ldgraw3->bind_result($lotldgid);
									//looping through all the records
									while($stmt_ldgraw3->fetch())
									{ 
										$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_id FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
										$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
										$result2=$stmt_ldgraw4->execute();
										$stmt_ldgraw4->store_result();
										if ($stmt_ldgraw4->num_rows > 0) {
											$stmt_ldgraw4->bind_result($lotldgid);
											//looping through all the records
											//$stmt_ldgraw->fetch();
											$cnt++;
										}
										$stmt_ldgraw4->close();
									}
								}
								$stmt_ldgraw3->close();
							}
						}
						$stmt_ldgraw2->close();
					}
				}
				$stmt_ldgraw->close();
				
				$stmt_ldgraw5 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_variety=? and lotldg_subbinid = ? AND lotldg_sstage!='Raw' AND plantcode=? ");
				$stmt_ldgraw5->bind_param("sis", $varietyid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw5->execute();
				$stmt_ldgraw5->store_result();
				if ($stmt_ldgraw5->num_rows > 0) {
					$stmt_ldgraw5->bind_result($lotno2);
					//looping through all the records
					while($stmt_ldgraw5->fetch())
					{
						$stmt_ldgraw6 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? and lotldg_lotno = ? AND lotldg_sstage!='Raw' AND plantcode=? ");
						$stmt_ldgraw6->bind_param("siss", $varietyid, $subbinid, $lotno2, $plantcode);
						$result2=$stmt_ldgraw6->execute();
						$stmt_ldgraw6->store_result();
						if ($stmt_ldgraw6->num_rows > 0) {
							$stmt_ldgraw6->bind_result($lotldgid2);
							//looping through all the records
							while($stmt_ldgraw6->fetch())
							{
								$stmt_ldgraw7 = $this->conn_ps->prepare("SELECT lotldg_id FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0  AND lotldg_sstage!='Raw' AND plantcode=? ");
								$stmt_ldgraw7->bind_param("is", $lotldgid2, $plantcode);
								$result2=$stmt_ldgraw7->execute();
								$stmt_ldgraw7->store_result();
								if ($stmt_ldgraw7->num_rows > 0) {
									$stmt_ldgraw7->bind_result($lotldgid3);
									//looping through all the records
									//$stmt_ldgraw7->fetch();
									$cnt1++;
								}
								$stmt_ldgraw7->close();
							}
						}
						$stmt_ldgraw6->close();
					}
				}
				$stmt_ldgraw5->close();
				
				//return "SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE lotldg_variety = $varietyid and subbinid = $subbinid ";
				$stmt_ldgraw8 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE subbinid = ? AND plantcode=? ");
				$stmt_ldgraw8->bind_param("is", $subbinid, $plantcode);
				$result2=$stmt_ldgraw8->execute();
				$stmt_ldgraw8->store_result();
				if ($stmt_ldgraw8->num_rows > 0) {
					$stmt_ldgraw8->bind_result($lotno3);
					//looping through all the records
					while($stmt_ldgraw8->fetch())
					{
						$stmt_ldgraw9 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw9->bind_param("iss", $subbinid, $lotno3, $plantcode);
						$result2=$stmt_ldgraw9->execute();
						$stmt_ldgraw9->store_result();
						if ($stmt_ldgraw9->num_rows > 0) {
							$stmt_ldgraw9->bind_result($lotldgid4);
							//looping through all the records
							while($stmt_ldgraw9->fetch())
							{
								$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT lotdgp_id FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");
								$stmt_ldgraw0->bind_param("is", $lotldgid4, $plantcode);
								$result2=$stmt_ldgraw0->execute();
								$stmt_ldgraw0->store_result();
								if ($stmt_ldgraw0->num_rows > 0) {
									$stmt_ldgraw0->bind_result($lotldgid5);
									//looping through all the records
									//$stmt_ldgraw7->fetch();
									$cnt2++;
								}
								$stmt_ldgraw0->close();
							}
						}
						$stmt_ldgraw9->close();
					}
				}
				$stmt_ldgraw8->close();
				
				if($cnt>0)
				{$sbflg=1; $existview="Occupied with Different Variety";}
				if($cnt1>0 || $cnt2>0 )
				{$sbflg=2; $existview="Occupied with Different Stage";}
			}
			$stmt_arss->close();
		}
		$stmt_arsub->close();
		$user10["sbflg"]=$sbflg;
		$user10["existview"]=$existview;
		
		if(empty($user10))
		{return false;}
		else
		{return $user10;}		
	}	
	
	
	public function GetTranLotSubmit($scode,$trid,$lotno,$harvestdate,$geoindex,$gottype,$seedstatus,$moisture,$purity,$remark,$qcstatus,$leduration,$ledate,$arrstatus,$gotstatus,$stage,$whname,$binname,$subbinname,$whname1,$binname1,$subbinname1,$slocnob,$slocnob1,$slocqty,$slocqty1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; 
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotno, orlot, tarewt, old, arrsub_id, qty, act1, lotcrop, lotvariety  FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
			$stmt_lotimp->bind_param("is", $trid, $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($nlotno, $orlot, $tarewt, $old, $arrsub_id, $qty, $act1, $lotcrop, $lotvariety);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$stmt_arrss = $this->conn_ps->prepare("SELECT SUM(netwt) FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? ");
					$stmt_arrss->bind_param("ii", $arrival_id, $arrsub_id);
					$result2=$stmt_arrss->execute();
					$stmt_arrss->store_result();
					if ($stmt_arrss->num_rows > 0) {
						$stmt_arrss->bind_result($grosswt);
						//looping through all the records
						$stmt_arrss->fetch();
					}
					$stmt_arrss->close();
					
					$stmt_arrss2 = $this->conn_ps->prepare("SELECT arrsubsub_id FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? ");
					$stmt_arrss2->bind_param("ii", $arrival_id, $arrsub_id);
					$result22=$stmt_arrss2->execute();
					$stmt_arrss2->store_result();
					$totnob=$stmt_arrss2->num_rows;
					$stmt_arrss2->fetch();
					$stmt_arrss2->close();
					
					if($slocqty>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? AND plantcode=?");
						$stmt_wh->bind_param("ss", $whname, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
							$stmt_bin->bind_param("is", $whid, $binname);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? order by sname ASC");
								$stmt_sbin->bind_param("iis", $whid, $binid, $subbinname);
								$result2=$stmt_sbin->execute();
								$stmt_sbin->store_result();
								if ($stmt_sbin->num_rows > 0) {
									$stmt_sbin->bind_result($subbinname, $subbinid);
									//looping through all the records
									$stmt_sbin->fetch();
									$stmt_sbin->close();
								}
							}
						}
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisis", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob, $plantcode);
						$result60 = $stmt60->execute();
						if($result60){$flg=1;//"Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values($arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob) ";
						}  
						$stmt60->close();
					}
					
					if($slocqty1>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
						$stmt_wh->bind_param("ss", $whname1, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
							$stmt_bin->bind_param("is", $whid, $binname1);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? order by sname ASC");
								$stmt_sbin->bind_param("iis", $whid, $binid, $subbinname1);
								$result2=$stmt_sbin->execute();
								$stmt_sbin->store_result();
								if ($stmt_sbin->num_rows > 0) {
									$stmt_sbin->bind_result($subbinname, $subbinid);
									//looping through all the records
									$stmt_sbin->fetch();
									$stmt_sbin->close();
								}
							}
						}
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisis", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty1, $slocnob1, $slocqty1, $slocnob1, $plantcode);
						$result60 = $stmt60->execute();
						if($result60){$flg=2;//"Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values($arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty1, $slocnob1, $slocqty1, $slocnob1) ";
						}  
						$stmt60->close();
					}
					
					if($harvestdate!='' && $harvestdate!='0000-00-00' && $harvestdate!=NULL)
					{
						$harvestdate1=explode("-",$harvestdate);
						$harvestdate=$harvestdate1[2]."-".$harvestdate1[1]."-".$harvestdate1[0];
					}
					
					if($ledate!='' && $ledate!='0000-00-00' && $ledate!=NULL)
					{
						$ledate1=explode("-",$ledate);
						$ledate=$ledate1[2]."-".$ledate1[1]."-".$ledate1[0];
					}
					$val=1; $gemp=0; $got12=explode(" ", $gotstatus); $got1=$got12[1];
					$diff=$qty-$grosswt; 
					$diff1=$act1-$totnob;
					
					$stmtsub = $this->conn_ps->prepare("Update tblarrival_sub_unld SET moisture=?, gemp=?, vchk=?, got=?, qc=?, remarks=?, got1=?, sstatus=?, qcstatus=?, sample=?, harvestdate=?, gi=?, leduration=?, leupto=?, act=?, diff=?, qty1=?, diff1=? where arrival_id = ? and arrsub_id = ? ");
					$stmtsub->bind_param("sisssssssisissiissii", $moisture, $gemp, $purity, $gottype, $qcstatus, $remark, $got1, $seedstatus, $qcstatus, $val, $harvestdate, $geoindex, $leduration, $ledate, $grosswt, $diff, $totnob, $diff1, $arrival_id, $arrsub_id);
					$resultsub = $stmtsub->execute();
					if($resultsub){$flg=3;//"Update tblarrival_sub_unld SET moisture=$moisture, gemp=$gemp, vchk=$purity, got=$gottype, qc=$qcstatus, remarks=$remark, got1=$got1, sstatus=$seedstatus, qcstatus=$qcstatus, sample=$val, harvestdate=$harvestdate, gi=$geoindex, leduration=$leduration, leupto=$ledate, act=$grosswt, diff=$diff, qty1=$totnob, diff1=$diff1 where arrival_id = $arrival_id and arrsub_id = $arrsub_id";
					}  
					$stmtsub->close();
					 //sisssssssssissi
				}
			}	
			$stmt_lotimp->close();
				
			$stmt_2->close();
		}
		//return $flg;
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}
	
	
	public function GetTranLotEditUpdate($scode,$trid,$lotno,$harvestdate,$geoindex,$gottype,$seedstatus,$moisture,$purity,$remark,$qcstatus,$leduration,$ledate,$arrstatus,$gotstatus,$stage,$whname,$binname,$subbinname,$whname1,$binname1,$subbinname1,$slocnob,$slocnob1,$slocqty,$slocqty1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; 
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotno, orlot, tarewt, old, arrsub_id, qty, act1 FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
			$stmt_lotimp->bind_param("is", $trid, $lotno);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($nlotno, $orlot, $tarewt, $old, $arrsub_id, $qty, $act1);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$stmt_slocunld = $this->conn_ps->prepare("DELETE From tblarr_sloc_unld where arr_tr_id = ?  and arr_id = ?");
					$stmt_slocunld->bind_param("ii", $arrival_id, $arrsub_id);
					$result_slocunld = $stmt_slocunld->execute();
					$stmt_slocunld->close();
					
					$stmt_arrss = $this->conn_ps->prepare("SELECT SUM(netwt) FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? ");
					$stmt_arrss->bind_param("ii", $arrival_id, $arrsub_id);
					$result2=$stmt_arrss->execute();
					$stmt_arrss->store_result();
					if ($stmt_arrss->num_rows > 0) {
						$stmt_arrss->bind_result($grosswt);
						//looping through all the records
						$stmt_arrss->fetch();
						
					}
					$stmt_arrss->close();
					
					$stmt_arrss2 = $this->conn_ps->prepare("SELECT arrsubsub_id FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? ");
					$stmt_arrss2->bind_param("ii", $arrival_id, $arrsub_id);
					$result22=$stmt_arrss2->execute();
					$stmt_arrss2->store_result();
					$totnob=$stmt_arrss2->num_rows;
					$stmt_arrss2->fetch();
					$stmt_arrss2->close();
					
					if($slocqty>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
						$stmt_wh->bind_param("ss", $whname, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
							$stmt_bin->bind_param("is", $whid, $binname);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? order by sname ASC");
								$stmt_sbin->bind_param("iis", $whid, $binid, $subbinname);
								$result2=$stmt_sbin->execute();
								$stmt_sbin->store_result();
								if ($stmt_sbin->num_rows > 0) {
									$stmt_sbin->bind_result($subbinname, $subbinid);
									//looping through all the records
									$stmt_sbin->fetch();
									$stmt_sbin->close();
								}
							}
						}
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisis", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob, $plantcode);
						$result60 = $stmt60->execute();
						if($result60){$flg=1;}  
						$stmt60->close();
					}
					
					if($slocqty1>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
						$stmt_wh->bind_param("ss", $whname1, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? ");
							$stmt_bin->bind_param("is", $whid, $binname1);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? order by sname ASC");
								$stmt_sbin->bind_param("iis", $whid, $binid, $subbinname1);
								$result2=$stmt_sbin->execute();
								$stmt_sbin->store_result();
								if ($stmt_sbin->num_rows > 0) {
									$stmt_sbin->bind_result($subbinname, $subbinid);
									//looping through all the records
									$stmt_sbin->fetch();
									$stmt_sbin->close();
								}
							}
						}
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisis", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty1, $slocnob1, $slocqty1, $slocnob1, $plantcode);
						$result60 = $stmt60->execute();
						if($result60){$flg=1;}  
						$stmt60->close();
					}
					
					if($harvestdate!='' && $harvestdate!='0000-00-00' && $harvestdate!=NULL)
					{
						$harvestdate1=explode("-",$harvestdate);
						$harvestdate=$harvestdate1[2]."-".$harvestdate1[1]."-".$harvestdate1[0];
					}
					
					if($ledate!='' && $ledate!='0000-00-00' && $ledate!=NULL)
					{
						$ledate1=explode("-",$ledate);
						$ledate=$ledate1[2]."-".$ledate1[1]."-".$ledate1[0];
					}
					$val=1; $gemp=0; $got12=explode(" ", $gotstatus); $got1=$got12[1];
					$diff=$qty-$grosswt; 
					$diff1=$act1-$totnob;
					$stmtsub = $this->conn_ps->prepare("Update tblarrival_sub_unld SET moisture=?, gemp=?, vchk=?, got=?, qc=?, remarks=?, got1=?, sstatus=?, qcstatus=?, sample=?, harvestdate=?, gi=?, leduration=?, leupto=?, act=?, diff=?, qty1=?, diff1=? where arrival_id = ? and arrsub_id = ? ");
					$stmtsub->bind_param("sisssssssisissiissii", $moisture, $gemp, $purity, $gottype, $qcstatus, $remark, $got1, $seedstatus, $qcstatus, $val, $harvestdate, $geoindex, $leduration, $ledate, $arrival_id, $arrsub_id, $grosswt, $diff, $totnob, $diff1);
					$resultsub = $stmtsub->execute();
					if($resultsub){$flg=1;}  
					$stmtsub->close();
					 //sisssssssssissi
				}
			}	
			$stmt_lotimp->close();
				
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}
	
	
	public function GetTranLotBagDel($scode,$trid,$lotno,$deltype) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0;
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag!=0 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		//return "SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = $trid";
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			if($deltype=="BAGREMOVE")
			{
				$stmt_lotimp = $this->conn_ps->prepare("SELECT arrsub_id FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
				$stmt_lotimp->bind_param("is", $trid, $lotno);
				$result_lotimp=$stmt_lotimp->execute();
				$stmt_lotimp->store_result();
				if ($stmt_lotimp->num_rows > 0) {
					$stmt_lotimp->bind_result($arrsub_id);
					//looping through all the records 
					while($stmt_lotimp->fetch())
					{
						$stmt_arrss = $this->conn_ps->prepare("SELECT MAX(arrsubsub_id) FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? order by arrsubsub_id DESC");
						$stmt_arrss->bind_param("ii", $arrival_id, $arrsub_id);
						$result2=$stmt_arrss->execute();
						$stmt_arrss->store_result();
						if ($stmt_arrss->num_rows > 0) {
							$stmt_arrss->bind_result($arrsubsub_id);
							//looping through all the records
							$stmt_arrss->fetch();
						}
						$stmt_arrss->close();
						$stmt_slocunld = $this->conn_ps->prepare("DELETE From tblarrsub_sub_unld where arrsubsub_id = ?");
						$stmt_slocunld->bind_param("i", $arrsubsub_id);
						$result_slocunld = $stmt_slocunld->execute();
						if($result_slocunld){$flg=1;}  
						$stmt_slocunld->close();
						
					}
				}
			}	
			
			if($deltype=="LOTREMOVE")
			{
				$stmt_lotimp = $this->conn_ps->prepare("SELECT arrsub_id FROM tblarrival_sub_unld WHERE arrival_id = ? AND old = ? ");
				$stmt_lotimp->bind_param("is", $trid, $lotno);
				$result_lotimp=$stmt_lotimp->execute();
				$stmt_lotimp->store_result();
				if ($stmt_lotimp->num_rows > 0) {
					$stmt_lotimp->bind_result($arrsub_id);
					//looping through all the records 
					while($stmt_lotimp->fetch())
					{
						$stmt_slocunld = $this->conn_ps->prepare("DELETE From tblarrsub_sub_unld where arrsub_id = ?");
						$stmt_slocunld->bind_param("i", $arrsub_id);
						$result_slocunld = $stmt_slocunld->execute();
						if($result_slocunld){$flg=1;}  
						$stmt_slocunld->close();
						
					}
				}
				$stmt_subunld = $this->conn_ps->prepare("DELETE From tblarrival_sub_unld where arrival_id = ? AND old = ? ");
				$stmt_subunld->bind_param("is", $trid, $lotno);
				$result_subunld = $stmt_subunld->execute();
				if($result_subunld){$flg=1;}  
				$stmt_subunld->close();
				
							
				$stmt_lotimptbl = $this->conn_ps->prepare("Update tbllotimp SET lotimpflg=0 where lotnumber = ? ");
				$stmt_lotimptbl->bind_param("s", $lotno);
				$result_lotimptbl = $stmt_lotimptbl->execute();
				$stmt_lotimptbl->close();
			}
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}
	
	
	
	public function GetTranBagEdtDel($scode,$trid,$bagid,$bagwt,$tarewt,$deltype) {
		$flg=0;
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag!=0 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		//return "SELECT arrival_id FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = $trid";
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			if($deltype=="BAGREMOVE")
			{
				$stmt_slocunld = $this->conn_ps->prepare("DELETE From tblarrsub_sub_unld where arrsubsub_id = ?");
				$stmt_slocunld->bind_param("i", $bagid);
				$result_slocunld = $stmt_slocunld->execute();
				if($result_slocunld){$flg=1;}  
				$stmt_slocunld->close();
			}	
			
			if($deltype=="BAGEDIT")
			{
				$netwt=$bagwt-$tarewt;
				$stmt_slocunld = $this->conn_ps->prepare("UPDATE tblarrsub_sub_unld SET grosswt=?, netwt=?, tarewt=? where arrsubsub_id = ?");
				$stmt_slocunld->bind_param("sssi", $bagwt, $netwt, $tarewt, $bagid);
				$result_slocunld = $stmt_slocunld->execute();
				if($result_slocunld){$flg=1;}  
				$stmt_slocunld->close();
			}
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}
	
	
	public function GetTranFinalSubmit($scodeorg, $trid, $trnremarks) {
	//return false;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; $dt=date("Y-m-d");
		
		$sql_m2=$this->conn_ps->prepare("UPDATE tblarrival_unld SET remarks = ?, arrival_date= ? where arrival_id = ?");
		$sql_m2->bind_param("ssi", $trnremarks, $dt, $trid);
		$result_sql_m2 = $sql_m2->execute();
		$sql_m2->close();
		
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id, yearcode, arrival_type, arrival_code, arrival_date, dcno, dc_date, disp_date, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, remarks, arr_role, arrtrflag FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows == 0) {
		$flg=1;
		//return "SELECT arrival_id, yearcode, arrival_type, arrival_code, arrival_date, dcno, dc_date, disp_date, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, remarks, arr_role, arrtrflag FROM tblarrival_unld WHERE arrunldflag=1 AND arrival_id = $trid";
		}
		else
		{
			$stmt_2->bind_result($arrival_id, $yearcode, $arrival_type, $arrival_code, $arrival_date, $dcno, $dc_date, $disp_date, $tmode, $trans_name, $trans_lorryrepno, $trans_vehno, $trans_paymode, $remarks, $arr_role, $arrtrflag);
			//looping through all the records
			$stmt_2->fetch();
			$stmt_2->close();
			$arrtrflag=1;
			
			$sqlcode=$this->conn_ps->prepare("SELECT MAX(arrival_code) FROM tblarrival where yearcode='".$yearcode."' and arrival_type='Fresh Seed with PDN' and plantcode='".$plantcode."' ORDER BY arrival_code DESC");
								//$sql_code1->bind_param("s", $lotno);
			$result_sqlcode=$sqlcode->execute();
			$sqlcode->store_result();
			if($sqlcode->num_rows > 0) 
			{
				$sqlcode->bind_result($arrival_coden);
				$t_sqlcode=$arrival_coden;
				$scode=$t_sqlcode+1;
			}
			else
			{
				$scode=1;
			}
			$sqlcode->close();
			
			$sqlcode1=$this->conn_ps->prepare("SELECT MAX(arr_code) FROM tblarrival where yearcode='".$yearcode."' and arrival_type='Fresh Seed with PDN' and plantcode='".$plantcode."' ORDER BY arr_code DESC");
								//$sql_code1->bind_param("s", $lotno);
			$result_sqlcode1=$sqlcode1->execute();
			$sqlcode1->store_result();
			if($sqlcode1->num_rows > 0) 
			{
				$sqlcode1->bind_result($arr_coden);
				$t_sqlcode1=$arr_coden;
				$scode1=$t_sqlcode1+1;
			}
			else
			{
				$scode1=1;
			}
			$sqlcode1->close();
			
			
			$stmt_arrimain = $this->conn_ps->prepare("insert into tblarrival (yearcode, arrival_type, arrival_code, arr_code, arrival_date, dcno, dc_date, disp_date, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, remarks, arr_role, arrtrflag, plantcode)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt_arrimain->bind_param("ssiisssssssssssis", $yearcode, $arrival_type, $scode, $scode1, $arrival_date, $dcno, $dc_date, $disp_date, $tmode, $trans_name, $trans_lorryrepno, $trans_vehno, $trans_paymode, $trnremarks, $arr_role, $arrtrflag, $plantcode);
			$result_arrimain = $stmt_arrimain->execute();
			if($result_arrimain)
			{
				$artrid=$stmt_arrimain->insert_id;
				
				$stmt_arsub = $this->conn_ps->prepare("SELECT arrsub_id, organiser, pdnno, pdndate, spcodef, spcodem, lotcrop, lotvariety, ploc, pper, farmer, plotno, gi, harvestdate, got, qty, act, diff, qty1, act1, diff1, moisture, vchk, qc, remarks, sstage, sstatus, lotno, old, got1, sample, qcsample,orlot,gssample,prodtype, lotstate, leduration, leupto FROM tblarrival_sub_unld WHERE arrival_id = ? ");
				$stmt_arsub->bind_param("i", $trid);
				$result_arsub=$stmt_arsub->execute();
				$stmt_arsub->store_result();
				if ($stmt_arsub->num_rows == 0) {
				$flg=2;
				}
				else{
					$stmt_arsub->bind_result($arrsub_id, $organiser, $pdnno, $pdndate, $spcodef, $spcodem, $lotcrop, $lotvariety, $ploc, $pper, $farmer, $plotno, $gi, $harvestdate, $got, $qty, $act, $diff, $qty1, $act1, $diff1, $moisture, $vchk, $qc, $remarks, $sstage, $sstatus, $lotno, $old, $got1, $sample, $qcsample, $orlot, $gssample, $prodtype, $lotstate, $leduration, $leupto); 
					//looping through all the records 
					while($stmt_arsub->fetch())
					{
						$crop=$lotcrop;
						$variety=$lotvariety;
						
						$vrnew=$crop."-"."Coded";
																
						$sql_crop=mysql_query("select * from tblcrop where cropname='$crop'") or die(mysql_error());
						$row_crop=mysql_fetch_array($sql_crop);
						$classid=$row_crop['cropid'];
				
						if($variety!="" && $variety!=$vrnew)
						{
							$sql_veriety=mysql_query("select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysql_error());
							$row_variety=mysql_fetch_array($sql_veriety);
							$itemid=$row_variety['varietyid'];				
						}
						else
						{
							$itemid=$row_arrsub['lotvariety'];
						}
					
						$sqlcode2=$this->conn_ps->prepare("SELECT MAX(ncode) FROM tblarrival_sub ORDER BY ncode DESC");
						//$sql_code1->bind_param("s", $lotno);
						$result_sqlcode1=$sqlcode2->execute();
						$sqlcode2->store_result();
						if($sqlcode2->num_rows > 0) 
						{
							$sqlcode2->bind_result($arr_coden);
							$t_sqlcode2=$arr_coden;
							$ncode=$t_sqlcode2+1;
						}
						else
						{
							$ncode=1;
						}
						$sqlcode2->close();
						
						$stmt_arrsub = $this->conn_ps->prepare("insert into tblarrival_sub (arrival_id, organiser, pdnno, pdndate, spcodef, spcodem, lotcrop, lotvariety, ploc, pper, farmer, plotno, gi, harvestdate, got, qty, act, diff, qty1, act1, diff1, moisture, vchk, qc, remarks, sstage, sstatus, lotno, old, got1, sample, qcsample, orlot, gssample, prodtype, lotstate, leduration, leupto, ncode, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_arrsub->bind_param("isssssssssssisssssiiissssssssssssissisis", $artrid, $organiser, $pdnno, $pdndate, $spcodef, $spcodem, $lotcrop, $lotvariety, $ploc, $pper, $farmer, $plotno, $gi, $harvestdate, $got, $qty, $act, $diff, $qty1, $act1, $diff1, $moisture, $vchk, $qc, $remarks, $sstage, $sstatus, $lotno, $old, $got1, $sample, $qcsample, $orlot, $gssample, $prodtype, $lotstate, $leduration, $leupto, $ncode, $plantcode);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub)
						{
							$arsubtrid=$stmt_arrsub->insert_id;
							
							//return "SELECT arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety FROM tblarr_sloc_unld WHERE arrival_id = $trid AND arr_id = $arrsub_id ";
							$stmt_arsubsub = $this->conn_ps->prepare("SELECT arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety FROM tblarr_sloc_unld WHERE arr_tr_id = ? AND arr_id = ? ");
							$stmt_arsubsub->bind_param("ii", $trid, $arrsub_id);
							$result_arsubsub=$stmt_arsubsub->execute();
							$stmt_arsubsub->store_result();
							if ($stmt_arsubsub->num_rows == 0) {
							$flg=3;
							//return "SELECT arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety FROM tblarr_sloc_unld WHERE arr_tr_id = $trid AND arr_id = $arrsub_id ";
							
							}
							else {
								$stmt_arsubsub->bind_result($arr_type, $arr_tr_id, $arr_id, $whid, $binid, $subbin, $rowid, $qty, $bags, $balqty, $balbags, $lotcrop, $lotvariety); 
								//looping through all the records 
								while($stmt_arsubsub->fetch())
								{
							
									$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety, plantcode)  Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
									$stmt_arrsubsub->bind_param("siiiiiisisisss", $arr_type, $artrid, $arsubtrid, $whid, $binid, $subbin, $rowid, $qty, $bags, $balqty, $balbags, $lotcrop, $lotvariety, $plantcode);
									$result_arrsubsub = $stmt_arrsubsub->execute();
									if($result_arrsubsub)
									{  
										$zero=0; $zero1=0.000; $gemp=0; if($gssample==NULL || $gssample=='')$gssample=0;
										
										$stmt_lotldg = $this->conn_ps->prepare("insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, lotldg_got1, lotldg_sstatus, orlot, lotldg_gs, lotldg_got, leduration, leupto, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
										$stmt_lotldg->bind_param("sssisssiiiisisisssisssssisiss", $yearcode, $lotno, $trtype, $artrid, $arrival_date, $classid, $itemid, $whid, $binid, $subbin, $zero, $zero1, $bags, $qty, $balbags, $balqty, $stage, $moisture, $gemp, $vchk, $qc, $got, $sstatus, $orlot, $gssample, $got1, $leduration, $leupto, $plantcode);
										$result_lotldg = $stmt_lotldg->execute();
						
										if($result_lotldg){$flg=0;}  
										$stmt_lotldg->close();
										
										$stmt_arrsubsub->close();
									}
									
								}
								$stmt_arsubsub->close();
							}
							
								$sqlisstbl=$this->conn_ps->prepare("select le_lotno from tbl_lemain where le_lotno = ? "); 
								$sqlisstbl->bind_param("s", $lotno);
								$result_sqlisstbl=$sqlisstbl->execute();
								$sqlisstbl->store_result();
								if ($sqlisstbl->num_rows > 0) 
								{
									$sqlsubsub1=$this->conn_ps->prepare("UPDATE tbl_lemain SET le_duration = ?, le_upto = ? where le_lotno = ? and le_stage = ?");
									$sqlsubsub1->bind_param("ssss", $leduration, $leupto, $lotno, $stage);
									$result_sqlsubsub1 = $sqlsubsub1->execute();
									$sqlsubsub1->close();
								}
								else
								{
									$sqlsubsub1=$this->conn_ps->prepare("insert into tbl_lemain (le_duration, le_upto, le_lotno, le_stage) values(?,?,?,?)");
									$sqlsubsub1->bind_param("ssss", $leduration, $leupto, $lotno, $stage);
									$result_sqlsubsub1 = $sqlsubsub1->execute();
									$sqlsubsub1->close();
								}
								$sqlisstbl->close();
								
								$Arrival='Arrival';
								$sqlsubsub13=$this->conn_ps->prepare("insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid) values(?,?,?,?,?,?,?)");
								$sqlsubsub13->bind_param("sssssss", $lotno, $stage, $leduration, $leupto, $arrival_date, $Arrival, $arr_role);
								$result_sqlsubsub13 = $sqlsubsub13->execute();
								$sqlsubsub13->close();
								
								$sql_itm=$this->conn_ps->prepare("UPDATE tbl_subbin SET status = ? where sid = ?");
								$sql_itm->bind_param("ss", $ststus, $subbin);
								$result_sql_itm = $sql_itm->execute();
								$sql_itm->close();
								
								$sql_code1=$this->conn_ps->prepare("SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearcode."' and plantcode='".$plantcode."' ORDER BY tid DESC");
								//$sql_code1->bind_param("s", $lotno);
								$result_sql_code1=$sql_code1->execute();
								$sql_code1->store_result();
								if ($sql_code1->num_rows == 0) 
								{
									$sql_code1->bind_result($qsampleno);
									$t_code1=$qsampleno;
									$ncode1=$t_code1+1;
								}
								else
								{
									$ncode1=1;
								}
								$sql_code1->close();
									
								$state="P/M/G";	 $one=1;
								if($qc=="UT")
								{
									$sql_sub_sub1244=$this->conn_ps->prepare("insert into tbl_qctest(pp, moist, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid,logid, plantcode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
									$sql_sub_sub1244->bind_param("sssssssssssssss", $vchk, $moisture, $lotno, $arrival_date, $classid, $itemid, $ncode1, $stage, $qc, $state,$one ,$orlot, $yearcode, $arr_role, $plantcode);
									$result_sql_sub_sub1244 = $sql_sub_sub1244->execute();
									$sql_sub_sub1244->close();
								}
								if($got1=="UT")
								{
									$sql_sub_sub1245=$this->conn_ps->prepare("insert into tbl_gottest(gottest_got, gottest_lotno, gottest_srdate, gottest_crop, gottest_variety, gottest_sampleno, gottest_trstage, gottest_oldlot, yearid, logid, plantcode) values(?,?,?,?,?,?,?,?,?,?,?)");
									$sql_sub_sub1245->bind_param("sssssssssss", $got1, $lotno, $arrival_date, $classid, $itemid, $ncode1, $stage, $orlot, $yearcode, $arr_role, $plantcode);
									$result_sql_sub_sub1245 = $sql_sub_sub1245->execute();
									$sql_sub_sub1245->close();
								}
								//exit;
							
								$sql_itm=$this->conn_ps->prepare("UPDATE tbllotimp SET lotimpflg = ?, trid = ? where lotnumber = ?");
								$sql_itm->bind_param("sss", $one, $artrid, $old);
								$result_sql_itm = $sql_itm->execute();
								$sql_itm->close();
							
							
						}  
						$stmt_arrsub->close();
						
					}
					$stmt_arsub->close();
				}
			
			}  
			$stmt_arrimain->close();
			$one=1;
			$sql_m=$this->conn_ps->prepare("UPDATE tblarrival_unld SET arrtrflag = ?, unldarr_trid = ?, logid = ? where arrival_id = ?");
			$sql_m->bind_param("sssi", $one, $artrid, $scodeorg, $trid);
			$result_sql_m = $sql_m->execute();
			$sql_m->close();
				
		}
		//return $flg;
		if($flg==0)
		{return true;}
		else
		{return false;}		
	}

// New Code ------------------------------------------------	
	
	public function GetTranStsUpdate($scode, $trid, $unldtype) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0;
		if($unldtype=="")$unldtype="online";
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrtrnunldtype=? where arrival_id = ? ");
			$stmt60->bind_param("si", $unldtype, $arrival_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
			
			$stmt_2->close();
		}
		
		if($flg==0)
		{return false;}
		else
		{return true;}		
	}	
	

	
	public function UpdateUnloadingJsonData($trid, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $unldtype="online"; $lots=array();
		$stmt_2 = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_unld WHERE arrival_id = ?");
		$stmt_2->bind_param("i", $trid);
		$result2=$stmt_2->execute();
		$stmt_2->store_result();
		if ($stmt_2->num_rows > 0) {
			$stmt_2->bind_result($arrival_id);
			//looping through all the records
			$stmt_2->fetch();
			
			$stmt0 = $this->conn_ps->prepare("DELETE From tblarrsub_sub_unld where arrival_id = ? ");
			$stmt0->bind_param("i", $arrival_id);
			$result0 = $stmt0->execute();
			$stmt0->close();
			
			$xcx=count($jdata['unloadingData']);
			for($i=0; $i<$xcx; $i++)
			{
				if($jdata['unloadingData'][$i]<>"")
				{
					$exoldlot=$jdata['unloadingData'][$i]['lotno'];
					$grosswt=$jdata['unloadingData'][$i]['actqty'];
					$trwt=$jdata['unloadingData'][$i]['tarewt'];
					$netqty=$grosswt-$trwt;
					array_push($lots,$exoldlot);
					
					$stmt_arsub = $this->conn_ps->prepare("SELECT arrsub_id, old FROM tblarrival_sub_unld WHERE arrival_id = ? and old = ?");
					$stmt_arsub->bind_param("is", $trid, $exoldlot);
					$result_arsub=$stmt_arsub->execute();
					$stmt_arsub->store_result();
					if ($stmt_arsub->num_rows == 0) 
					{
						$trtype='Fresh Seed with PDN'; $stage='Raw'; $stage2='R'; 
						$lotimpid=0; $lotcrop=''; $lotspcodef=''; $lotspcodem=''; $lotploc=''; $lotstate=''; $lotpper=''; $lotorganiser=''; $lotfarmer=''; $lotplotno=''; $pdnno=''; $pdndate=''; $sstage='Raw'; $prodtype='';
						$stmt_lotimp = $this->conn_ps->prepare("SELECT lotimpid, lotcrop, lotspcodef, lotspcodem, lotploc, lotstate, lotpper, lotorganiser, lotfarmer, lotplotno, pdnno, pdndate, prodtype  FROM tbllotimp WHERE trid=0 AND lotnumber = ? ");
						$stmt_lotimp->bind_param("s", $exoldlot);
						$result_lotimp=$stmt_lotimp->execute();
						$stmt_lotimp->store_result();
						//return "SELECT lotimpid, lotcrop, lotspcodef, lotspcodem, lotploc, lotstate, lotpper, lotorganiser, lotfarmer, lotplotno, pdnno, pdndate, prodtype  FROM tbllotimp WHERE trid=0 AND lotnumber = '$lotno' ";
						if ($stmt_lotimp->num_rows > 0) {
							$stmt_lotimp->bind_result($lotimpid, $lotcrop, $lotspcodef, $lotspcodem, $lotploc, $lotstate, $lotpper, $lotorganiser, $lotfarmer, $lotplotno, $pdnno, $pdndate, $prodtype);
							//looping through all the records 
							$stmt_lotimp->fetch();
							$stmt_lotimp->close();
						
							$popularname=$lotcrop."-Coded";
							$stmt_spc = $this->conn_ps->prepare("SELECT variety, crop FROM tblspcodes WHERE spcodef = ? AND spcodem = ? ");
							$stmt_spc->bind_param("ss", $lotspcodef, $lotspcodem);
							$result_spc=$stmt_spc->execute();
							$stmt_spc->store_result();
							if ($stmt_spc->num_rows > 0) {
								$stmt_spc->bind_result($spcvariety, $spccrop);
								//looping through all the records 
								$stmt_spc->fetch();
								$stmt_spc->close();
							
								$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
								$stmt_variety->bind_param("i", $spcvariety);
								$result_variety=$stmt_variety->execute();
								$stmt_variety->store_result();
								if ($stmt_variety->num_rows > 0) {
									$stmt_variety->bind_result($varietyid, $popularname);
									//looping through all the records 
									$stmt_variety->fetch();
									$stmt_variety->close();
								}
							}
							$pcode=''; 
							$stmt_plant = $this->conn_ps->prepare("SELECT code  FROM tbl_parameters WHERE plantcode=?");
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
							$lotno=$pcode.$exoldlot."/00000/00R";
							$orlot=$pcode.$exoldlot."/00000/00";
							$qtydc=0; $nobdc=0; $tarewt=0;
							$stmt_arrsub = $this->conn_ps->prepare("Insert into tblarrival_sub_unld (arrival_id, lotimpid, lotcrop, lotvariety, qty, act1, tarewt, lotno, orlot, old, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, sstage, prodtype, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
							$stmt_arrsub->bind_param("iisssssssssssssssssssss", $arrival_id, $lotimpid, $lotcrop, $popularname, $qtydc, $nobdc, $tarewt, $lotno, $orlot, $exoldlot, $pdndate, $pdnno, $lotspcodef, $lotspcodem, $lotorganiser, $lotfarmer, $lotploc, $lotstate, $lotpper, $lotplotno, $stage, $prodtype, $plantcode);
						
							//$stmt_arrsub = $this->conn_ps->prepare("insert into tblarrival_sub_unld (arrival_id, old, lotno, orlot)  Values(?,?,?,?) ");
							//$stmt_arrsub->bind_param("iissss", $trid, $exoldlot, $lotno, $orlot, $netqty, $trwt);
							$result_arrsub = $stmt_arrsub->execute();
							$arrsub_id=$stmt_arrsub->insert_id;
							$stmt_arrsub->close();
							
							$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt, plantcode)  Values(?,?,?,?,?,?,?) ");
							$stmt_arrsubsub->bind_param("iisssss", $trid, $arrsub_id, $exoldlot, $grosswt, $netqty, $trwt, $plantcode);
							$result_arrsubsub = $stmt_arrsubsub->execute();
							$stmt_arrsubsub->close();
						}
						else
						{
							$stmt_arrsub = $this->conn_ps->prepare("insert into tblarrival_sub_unld (arrival_id, old, lotno, orlot, plantcode)  Values(?,?,?,?,?) ");
							$stmt_arrsub->bind_param("issss", $trid, $exoldlot, $lotno, $orlot, $plantcode);
							$result_arrsub = $stmt_arrsub->execute();
							$arrsub_id=$stmt_arrsub->insert_id;
							$stmt_arrsub->close();
							
							$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt, plantcode)  Values(?,?,?,?,?,?,?) ");
							$stmt_arrsubsub->bind_param("iisssss", $trid, $arrsub_id, $exoldlot, $grosswt, $netqty, $trwt, $plantcode);
							$result_arrsubsub = $stmt_arrsubsub->execute();
							$stmt_arrsubsub->close();
						}
					}
					else
					{
						$stmt_arsub->bind_result($arrsub_id, $old);
						//looping through all the records
						$stmt_arsub->fetch();
						
						$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt, plantcode)  Values(?,?,?,?,?,?,?) ");
						$stmt_arrsubsub->bind_param("iisssss", $trid, $arrsub_id, $exoldlot, $grosswt, $netqty, $trwt, $plantcode);
						$result_arrsubsub = $stmt_arrsubsub->execute();
						$stmt_arrsubsub->close();
					}
				}
			}
		}
		else
		{
			$flg=1;
		}
		$stmt_2->close();
		if($flg==0)
		{
			/*$newlots='';
			$lotns=array_unique($lots);
			
			foreach($lotns as $lotnnn)
			{
				if($lotnnn<>"")
				{
					$lotno1="'$lotnnn'";
					if($newlots!="") {$newlots=$newlots.",".$lotno1;}
					else  {$newlots=$lotno1;}
				}
			}
			if(!empty($newlots))
			{
				$stmt_lotimp = $this->conn_ps->prepare("SELECT arrsub_id FROM tblarrival_sub_unld WHERE arrival_id = ? AND old NOT IN (?) ");
				$stmt_lotimp->bind_param("is", $trid, $newlots);
				$result_lotimp=$stmt_lotimp->execute();
				$stmt_lotimp->store_result();
				if ($stmt_lotimp->num_rows > 0) {
					$stmt_lotimp->bind_result($arrsub_id);
					//looping through all the records 
					while($stmt_lotimp->fetch())
					{
						$stmt_slocunld = $this->conn_ps->prepare("DELETE From tblarrsub_sub_unld where arrsub_id = ?");
						$stmt_slocunld->bind_param("i", $arrsub_id);
						$result_slocunld = $stmt_slocunld->execute();
						if($result_slocunld){$flg=1;}  
						$stmt_slocunld->close();
						
					}
				}
				$stmt_subunld = $this->conn_ps->prepare("DELETE From tblarrival_sub_unld where arrival_id = ? AND old NOT IN (?) ");
				$stmt_subunld->bind_param("is", $trid, $newlots);
				$result_subunld = $stmt_subunld->execute();
				if($result_subunld){$flg=1;}  
				$stmt_subunld->close();
				
							
				$stmt_lotimptbl = $this->conn_ps->prepare("Update tbllotimp SET lotimpflg=0 where lotnumber IN (?) ");
				$stmt_lotimptbl->bind_param("s", $newlots);
				$result_lotimptbl = $stmt_lotimptbl->execute();
				$stmt_lotimptbl->close();
			}*/
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrtrnunldtype=? where arrival_id = ? ");
			$stmt60->bind_param("si", $unldtype, $arrival_id);
			$result60 = $stmt60->execute();
			//if($result60){$flg=1;}
			$stmt60->close();
			return true;
		}
		else
		{return false;}		
	}
	
	public function GetYearCodeList($scode) {
		$plantcode = $this->getPlantcode($scode);
        $stmt = $this->conn_ps->prepare("SELECT years, ycode, baryrcode FROM tblyears WHERE ycode!='' ORDER BY yearsid DESC LIMIT 3");
        //$stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$years=''; $ycode=''; $baryrcode=''; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($years, $ycode, $baryrcode);
			while($stmt->fetch())
			{
				if($ycode==NULL){$ycode='';} 
				//$userSR["ycode"] = $ycode;
				array_push($userSR,$ycode);
			}
			$stmt->close();
           // return $resusers;
        } else {
            // user not existed
			$userSR = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	
	
	
	
		
	function GetLMCQRScanningFinalize($scode, $trtype, $qrcode, $grosswt, $mptype, $wh_id, $bin_id, $subbin_id)
	{
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0;
		$wh=''; $bin=''; $subbin='';
		if($trtype=="lmc" || $trtype=="LMC") { $trtype='LMC'; $trtype2="PACKLMC";} if($trtype=="nlc" || $trtype=="NLC") { $trtype='NLC'; $trtype2="PACKNLC";}
		
		$stmtm = $this->conn_ps->prepare("SELECT  wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype, wb_mpqrcode, wb_mpbarcode, wb_mpwt, wb_mpgrosswt, wb_id  FROM tbl_wbqrcode WHERE wb_mpqrcode = ?");
		$stmtm->bind_param("s", $qrcode);
		$stmtm->execute();
		$stmtm->store_result();
		$arrivalcode=0;
		$wb_extqrcode=""; $wb_type=""; $wb_crop=""; $wb_variety=""; $wb_ups=""; $wb_lotno=""; $wb_nop=""; $wb_qty=""; $wb_mptype=""; $wb_mpqrcode=""; $wb_mpbarcode=""; $wb_mpwt=""; $wb_mpgrosswt=""; $wb_id=""; $wbids="";
		
		if($stmtm->num_rows > 0) {
			// user existed 
			$stmtm->bind_result($wb_extqrcode, $wb_type, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_mptype, $wb_mpqrcode, $wb_mpbarcode, $wb_mpwt, $wb_mpgrosswt, $wb_id);
			$stmtm->fetch();
			while($stmtm->fetch())
			{
				if($wbids!=""){$wbids=$wbids.",".$wb_id;} else {$wbids=$wb_id;}
			}
			$stmtm->close();
		}
		else
		{
			return false;
		}
		
		$stmt_pac = $this->conn_ps->prepare("SELECT max(packaging_tcode) FROM tbl_packaging WHERE plantcode=?");
		$stmt_pac->bind_param("s", $plantcode);
		$result_pac=$stmt_pac->execute();
		$stmt_pac->store_result();
		if ($stmt_pac->num_rows > 0) {
			$stmt_pac->bind_result($packaging_tcode);
			//looping through all the records 
			$stmt_pac->fetch();
			$tcode=$packaging_tcode+1; 
			$stmt_pac->close();
		}
		
		$stmt_pac2 = $this->conn_ps->prepare("SELECT max(packaging_code) FROM tbl_packaging WHERE plantcode=?");
		$stmt_pac2->bind_param("s", $plantcode);
		$result_pac2=$stmt_pac2->execute();
		$stmt_pac2->store_result();
		if ($stmt_pac2->num_rows > 0) {
			$stmt_pac2->bind_result($packaging_code);
			//looping through all the records 
			$stmt_pac2->fetch();
			$pcode=$packaging_code+1; 
			$stmt_pac2->close();
		}
		
		$stmt24 = $this->conn_ps->prepare("SELECT lgenyearcode, lgenyear FROM tbl_lgenyear order by lgenyearid DESC ");
		//$stmt_2->bind_param("s", $pdate);
		$result24=$stmt24->execute();
		$stmt24->store_result();
		if ($stmt24->num_rows > 0) {
			$stmt24->bind_result($lgenyearcode, $lgenyear);
			//looping through all the records
			$stmt24->fetch();
			$stmt24->close();
		}
		
		
		$typ="regular";
		$stmt_packm = $this->conn_ps->prepare("Insert into tbl_packaging (packaging_type, packaging_tdate, packaging_tcode, packaging_code, packaging_date, packaging_yearid, packaging_logid, packaging_barcode, packaging_mptype, packaging_trtype, plantcode, packaging_tflg) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
		$stmt_packm->bind_param("ssiisssssssi", $trtype, $dt, $tcode, $pcode, $dt, $lgenyearcode, $scode, $wb_mpbarcode, $mptype, $typ, $plantcode, $two);
		$result_packm = $stmt_packm->execute();
		if($result_packm){$flg=$flg+1;}  
		$packm_id=$stmt_packm->insert_id;
		$stmt_packm->close();
		
		$stmt_packsub = $this->conn_ps->prepare("Insert into tbl_packaging_sub (packaging_id, packagingsub_crop, packagingsub_variety, plantcode) Values(?,?,?,?) ");
		$stmt_packsub->bind_param("isss", $packm_id, $wb_crop, $wb_variety, $plantcode);
		$result_packsub = $stmt_packsub->execute();
		if($result_packsub){$flg=$flg+1;}  
		$packsub_id=$stmt_packsub->insert_id;
		$stmt_packsub->close();
		
				
		$lotnos=''; $tnop=0; $tqty=0; $lotnop=''; $lotqty=''; $orlots='';
				
		$stmt_wbs = $this->conn_ps->prepare("SELECT DISTINCT wb_lotno FROM tbl_wbqrcode_sub WHERE wb_id IN ($wbids)");
		//$stmt_wbs->bind_param("i", $wb_id);
		$result_wbs=$stmt_wbs->execute();
		$stmt_wbs->store_result();
		if ($stmt_wbs->num_rows > 0) {
			$stmt_wbs->bind_result($wb_lotno);
			//looping through all the records 
			while($stmt_wbs->fetch())
			{
				if($lotnos!="") {$lotnos=$lotnos.",".$wb_lotno;} else {$lotnos=$wb_lotno;}
				
				$nop=0; $qty=0;
				$stmt_wbs2 = $this->conn_ps->prepare("SELECT wb_extqrcode, wb_type, wb_crop, wb_variety, wb_ups, wb_lotno, wb_nop, wb_qty, wb_mptype FROM tbl_wbqrcode_sub WHERE wb_lotno=? AND wb_id IN ($wbids)");
				$stmt_wbs2->bind_param("s", $wb_lotno);
				$result_wbs2=$stmt_wbs2->execute();
				$stmt_wbs2->store_result();
				if ($stmt_wbs2->num_rows > 0) {
					$stmt_wbs2->bind_result($wb_extqrcode, $wb_type, $wb_crop, $wb_variety, $wb_ups, $wb_lotno, $wb_nop, $wb_qty, $wb_mptype);
					//looping through all the records 
					while($stmt_wbs2->fetch())
					{
						$nop=$nop+$wb_nop;
						$qty=$qty+$wb_qty;
						$tnop=$tnop+$wb_nop;
						$tqty=$tqty+$wb_qty;
					}
				}
				$stmt_wbs2->close();
				
				if($lotnop!=""){$lotnop=$lotnop.",".$nop; } else {$lotnop=$nop;}
				if($lotqty!=""){$lotqty=$lotqty.",".$qty; } else {$lotqty=$qty;}
						
				$stmt_24 = $this->conn_ps->prepare("SELECT  whid, binid, subbinid, balnop, balnomp, balqty  FROM tbl_lot_ldg_pack where lotno=? ");
				$stmt_24->bind_param("s", $wb_lotno);
				$result24=$stmt_24->execute();
				$stmt_24->store_result();
				if ($stmt_24->num_rows > 0) {
					$stmt_24->bind_result($whid, $binid, $subbinid, $balnop, $balnomp, $balqty);
					//looping through all the records
					$stmt_24->fetch();
					$stmt_24->close();
				}
				
				$stmt_packsubsub = $this->conn_ps->prepare("insert into tbl_packagingsub_sub (packaging_id, packagingsub_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_wtmp, extwh, extbin, extsubbin, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nop, packagingsubsub_balpch, plantcode)  Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_packsubsub->bind_param("iisssssssssss", $packm_id, $packsub_id, $wb_lotno, $wb_ups, $wb_mpwt, $whid, $binid, $subbinid, $balnop, $balqty, $nop, $zero, $plantcode);
				$result_packsubsub = $stmt_packsubsub->execute();
				if($result_packsubsub){$flg=$flg+1;}  
				$stmt_packsubsub->close();
				
				
				$stmt_lotpack = $this->conn_ps->prepare("SELECT lotldg_id, trtype, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid, subbinid, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode FROM tbl_lot_ldg_pack where lotno=? ");
				$stmt_lotpack->bind_param("s", $wb_lotno);
				$result_lotpack=$stmt_lotpack->execute();
				$stmt_lotpack->store_result();
				if ($stmt_lotpack->num_rows > 0) {
					$stmt_lotpack->bind_result($lotldg_id, $trtype, $trstage, $packtype, $lotno, $packlabels, $barcodes, $wtinmp, $opnop, $opnomp, $optqty, $whid2, $binid2, $subbinid2, $nop2, $nomp, $tqty2, $balnop, $balnomp, $balqty, $lotldg_trdate, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $lotldg_genpurity, $lotldg_dop, $lotldg_valperiod, $lotldg_valupto, $lotldg_rvflg, $lotldg_alflg, $lotldg_dispflg, $lotldg_altrids, $lotldg_alqtys, $lotldg_alnomps, $lotldg_spremflg, $lotldg_totalqty, $plantcode);
					//looping through all the records
					$stmt_lotpack->fetch();
					$stmt_lotpack->close();
				}
				
				if($orlots!="") {$orlots=$orlots.",".$orlot;} else {$orlots=$orlot;}
				
				$nomp=$nomp+1; $balnomp=$balnomp+1;
				$stmt_packtbl = $this->conn_ps->prepare("insert into tbl_lot_ldg_pack (lotldg_id, trtype, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid, subbinid, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode)  Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_packtbl->bind_param("isssssssssssssssssssssssssssssssssssssssssssssssssss", $packm_id, $trtype2, $trstage, $packtype, $lotno, $packlabels, $barcodes, $wtinmp, $balnop, $balnomp, $balqty, $whid2, $binid2, $subbinid2, $nop, $nomp, $qty, $balnop, $balnomp, $balqty, $lotldg_trdate, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $lotldg_genpurity, $lotldg_dop, $lotldg_valperiod, $lotldg_valupto, $lotldg_rvflg, $lotldg_alflg, $lotldg_dispflg, $lotldg_altrids, $lotldg_alqtys, $lotldg_alnomps, $lotldg_spremflg, $lotldg_totalqty, $plantcode);
				$result_packtbl = $stmt_packtbl->execute();
				if($result_packtbl){$flg=$flg+1;}  
				$stmt_packtbl->close();
				
				
			}	
			$packagingtyp="Packaging";
			$stmt_mpmain = $this->conn_ps->prepare("insert into tbl_mpmain ( mpmain_date, mpmain_trid, mpmain_trtyp, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_mptype, mpmain_wtmp, mpmain_mptnop, mpmain_lotnop, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_tflg, mpmain_yearcode, mpmain_logid, plantcode )  Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt_mpmain->bind_param("sissssssssssssssisss", $dt, $packm_id, $packagingtyp, $trtype2, $wb_crop, $wb_variety, $lotnos, $wb_ups, $wb_mpbarcode, $trtype, $wb_mpwt, $tnop, $lotnop, $wh_id, $bin_id, $subbin_id, $one, $lgenyearcode, $scode, $plantcode);
			$result_mpmain = $stmt_mpmain->execute();
			if($result_mpmain){$flg=$flg+1;}  
			$stmt_mpmain->close();	
			
			
			$stmt_barctbl = $this->conn_ps->prepare("insert into tbl_barcodes (bar_trid, bar_trtype, bar_subtrid, bar_lotno, bar_orlot, bar_barcode, bar_wtmp, bar_grosswt, logid, yearid, bar_crop, bar_variety, bar_ups, bar_dop, plantcode)  Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt_barctbl->bind_param("isissssssssssss", $packm_id, $trtype2, $packsub_id, $wb_lotno, $orlots, $wb_mpbarcode, $wb_mpwt, $grosswt, $scode, $lgenyearcode, $wb_crop, $wb_variety, $wb_ups, $dt, $plantcode);
			$result_barctbl = $stmt_barctbl->execute();
			if($result_barctbl){$flg=$flg+1;}  
			$stmt_barctbl->close();
			
			$stmt_packsstbl = $this->conn_ps->prepare("insert into tbl_packagingsub_sub2 (packaging_id, packagingsub_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_wh, packagingsubsub_bin, packagingsubsub_subbin, packagingsubsub_nomp, packagingsubsub_nopch, packagingsubsub_totpch, packagingsubsub_totqty, plantcode)  Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt_packsstbl->bind_param("iissssssssss", $packm_id, $packsub_id, $lotnos, $wb_ups, $wh_id, $bin_id, $subbin_id, $zero, $one, $tnop, $tqty, $plantcode);
			$result_packsstbl = $stmt_packsstbl->execute();
			if($result_packsstbl){$flg=$flg+1;}  
			$stmt_packsstbl->close();
				
			$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mpblinkflg=?, wb_mpqlinkflg=?, wb_mpgrosswt=? where wb_mpqrcode=?  and wb_linklogid=? ");
			$stmt60->bind_param("iisss", $one, $one, $grosswt, $qrcode, $scode);
			$result60 = $stmt60->execute();
			if($result60){$flag=$flg+1;} 
			$stmt60->close();	
			
			$stmt600 = $this->conn_ps->prepare("UPDATE tbl_packaging SET packaging_tflg=? where packaging_id=?  ");
			$stmt600->bind_param("is", $one, $packm_id);
			$result600 = $stmt600->execute();
			if($result600){$flag=$flg+1;} 
			$stmt600->close();	
		}
		$stmt_wbs->close();	
		
		
			
		if($flg==0)
		{return false;}
		else
		{return true;}	
		
		
	}
	
	
	
	
	
	public function GetQRcodeDelete($scode, $trid, $scantype, $qrcode, $trtype) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $dt=date("Y-m-d"); $one=1; $two=2; $zero=0; $cropname=''; $varietyname=''; $ups='';
		$userSR = array();
		if($trtype=="smc")
		{
			if($scantype=="wbqrcode")
			{
				$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_mpqlinkflg!=1 ");
			
				$stmt_2->bind_param("s", $qrcode);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
					
					$trtyp=NULL;
					
					$stmtqrchk = $this->conn_ps->prepare("SELECT wb_crop, wb_variety, wb_ups, wb_id FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_actflg>0 and wb_mpqlinkflg!=1");
					$stmtqrchk->bind_param("s", $qrcode);
					$result_qrchk=$stmtqrchk->execute();
					$stmtqrchk->store_result();
					if ($stmtqrchk->num_rows > 0) {
						$stmtqrchk->bind_result($cropname, $varietyname, $ups, $wb_id);
						
						$trtyp=NULL;
						$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_actdate=?, wb_type=?, wb_pnptrid=?, wb_crop=?, wb_variety=?, wb_ups=?, wb_lotno=?, wb_nop=?, wb_qty=?, wb_actflg=?, wb_actlogid=?, wb_mptype=?, wb_mpqrcode=?, wb_mpbarcode=?, wb_mpwt=?, wb_mpqlinkflg=?, wb_mpblinkflg=?, wb_mpgrosswt=? where wb_extqrcode=?  ");
						$stmt60->bind_param("ssissssssisssssiiss", $trtyp, $trtyp, $zero, $trtyp, $trtyp, $trtyp, $trtyp, $trtyp, $trtyp, $zero, $trtyp, $trtyp, $trtyp, $trtyp, $zero, $zero, $zero, $trtyp, $qrcode);
						$result60 = $stmt60->execute();
						if($result60)
						{
							$flg=1;
							$stmt_wbqrsub = $this->conn_ps->prepare("DELETE FROM tbl_wbqrcode_sub WHERE wb_id=? ");
							$stmt_wbqrsub->bind_param("i", $wb_id);
							$result_wbqrsub = $stmt_wbqrsub->execute();
							$stmt_wbqrsub->close();
						} 
						$stmt60->close();
					}
				}
			}
			else if($scantype=="mpqrcode")
			{
				$stmt_2 = $this->conn_ps->prepare("SELECT wb_crop, wb_variety, wb_ups, wb_id FROM tbl_wbqrcode WHERE wb_mpqrcode = ?  and wb_mpblinkflg!=1 ");
				$stmt_2->bind_param("s", $qrcode);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
					$stmt_2->bind_result($cropname, $varietyname, $ups, $wb_id);
					$trtyp=NULL;
					
					$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_actdate=?, wb_type=?, wb_pnptrid=?, wb_crop=?, wb_variety=?, wb_ups=?, wb_lotno=?, wb_nop=?, wb_qty=?, wb_actflg=?, wb_actlogid=?, wb_mptype=?, wb_mpqrcode=?, wb_mpbarcode=?, wb_mpwt=?, wb_mpqlinkflg=?, wb_mpblinkflg=?, wb_mpgrosswt=? where  wb_mpqrcode=?  ");
					$stmt60->bind_param("ssissssssisssssiiss", $trtyp, $trtyp, $zero, $trtyp, $trtyp, $trtyp, $trtyp, $trtyp, $trtyp, $zero, $trtyp, $trtyp, $trtyp, $trtyp, $zero, $zero, $zero, $trtyp, $qrcode);
					$result60 = $stmt60->execute();
					if($result60)
					{
						$flg=1;
						$stmt_wbqrsub = $this->conn_ps->prepare("DELETE FROM tbl_wbqrcode_sub WHERE wb_id=? ");
						$stmt_wbqrsub->bind_param("i", $wb_id);
						$result_wbqrsub = $stmt_wbqrsub->execute();
						$stmt_wbqrsub->close();
					} 
					$stmt60->close();
				}
			}
			else
			{
			
			}
			 
			$stmt_2->close();
		}
		else
		{
			if($scantype=="wbqrcode")
			{
				$stmt_2 = $this->conn_ps->prepare("SELECT wb_extqrcode FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_mpqlinkflg!=1 ");
			
				$stmt_2->bind_param("s", $qrcode);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
					
					$trtyp=NULL;
					
					$stmtqrchk = $this->conn_ps->prepare("SELECT wb_crop, wb_variety, wb_ups, wb_id FROM tbl_wbqrcode WHERE wb_extqrcode = ? and wb_actflg>0 and wb_mpqlinkflg!=1");
					$stmtqrchk->bind_param("s", $qrcode);
					$result_qrchk=$stmtqrchk->execute();
					$stmtqrchk->store_result();
					if ($stmtqrchk->num_rows > 0) {
						$stmtqrchk->bind_result($cropname, $varietyname, $ups, $wb_id);
					
						$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mptype=?, wb_mpqrcode=?, wb_mpbarcode=?, wb_mpwt=?, wb_mpqlinkflg=?, wb_mpblinkflg=?, wb_mpgrosswt=? where wb_extqrcode=?  ");
						$stmt60->bind_param("sssiiiss", $trtyp, $trtyp, $trtyp, $zero, $zero, $zero, $trtyp, $qrcode);
						$result60 = $stmt60->execute();
						if($result60)
						{
							$flg=1;
							//$stmt_wbqrsub = $this->conn_ps->prepare("DELETE FROM tbl_wbqrcode_sub WHERE wb_id=? ");
						//	$stmt_wbqrsub->bind_param("i", $wb_id);
						//	$result_wbqrsub = $stmt_wbqrsub->execute();
						//	$stmt_wbqrsub->close();
						} 
						$stmt60->close();
					}
				}
			}
			else if($scantype=="mpqrcode")
			{
				$stmt_2 = $this->conn_ps->prepare("SELECT wb_crop, wb_variety, wb_ups FROM tbl_wbqrcode WHERE wb_mpqrcode = ? and wb_mpblinkflg!=1 ");
				$stmt_2->bind_param("s", $qrcode);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
					$stmtqrchk->bind_result($cropname, $varietyname, $ups);
					$trtyp=NULL;
					
					$stmt60 = $this->conn_ps->prepare("UPDATE tbl_wbqrcode SET wb_mptype=?, wb_mpqrcode=?, wb_mpbarcode=?, wb_mpwt=?, wb_mpqlinkflg=?, wb_mpblinkflg=?, wb_mpgrosswt=? where wb_extqrcode=?  ");
					$stmt60->bind_param("sssiiiss", $trtyp, $trtyp, $trtyp, $zero, $zero, $zero, $trtyp, $qrcode);
					$result60 = $stmt60->execute();
					if($result60){$flg=1;} 
					$stmt60->close();
				}
			}
			else
			{
			}
			 
			$stmt_2->close();
		}
		array_push($userSR,$cropname, $varietyname, $ups);
			
		if($flg==0)
		{return false;}
		else
		{return $userSR;}		
	}	
	
	
	
	public function GetWHList($scode, $mobile1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT whid, perticulars FROM tbl_warehouse where plantcode=? ");
		$stmt_pnps->bind_param("s", $plantcode);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($whid, $perticulars);
			//looping through all the records 
			while($stmt_pnps->fetch())
			{
				$temp['whid']=$whid;
				$temp['perticulars']=$perticulars;
				array_push($userSR, $temp);
			}
			$stmt_pnps->close();
		}
		if(empty($userSR))
		{
			return false;
		}
		else
		{
			return $userSR;
		}		
	}
	
	
	public function GetBinList($scode, $mobile1, $whid) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT binid, binname FROM tbl_bin WHERE whid = ?");
		$stmt_pnps->bind_param("i", $whid);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($binid, $binname);
			//looping through all the records 
			while($stmt_pnps->fetch())
			{
				$temp['binid']=$binid;
				$temp['binname']=$binname;
				array_push($userSR, $temp);
			}
			$stmt_pnps->close();
		}
		if(empty($userSR))
		{
			return false;
		}
		else
		{
			return $userSR;
		}		
	}
	
	
	
	public function GetSubBinList($scode, $mobile1, $whid, $binid) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT sid, sname FROM tbl_subbin WHERE whid=? and binid=? ");
		$stmt_pnps->bind_param("ii", $whid, $binid);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($sid, $sname);
			//looping through all the records 
			while($stmt_pnps->fetch())
			{
				$temp['sid']=$sid;
				$temp['sname']=$sname;
				array_push($userSR, $temp);
			}
			$stmt_pnps->close();
		}
		if(empty($userSR))
		{
			return false;
		}
		else
		{
			return $userSR;
		}		
	}
	
	
	public function GetSubBinChk($scode, $mobile1, $whid, $binid, $subbinid, $variety) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		$bqty=0;
		
		$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
		$stmt_variety->bind_param("s", $variety);
		$result_variety=$stmt_variety->execute();
		$stmt_variety->store_result();
		if ($stmt_variety->num_rows > 0) {
			$stmt_variety->bind_result($varietyid, $popularname);
			//looping through all the records 
			$stmt_variety->fetch();
			$stmt_variety->close();
		}
		
		$stmt_ldgraw9 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = ? and plantcode=?");
		$stmt_ldgraw9->bind_param("is", $subbinid, $plantcode);
		$result2=$stmt_ldgraw9->execute();
		$stmt_ldgraw9->store_result();
		if ($stmt_ldgraw9->num_rows > 0) {
			$stmt_ldgraw9->bind_result($lotldgid);
			//looping through all the records
			while($stmt_ldgraw9->fetch())
			{
				$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT lotldg_balqty, lotldg_variety FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
				$stmt_ldgraw0->bind_param("is", $lotldgid, $plantcode);
				$result2=$stmt_ldgraw0->execute();
				$stmt_ldgraw0->store_result();
				if ($stmt_ldgraw0->num_rows > 0) {
					$stmt_ldgraw0->bind_result($lotldg_balqty, $lotldg_variety);
					//looping through all the records
					$stmt_ldgraw0->fetch();
					if($lotldg_variety!=$varietyid)
					{$bqty=$bqty+$lotldg_balqty;}
					//$cnt2++;
				}
				$stmt_ldgraw0->close();
			}
		}
		$stmt_ldgraw9->close();
		
		
		$stmt_ldgraw9 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and plantcode=?");
		$stmt_ldgraw9->bind_param("is", $subbinid, $plantcode);
		$result2=$stmt_ldgraw9->execute();
		$stmt_ldgraw9->store_result();
		if ($stmt_ldgraw9->num_rows > 0) {
			$stmt_ldgraw9->bind_result($lotldgid4);
			//looping through all the records
			while($stmt_ldgraw9->fetch())
			{
				$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT balqty, lotldg_variety FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");
				$stmt_ldgraw0->bind_param("is", $lotldgid4, $plantcode);
				$result2=$stmt_ldgraw0->execute();
				$stmt_ldgraw0->store_result();
				if ($stmt_ldgraw0->num_rows > 0) {
					$stmt_ldgraw0->bind_result($balqty, $lotldg_variety);
					//looping through all the records
					$stmt_ldgraw0->fetch();
					if($lotldg_variety!=$varietyid)
					{$bqty=$bqty+$balqty;}
					//$cnt2++;
				}
				$stmt_ldgraw0->close();
			}
		}
		$stmt_ldgraw9->close();
		
		if($bqty>0){$flg=1;}
		
		if($flg>0)
		{return false;}
		else
		{return true;}	
	}
	
	
	
	
	
	
	
	
	
	
	
	
}// Main Class close
?>
