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
	
	
	public function getPlantdetails() {
        $pcode='';
		$stmt_plant = $this->conn_ps->prepare("SELECT code  FROM tbl_parameters ");
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

	public function GetTrList($scode) {
        $stmt = $this->conn_ps->prepare("SELECT arrival_id, arrival_code, disp_date, arrsetupflag, setuplogid, arrunldflag, unldlogid, arrtrflag, logid, arrtrnunldtype, dc_date, dcno FROM tblarrival_unld WHERE arrtrflag!=1 and arrtrnunldtype='online'");
        //$stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$arrival_id=''; $arrival_code=''; $disp_date=''; $arrsetupflag=0; $setuplogid=''; $arrunldflag=0; $unldlogid=''; $arrtrflag=0; $logid=''; $arrtrnunldtype='online'; $dcdate=''; $dcno='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_id, $arrival_code, $disp_date, $arrsetupflag, $setuplogid, $arrunldflag, $unldlogid, $arrtrflag, $logid, $arrtrnunldtype, $dcdate, $dcno);
			while($stmt->fetch())
			{
			if($disp_date==NULL){$disp_date='';} if($arrsetupflag==NULL){$arrsetupflag=0;} if($setuplogid==NULL){$setuplogid='';} if($arrunldflag==NULL){$arrunldflag=0;} if($unldlogid==NULL){$unldlogid='';} if($arrtrflag==NULL){$arrtrflag=0;} if($logid==NULL){$logid='';} if($dcdate==NULL){$dcdate='';} if($dcno==NULL){$dcno='';}
			if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
			{
				$disp_date1=explode("-",$disp_date);
				$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
			}
			if($dcdate!='' && $dcdate!='0000-00-00' && $dcdate!=NULL)
			{
				$dcdate1=explode("-",$dcdate);
				$dcdate=$dcdate1[2]."-".$dcdate1[1]."-".$dcdate1[0];
			}
			$userSR["arrival_id"] = $arrival_id;
			$userSR["arrival_code"] = "AF".$arrival_code;
			$userSR["disp_date"] = $disp_date;
			$userSR["arrsetupflag"] = $arrsetupflag;
			$userSR["setuplogid"] = $setuplogid;
			$userSR["arrunldflag"] = $arrunldflag;
			$userSR["unldlogid"] = $unldlogid;
			$userSR["arrtrflag"] = $arrtrflag;
			$userSR["logid"] = $logid;
			
			$pper=''; $ploc=''; $lotstate='';
			$stmt_2 = $this->conn_ps->prepare("SELECT pper, ploc, lotstate  FROM tblarrival_sub_unld WHERE arrival_id = ? ");
			$stmt_2->bind_param("i", $arrival_id);
			$result2=$stmt_2->execute();
			$stmt_2->store_result();
			if ($stmt_2->num_rows == 0) {
				$userSR["pper"] = $pper;
				$userSR["ploc"] = $ploc;
				$userSR["lotstate"] = $lotstate;
				$stmt_2->close();

			} else {
				$stmt_2->bind_result($pper, $ploc, $lotstate);
				//looping through all the records
				$stmt_2->fetch();
				
				$userSR["pper"] = $pper;
				$userSR["ploc"] = $ploc;
				$userSR["lotstate"] = $lotstate;
				$stmt_2->close();
			}
			$userSR["transactionmode"] = $arrtrnunldtype;
			$userSR["dcdate"] = $dcdate;
			$userSR["dcno"] = $dcno;
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
        $stmt = $this->conn_ps->prepare("SELECT MAX(arrival_code) FROM tblarrival_unld WHERE arrival_type = ? AND yearcode = ?");
        $stmt->bind_param("ss", $trtype, $ycode);
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
			$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_unld (arrival_type, arrival_code, arrsetup_date, disp_date, dc_date, dcno, sstage, yearcode, arrsetupflag, setuplogid, arr_role) Values(?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt60->bind_param("sissssssiss", $trtype, $arrivalcode, $dt, $dispdate, $dcdate, $dcno, $stage, $ycode, $stpflg, $scode, $scode);
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
				$stmt_plant = $this->conn_ps->prepare("SELECT code  FROM tbl_parameters ");
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
						$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_sub_unld (arrival_id, lotimpid, lotcrop, lotvariety, qty, act1, tarewt, lotno, orlot, old, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, sstage, prodtype) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iissssssssssssssssssss", $arrival_id, $lotimpid, $lotcrop, $popularname, $qtydc, $nobdc, $tarewt, $lotn, $orlot, $lotno, $pdndate, $pdnno, $lotspcodef, $lotspcodem, $lotorganiser, $lotfarmer, $lotploc, $lotstate, $lotpper, $lotplotno, $stage, $prodtype);
					}
					else if($setuptype=="Edit")
					{
						$stmt60 = $this->conn_ps->prepare("UPDATE tblarrival_sub_unld SET qty=?, act1=? where arrsub_id=?");
						$stmt60->bind_param("sii", $qtydc, $nobdc, $arrsub_id);
					}
					else
					{
						$stmt60 = $this->conn_ps->prepare("Insert into tblarrival_sub_unld (arrival_id, lotimpid, lotcrop, lotvariety, qty, act1, tarewt, lotno, orlot, old, pdndate, pdnno, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, plotno, sstage, prodtype) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iissssssssssssssssssss", $arrival_id, $lotimpid, $lotcrop, $popularname, $qtydc, $nobdc, $tarewt, $lotn, $orlot, $lotno, $pdndate, $pdnno, $lotspcodef, $lotspcodem, $lotorganiser, $lotfarmer, $lotploc, $lotstate, $lotpper, $lotplotno, $stage, $prodtype);
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
					$stmt60 = $this->conn_ps->prepare("Insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt) Values(?,?,?,?,?,?) ");
					$stmt60->bind_param("iissss", $trid, $arrsub_id, $old, $qtyact, $ntwt, $tarewt);
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
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse order by perticulars ASC");
								//$stmt_variety->bind_param("is", $lotvariety, $lotcrop);
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
								
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse order by perticulars ASC");
								//$stmt_variety->bind_param("is", $lotvariety, $lotcrop);
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
								
								$stmt_wharr = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse order by perticulars ASC");
								//$stmt_variety->bind_param("is", $lotvariety, $lotcrop);
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
					
					$stmt_wh = $this->conn_ps->prepare("SELECT perticulars, whid FROM tbl_warehouse order by perticulars ASC");
					//$stmt_variety->bind_param("is", $lotvariety, $lotcrop);
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
		$user10=array();
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
		$stmt_wh->bind_param("s", $whname);
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
		$user10=array();
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
		$stmt_wh->bind_param("s", $whname);
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
	
	
	public function GetTranDetails($scode,$trid) {
	
		$userSR=array(); $arrival_id=0; $trtype='Fresh Seed with PDN'; $stage='Raw'; $user10=array();
		$stmt = $this->conn_ps->prepare("SELECT arrival_id, dc_date, dcno, disp_date, arrival_code FROM tblarrival_unld WHERE arrival_id = ?");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
		$arrivalcode=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($arrival_id,$dc_date,$dcno,$disp_date,$arrival_code);
			$stmt->fetch();
			$stmt->close();
			if($dc_date!='' && $dc_date!='0000-00-00' && $dc_date!=NULL)
			{
				$dc_date1=explode("-",$dc_date);
				$dc_date=$dc_date1[2]."-".$dc_date1[1]."-".$dc_date1[0];
			}
			
			if($disp_date!='' && $disp_date!='0000-00-00' && $disp_date!=NULL)
			{
				$disp_date1=explode("-",$disp_date);
				$disp_date=$disp_date1[2]."-".$disp_date1[1]."-".$disp_date1[0];
			}
			
			$user10["arrival_code"]="AF".$arrival_code;
			$user10["disp_date"]=$disp_date;
			$user10["dcdate"]=$dc_date;
			$user10["dcno"]=$dcno;
			array_push($userSR,$user10);
			
			/*$lotcrop=''; $lotvariety=''; $lotno=''; $orlot=''; $qty=0; $act1=0; $tarewt=0; $old='';   
			$stmt_lotimp = $this->conn_ps->prepare("SELECT lotcrop, lotvariety, lotno, orlot, qty, act1, tarewt, old, arrsub_id FROM tblarrival_sub_unld WHERE arrival_id = ? ");
			$stmt_lotimp->bind_param("i", $trid);
			$result_lotimp=$stmt_lotimp->execute();
			$stmt_lotimp->store_result();
			if ($stmt_lotimp->num_rows > 0) {
				$stmt_lotimp->bind_result($lotcrop, $lotvariety, $lotno, $orlot, $qty, $act1, $tarewt, $old, $arrsub_id);
				//looping through all the records 
				while($stmt_lotimp->fetch())
				{
					$nnob=0; $grwt=0; $ntwt=0; $actntqty=0;  $actgrqty=0; $actnob=0;
					$stmt_2 = $this->conn_ps->prepare("SELECT grosswt, netwt FROM tblarrsub_sub_unld WHERE arrival_id = ? and arrsub_id = ? ");
					$stmt_2->bind_param("ii", $arrival_id, $arrsub_id);
					$result2=$stmt_2->execute();
					$stmt_2->store_result();
					if ($stmt_2->num_rows > 0) {
						$stmt_2->bind_result($grosswt, $netwt);
						//looping through all the records
						while($stmt_2->fetch())
						{
							$nnob=$nnob+1;
							$grwt=$grwt+$grosswt;
							$ntwt=$ntwt+$netwt;
						}
						$actntqty=$actntqty+$ntwt;  
						$actgrqty=$actgrqty+$grwt; 
						$actnob=$actnob+$nnob;
					}
					$stmt_2->close();
					$trwt=$tarewt*$act1;
					$qtynt=$qty-$trwt;
					$user10["crop"] = $lotcrop;
					$user10["variety"] = $lotvariety;
					$user10["lotno"] = stripslashes($lotno);
					$user10["orlot"] = $orlot;
					$user10["dcnob"] = $act1;
					$user10["dcgrqty"] = $qty;
					$user10["dcntqty"] = $qtynt;
					$user10["tarewt"] = $tarewt;
					$user10["oldlot"] = $old;
					$user10["actnob"] = $actnob;
					$user10["actntqty"] = $actntqty;
					$user10["actgrqty"] = $actgrqty;
					array_push($userSR,$user10);
				}
				
				$stmt_lotimp->close();
			}*/
		} 
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
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
		$sbflg=0; $estage="Raw"; $user10=array(); $existview="Empty";
		$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
		$stmt_wh->bind_param("s", $whname);
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
				$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_variety) FROM tbl_lot_ldg WHERE lotldg_variety != ? and lotldg_subbinid = ? ");
				$stmt_ldgraw->bind_param("si", $popularname, $subbinid);
				$result2=$stmt_ldgraw->execute();
				$stmt_ldgraw->store_result();
				if ($stmt_ldgraw->num_rows > 0) {
					$stmt_ldgraw->bind_result($varietyname);
					//looping through all the records
					while($stmt_ldgraw->fetch())
					{
						$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? ");
						$stmt_ldgraw2->bind_param("si", $varietyname, $subbinid);
						$result2=$stmt_ldgraw2->execute();
						$stmt_ldgraw2->store_result();
						if ($stmt_ldgraw2->num_rows > 0) {
							$stmt_ldgraw2->bind_result($lotno);
							//looping through all the records
							while($stmt_ldgraw2->fetch())
							{
								$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? and lotldg_lotno = ?");
								$stmt_ldgraw3->bind_param("sis", $varietyname, $subbinid, $lotno);
								$result2=$stmt_ldgraw3->execute();
								$stmt_ldgraw3->store_result();
								if ($stmt_ldgraw3->num_rows > 0) {
									$stmt_ldgraw3->bind_result($lotldgid);
									//looping through all the records
									while($stmt_ldgraw3->fetch())
									{ 
										$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_id FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 ");
										$stmt_ldgraw4->bind_param("i", $lotldgid);
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
				
				$stmt_ldgraw5 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_variety=? and lotldg_subbinid = ? AND lotldg_sstage!='Raw' ");
				$stmt_ldgraw5->bind_param("si", $varietyid, $subbinid);
				$result2=$stmt_ldgraw5->execute();
				$stmt_ldgraw5->store_result();
				if ($stmt_ldgraw5->num_rows > 0) {
					$stmt_ldgraw5->bind_result($lotno2);
					//looping through all the records
					while($stmt_ldgraw5->fetch())
					{
						$stmt_ldgraw6 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_variety = ? and lotldg_subbinid = ? and lotldg_lotno = ? AND lotldg_sstage!='Raw' ");
						$stmt_ldgraw6->bind_param("sis", $varietyid, $subbinid, $lotno2);
						$result2=$stmt_ldgraw6->execute();
						$stmt_ldgraw6->store_result();
						if ($stmt_ldgraw6->num_rows > 0) {
							$stmt_ldgraw6->bind_result($lotldgid2);
							//looping through all the records
							while($stmt_ldgraw6->fetch())
							{
								$stmt_ldgraw7 = $this->conn_ps->prepare("SELECT lotldg_id FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0  AND lotldg_sstage!='Raw' ");
								$stmt_ldgraw7->bind_param("i", $lotldgid2);
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
				$stmt_ldgraw8 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE subbinid = ? ");
				$stmt_ldgraw8->bind_param("i", $subbinid);
				$result2=$stmt_ldgraw8->execute();
				$stmt_ldgraw8->store_result();
				if ($stmt_ldgraw8->num_rows > 0) {
					$stmt_ldgraw8->bind_result($lotno3);
					//looping through all the records
					while($stmt_ldgraw8->fetch())
					{
						$stmt_ldgraw9 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? ");
						$stmt_ldgraw9->bind_param("is", $subbinid, $lotno3);
						$result2=$stmt_ldgraw9->execute();
						$stmt_ldgraw9->store_result();
						if ($stmt_ldgraw9->num_rows > 0) {
							$stmt_ldgraw9->bind_result($lotldgid4);
							//looping through all the records
							while($stmt_ldgraw9->fetch())
							{
								$stmt_ldgraw0 = $this->conn_ps->prepare("SELECT lotdgp_id FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 ");
								$stmt_ldgraw0->bind_param("i", $lotldgid4);
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
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
						$stmt_wh->bind_param("s", $whname);
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
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisi", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob);
						$result60 = $stmt60->execute();
						if($result60){$flg=1;//"Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values($arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob) ";
						}  
						$stmt60->close();
					}
					
					if($slocqty1>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
						$stmt_wh->bind_param("s", $whname1);
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
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisi", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty1, $slocnob1, $slocqty1, $slocnob1);
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
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
						$stmt_wh->bind_param("s", $whname);
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
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisi", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty, $slocnob, $slocqty, $slocnob);
						$result60 = $stmt60->execute();
						if($result60){$flg=1;}  
						$stmt60->close();
					}
					
					if($slocqty1>0)
					{
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ?");
						$stmt_wh->bind_param("s", $whname1);
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
						
						$stmt60 = $this->conn_ps->prepare("Insert into tblarr_sloc_unld (arr_tr_id, arr_id, arr_type, lotcrop, lotvariety, whid, binid, subbin, qty, bags, balqty, balbags) Values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt60->bind_param("iisssiiisisi", $arrival_id, $arrsub_id, $trtype, $lotcrop, $lotvariety, $whid, $binid, $subbinid, $slocqty1, $slocnob1, $slocqty1, $slocnob1);
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
			
			$sqlcode=$this->conn_ps->prepare("SELECT MAX(arrival_code) FROM tblarrival where yearcode='".$yearcode."' and arrival_type='Fresh Seed with PDN' ORDER BY arrival_code DESC");
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
			
			$sqlcode1=$this->conn_ps->prepare("SELECT MAX(arr_code) FROM tblarrival where yearcode='".$yearcode."' and arrival_type='Fresh Seed with PDN' ORDER BY arr_code DESC");
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
			
			
			$stmt_arrimain = $this->conn_ps->prepare("insert into tblarrival (yearcode, arrival_type, arrival_code, arr_code, arrival_date, dcno, dc_date, disp_date, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, remarks, arr_role, arrtrflag)values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
			$stmt_arrimain->bind_param("ssiisssssssssssi", $yearcode, $arrival_type, $scode, $scode1, $arrival_date, $dcno, $dc_date, $disp_date, $tmode, $trans_name, $trans_lorryrepno, $trans_vehno, $trans_paymode, $trnremarks, $arr_role, $arrtrflag);
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
																
						
						$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='$crop'") or die(mysqli_error($link));
						$row_crop=mysqli_fetch_array($sql_crop);
						$classid=$row_crop['cropid'];
				
						if($variety!="" && $variety!=$vrnew)
						{
							$sql_veriety=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
							$row_variety=mysqli_fetch_array($sql_veriety);
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
						
						$stmt_arrsub = $this->conn_ps->prepare("insert into tblarrival_sub (arrival_id, organiser, pdnno, pdndate, spcodef, spcodem, lotcrop, lotvariety, ploc, pper, farmer, plotno, gi, harvestdate, got, qty, act, diff, qty1, act1, diff1, moisture, vchk, qc, remarks, sstage, sstatus, lotno, old, got1, sample, qcsample, orlot, gssample, prodtype, lotstate, leduration, leupto, ncode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_arrsub->bind_param("isssssssssssisssssiiissssssssssssissisi", $artrid, $organiser, $pdnno, $pdndate, $spcodef, $spcodem, $lotcrop, $lotvariety, $ploc, $pper, $farmer, $plotno, $gi, $harvestdate, $got, $qty, $act, $diff, $qty1, $act1, $diff1, $moisture, $vchk, $qc, $remarks, $sstage, $sstatus, $lotno, $old, $got1, $sample, $qcsample, $orlot, $gssample, $prodtype, $lotstate, $leduration, $leupto, $ncode);
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
							
									$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety)  Values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
									$stmt_arrsubsub->bind_param("siiiiiisisiss", $arr_type, $artrid, $arsubtrid, $whid, $binid, $subbin, $rowid, $qty, $bags, $balqty, $balbags, $lotcrop, $lotvariety);
									$result_arrsubsub = $stmt_arrsubsub->execute();
									if($result_arrsubsub)
									{  
										
																				
										$zero=0; $zero1=0.000; $gemp=0; if($gssample==NULL || $gssample=='')$gssample=0;
										
										$stmt_lotldg = $this->conn_ps->prepare("insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, lotldg_got1, lotldg_sstatus, orlot, lotldg_gs, lotldg_got, leduration, leupto) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?,?,?,?,?,?,?,?,?,?,?,?) ");
										$stmt_lotldg->bind_param("sssisssiiiisisisssisssssisis", $yearcode, $lotno, $trtype, $artrid, $arrival_date, $classid, $itemid, $whid, $binid, $subbin, $zero, $zero1, $bags, $qty, $balbags, $balqty, $stage, $moisture, $gemp, $vchk, $qc, $got, $sstatus, $orlot, $gssample, $got1, $leduration, $leupto);
										$result_lotldg = $stmt_lotldg->execute();
						
										if($result_lotldg){$flg=0;}  
										$stmt_lotldg->close();
										
										$stmt_arrsubsub->close();
									}
									
								}
								$stmt_arsubsub->close();
							}
							
							
								$sqlisstbl=$this->conn_ps->prepare("select le_lotno from tbl_lemain where le_lotno = ?"); 
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
								
								$sql_code1=$this->conn_ps->prepare("SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearcode."' ORDER BY tid DESC");
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
									$sql_sub_sub1244=$this->conn_ps->prepare("insert into tbl_qctest(pp, moist, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid,logid) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
									$sql_sub_sub1244->bind_param("ssssssssssssss", $vchk, $moisture, $lotno, $arrival_date, $classid, $itemid, $ncode1, $stage, $qc, $state,$one ,$orlot, $yearcode, $arr_role);
									$result_sql_sub_sub1244 = $sql_sub_sub1244->execute();
									$sql_sub_sub1244->close();
								}
								if($got1=="UT")
								{
									$sql_sub_sub1245=$this->conn_ps->prepare("insert into tbl_gottest(gottest_got, gottest_lotno, gottest_srdate, gottest_crop, gottest_variety, gottest_sampleno, gottest_trstage, gottest_oldlot, yearid, logid) values(?,?,?,?,?,?,?,?,?,?)");
									$sql_sub_sub1245->bind_param("ssssssssss", $got1, $lotno, $arrival_date, $classid, $itemid, $ncode1, $stage, $orlot, $yearcode, $arr_role);
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
					$netqty=$jdata['unloadingData'][$i]['actqty'];
					$trwt=$jdata['unloadingData'][$i]['tarewt'];
					$grosswt=$netqty+$trwt;
					array_push($lots,$exoldlot);
					
					$stmt_arsub = $this->conn_ps->prepare("SELECT arrsub_id, old FROM tblarrival_sub_unld WHERE arrival_id = ? and old = ?");
					$stmt_arsub->bind_param("is", $trid, $exoldlot);
					$result_arsub=$stmt_arsub->execute();
					$stmt_arsub->store_result();
					if ($stmt_arsub->num_rows == 0) 
					{
						$pcode='';
						$stmt_plant = $this->conn_ps->prepare("SELECT code  FROM tbl_parameters ");
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
						
						$stmt_arrsub = $this->conn_ps->prepare("insert into tblarrival_sub_unld (arrival_id, old, lotno, orlot)  Values(?,?,?,?) ");
						$stmt_arrsub->bind_param("iissss", $trid, $exoldlot, $lotno, $orlot, $netqty, $trwt);
						$result_arrsub = $stmt_arrsub->execute();
						$arrsub_id=$stmt_arrsub->insert_id();
						$stmt_arrsub->close();
						
						$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt)  Values(?,?,?,?,?,?) ");
						$stmt_arrsubsub->bind_param("iissss", $trid, $arrsub_id, $exoldlot, $grosswt, $netqty, $trwt);
						$result_arrsubsub = $stmt_arrsubsub->execute();
						$stmt_arrsubsub->close();
					}
					else
					{
						$stmt_arsub->bind_result($arrsub_id, $old);
						//looping through all the records
						$stmt_arsub->fetch();
						
						$stmt_arrsubsub = $this->conn_ps->prepare("insert into tblarrsub_sub_unld (arrival_id, arrsub_id, lotno, grosswt, netwt, tarewt)  Values(?,?,?,?,?,?) ");
						$stmt_arrsubsub->bind_param("iissss", $trid, $arrsub_id, $exoldlot, $grosswt, $netqty, $trwt);
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
			$newlots='';
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
			}
			$stmt60 = $this->conn_ps->prepare("Update tblarrival_unld SET arrtrnunldtype=? where arrival_id = ? ");
			$stmt60->bind_param("si", $unldtype, $arrival_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
			return true;
		}
		else
		{return false;}		
	}	
	
	
	
	
	
}// Main Class close
?>
