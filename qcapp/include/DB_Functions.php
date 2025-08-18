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
		$stmtm = $this->conn_ps->prepare("SELECT * FROM tbluser WHERE loginid = ? and logtype!='Web'");
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

	public function GetSampleInfo($sampleno,$email) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid ASC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($trstage==NULL){$trstage=0;} if($state==NULL){$state='';} if($spdate==NULL){$spdate='';}  if($sampcldate==NULL){$sampcldate='';}  if($sampclrole==NULL){$sampclrole='';} 
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
				$sampflg=1;
			}
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			$stmt_user = $this->conn_ps->prepare("SELECT scode, plantcode FROM tbluser WHERE loginid = ? ");
			$stmt_user->bind_param("s", $email);
			$result_user=$stmt_user->execute();
			$stmt_user->store_result();
			if ($stmt_user->num_rows > 0) {
				$stmt_user->bind_result($scode,$plantcode);
				//looping through all the records 
				$stmt_user->fetch();
				$stmt_user->close();
			}
			
			$stmt_year = $this->conn_ps->prepare("SELECT ycode, baryrcode FROM tblyears WHERE years_flg = 1 ");
			//$stmt_year->bind_param("s", $email);
			$result_year=$stmt_year->execute();
			$stmt_year->store_result();
			if ($stmt_year->num_rows > 0) {
				$stmt_year->bind_result($ycode,$baryrcode);
				//looping through all the records 
				$stmt_year->fetch();
				$stmt_year->close();
			}
			
			$srf_id=0; $srfno=''; $srfseries='old';
			$stmt_srfm = $this->conn_ps->prepare("SELECT MAX(srf_id) FROM tbl_qcsrf WHERE srf_logid = ? ");
			$stmt_srfm->bind_param("s", $scode);
			$result_srfm=$stmt_srfm->execute();
			$stmt_srfm->store_result();
			if ($stmt_srfm->num_rows > 0) {
				$stmt_srfm->bind_result($srf_id);
				$stmt_srfm->fetch();

				$stmt_srfm->close();
			}
			if($srf_id==""){$srf_id=0;}
//return "srf id ".$srf_id;
			if($srf_id>0)
			{
				$stmt_srfm1 = $this->conn_ps->prepare("SELECT srf_srfno FROM tbl_qcsrf WHERE srf_id = ? ");
				$stmt_srfm1->bind_param("s", $srf_id);
				$result_srfm1=$stmt_srfm1->execute();
				$stmt_srfm1->store_result();
				if ($stmt_srfm1->num_rows > 0) {
					$stmt_srfm1->bind_result($srf_srfno);
					//looping through all the records 
					$stmt_srfm1->fetch();
					$stmt_srfm1->close();
				}

				$totcnt=0; $srf_tcode=0;
				$stmt_srfm2 = $this->conn_ps->prepare("SELECT srf_tcode FROM tbl_qcsrf WHERE srf_srfno = ? ");
				$stmt_srfm2->bind_param("s", $srf_srfno);
				$result_srfm2=$stmt_srfm2->execute();
				$stmt_srfm2->store_result();
				$totcnt=$stmt_srfm2->num_rows;
				if ($totcnt > 0) {
					$totcnt=$totcnt+1;
					$stmt_srfm2->bind_result($srf_tcode);
					//looping through all the records 
					$stmt_srfm2->fetch();
//return "srf no".$srf_tcode;
					$stmt_srfm2->close();
				}
				
				if($totcnt>20 || $totcnt==0)
				{
					$stmt_srfm2 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf WHERE srf_logid = ? ");
					$stmt_srfm2->bind_param("s", $scode);
					$result_srfm2=$stmt_srfm2->execute();
					$stmt_srfm2->store_result();
					$totcnt=$stmt_srfm2->num_rows;
					if ($stmt_srfm2->num_rows > 0) {
						
						$stmt_srfm2->bind_result($srf_tcode);
						//looping through all the records 
						$stmt_srfm2->fetch();
						$srf_tcode=$srf_tcode+1;
						$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
						$srfseries='new';
						//$stmt_srfm2->fetch();
						$stmt_srfm2->close();
					}
					else
					{
						$stmt_srfm23 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf  ");
						//$stmt_srfm23->bind_param("s", $scode);
						$result_srfm23=$stmt_srfm23->execute();
						$stmt_srfm23->store_result();
						//$totcnt=$stmt_srfm23->num_rows;
						if ($stmt_srfm23->num_rows > 0) {
							$stmt_srfm23->bind_result($srf_tcode);
							//looping through all the records 
							$stmt_srfm23->fetch();
							//$srf_tcode=1;
							$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
							$srfseries='new';
						}
					}
				
				}
				else
				{
					$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
				}
				
			}
			else
			{
				$stmt_srfm23 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf  ");
				//$stmt_srfm23->bind_param("s", $scode);
				$result_srfm23=$stmt_srfm23->execute();
				$stmt_srfm23->store_result();
				//$totcnt=$stmt_srfm23->num_rows;
				if ($stmt_srfm23->num_rows > 0) {
					$stmt_srfm23->bind_result($srf_tcode);
					$stmt_srfm23->fetch();
					$srf_tcode=$srf_tcode+1;
//return "srf no ".$srf_tcode;
					$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
					$srfseries='new';
				}
				else
				{
					$srf_tcode=1;
//return "srf no2 ".$srf_tcode;
					$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
					$srfseries='new';
				}
			}
			
			$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2="";
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;
										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			//$userSR["arrival_id"] = $arrival_id;
			$userSR["srdate"] = $srdate;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			$userSR["sloc"] = $slocs;
			$userSR["qctest"] = $state;
			$userSR["sampleno"] = $sampleno;
			$userSR["spdate"] = $spdate;
			$userSR["sampflg"] = $sampflg;
			$userSR["sampcldate"] = $sampcldate;
			$userSR["sampclrole"] = $sampclrole;
			$userSR["srfseries"] = $srfseries;
			$userSR["srfno"] = $srfno;
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }



	public function GetSampleNewSRF($sampleno,$email) {
		$userSR = array(); $user24=array();
		$stmt_user = $this->conn_ps->prepare("SELECT scode, plantcode FROM tbluser WHERE loginid = ? ");
		$stmt_user->bind_param("s", $email);
		$result_user=$stmt_user->execute();
		$stmt_user->store_result();
		if ($stmt_user->num_rows > 0) {
			$stmt_user->bind_result($scode,$plantcode);
			//looping through all the records 
			$stmt_user->fetch();
			$stmt_user->close();
		}
		
		$stmt_year = $this->conn_ps->prepare("SELECT ycode, baryrcode FROM tblyears WHERE years_flg = 1 ");
		//$stmt_year->bind_param("s", $email);
		$result_year=$stmt_year->execute();
		$stmt_year->store_result();
		if ($stmt_year->num_rows > 0) {
			$stmt_year->bind_result($ycode,$baryrcode);
			//looping through all the records 
			$stmt_year->fetch();
			$stmt_year->close();
		}
		
		$srf_id=0; $srfno=''; $srfseries='new';
		$stmt_srfm2 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf ");
		//$stmt_srfm2->bind_param("s", $scode);
		$result_srfm2=$stmt_srfm2->execute();
		$stmt_srfm2->store_result();
		$totcnt=$stmt_srfm2->num_rows;
		if ($totcnt > 0) {
			
			$stmt_srfm2->bind_result($srf_tcode);
			//looping through all the records 
			$stmt_srfm2->fetch();
			$srf_tcode=$srf_tcode+1;
			$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
			$srfseries='new';
			
			$stmt_srfm2->close();
		}
		else
		{
			$srf_tcode=1;
			$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
			$srfseries='new';
		}
			
		$userSR["srfseries"] = $srfseries;
		$userSR["srfno"] = $srfno;

		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }






	public function GetSampleCollect($scode, $sampleno, $smpdate, $srfseries, $srfno, $email, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		$flg=0; 
        $stmt = $this->conn_ps->prepare("SELECT tid, lotno, oldlot  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid ASC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $lotno, $oldlot);
			while($stmt->fetch())
			{
				if($smpdate!='' && $smpdate!='00-00-0000' && $smpdate!=NULL)
				{
					$smpdate1=explode("-",$smpdate);
					$smpdate=$smpdate1[2]."-".$smpdate1[1]."-".$smpdate1[0];
				}
				//else {$smpdate='';}
				$dt=date("d-m-Y h:i:sa"); $one=1; $dt2=date("Y-m-d"); $qflg=0;
				if($smpdate!=''){
					
					$stmt_user = $this->conn_ps->prepare("SELECT scode, plantcode FROM tbluser WHERE loginid = ? ");
					$stmt_user->bind_param("s", $email);
					$result_user=$stmt_user->execute();
					$stmt_user->store_result();
					if ($stmt_user->num_rows > 0) {
						$stmt_user->bind_result($scode,$plantcode);
						//looping through all the records 
						$stmt_user->fetch();
						$stmt_user->close();
					}
					
					$stmt_year = $this->conn_ps->prepare("SELECT ycode, baryrcode FROM tblyears WHERE years_flg = 1 ");
					//$stmt_year->bind_param("s", $email);
					$result_year=$stmt_year->execute();
					$stmt_year->store_result();
					if ($stmt_year->num_rows > 0) {
						$stmt_year->bind_result($ycode,$baryrcode);
						//looping through all the records 
						$stmt_year->fetch();
						$stmt_year->close();
					}
					//return $srfseries;
					if($srfseries=="old")
					{	
						$stmt_srfm23 = $this->conn_ps->prepare("SELECT srf_tcode FROM tbl_qcsrf WHERE srf_sampleno = ? ");
						$stmt_srfm23->bind_param("s", $sampleno);
						$result_srfm23=$stmt_srfm23->execute();
						$stmt_srfm23->store_result();
						//$totcnt=$stmt_srfm2->num_rows;
						if ($stmt_srfm23->num_rows == 0) {
						
							$stmt_srfm2 = $this->conn_ps->prepare("SELECT srf_tcode, srf_code FROM tbl_qcsrf WHERE srf_srfno = ?  ");
							$stmt_srfm2->bind_param("s", $srfno);
							$result_srfm2=$stmt_srfm2->execute();
							$stmt_srfm2->store_result();
							$totcnt=$stmt_srfm2->num_rows;
							if ($totcnt > 0) {
								//$totcnt=$totcnt+1;
								$stmt_srfm2->bind_result($srf_tcode, $srf_code);
								$stmt_srfm2->fetch();
								//$srf_tcode=$srf_tcode+1;
								//looping through all the records 
	//return "INSERT INTO tbl_qcsrf (srf_date, srf_tcode, srf_code, srf_srfno, srf_tid, srf_lotno, srf_orlot, srf_sampleno, srf_logid, srf_yrcode, srf_year) VALUES ('$dt2','$srf_tcode','$srf_code','$srfno','$tid','$lotno','$oldlot','$sampleno','$scode','$ycode','$baryrcode') ";
								$stmt_srfm6 = $this->conn_ps->prepare("INSERT INTO tbl_qcsrf (srf_date, srf_tcode, srf_code, srf_srfno, srf_tid, srf_lotno, srf_orlot, srf_sampleno, srf_logid, srf_yrcode, srf_year) VALUES (?,?,?,?,?,?,?,?,?,?,?) ");
								$stmt_srfm6->bind_param("siisissssss", $dt2,$srf_tcode,$srf_code,$srfno,$tid,$lotno,$oldlot,$sampleno,$scode,$ycode,$baryrcode);
								if($result_srfm6=$stmt_srfm6->execute())
								{
									$qflg++;
								}
								$stmt_srfm6->close();
								
								
								$stmt_srfm2->close();
							}
						}
						$stmt_srfm23->close();
					}
					else
					{
						$stmt_srfm23 = $this->conn_ps->prepare("SELECT srf_tcode FROM tbl_qcsrf WHERE srf_sampleno = ? ");
						$stmt_srfm23->bind_param("s", $sampleno);
						$result_srfm23=$stmt_srfm23->execute();
						$stmt_srfm23->store_result();
						//$totcnt=$stmt_srfm2->num_rows;
						if ($stmt_srfm23->num_rows == 0) {
							$stmt_srfm2 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf ");
							//$stmt_srfm2->bind_param("s", $scode);
							$result_srfm2=$stmt_srfm2->execute();
							$stmt_srfm2->store_result();
							//$totcnt=$stmt_srfm2->num_rows;
							if ($stmt_srfm2->num_rows > 0) {
								$stmt_srfm2->bind_result($srf_tcode);
								$stmt_srfm2->fetch();
								//looping through all the records 
								$srf_tcode=$srf_tcode+1;
								$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
								//$srfseries='new';
								$stmt_srfm2->close();
							
								$stmt_srfm6 = $this->conn_ps->prepare("INSERT INTO tbl_qcsrf (srf_date, srf_tcode, srf_code, srf_srfno, srf_tid, srf_lotno, srf_orlot, srf_sampleno, srf_logid, srf_yrcode, srf_year) VALUES (?,?,?,?,?,?,?,?,?,?,?) ");
								$stmt_srfm6->bind_param("siisissssss", $dt2,$srf_tcode,$srf_tcode,$srfno,$tid,$lotno,$oldlot,$sampleno,$scode,$ycode,$baryrcode);
								if($result_srfm6=$stmt_srfm6->execute())
								{
									$qflg++;
								}
								//return $stmt_srfm6->insert_id;
								$stmt_srfm6->close();
							}
							
							$stmt_srfm23->close();
						}
						else
						{
							$stmt_srfm23 = $this->conn_ps->prepare("SELECT srf_tcode FROM tbl_qcsrf WHERE srf_sampleno = ? ");
							$stmt_srfm23->bind_param("s", $sampleno);
							$result_srfm23=$stmt_srfm23->execute();
							$stmt_srfm23->store_result();
							//$totcnt=$stmt_srfm2->num_rows;
							if ($stmt_srfm23->num_rows == 0) {
														
								$stmt_srfm2 = $this->conn_ps->prepare("SELECT Max(srf_tcode) FROM tbl_qcsrf ");
								//$stmt_srfm2->bind_param("s", $scode);
								$result_srfm2=$stmt_srfm2->execute();
								$stmt_srfm2->store_result();
								//$totcnt=$stmt_srfm2->num_rows;
								if ($stmt_srfm2->num_rows > 0) {
									$stmt_srfm2->bind_result($srf_tcode);
									$stmt_srfm2->fetch();
									//looping through all the records 
									$srf_tcode=$srf_tcode+1;
									$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
									//$srfseries='new';
									$stmt_srfm2->close();
								
									$stmt_srfm6 = $this->conn_ps->prepare("INSERT INTO tbl_qcsrf (srf_date, srf_tcode, srf_code, srf_srfno, srf_tid, srf_lotno, srf_orlot, srf_sampleno, srf_logid, srf_yrcode, srf_year) VALUES (?,?,?,?,?,?,?,?,?,?,?) ");
									$stmt_srfm6->bind_param("siisissssss", $dt2,$srf_tcode,$srf_tcode,$srfno,$tid,$lotno,$oldlot,$sampleno,$scode,$ycode,$baryrcode);
									if($result_srfm6=$stmt_srfm6->execute())
									{
										$qflg++;
									}
									//return $stmt_srfm6->insert_id;
									$stmt_srfm6->close();
								}
							}
							$stmt_srfm23->close();
						}
					}
					//return "submitted";
					if($qflg>0)
					{
						$stmt_crop = $this->conn_ps->prepare("UPDATE tbl_qctest SET spdate=?, sampcldate=?, sampclrole=?, bflg=?, cflg=?, qcrefno=?, oprid=? WHERE sampleno=? and yearid=? and plantcode=?");
						$stmt_crop->bind_param("sssiisisss", $smpdate, $dt, $scode, $one, $one, $srfno, $oprid, $sampno, $yearid, $plantid);
						$result_crop=$stmt_crop->execute();
						if($result_crop)
						{
							$flg=1;
							$stmt_got = $this->conn_ps->prepare("UPDATE tbl_gottest SET gottest_spdate=?, gottest_bflg=?, oprid=? WHERE gottest_sampleno=? and yearid=? and plantcode=? ");
							$stmt_got->bind_param("siisss", $smpdate, $one, $oprid, $sampno, $yearid, $plantid);
							$result_got=$stmt_got->execute();
							$stmt_got->close();
						}
						$stmt_crop->close();
					}
				}
			}
		}
		if($flg==0)
		{return false;}
		else
		{return $srfno;}
    }

	public function GetSampleMoistInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? and spdate IS NOT NULL and spdate!='0000-00-00' ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($trstage==NULL){$trstage=0;} if($state==NULL){$state='';} if($spdate==NULL){$spdate='';}  if($sampcldate==NULL){$sampcldate='';}  if($sampclrole==NULL){$sampclrole='';} 
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
				$sampflg=1;
			}
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			
			
			$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2="";
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;
										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										/*$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	*/
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										/*$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	*/
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			$srfno='';
			$stmt_srfm1 = $this->conn_ps->prepare("SELECT srf_srfno FROM tbl_qcsrf WHERE srf_sampleno = ? ");
			$stmt_srfm1->bind_param("s", $sampleno);
			$result_srfm1=$stmt_srfm1->execute();
			$stmt_srfm1->store_result();
			if ($stmt_srfm1->num_rows > 0) {
				$stmt_srfm1->bind_result($srfno);
				//looping through all the records 
				$stmt_srfm1->fetch();
				$stmt_srfm1->close();
			}
			
			$qcm_m1rep1=0; $qcm_m1rep2=0; $qcm_m1rep3=0; $qcm_m1rep4=0; $qcm_m2rep1=0; $qcm_m2rep2=0; $qcm_m2rep3=0; $qcm_m2rep4=0; $qcm_m3rep1=0; $qcm_m3rep2=0; $qcm_m3rep3=0; $qcm_m3rep4=0; $qcm_rep1moistper=0; $qcm_rep2moistper=0; $qcm_rep3moistper=0; $qcm_rep4moistper=0; $qcm_haommoistper=0; $qcm_haomflg=0; $qcm_mmrep1=0; $qcm_mmrep2=0; $qcm_mmrep3=0; $qcm_mmrmoistper=0; $qcm_mmrflg=0; $qcm_moistflg=0;
			$stmt_samp = $this->conn_ps->prepare("SELECT qcm_m1rep1, qcm_m1rep2, qcm_m1rep3, qcm_m1rep4, qcm_m2rep1, qcm_m2rep2, qcm_m2rep3, qcm_m2rep4, qcm_m3rep1, qcm_m3rep2, qcm_m3rep3, qcm_m3rep4, qcm_rep1moistper, qcm_rep2moistper, qcm_rep3moistper, qcm_rep4moistper, qcm_haommoistper, qcm_haomflg, qcm_mmrep1, qcm_mmrep2, qcm_mmrep3, qcm_mmrmoistper, qcm_mmrflg, qcm_moistflg FROM tbl_qcmdata WHERE qcm_moistflg!=1 and qcm_sampno = ? ");
			$stmt_samp->bind_param("s", $sampleno);
			$result_samp=$stmt_samp->execute();
			$stmt_samp->store_result();
			if ($stmt_samp->num_rows > 0) {
				$stmt_samp->bind_result($qcm_m1rep1, $qcm_m1rep2, $qcm_m1rep3, $qcm_m1rep4, $qcm_m2rep1, $qcm_m2rep2, $qcm_m2rep3, $qcm_m2rep4, $qcm_m3rep1, $qcm_m3rep2, $qcm_m3rep3, $qcm_m3rep4, $qcm_rep1moistper, $qcm_rep2moistper, $qcm_rep3moistper, $qcm_rep4moistper, $qcm_haommoistper, $qcm_haomflg, $qcm_mmrep1, $qcm_mmrep2, $qcm_mmrep3, $qcm_mmrmoistper, $qcm_mmrflg, $qcm_moistflg);
				//looping through all the records 
				$stmt_samp->fetch();
				$stmt_samp->close();
			}
			
			//$userSR["arrival_id"] = $arrival_id;
			//$userSR["srdate"] = $srdate;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			/*$userSR["sloc"] = $slocs;
			$userSR["qctest"] = $state;*/
			$userSR["sampleno"] = $sampleno;
			/*$userSR["spdate"] = $spdate;
			$userSR["sampflg"] = $sampflg;
			$userSR["sampcldate"] = $sampcldate;
			$userSR["sampclrole"] = $sampclrole;*/
			
			$userSR["qcm_m1rep1"] = $qcm_m1rep1;
			$userSR["qcm_m1rep2"] = $qcm_m1rep2;
			$userSR["qcm_m1rep3"] = $qcm_m1rep3;
			$userSR["qcm_m1rep4"] = $qcm_m1rep4;
			$userSR["qcm_m2rep1"] = $qcm_m2rep1;
			$userSR["qcm_m2rep2"] = $qcm_m2rep2;
			$userSR["qcm_m2rep3"] = $qcm_m2rep3;
			$userSR["qcm_m2rep4"] = $qcm_m2rep4;
			$userSR["qcm_m3rep1"] = $qcm_m3rep1;
			$userSR["qcm_m3rep2"] = $qcm_m3rep2;
			$userSR["qcm_m3rep3"] = $qcm_m3rep3;
			$userSR["qcm_m3rep4"] = $qcm_m3rep4;
			$userSR["qcm_rep1moistper"] = $qcm_rep1moistper;
			$userSR["qcm_rep2moistper"] = $qcm_rep2moistper;
			$userSR["qcm_rep3moistper"] = $qcm_rep3moistper;
			$userSR["qcm_rep4moistper"] = $qcm_rep4moistper;
			$userSR["qcm_haommoistper"] = $qcm_haommoistper;
			$userSR["qcm_haomflg"] = $qcm_haomflg;
			$userSR["qcm_mmrep1"] = $qcm_mmrep1;
			$userSR["qcm_mmrep2"] = $qcm_mmrep2;
			$userSR["qcm_mmrep3"] = $qcm_mmrep3;
			$userSR["qcm_mmrmoistper"] = $qcm_mmrmoistper;
			$userSR["qcm_mmrflg"] = $qcm_mmrflg;
			$userSR["qcm_moistflg"] = $qcm_moistflg;
			$userSR["srfno"] = $srfno;
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	public function GetSampleMoistUpdate($sampleno,$hmtype, $m1rep1, $m1rep2, $m1rep3, $m1rep4, $m2rep1,$m2rep2, $m2rep3, $m2rep4, $m3rep1, $m3rep2, $m3rep3, $m3rep4, $rep1moistper, $rep2moistper, $rep3moistper, $rep4moistper, $haommoistper, $mmrep1, $mmrep2, $mmrep3, $mmrmoistper, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			
			if($hmtype=="m1" || $hmtype=="M1")
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT qcm_sampno FROM tbl_qcmdata WHERE qcm_moistflg!=1 and qcm_sampno = ? ");
				$stmtsamp->bind_param("s", $sampleno);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				if ($stmtsamp->num_rows > 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m1rep1=?, qcm_m1rep2=?, qcm_m1rep3=?, qcm_m1rep4=?, qcm_m1replogid=?, qcm_m1repdt=?, qcm_haomflg=?  WHERE qcm_sampno = ? ");
					$stmt_samp->bind_param("ssssssis", $m1rep1,$m1rep2,$m1rep3,$m1rep4,$scode,$dt,$two,$sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				else
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcmdata (qcm_sampno, qcm_m1rep1, qcm_m1rep2, qcm_m1rep3, qcm_m1rep4, qcm_m1replogid, qcm_m1repdt, qcm_haomflg) values(?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("sssssssi", $sampleno,$m1rep1,$m1rep2,$m1rep3,$m1rep4,$scode,$dt,$two);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			else if($hmtype=="m2" || $hmtype=="M2")
			{
				$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m2rep1=?, qcm_m2rep2=?, qcm_m2rep3=?, qcm_m2rep4=?, qcm_m2replogid=?, qcm_m2repdt=?, qcm_haomflg=? WHERE qcm_sampno = ? ");
				$stmt_samp->bind_param("ssssssis", $m2rep1,$m2rep2,$m2rep3,$m2rep4,$scode,$dt,$two,$sampleno);
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			else if($hmtype=="m3" || $hmtype=="M3")
			{
				$divval=2;
				$totrepval=$rep1moistper+$rep2moistper;
				if($rep3moistper>0){$totrepval=$totrepval+$rep3moistper; $divval=3;}
				if($rep4moistper>0){$totrepval=$totrepval+$rep4moistper; $divval=4;}
				
				$haommoistper=round(($totrepval/$divval),1);
				
				$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m3rep1=?, qcm_m3rep2=?, qcm_m3rep3=?, qcm_m3rep4=?, qcm_rep1moistper=?, qcm_rep2moistper=?, qcm_rep3moistper=?, qcm_rep4moistper=?, qcm_haommoistper=?, qcm_m3replogid=?, qcm_m3repdt=?, qcm_haomflg=?  WHERE qcm_sampno = ? ");
				$stmt_samp->bind_param("sssssssssssss", $m3rep1, $m3rep2, $m3rep3, $m3rep4, $rep1moistper, $rep2moistper, $rep3moistper, $rep4moistper, $haommoistper, $scode, $dt, $one, $sampleno);
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			else if($hmtype=="mm" || $hmtype=="MM" || $hmtype=="Mm" || $hmtype=="mM")
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT qcm_sampno FROM tbl_qcmdata WHERE qcm_moistflg!=1 and qcm_sampno = ? ");
				$stmtsamp->bind_param("s", $sampleno);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				$two=2;
				if ($stmtsamp->num_rows > 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_mmrep1=?, qcm_mmrep2=?, qcm_mmrep3=?, qcm_mmrmoistper=?, qcm_mmreplogid=?, qcm_mmrepdt=?, qcm_mmrflg=?  WHERE qcm_sampno = ? ");
					$stmt_samp->bind_param("ssssssis", $mmrep1, $mmrep2, $mmrep3, $mmrmoistper, $scode, $dt, $two, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				else
				{
					//return "Insert into tbl_qcmdata (qcm_mmrep1, qcm_mmrep2, qcm_mmrep3, qcm_mmrmoistper, qcm_mmreplogid, qcm_mmrepdt, qcm_mmrflg, qcm_sampno) values('$mmrep1','$mmrep2','$mmrep3','$mmrmoistper','$scode','$dt','$two','$sampleno')";
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcmdata (qcm_mmrep1, qcm_mmrep2, qcm_mmrep3, qcm_mmrmoistper, qcm_mmreplogid, qcm_mmrepdt, qcm_mmrflg, qcm_sampno) values(?,?,?,?,?,?,?,?)");
					$stmt_samp->bind_param("ssssssis", $mmrep1, $mmrep2, $mmrep3, $mmrmoistper, $scode, $dt, $two, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			else
			{
				$flg=0;
			}
			
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	
	public function GetSampleMoisFinalSubmit($sampleno, $scode, $new_retImageString_ret, $type, $remarks, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		$flg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid);
			while($stmt->fetch())
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT qcm_sampno, qcm_haommoistper, qcm_mmrmoistper, qcm_haomflg, qcm_mmrflg FROM tbl_qcmdata WHERE qcm_moistflg!=1 and qcm_sampno = ? ");
				$stmtsamp->bind_param("s", $sampleno);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				if ($stmtsamp->num_rows > 0) 
				{
					$stmtsamp->bind_result($qcm_sampno, $qcm_haommoistper, $qcm_mmrmoistper, $qcm_haomflg, $qcm_mmrflg);
					$stmtsamp->close();	
					$dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $haoflg=0; $mmrflg=0;
					if($qcm_haommoistper>0){$haoflg=1;}else {$haoflg=$qcm_haomflg;}
					if($qcm_mmrmoistper>0){$mmrflg=1;}else {$mmrflg=$qcm_mmrflg;}
					if($type=="MM")
					{
						$stmt_crop = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_haomflg=?, qcm_mmrflg=?, qcm_moistflg=?, qcm_moistphoto=?, qcm_mmremarks=? , qcm_mmoprid=? WHERE qcm_sampno = ? ");
					}
					else
					{
						$stmt_crop = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_haomflg=?, qcm_mmrflg=?, qcm_moistflg=?, qcm_hmoistphoto=?, qcm_hmremarks=? , qcm_haomoprid=? WHERE qcm_sampno = ? ");
					}
					$stmt_crop->bind_param("iiissis", $haoflg, $mmrflg, $two, $new_retImageString_ret, $remarks, $oprid, $sampleno);
					$result_crop=$stmt_crop->execute();
					if($result_crop)
					{
						$flg=1;
					}
					$stmt_crop->close();
				}
			}
		}
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	public function GetSamplePPInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole=''; $srfno='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($trstage==NULL){$trstage=0;} if($state==NULL){$state='';} if($spdate==NULL){$spdate='';}  if($sampcldate==NULL){$sampcldate='';}  if($sampclrole==NULL){$sampclrole='';} 
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
				$sampflg=1;
			}
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			$stmt_srfm1 = $this->conn_ps->prepare("SELECT srf_srfno FROM tbl_qcsrf WHERE srf_sampleno = ? ");
			$stmt_srfm1->bind_param("s", $sampleno);
			$result_srfm1=$stmt_srfm1->execute();
			$stmt_srfm1->store_result();
			if ($stmt_srfm1->num_rows > 0) {
				$stmt_srfm1->bind_result($srfno);
				//looping through all the records 
				$stmt_srfm1->fetch();
				$stmt_srfm1->close();
			}
			
			$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2="";
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;
										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
										$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
										$stmt_wh->bind_param("i", $lotldg_whid);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										$stmt_wh->bind_result($perticulars);
										$stmt_wh->fetch();
										$wareh=$perticulars."/";
										$stmt_wh->close();
										
										$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
										$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
										$result_bn=$stmt_bn->execute();
										$stmt_bn->store_result();
										$stmt_bn->bind_result($binname);
										$stmt_bn->fetch();
										$binn=$binname."/";
										$stmt_bn->close();
										
										$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
										$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
										$result_sbn=$stmt_sbn->execute();
										$stmt_sbn->store_result();
										$stmt_sbn->bind_result($sname);
										$stmt_sbn->fetch();
										$subbinn=$sname;
										$stmt_sbn->close();
										
										if($slocs!="")
										$slocs=$slocs.",".$wareh.$binn.$subbinn;
										else
										$slocs=$wareh.$binn.$subbinn;	
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			$qcp_samplewt=''; $qcp_pureseed=''; $qcp_pureseedper=''; $qcp_imseed=''; $qcp_imseedper=''; $qcp_lightseed=''; $qcp_lightseedper=''; $qcp_ocseedno=''; $qcp_ocseedinkg=''; $qcp_odvseedno=''; $qcp_odvseedinkg=''; $qcp_dcseed=''; $qcp_dcseedper=''; $qcp_phseedno=''; $qcp_phseedinkg=''; $qcp_ppresult=''; $qcp_ppdatadt=''; $qcp_ppphoto=''; $qcp_ppdataflg=0;  $qcp_gstotnosmp=''; $qcp_gsnoperkg=''; $qcp_gswtgms=''; $qcp_gsper=''; $qcp_ocwt=''; $qcp_ocper=''; $qcp_ocremark=''; $qcp_odvwt=''; $qcp_odvper=''; $qcp_odv1010=''; $qcp_odvfgrain=''; $qcp_odvbgrain=''; $qcp_odvlonggrain=''; $qcp_odvothertype=''; $qcp_odvtotal=''; $qcp_odvtotalper=''; $qcp_odvremark=''; $qcp_phwt=''; $qcp_phper=''; $qcp_phremark=''; $qcp_gsremark=''; 
			
			$stmt_pp = $this->conn_ps->prepare("SELECT qcp_sampleno, qcp_samplewt, qcp_pureseed, qcp_pureseedper, qcp_imseed, qcp_imseedper, qcp_lightseed, qcp_lightseedper, qcp_ocseedno, qcp_ocseedinkg, qcp_odvseedno, qcp_odvseedinkg, qcp_dcseed, qcp_dcseedper, qcp_phseedno, qcp_phseedinkg, qcp_ppresult, qcp_ppdatadt, qcp_ppphoto, qcp_ppdataflg, qcp_gstotnosmp, qcp_gsnoperkg, qcp_gswtgms, qcp_gsper, qcp_ocwt, qcp_ocper, qcp_ocremark, qcp_odvwt, qcp_odvper, qcp_odv1010, qcp_odvfgrain, qcp_odvbgrain, qcp_odvlonggrain, qcp_odvothertype, qcp_odvtotal, qcp_odvtotalper, qcp_odvremark, qcp_phwt, qcp_phper, qcp_phremark, qcp_gsremark FROM tbl_qcpdata WHERE qcp_sampleno = ? ");
			$stmt_pp->bind_param("s", $sampleno);
			$result_pp=$stmt_pp->execute();
			$stmt_pp->store_result();
			if ($stmt_pp->num_rows == 0) {
				//$userSR["arrival_id"] = $arrival_id;
				$userSR["srdate"] = $srdate;
				$userSR["crop"] = $cropname;
				$userSR["variety"] = $popularname;
				$userSR["lotno"] = $lotno;
				$userSR["trstage"] = $trstage;
				$userSR["nob"] = $nob;
				$userSR["qty"] = $qty;
				$userSR["sloc"] = $slocs;
				$userSR["qctest"] = $state;
				$userSR["sampleno"] = $sampleno;
				$userSR["spdate"] = $spdate;
				$userSR["sampflg"] = $sampflg;
				$userSR["sampcldate"] = $sampcldate;
				$userSR["sampclrole"] = $sampclrole;
				
				$userSR["qcp_samplewt"] = $qcp_samplewt;
				$userSR["qcp_pureseed"] = $qcp_pureseed;
				$userSR["qcp_pureseedper"] = $qcp_pureseedper;
				$userSR["qcp_imseed"] = $qcp_imseed;
				$userSR["qcp_imseedper"] = $qcp_imseedper;
				$userSR["qcp_lightseed"] = $qcp_lightseed;
				$userSR["qcp_lightseedper"] = $qcp_lightseedper;
				$userSR["qcp_ocseedno"] = $qcp_ocseedno;
				$userSR["qcp_ocseedinkg"] = $qcp_ocseedinkg;
				$userSR["qcp_odvseedno"] = $qcp_odvseedno;
				$userSR["qcp_odvseedinkg"] = $qcp_odvseedinkg;
				$userSR["qcp_dcseed"] = $qcp_dcseed;
				$userSR["qcp_dcseedper"] = $qcp_dcseedper;
				$userSR["qcp_phseedno"] = $qcp_phseedno;
				$userSR["qcp_phseedinkg"] = $qcp_phseedinkg;
				$userSR["qcp_ppresult"] = $qcp_ppresult;
				$userSR["qcp_ppdatadt"] = $qcp_ppdatadt;
				$userSR["qcp_ppphoto"] = $qcp_ppphoto;
				$userSR["qcp_ppdataflg"] = $qcp_ppdataflg;
				
				$userSR["qcp_gstotnosmp"] = $qcp_gstotnosmp;
				$userSR["qcp_gsnoperkg"] = $qcp_gsnoperkg;
				$userSR["qcp_gswtgms"] = $qcp_gswtgms;
				$userSR["qcp_gsper"] = $qcp_gsper;
				$userSR["qcp_gsremark"] = $qcp_gsremark;
				$userSR["qcp_ocwt"] = $qcp_ocwt;
				$userSR["qcp_ocper"] = $qcp_ocper;
				$userSR["qcp_ocremark"] = $qcp_ocremark;
				$userSR["qcp_odvwt"] = $qcp_odvwt;
				$userSR["qcp_odvper"] = $qcp_odvper;
				$userSR["qcp_odv1010"] = $qcp_odv1010;
				$userSR["qcp_odvfgrain"] = $qcp_odvfgrain;
				$userSR["qcp_odvbgrain"] = $qcp_odvbgrain;
				$userSR["qcp_odvlonggrain"] = $qcp_odvlonggrain;
				$userSR["qcp_odvothertype"] = $qcp_odvothertype;
				$userSR["qcp_odvtotal"] = $qcp_odvtotal;
				$userSR["qcp_odvtotalper"] = $qcp_odvtotalper;
				$userSR["qcp_odvremark"] = $qcp_odvremark;
				$userSR["qcp_phwt"] = $qcp_phwt;
				$userSR["qcp_phper"] = $qcp_phper;
				$userSR["qcp_phremark"] = $qcp_phremark;
				$userSR["srfno"] = $srfno;
				
				
				array_push($user24,$userSR);
			} else {
				$stmt_pp->bind_result($qcp_sampleno, $qcp_samplewt, $qcp_pureseed, $qcp_pureseedper, $qcp_imseed, $qcp_imseedper, $qcp_lightseed, $qcp_lightseedper, $qcp_ocseedno, $qcp_ocseedinkg, $qcp_odvseedno, $qcp_odvseedinkg, $qcp_dcseed, $qcp_dcseedper, $qcp_phseedno, $qcp_phseedinkg, $qcp_ppresult, $qcp_ppdatadt, $qcp_ppphoto, $qcp_ppdataflg, $qcp_gstotnosmp, $qcp_gsnoperkg, $qcp_gswtgms, $qcp_gsper, $qcp_ocwt, $qcp_ocper, $qcp_ocremark, $qcp_odvwt, $qcp_odvper, $qcp_odv1010, $qcp_odvfgrain, $qcp_odvbgrain, $qcp_odvlonggrain, $qcp_odvothertype, $qcp_odvtotal, $qcp_odvtotalper, $qcp_odvremark, $qcp_phwt, $qcp_phper, $qcp_phremark, $qcp_gsremark);
				$stmt_pp->fetch();
				
				$userSR["srdate"] = $srdate;
				$userSR["crop"] = $cropname;
				$userSR["variety"] = $popularname;
				$userSR["lotno"] = $lotno;
				$userSR["trstage"] = $trstage;
				$userSR["nob"] = $nob;
				$userSR["qty"] = $qty;
				$userSR["sloc"] = $slocs;
				$userSR["qctest"] = $state;
				$userSR["sampleno"] = $sampleno;
				$userSR["spdate"] = $spdate;
				$userSR["sampflg"] = $sampflg;
				$userSR["sampcldate"] = $sampcldate;
				$userSR["sampclrole"] = $sampclrole;
				
				$userSR["qcp_samplewt"] = $qcp_samplewt;
				$userSR["qcp_pureseed"] = $qcp_pureseed;
				$userSR["qcp_pureseedper"] = $qcp_pureseedper;
				$userSR["qcp_imseed"] = $qcp_imseed;
				$userSR["qcp_imseedper"] = $qcp_imseedper;
				$userSR["qcp_lightseed"] = $qcp_lightseed;
				$userSR["qcp_lightseedper"] = $qcp_lightseedper;
				$userSR["qcp_ocseedno"] = $qcp_ocseedno;
				$userSR["qcp_ocseedinkg"] = $qcp_ocseedinkg;
				$userSR["qcp_odvseedno"] = $qcp_odvseedno;
				$userSR["qcp_odvseedinkg"] = $qcp_odvseedinkg;
				$userSR["qcp_dcseed"] = $qcp_dcseed;
				$userSR["qcp_dcseedper"] = $qcp_dcseedper;
				$userSR["qcp_phseedno"] = $qcp_phseedno;
				$userSR["qcp_phseedinkg"] = $qcp_phseedinkg;
				$userSR["qcp_ppresult"] = $qcp_ppresult;
				$userSR["qcp_ppdatadt"] = $qcp_ppdatadt;
				$userSR["qcp_ppphoto"] = $qcp_ppphoto;
				$userSR["qcp_ppdataflg"] = $qcp_ppdataflg;
				
				$userSR["qcp_gstotnosmp"] = $qcp_gstotnosmp;
				$userSR["qcp_gsnoperkg"] = $qcp_gsnoperkg;
				$userSR["qcp_gswtgms"] = $qcp_gswtgms;
				$userSR["qcp_gsper"] = $qcp_gsper;
				$userSR["qcp_gsremark"] = $qcp_gsremark;
				$userSR["qcp_ocwt"] = $qcp_ocwt;
				$userSR["qcp_ocper"] = $qcp_ocper;
				$userSR["qcp_ocremark"] = $qcp_ocremark;
				$userSR["qcp_odvwt"] = $qcp_odvwt;
				$userSR["qcp_odvper"] = $qcp_odvper;
				$userSR["qcp_odv1010"] = $qcp_odv1010;
				$userSR["qcp_odvfgrain"] = $qcp_odvfgrain;
				$userSR["qcp_odvbgrain"] = $qcp_odvbgrain;
				$userSR["qcp_odvlonggrain"] = $qcp_odvlonggrain;
				$userSR["qcp_odvothertype"] = $qcp_odvothertype;
				$userSR["qcp_odvtotal"] = $qcp_odvtotal;
				$userSR["qcp_odvtotalper"] = $qcp_odvtotalper;
				$userSR["qcp_odvremark"] = $qcp_odvremark;
				$userSR["qcp_phwt"] = $qcp_phwt;
				$userSR["qcp_phper"] = $qcp_phper;
				$userSR["qcp_phremark"] = $qcp_phremark;
				$userSR["srfno"] = $srfno;
			
				array_push($user24,$userSR);
			}
			$stmt_pp->close();
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	public function GetSamplePPUpdate($sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed, $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $ppphoto, $scode, $new_retImageString_ret, $gsseedno,$gsseedinkg,$gsseedwt,$gsseedper,$ocseedwt,$ocseedper,$ocremark,$odvseedwt,$odvseedper,$odvremark,$odv1010,$odvfinegrain,$odvboldgrain,$odvlonggrain,$odvothertype,$odvtotal,$odvtotalper,$phseedwt,$phseedper,$phremark,$gsremark, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT qcp_sampleno FROM tbl_qcpdata where qcp_sampleno=?");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows == 0) 
			{
				
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				
				if($cropname=="Paddy Seed") {$odvseedno=$odvtotal; $odvseedinkg=$gsseedinkg;}
				
				$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcpdata (qcp_sampleno, qcp_samplewt, qcp_pureseed, qcp_pureseedper, qcp_imseed, qcp_imseedper, qcp_lightseed, qcp_lightseedper, qcp_ocseedno, qcp_ocseedinkg, qcp_odvseedno, qcp_odvseedinkg, qcp_dcseed, qcp_dcseedper, qcp_phseedno, qcp_phseedinkg, qcp_pplogid, qcp_ppdatadt, qcp_ppphoto, qcp_ppdataflg, qcp_gstotnosmp, qcp_gsnoperkg, qcp_gswtgms, qcp_gsper, qcp_ocwt, qcp_ocper, qcp_ocremark, qcp_odvwt, qcp_odvper, qcp_odv1010, qcp_odvfgrain, qcp_odvbgrain, qcp_odvlonggrain, qcp_odvothertype, qcp_odvtotal, qcp_odvtotalper, qcp_odvremark, qcp_phwt, qcp_phper, qcp_phremark, qcp_gsremark, qcp_oprid) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_samp->bind_param("sssssssssssssssssssisssssssssssssssssssssi", $sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed,  $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $scode, $dt, $new_retImageString_ret, $two, $gsseedno,$gsseedinkg, $gsseedwt, $gsseedper, $ocseedwt, $ocseedper, $ocremark, $odvseedwt, $odvseedper, $odv1010, $odvfinegrain, $odvboldgrain, $odvlonggrain, $odvothertype, $odvtotal, $odvtotalper, $odvremark, $phseedwt, $phseedper, $phremark, $gsremark, $oprid);
				
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			$stmtsamp->close();	
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }


	public function GetSampleGempInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole, qcstatus  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? and spdate IS NOT NULL and spdate!='0000-00-00' ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole=''; $qcstatus='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole, $qcstatus);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($trstage==NULL){$trstage=0;} if($state==NULL){$state='';} if($spdate==NULL){$spdate='';}  if($sampcldate==NULL){$sampcldate='';}  if($sampclrole==NULL){$sampclrole='';} 
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
				$sampflg=1;
			}
			$cropname=''; $popularname=''; $seedsize=''; $nosior=0; $nosiorfgt=0;
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior, nosiorfgt FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior, $nosiorfgt);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			
			
			$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2="";
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;
										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			
			$srfno='';
			$stmt_srfm1 = $this->conn_ps->prepare("SELECT srf_srfno FROM tbl_qcsrf WHERE srf_sampleno = ? ");
			$stmt_srfm1->bind_param("s", $sampleno);
			$result_srfm1=$stmt_srfm1->execute();
			$stmt_srfm1->store_result();
			if ($stmt_srfm1->num_rows > 0) {
				$stmt_srfm1->bind_result($srfno);
				//looping through all the records 
				$stmt_srfm1->fetch();
				$stmt_srfm1->close();
			}
			
			if($qcstatus=="RT")
			{
				$stmt_srfm1 = $this->conn_ps->prepare("SELECT srf_srfno FROM tbl_qcsrf_rt WHERE srf_sampleno = ? ");
				$stmt_srfm1->bind_param("s", $sampleno);
				$result_srfm1=$stmt_srfm1->execute();
				$stmt_srfm1->store_result();
				if ($stmt_srfm1->num_rows > 0) {
					$stmt_srfm1->bind_result($srfno);
					//looping through all the records 
					$stmt_srfm1->fetch();
					$stmt_srfm1->close();
				}
			}
			
			$qcg_testtype=''; $qcg_setupflg=0; $qcg_seedsize=0; $qcg_noofseedinonerep=0; $qcg_sgtoneobflg=0; $qcg_sgtnoofrep=0; $qcg_sgtoobnormal1=0; $qcg_sgtoobnormal2=0; $qcg_sgtoobnormal3=0; $qcg_sgtoobnormal4=0; $qcg_sgtoobnormal5=0; $qcg_sgtoobnormal6=0; $qcg_sgtoobnormal7=0; $qcg_sgtoobnormal8=0; $qcg_sgtoobnormalavg=0; $qcg_sgtoobnormaldt=0; $qcg_sgtnormal1=0; $qcg_sgtnormal2=0; $qcg_sgtnormal3=0; $qcg_sgtnormal4=0; $qcg_sgtnormal5=0; $qcg_sgtnormal6=0; $qcg_sgtnormal7=0; $qcg_sgtnormal8=0; $qcg_sgtnormalavg=0; $qcg_sgtabnormal1=0; $qcg_sgtabnormal2=0; $qcg_sgtabnormal3=0; $qcg_sgtabnormal4=0; $qcg_sgtabnormal5=0; $qcg_sgtabnormal6=0; $qcg_sgtabnormal7=0; $qcg_sgtabnormal8=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfug1=0; $qcg_sgthardfug2=0; $qcg_sgthardfug3=0; $qcg_sgthardfug4=0; $qcg_sgthardfug5=0; $qcg_sgthardfug6=0; $qcg_sgthardfug7=0; $qcg_sgthardfug8=0; $qcg_sgthardfugavg=0; $qcg_sgtdead1=0; $qcg_sgtdead2=0; $qcg_sgtdead3=0; $qcg_sgtdead4=0; $qcg_sgtdead5=0; $qcg_sgtdead6=0; $qcg_sgtdead7=0; $qcg_sgtdead8=0; $qcg_sgtdeadavg=0; $qcg_sgtdt=''; $qcg_sgtvremark=''; $qcg_vigtesttype=''; $qcg_vigoneobflg=0; $qcg_vignoofrep=0; $qcg_vigoobnormal1=0; $qcg_vigoobnormal2=0; $qcg_vigoobnormal3=0; $qcg_vigoobnormal4=0; $qcg_vigoobnormal5=0; $qcg_vigoobnormal6=0; $qcg_vigoobnormal7=0; $qcg_vigoobnormal8=0; $qcg_vigoobnormalavg=0; $qcg_vigoobnormaldt=''; $qcg_vignormal1=0; $qcg_vignormal2=0; $qcg_vignormal3=0; $qcg_vignormal4=0; $qcg_vignormal5=0; $qcg_vignormal6=0; $qcg_vignormal7=0; $qcg_vignormal8=0; $qcg_vignormalavg=0; $qcg_vigabnormal1=0; $qcg_vigabnormal2=0; $qcg_vigabnormal3=0; $qcg_vigabnormal4=0; $qcg_vigabnormal5=0; $qcg_vigabnormal6=0; $qcg_vigabnormal7=0; $qcg_vigabnormal8=0; $qcg_vigabnormalavg=0; $qcg_vigdead1=0; $qcg_vigdead2=0; $qcg_vigdead3=0; $qcg_vigdead4=0; $qcg_vigdead5=0; $qcg_vigdead6=0; $qcg_vigdead7=0; $qcg_vigdead8=0; $qcg_vigdeadavg=0; $qcg_viglogid=0; $qcg_vigdt=0; $qcg_viggermp=0; $qcg_vigflg=0; $qcg_vigvremark=''; $qcg_oprremark=''; $qcg_sgtflg=0; $fingermpflg=0; $qcg_germpflg=0; $qcg_noofseedinonerepfgt=0; $nosiorsgtd=0; $qcg_noofseedinonerepsgtd=0; $qcg_sgtdoneobflg=0; $qcg_sgtdnoofrep=0; $qcg_sgtdoobnormal1=0; $qcg_sgtdoobnormal2=0; $qcg_sgtdoobnormal3=0; $qcg_sgtdoobnormal4=0; $qcg_sgtdoobnormal5=0; $qcg_sgdtoobnormal6=0; $qcg_sgtdoobnormal7=0; $qcg_sgtdoobnormal8=0; $qcg_sgtdoobnormalavg=0; $qcg_sgtdoobnormaldt=0; $qcg_sgtdnormal1=0; $qcg_sgtdnormal2=0; $qcg_sgtdnormal3=0; $qcg_sgtdnormal4=0; $qcg_sgtdnormal5=0; $qcg_sgtdnormal6=0; $qcg_sgtdnormal7=0; $qcg_sgtdnormal8=0; $qcg_sgtdnormalavg=0; $qcg_sgtdabnormal1=0; $qcg_sgtdabnormal2=0; $qcg_sgtdabnormal3=0; $qcg_sgtdabnormal4=0; $qcg_sgtdabnormal5=0; $qcg_sgtdabnormal6=0; $qcg_sgtdabnormal7=0; $qcg_sgtdabnormal8=0; $qcg_sgtdabnormalavg=0; $qcg_sgtdhardfug1=0; $qcg_sgtdhardfug2=0; $qcg_sgtdhardfug3=0; $qcg_sgtdhardfug4=0; $qcg_sgtdhardfug5=0; $qcg_sgtdhardfug6=0; $qcg_sgtdhardfug7=0; $qcg_sgtdhardfug8=0; $qcg_sgtdhardfugavg=0; $qcg_sgtddead1=0; $qcg_sgtddead2=0; $qcg_sgtddead3=0; $qcg_sgtddead4=0; $qcg_sgtddead5=0; $qcg_sgtddead6=0; $qcg_sgtddead7=0; $qcg_sgtddead8=0; $qcg_sgtddeadavg=0; $qcg_sgtddt=0; $qcg_sgtdvremark=0; $qcg_sgtdflg=0; 
			$qcg_sgtimage=''; $qcg_fgtimage=''; $qcg_sgtdimage=''; $qcg_sgtdremark=''; $qcg_sgtfcimage=''; $qcg_fgtfcimage=''; $qcg_sgtdfcimage=''; $qcg_sgtfcremark=''; $qcg_fgtfcremark=''; $qcg_sgtdfcremark=''; $qcg_sgtremark=''; $qcg_fgtremark='';  $qcg_fgtoprremark=''; $qcg_sgtdoprremark=''; 
			$qcg_sgtnormalb1=0; $qcg_sgtnormalb2=0; $qcg_sgtnormalb3=0; $qcg_sgtnormalb4=0; $qcg_sgtnormalb5=0; $qcg_sgtnormalb6=0; $qcg_sgtnormalb7=0; $qcg_sgtnormalb8=0; $qcg_sgtnormalavga=0; $qcg_sgtnormalavgb=0; $qcg_sgtfug1=0; $qcg_sgtfug2=0; $qcg_sgtfug3=0; $qcg_sgtfug4=0; $qcg_sgtfug5=0; $qcg_sgtfug6=0; $qcg_sgtfug7=0; $qcg_sgtfug8=0; $qcg_sgtfugavg=0; 
			$qcg_vignormalb1=0; $qcg_vignormalb2=0; $qcg_vignormalb3=0; $qcg_vignormalb4=0; $qcg_vignormalb5=0; $qcg_vignormalb6=0; $qcg_vignormalb7=0; $qcg_vignormalb8=0; $qcg_vignormalavga=0; $qcg_vignormalavgb=0;
			
			$qcg_sgtdnormalb1=0; $qcg_sgtdnormalb2=0; $qcg_sgtdnormalb3=0; $qcg_sgtdnormalb4=0; $qcg_sgtdnormalb5=0; $qcg_sgtdnormalb6=0; $qcg_sgtdnormalb7=0; $qcg_sgtdnormalb8=0; $qcg_sgtdnormalavga=0; $qcg_sgtdnormalavgb=0; $qcg_sgtdfug1=0; $qcg_sgtdfug2=0; $qcg_sgtdfug3=0; $qcg_sgtdfug4=0; $qcg_sgtdfug5=0; $qcg_sgtdfug6=0; $qcg_sgtdfug7=0; $qcg_sgtdfug8=0; $qcg_sgtdfugavg=0;
			
			
			
			$stmt_samp = $this->conn_ps->prepare("SELECT qcg_testtype, qcg_setupflg, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtoneobflg, qcg_sgtnoofrep, qcg_sgtoobnormal1, qcg_sgtoobnormal2, qcg_sgtoobnormal3, qcg_sgtoobnormal4, qcg_sgtoobnormal5, qcg_sgtoobnormal6, qcg_sgtoobnormal7, qcg_sgtoobnormal8, qcg_sgtoobnormalavg, qcg_sgtoobnormaldt, qcg_sgtnormal1, qcg_sgtnormal2, qcg_sgtnormal3, qcg_sgtnormal4, qcg_sgtnormal5, qcg_sgtnormal6, qcg_sgtnormal7, qcg_sgtnormal8, qcg_sgtnormalavg, qcg_sgtabnormal1, qcg_sgtabnormal2, qcg_sgtabnormal3, qcg_sgtabnormal4, qcg_sgtabnormal5, qcg_sgtabnormal6, qcg_sgtabnormal7, qcg_sgtabnormal8, qcg_sgtabnormalavg, qcg_sgthardfug1, qcg_sgthardfug2, qcg_sgthardfug3, qcg_sgthardfug4, qcg_sgthardfug5, qcg_sgthardfug6, qcg_sgthardfug7, qcg_sgthardfug8, qcg_sgthardfugavg, qcg_sgtdead1, qcg_sgtdead2, qcg_sgtdead3, qcg_sgtdead4, qcg_sgtdead5, qcg_sgtdead6, qcg_sgtdead7, qcg_sgtdead8, qcg_sgtdeadavg, qcg_sgtdt, qcg_sgtvremark, qcg_vigtesttype, qcg_vigoneobflg, qcg_vignoofrep, qcg_vigoobnormal1, qcg_vigoobnormal2, qcg_vigoobnormal3, qcg_vigoobnormal4, qcg_vigoobnormal5, qcg_vigoobnormal6, qcg_vigoobnormal7, qcg_vigoobnormal8, qcg_vigoobnormalavg, qcg_vigoobnormaldt, qcg_vignormal1, qcg_vignormal2, qcg_vignormal3, qcg_vignormal4, qcg_vignormal5, qcg_vignormal6, qcg_vignormal7, qcg_vignormal8, qcg_vignormalavg, qcg_vigabnormal1, qcg_vigabnormal2, qcg_vigabnormal3, qcg_vigabnormal4, qcg_vigabnormal5, qcg_vigabnormal6, qcg_vigabnormal7, qcg_vigabnormal8, qcg_vigabnormalavg, qcg_vigdead1, qcg_vigdead2, qcg_vigdead3, qcg_vigdead4, qcg_vigdead5, qcg_vigdead6, qcg_vigdead7, qcg_vigdead8, qcg_vigdeadavg, qcg_viglogid, qcg_vigdt, qcg_viggermp, qcg_vigflg, qcg_vigvremark, qcg_oprremark, qcg_sgtflg, qcg_germpflg, qcg_noofseedinonerepfgt, qcg_noofseedinonerepsgtd, qcg_sgtdoneobflg, qcg_sgtdnoofrep, qcg_sgtdoobnormal1, qcg_sgtdoobnormal2, qcg_sgtdoobnormal3, qcg_sgtdoobnormal4, qcg_sgtdoobnormal5, qcg_sgdtoobnormal6, qcg_sgtdoobnormal7, qcg_sgtdoobnormal8, qcg_sgtdoobnormalavg, qcg_sgtdoobnormaldt, qcg_sgtdnormal1, qcg_sgtdnormal2, qcg_sgtdnormal3, qcg_sgtdnormal4, qcg_sgtdnormal5, qcg_sgtdnormal6, qcg_sgtdnormal7, qcg_sgtdnormal8, qcg_sgtdnormalavg, qcg_sgtdabnormal1, qcg_sgtdabnormal2, qcg_sgtdabnormal3, qcg_sgtdabnormal4, qcg_sgtdabnormal5, qcg_sgtdabnormal6, qcg_sgtdabnormal7, qcg_sgtdabnormal8, qcg_sgtdabnormalavg, qcg_sgtdhardfug1, qcg_sgtdhardfug2, qcg_sgtdhardfug3, qcg_sgtdhardfug4, qcg_sgtdhardfug5, qcg_sgtdhardfug6, qcg_sgtdhardfug7, qcg_sgtdhardfug8, qcg_sgtdhardfugavg, qcg_sgtddead1, qcg_sgtddead2, qcg_sgtddead3, qcg_sgtddead4, qcg_sgtddead5, qcg_sgtddead6, qcg_sgtddead7, qcg_sgtddead8, qcg_sgtddeadavg, qcg_sgtddt, qcg_sgtdvremark, qcg_sgtdflg, qcg_sgtimage, qcg_fgtimage, qcg_sgtdimage, qcg_sgtdremark, qcg_sgtfcimage, qcg_fgtfcimage, qcg_sgtdfcimage, qcg_sgtfcremark, qcg_fgtfcremark, qcg_sgtdfcremark, qcg_sgtremark, qcg_fgtremark, qcg_fgtoprremark, qcg_sgtdoprremark,  qcg_sgtnormalb1, qcg_sgtnormalb2, qcg_sgtnormalb3, qcg_sgtnormalb4, qcg_sgtnormalb5, qcg_sgtnormalb6, qcg_sgtnormalb7, qcg_sgtnormalb8, qcg_sgtnormalavga, qcg_sgtnormalavgb, qcg_sgtfug1, qcg_sgtfug2, qcg_sgtfug3, qcg_sgtfug4, qcg_sgtfug5, qcg_sgtfug6, qcg_sgtfug7, qcg_sgtfug8, qcg_sgtfugavg, qcg_vignormalb1, qcg_vignormalb2, qcg_vignormalb3, qcg_vignormalb4, qcg_vignormalb5, qcg_vignormalb6, qcg_vignormalb7, qcg_vignormalb8, qcg_vignormalavga, qcg_vignormalavgb,  qcg_sgtdnormalb1, qcg_sgtdnormalb2, qcg_sgtdnormalb3, qcg_sgtdnormalb4, qcg_sgtdnormalb5, qcg_sgtdnormalb6, qcg_sgtdnormalb7, qcg_sgtdnormalb8, qcg_sgtdnormalavga, qcg_sgtdnormalavgb, qcg_sgtdfug1, qcg_sgtdfug2, qcg_sgtdfug3, qcg_sgtdfug4, qcg_sgtdfug5, qcg_sgtdfug6, qcg_sgtdfug7, qcg_sgtdfug8, qcg_sgtdfugavg FROM tbl_qcgdata WHERE qcg_germpflg!=1 and qcg_sampleno = ? ");
			$stmt_samp->bind_param("s", $sampleno);
			$result_samp=$stmt_samp->execute();
			$stmt_samp->store_result();
			if ($stmt_samp->num_rows > 0) {
				$stmt_samp->bind_result($qcg_testtype, $qcg_setupflg, $qcg_seedsize, $qcg_noofseedinonerep, $qcg_sgtoneobflg, $qcg_sgtnoofrep, $qcg_sgtoobnormal1, $qcg_sgtoobnormal2, $qcg_sgtoobnormal3, $qcg_sgtoobnormal4, $qcg_sgtoobnormal5, $qcg_sgtoobnormal6, $qcg_sgtoobnormal7, $qcg_sgtoobnormal8, $qcg_sgtoobnormalavg, $qcg_sgtoobnormaldt, $qcg_sgtnormal1, $qcg_sgtnormal2, $qcg_sgtnormal3, $qcg_sgtnormal4, $qcg_sgtnormal5, $qcg_sgtnormal6, $qcg_sgtnormal7, $qcg_sgtnormal8, $qcg_sgtnormalavg, $qcg_sgtabnormal1, $qcg_sgtabnormal2, $qcg_sgtabnormal3, $qcg_sgtabnormal4, $qcg_sgtabnormal5, $qcg_sgtabnormal6, $qcg_sgtabnormal7, $qcg_sgtabnormal8, $qcg_sgtabnormalavg, $qcg_sgthardfug1, $qcg_sgthardfug2, $qcg_sgthardfug3, $qcg_sgthardfug4, $qcg_sgthardfug5, $qcg_sgthardfug6, $qcg_sgthardfug7, $qcg_sgthardfug8, $qcg_sgthardfugavg, $qcg_sgtdead1, $qcg_sgtdead2, $qcg_sgtdead3, $qcg_sgtdead4, $qcg_sgtdead5, $qcg_sgtdead6, $qcg_sgtdead7, $qcg_sgtdead8, $qcg_sgtdeadavg, $qcg_sgtdt, $qcg_sgtvremark, $qcg_vigtesttype, $qcg_vigoneobflg, $qcg_vignoofrep, $qcg_vigoobnormal1, $qcg_vigoobnormal2, $qcg_vigoobnormal3, $qcg_vigoobnormal4, $qcg_vigoobnormal5, $qcg_vigoobnormal6, $qcg_vigoobnormal7, $qcg_vigoobnormal8, $qcg_vigoobnormalavg, $qcg_vigoobnormaldt, $qcg_vignormal1, $qcg_vignormal2, $qcg_vignormal3, $qcg_vignormal4, $qcg_vignormal5, $qcg_vignormal6, $qcg_vignormal7, $qcg_vignormal8, $qcg_vignormalavg, $qcg_vigabnormal1, $qcg_vigabnormal2, $qcg_vigabnormal3, $qcg_vigabnormal4, $qcg_vigabnormal5, $qcg_vigabnormal6, $qcg_vigabnormal7, $qcg_vigabnormal8, $qcg_vigabnormalavg, $qcg_vigdead1, $qcg_vigdead2, $qcg_vigdead3, $qcg_vigdead4, $qcg_vigdead5, $qcg_vigdead6, $qcg_vigdead7, $qcg_vigdead8, $qcg_vigdeadavg, $qcg_viglogid, $qcg_vigdt, $qcg_viggermp, $qcg_vigflg, $qcg_vigvremark, $qcg_oprremark, $qcg_sgtflg, $qcg_germpflg, $qcg_noofseedinonerepfgt, $qcg_noofseedinonerepsgtd, $qcg_sgtdoneobflg, $qcg_sgtdnoofrep, $qcg_sgtdoobnormal1, $qcg_sgtdoobnormal2, $qcg_sgtdoobnormal3, $qcg_sgtdoobnormal4, $qcg_sgtdoobnormal5, $qcg_sgdtoobnormal6, $qcg_sgtdoobnormal7, $qcg_sgtdoobnormal8, $qcg_sgtdoobnormalavg, $qcg_sgtdoobnormaldt, $qcg_sgtdnormal1, $qcg_sgtdnormal2, $qcg_sgtdnormal3, $qcg_sgtdnormal4, $qcg_sgtdnormal5, $qcg_sgtdnormal6, $qcg_sgtdnormal7, $qcg_sgtdnormal8, $qcg_sgtdnormalavg, $qcg_sgtdabnormal1, $qcg_sgtdabnormal2, $qcg_sgtdabnormal3, $qcg_sgtdabnormal4, $qcg_sgtdabnormal5, $qcg_sgtdabnormal6, $qcg_sgtdabnormal7, $qcg_sgtdabnormal8, $qcg_sgtdabnormalavg, $qcg_sgtdhardfug1, $qcg_sgtdhardfug2, $qcg_sgtdhardfug3, $qcg_sgtdhardfug4, $qcg_sgtdhardfug5, $qcg_sgtdhardfug6, $qcg_sgtdhardfug7, $qcg_sgtdhardfug8, $qcg_sgtdhardfugavg, $qcg_sgtddead1, $qcg_sgtddead2, $qcg_sgtddead3, $qcg_sgtddead4, $qcg_sgtddead5, $qcg_sgtddead6, $qcg_sgtddead7, $qcg_sgtddead8, $qcg_sgtddeadavg, $qcg_sgtddt, $qcg_sgtdvremark, $qcg_sgtdflg, $qcg_sgtimage, $qcg_fgtimage, $qcg_sgtdimage, $qcg_sgtdremark, $qcg_sgtfcimage, $qcg_fgtfcimage, $qcg_sgtdfcimage, $qcg_sgtfcremark, $qcg_fgtfcremark, $qcg_sgtdfcremark, $qcg_sgtremark, $qcg_fgtremark, $qcg_fgtoprremark, $qcg_sgtdoprremark,  $qcg_sgtnormalb1, $qcg_sgtnormalb2, $qcg_sgtnormalb3, $qcg_sgtnormalb4, $qcg_sgtnormalb5, $qcg_sgtnormalb6, $qcg_sgtnormalb7, $qcg_sgtnormalb8, $qcg_sgtnormalavga, $qcg_sgtnormalavgb, $qcg_sgtfug1, $qcg_sgtfug2, $qcg_sgtfug3, $qcg_sgtfug4, $qcg_sgtfug5, $qcg_sgtfug6, $qcg_sgtfug7, $qcg_sgtfug8, $qcg_sgtfugavg, $qcg_vignormalb1, $qcg_vignormalb2, $qcg_vignormalb3, $qcg_vignormalb4, $qcg_vignormalb5, $qcg_vignormalb6, $qcg_vignormalb7, $qcg_vignormalb8, $qcg_vignormalavga, $qcg_vignormalavgb,  $qcg_sgtdnormalb1, $qcg_sgtdnormalb2, $qcg_sgtdnormalb3, $qcg_sgtdnormalb4, $qcg_sgtdnormalb5, $qcg_sgtdnormalb6, $qcg_sgtdnormalb7, $qcg_sgtdnormalb8, $qcg_sgtdnormalavga, $qcg_sgtdnormalavgb, $qcg_sgtdfug1, $qcg_sgtdfug2, $qcg_sgtdfug3, $qcg_sgtdfug4, $qcg_sgtdfug5, $qcg_sgtdfug6, $qcg_sgtdfug7, $qcg_sgtdfug8, $qcg_sgtdfugavg);
				//looping through all the records 
				$stmt_samp->fetch();
				$stmt_samp->close();
			}
			
			if($qcg_testtype=="Standard Germination Test" && $qcg_sgtflg>0){$fingermpflg=1;}
			else if($qcg_testtype=="Standard Germination Test" && $qcg_sgtflg==0){$fingermpflg=2;}
			else if($qcg_testtype=="Field Germination Test" && $qcg_vigflg>0){$fingermpflg=1;}
			else if($qcg_testtype=="Field Germination Test" && $qcg_vigflg==0){$fingermpflg=2;}
			else if($qcg_testtype=="Both Germination Test" && $qcg_sgtflg>0 && $qcg_vigflg>0){$fingermpflg=1;}
			else if($qcg_testtype=="Both Germination Test" && $qcg_sgtflg==0 && $qcg_vigflg>0){$fingermpflg=2;}
			else if($qcg_testtype=="Both Germination Test" && $qcg_sgtflg>0 && $qcg_vigflg==0){$fingermpflg=2;}
			else {$fingermpflg=0;}
			
			//$userSR["arrival_id"] = $arrival_id;
			//$userSR["srdate"] = $srdate;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			/*$userSR["sloc"] = $slocs;
			$userSR["qctest"] = $state;*/
			$userSR["sampleno"] = $sampleno;
			/*$userSR["spdate"] = $spdate;
			$userSR["sampflg"] = $sampflg;*/
			$userSR["seedsize"] = $seedsize;
			$userSR["noofseedinonerep"] = $nosior;
			$userSR["noofseedinonerepfgt"] = $nosiorfgt;
					
			$userSR["qcg_testtype"] = $qcg_testtype;
			$userSR["qcg_setupflg"] = $qcg_setupflg;
			$userSR["qcg_seedsize"] = $qcg_seedsize;
			$userSR["qcg_noofseedinonerep"] = $qcg_noofseedinonerep;
			$userSR["qcg_sgtoneobflg"] = $qcg_sgtoneobflg;
			$userSR["qcg_sgtnoofrep"] = $qcg_sgtnoofrep;
			$userSR["qcg_sgtoobnormal1"] = $qcg_sgtoobnormal1;
			$userSR["qcg_sgtoobnormal2"] = $qcg_sgtoobnormal2;
			$userSR["qcg_sgtoobnormal3"] = $qcg_sgtoobnormal3;
			$userSR["qcg_sgtoobnormal4"] = $qcg_sgtoobnormal4;
			$userSR["qcg_sgtoobnormal5"] = $qcg_sgtoobnormal5;
			$userSR["qcg_sgtoobnormal6"] = $qcg_sgtoobnormal6;
			$userSR["qcg_sgtoobnormal7"] = $qcg_sgtoobnormal7;
			$userSR["qcg_sgtoobnormal8"] = $qcg_sgtoobnormal8;
			$userSR["qcg_sgtoobnormalavg"] = $qcg_sgtoobnormalavg;
			$userSR["qcg_sgtoobnormaldt"] = $qcg_sgtoobnormaldt;
			$userSR["qcg_sgtnormal1"] = $qcg_sgtnormal1;
			$userSR["qcg_sgtnormal2"] = $qcg_sgtnormal2;
			$userSR["qcg_sgtnormal3"] = $qcg_sgtnormal3;
			$userSR["qcg_sgtnormal4"] = $qcg_sgtnormal4;
			$userSR["qcg_sgtnormal5"] = $qcg_sgtnormal5;
			$userSR["qcg_sgtnormal6"] = $qcg_sgtnormal6;
			$userSR["qcg_sgtnormal7"] = $qcg_sgtnormal7;
			$userSR["qcg_sgtnormal8"] = $qcg_sgtnormal8;
			$userSR["qcg_sgtnormalavg"] = $qcg_sgtnormalavg;
			$userSR["qcg_sgtabnormal1"] = $qcg_sgtabnormal1;
			$userSR["qcg_sgtabnormal2"] = $qcg_sgtabnormal2;
			$userSR["qcg_sgtabnormal3"] = $qcg_sgtabnormal3;
			$userSR["qcg_sgtabnormal4"] = $qcg_sgtabnormal4;
			$userSR["qcg_sgtabnormal5"] = $qcg_sgtabnormal5;
			$userSR["qcg_sgtabnormal6"] = $qcg_sgtabnormal6;
			$userSR["qcg_sgtabnormal7"] = $qcg_sgtabnormal7;
			$userSR["qcg_sgtabnormal8"] = $qcg_sgtabnormal8;
			$userSR["qcg_sgtabnormalavg"] = $qcg_sgtabnormalavg;
			$userSR["qcg_sgthardfug1"] = $qcg_sgthardfug1;
			$userSR["qcg_sgthardfug2"] = $qcg_sgthardfug2;
			$userSR["qcg_sgthardfug3"] = $qcg_sgthardfug3;
			$userSR["qcg_sgthardfug4"] = $qcg_sgthardfug4;
			$userSR["qcg_sgthardfug5"] = $qcg_sgthardfug5;
			$userSR["qcg_sgthardfug6"] = $qcg_sgthardfug6;
			$userSR["qcg_sgthardfug7"] = $qcg_sgthardfug7;
			$userSR["qcg_sgthardfug8"] = $qcg_sgthardfug8;
			$userSR["qcg_sgthardfugavg"] = $qcg_sgthardfugavg;
			$userSR["qcg_sgtdead1"] = $qcg_sgtdead1;
			$userSR["qcg_sgtdead2"] = $qcg_sgtdead2;
			$userSR["qcg_sgtdead3"] = $qcg_sgtdead3;
			$userSR["qcg_sgtdead4"] = $qcg_sgtdead4;
			$userSR["qcg_sgtdead5"] = $qcg_sgtdead5;
			$userSR["qcg_sgtdead6"] = $qcg_sgtdead6;
			$userSR["qcg_sgtdead7"] = $qcg_sgtdead7;
			$userSR["qcg_sgtdead8"] = $qcg_sgtdead8;
			$userSR["qcg_sgtdeadavg"] = $qcg_sgtdeadavg;
			$userSR["qcg_sgtdt"] = $qcg_sgtdt;
			$userSR["qcg_sgtvremark"] = $qcg_sgtvremark;
			$userSR["qcg_sgtflg"] = $qcg_sgtflg;
			$userSR["qcg_vigtesttype"] = $qcg_vigtesttype;
			$userSR["qcg_vigoneobflg"] = $qcg_vigoneobflg;
			$userSR["qcg_vignoofrep"] = $qcg_vignoofrep;
			$userSR["qcg_vigoobnormal1"] = $qcg_vigoobnormal1;
			$userSR["qcg_vigoobnormal2"] = $qcg_vigoobnormal2;
			$userSR["qcg_vigoobnormal3"] = $qcg_vigoobnormal3;
			$userSR["qcg_vigoobnormal4"] = $qcg_vigoobnormal4;
			$userSR["qcg_vigoobnormal5"] = $qcg_vigoobnormal5;
			$userSR["qcg_vigoobnormal6"] = $qcg_vigoobnormal6;
			$userSR["qcg_vigoobnormal7"] = $qcg_vigoobnormal7;
			$userSR["qcg_vigoobnormal8"] = $qcg_vigoobnormal8;
			$userSR["qcg_vigoobnormalavg"] = $qcg_vigoobnormalavg;
			$userSR["qcg_vigoobnormaldt"] = $qcg_vigoobnormaldt;
			$userSR["qcg_vignormal1"] = $qcg_vignormal1;
			$userSR["qcg_vignormal2"] = $qcg_vignormal2;
			$userSR["qcg_vignormal3"] = $qcg_vignormal3;
			$userSR["qcg_vignormal4"] = $qcg_vignormal4;
			$userSR["qcg_vignormal5"] = $qcg_vignormal5;
			$userSR["qcg_vignormal6"] = $qcg_vignormal6;
			$userSR["qcg_vignormal7"] = $qcg_vignormal7;
			$userSR["qcg_vignormal8"] = $qcg_vignormal8;
			$userSR["qcg_vignormalavg"] = $qcg_vignormalavg;
			$userSR["qcg_vigabnormal1"] = $qcg_vigabnormal1;
			$userSR["qcg_vigabnormal2"] = $qcg_vigabnormal2;
			$userSR["qcg_vigabnormal3"] = $qcg_vigabnormal3;
			$userSR["qcg_vigabnormal4"] = $qcg_vigabnormal4;
			$userSR["qcg_vigabnormal5"] = $qcg_vigabnormal5;
			$userSR["qcg_vigabnormal6"] = $qcg_vigabnormal6;
			$userSR["qcg_vigabnormal7"] = $qcg_vigabnormal7;
			$userSR["qcg_vigabnormal8"] = $qcg_vigabnormal8;
			$userSR["qcg_vigabnormalavg"] = $qcg_vigabnormalavg;
			$userSR["qcg_vigdead1"] = $qcg_vigdead1;
			$userSR["qcg_vigdead2"] = $qcg_vigdead2;
			$userSR["qcg_vigdead3"] = $qcg_vigdead3;
			$userSR["qcg_vigdead4"] = $qcg_vigdead4;
			$userSR["qcg_vigdead5"] = $qcg_vigdead5;
			$userSR["qcg_vigdead6"] = $qcg_vigdead6;
			$userSR["qcg_vigdead7"] = $qcg_vigdead7;
			$userSR["qcg_vigdead8"] = $qcg_vigdead8;
			$userSR["qcg_vigdeadavg"] = $qcg_vigdeadavg;
			$userSR["qcg_viglogid"] = $qcg_viglogid;
			$userSR["qcg_vigdt"] = $qcg_vigdt;
			$userSR["qcg_viggermp"] = $qcg_viggermp;
			$userSR["qcg_vigflg"] = $qcg_vigflg;
			$userSR["qcg_vigvremark"] = $qcg_vigvremark;
			$userSR["qcg_oprremark"] = $qcg_oprremark;
			$userSR["fingermpflg"] = $fingermpflg;
			$userSR["qcg_noofseedinonerepfgt"] = $qcg_noofseedinonerepfgt;
			
			
			//$userSR["noofseedinonerepsgtd"] = $nosiorsgtd;
			$userSR["qcg_noofseedinonerepsgtd"] = $qcg_noofseedinonerepsgtd;
			$userSR["qcg_sgtdoneobflg"] = $qcg_sgtdoneobflg;
			$userSR["qcg_sgtdnoofrep"] = $qcg_sgtdnoofrep;
			$userSR["qcg_sgtdoobnormal1"] = $qcg_sgtdoobnormal1;
			$userSR["qcg_sgtdoobnormal2"] = $qcg_sgtdoobnormal2;
			$userSR["qcg_sgtdoobnormal3"] = $qcg_sgtdoobnormal3;
			$userSR["qcg_sgtdoobnormal4"] = $qcg_sgtdoobnormal4;
			$userSR["qcg_sgtdoobnormal5"] = $qcg_sgtdoobnormal5;
			$userSR["qcg_sgdtoobnormal6"] = $qcg_sgdtoobnormal6;
			$userSR["qcg_sgtdoobnormal7"] = $qcg_sgtdoobnormal7;
			$userSR["qcg_sgdtoobnormal8"] = $qcg_sgtdoobnormal8;
			$userSR["qcg_sgtdoobnormalavg"] = $qcg_sgtdoobnormalavg;
			$userSR["qcg_sgtdoobnormaldt"] = $qcg_sgtdoobnormaldt;
			$userSR["qcg_sgtdnormal1"] = $qcg_sgtdnormal1;
			$userSR["qcg_sgtdnormal2"] = $qcg_sgtdnormal2;
			$userSR["qcg_sgtdnormal3"] = $qcg_sgtdnormal3;
			$userSR["qcg_sgtdnormal4"] = $qcg_sgtdnormal4;
			$userSR["qcg_sgtdnormal5"] = $qcg_sgtdnormal5;
			$userSR["qcg_sgtdnormal6"] = $qcg_sgtdnormal6;
			$userSR["qcg_sgtdnormal7"] = $qcg_sgtdnormal7;
			$userSR["qcg_sgtdnormal8"] = $qcg_sgtdnormal8;
			$userSR["qcg_sgtdnormalavg"] = $qcg_sgtdnormalavg;
			$userSR["qcg_sgtdabnormal1"] = $qcg_sgtdabnormal1;
			$userSR["qcg_sgtdabnormal2"] = $qcg_sgtdabnormal2;
			$userSR["qcg_sgtdabnormal3"] = $qcg_sgtdabnormal3;
			$userSR["qcg_sgtdabnormal4"] = $qcg_sgtdabnormal4;
			$userSR["qcg_sgtdabnormal5"] = $qcg_sgtdabnormal5;
			$userSR["qcg_sgtdabnormal6"] = $qcg_sgtdabnormal6;
			$userSR["qcg_sgtdabnormal7"] = $qcg_sgtdabnormal7;
			$userSR["qcg_sgtdabnormal8"] = $qcg_sgtdabnormal8;
			$userSR["qcg_sgtdabnormalavg"] = $qcg_sgtdabnormalavg;
			$userSR["qcg_sgtdhardfug1"] = $qcg_sgtdhardfug1;
			$userSR["qcg_sgtdhardfug2"] = $qcg_sgtdhardfug2;
			$userSR["qcg_sgtdhardfug3"] = $qcg_sgtdhardfug3;
			$userSR["qcg_sgtdhardfug4"] = $qcg_sgtdhardfug4;
			$userSR["qcg_sgtdhardfug5"] = $qcg_sgtdhardfug5;
			$userSR["qcg_sgtdhardfug6"] = $qcg_sgtdhardfug6;
			$userSR["qcg_sgtdhardfug7"] = $qcg_sgtdhardfug7;
			$userSR["qcg_sgtdhardfug8"] = $qcg_sgtdhardfug8;
			$userSR["qcg_sgtdhardfugavg"] = $qcg_sgtdhardfugavg;
			$userSR["qcg_sgtddead1"] = $qcg_sgtddead1;
			$userSR["qcg_sgtddead2"] = $qcg_sgtddead2;
			$userSR["qcg_sgtddead3"] = $qcg_sgtddead3;
			$userSR["qcg_sgtddead4"] = $qcg_sgtddead4;
			$userSR["qcg_sgtddead5"] = $qcg_sgtddead5;
			$userSR["qcg_sgtddead6"] = $qcg_sgtddead6;
			$userSR["qcg_sgtddead7"] = $qcg_sgtddead7;
			$userSR["qcg_sgtddead8"] = $qcg_sgtddead8;
			$userSR["qcg_sgtddeadavg"] = $qcg_sgtddeadavg;
			$userSR["qcg_sgtddt"] = $qcg_sgtddt;
			$userSR["qcg_sgtdvremark"] = $qcg_sgtdvremark;
			$userSR["qcg_sgtdflg"] = $qcg_sgtdflg;
			
			$userSR["qcg_sgtimage"] = $qcg_sgtimage;
			$userSR["qcg_fgtimage"] = $qcg_fgtimage;
			$userSR["qcg_sgtdimage"] = $qcg_sgtdimage;
			$userSR["qcg_sgtremark"] = $qcg_sgtremark;
			$userSR["qcg_fgtremark"] = $qcg_fgtremark;
			$userSR["qcg_sgtdremark"] = $qcg_sgtdremark;
			$userSR["qcg_sgtfcimage"] = $qcg_sgtfcimage;
			$userSR["qcg_fgtfcimage"] = $qcg_fgtfcimage;
			$userSR["qcg_sgtdfcimage"] = $qcg_sgtdfcimage;
			$userSR["qcg_sgtfcremark"] = $qcg_sgtfcremark;
			$userSR["qcg_fgtfcremark"] = $qcg_fgtfcremark;
			$userSR["qcg_sgtdfcremark"] = $qcg_sgtdfcremark;
			
			$userSR["qcg_fgtoprremark"] = $qcg_fgtoprremark;
			$userSR["qcg_sgtdoprremark"] = $qcg_sgtdoprremark;
			
			$userSR["qcg_sgtnormalb1"] = $qcg_sgtnormalb1;
			$userSR["qcg_sgtnormalb2"] = $qcg_sgtnormalb2;
			$userSR["qcg_sgtnormalb3"] = $qcg_sgtnormalb3;
			$userSR["qcg_sgtnormalb4"] = $qcg_sgtnormalb4;
			$userSR["qcg_sgtnormalb5"] = $qcg_sgtnormalb5;
			$userSR["qcg_sgtnormalb6"] = $qcg_sgtnormalb6;
			$userSR["qcg_sgtnormalb7"] = $qcg_sgtnormalb7;
			$userSR["qcg_sgtnormalb8"] = $qcg_sgtnormalb8;
			$userSR["qcg_sgtnormalavga"] = $qcg_sgtnormalavga;
			$userSR["qcg_sgtnormalavgb"] = $qcg_sgtnormalavgb;
			$userSR["qcg_sgtfug1"] = $qcg_sgtfug1;
			$userSR["qcg_sgtfug2"] = $qcg_sgtfug2;
			$userSR["qcg_sgtfug3"] = $qcg_sgtfug3;
			$userSR["qcg_sgtfug4"] = $qcg_sgtfug4;
			$userSR["qcg_sgtfug5"] = $qcg_sgtfug5;
			$userSR["qcg_sgtfug6"] = $qcg_sgtfug6;
			$userSR["qcg_sgtfug7"] = $qcg_sgtfug7;
			$userSR["qcg_sgtfug8"] = $qcg_sgtfug8;
			$userSR["qcg_sgtfugavg"] = $qcg_sgtfugavg;
			$userSR["qcg_vignormalb1"] = $qcg_vignormalb1;
			$userSR["qcg_vignormalb2"] = $qcg_vignormalb2;
			$userSR["qcg_vignormalb3"] = $qcg_vignormalb3;
			$userSR["qcg_vignormalb4"] = $qcg_vignormalb4;
			$userSR["qcg_vignormalb5"] = $qcg_vignormalb5;
			$userSR["qcg_vignormalb6"] = $qcg_vignormalb6;
			$userSR["qcg_vignormalb7"] = $qcg_vignormalb7;
			$userSR["qcg_vignormalb8"] = $qcg_vignormalb8;
			$userSR["qcg_vignormalavga"] = $qcg_vignormalavga;
			$userSR["qcg_vignormalavgb"] = $qcg_vignormalavgb;
			$userSR["qcg_sgtdnormalb1"] = $qcg_sgtdnormalb1;
			$userSR["qcg_sgtdnormalb2"] = $qcg_sgtdnormalb2;
			$userSR["qcg_sgtdnormalb3"] = $qcg_sgtdnormalb3;
			$userSR["qcg_sgtdnormalb4"] = $qcg_sgtdnormalb4;
			$userSR["qcg_sgtdnormalb5"] = $qcg_sgtdnormalb5;
			$userSR["qcg_sgtdnormalb6"] = $qcg_sgtdnormalb6;
			$userSR["qcg_sgtdnormalb7"] = $qcg_sgtdnormalb7;
			$userSR["qcg_sgtdnormalb8"] = $qcg_sgtdnormalb8;
			$userSR["qcg_sgtdnormalavga"] = $qcg_sgtdnormalavga;
			$userSR["qcg_sgtdnormalavgb"] = $qcg_sgtdnormalavgb;
			$userSR["qcg_sgtdfug1"] = $qcg_sgtdfug1;
			$userSR["qcg_sgtdfug2"] = $qcg_sgtdfug2;
			$userSR["qcg_sgtdfug3"] = $qcg_sgtdfug3;
			$userSR["qcg_sgtdfug4"] = $qcg_sgtdfug4;
			$userSR["qcg_sgtdfug5"] = $qcg_sgtdfug5;
			$userSR["qcg_sgtdfug6"] = $qcg_sgtdfug6;
			$userSR["qcg_sgtdfug7"] = $qcg_sgtdfug7;
			$userSR["qcg_sgtdfug8"] = $qcg_sgtdfug8;
			$userSR["qcg_sgtdfugavg"] = $qcg_sgtdfugavg;
			
					
			$userSR["srfno"] = $srfno;
			$userSR["flg"] = 0;
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$userSR = array();
			$qcg_testtype=''; $qcg_setupflg=0; $qcg_seedsize=0; $qcg_noofseedinonerep=0; $qcg_sgtoneobflg=0; $qcg_sgtnoofrep=0; $qcg_sgtoobnormal1=0; $qcg_sgtoobnormal2=0; $qcg_sgtoobnormal3=0; $qcg_sgtoobnormal4=0; $qcg_sgtoobnormal5=0; $qcg_sgtoobnormal6=0; $qcg_sgtoobnormal7=0; $qcg_sgtoobnormal8=0; $qcg_sgtoobnormalavg=0; $qcg_sgtoobnormaldt=0; $qcg_sgtnormal1=0; $qcg_sgtnormal2=0; $qcg_sgtnormal3=0; $qcg_sgtnormal4=0; $qcg_sgtnormal5=0; $qcg_sgtnormal6=0; $qcg_sgtnormal7=0; $qcg_sgtnormal8=0; $qcg_sgtnormalavg=0; $qcg_sgtabnormal1=0; $qcg_sgtabnormal2=0; $qcg_sgtabnormal3=0; $qcg_sgtabnormal4=0; $qcg_sgtabnormal5=0; $qcg_sgtabnormal6=0; $qcg_sgtabnormal7=0; $qcg_sgtabnormal8=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfug1=0; $qcg_sgthardfug2=0; $qcg_sgthardfug3=0; $qcg_sgthardfug4=0; $qcg_sgthardfug5=0; $qcg_sgthardfug6=0; $qcg_sgthardfug7=0; $qcg_sgthardfug8=0; $qcg_sgthardfugavg=0; $qcg_sgtdead1=0; $qcg_sgtdead2=0; $qcg_sgtdead3=0; $qcg_sgtdead4=0; $qcg_sgtdead5=0; $qcg_sgtdead6=0; $qcg_sgtdead7=0; $qcg_sgtdead8=0; $qcg_sgtdeadavg=0; $qcg_sgtdt=''; $qcg_sgtvremark=''; $qcg_vigtesttype=''; $qcg_vigoneobflg=0; $qcg_vignoofrep=0; $qcg_vigoobnormal1=0; $qcg_vigoobnormal2=0; $qcg_vigoobnormal3=0; $qcg_vigoobnormal4=0; $qcg_vigoobnormal5=0; $qcg_vigoobnormal6=0; $qcg_vigoobnormal7=0; $qcg_vigoobnormal8=0; $qcg_vigoobnormalavg=0; $qcg_vigoobnormaldt=''; $qcg_vignormal1=0; $qcg_vignormal2=0; $qcg_vignormal3=0; $qcg_vignormal4=0; $qcg_vignormal5=0; $qcg_vignormal6=0; $qcg_vignormal7=0; $qcg_vignormal8=0; $qcg_vignormalavg=0; $qcg_vigabnormal1=0; $qcg_vigabnormal2=0; $qcg_vigabnormal3=0; $qcg_vigabnormal4=0; $qcg_vigabnormal5=0; $qcg_vigabnormal6=0; $qcg_vigabnormal7=0; $qcg_vigabnormal8=0; $qcg_vigabnormalavg=0; $qcg_vigdead1=0; $qcg_vigdead2=0; $qcg_vigdead3=0; $qcg_vigdead4=0; $qcg_vigdead5=0; $qcg_vigdead6=0; $qcg_vigdead7=0; $qcg_vigdead8=0; $qcg_vigdeadavg=0; $qcg_viglogid=0; $qcg_vigdt=0; $qcg_viggermp=0; $qcg_vigflg=0; $qcg_vigvremark=''; $qcg_oprremark=''; $qcg_sgtflg=0; $fingermpflg=0; $qcg_germpflg=0; $qcg_noofseedinonerepfgt=0; $nosiorsgtd=0; $qcg_noofseedinonerepsgtd=0; $qcg_sgtdoneobflg=0; $qcg_sgtdnoofrep=0; $qcg_sgtdoobnormal1=0; $qcg_sgtdoobnormal2=0; $qcg_sgtdoobnormal3=0; $qcg_sgtdoobnormal4=0; $qcg_sgtdoobnormal5=0; $qcg_sgdtoobnormal6=0; $qcg_sgtdoobnormal7=0; $qcg_sgtdoobnormal8=0; $qcg_sgtdoobnormalavg=0; $qcg_sgtdoobnormaldt=0; $qcg_sgtdnormal1=0; $qcg_sgtdnormal2=0; $qcg_sgtdnormal3=0; $qcg_sgtdnormal4=0; $qcg_sgtdnormal5=0; $qcg_sgtdnormal6=0; $qcg_sgtdnormal7=0; $qcg_sgtdnormal8=0; $qcg_sgtdnormalavg=0; $qcg_sgtdabnormal1=0; $qcg_sgtdabnormal2=0; $qcg_sgtdabnormal3=0; $qcg_sgtdabnormal4=0; $qcg_sgtdabnormal5=0; $qcg_sgtdabnormal6=0; $qcg_sgtdabnormal7=0; $qcg_sgtdabnormal8=0; $qcg_sgtdabnormalavg=0; $qcg_sgtdhardfug1=0; $qcg_sgtdhardfug2=0; $qcg_sgtdhardfug3=0; $qcg_sgtdhardfug4=0; $qcg_sgtdhardfug5=0; $qcg_sgtdhardfug6=0; $qcg_sgtdhardfug7=0; $qcg_sgtdhardfug8=0; $qcg_sgtdhardfugavg=0; $qcg_sgtddead1=0; $qcg_sgtddead2=0; $qcg_sgtddead3=0; $qcg_sgtddead4=0; $qcg_sgtddead5=0; $qcg_sgtddead6=0; $qcg_sgtddead7=0; $qcg_sgtddead8=0; $qcg_sgtddeadavg=0; $qcg_sgtddt=0; $qcg_sgtdvremark=0; $qcg_sgtdflg=0; 
			$qcg_sgtimage=''; $qcg_fgtimage=''; $qcg_sgtdimage=''; $qcg_sgtdremark=''; $qcg_sgtfcimage=''; $qcg_fgtfcimage=''; $qcg_sgtdfcimage=''; $qcg_sgtfcremark=''; $qcg_fgtfcremark=''; $qcg_sgtdfcremark=''; $qcg_sgtremark=''; $qcg_fgtremark='';  $qcg_fgtoprremark=''; $qcg_sgtdoprremark=''; 
			$qcg_sgtnormalb1=0; $qcg_sgtnormalb2=0; $qcg_sgtnormalb3=0; $qcg_sgtnormalb4=0; $qcg_sgtnormalb5=0; $qcg_sgtnormalb6=0; $qcg_sgtnormalb7=0; $qcg_sgtnormalb8=0; $qcg_sgtnormalavga=0; $qcg_sgtnormalavgb=0; $qcg_sgtfug1=0; $qcg_sgtfug2=0; $qcg_sgtfug3=0; $qcg_sgtfug4=0; $qcg_sgtfug5=0; $qcg_sgtfug6=0; $qcg_sgtfug7=0; $qcg_sgtfug8=0; $qcg_sgtfugavg=0; 
			$qcg_vignormalb1=0; $qcg_vignormalb2=0; $qcg_vignormalb3=0; $qcg_vignormalb4=0; $qcg_vignormalb5=0; $qcg_vignormalb6=0; $qcg_vignormalb7=0; $qcg_vignormalb8=0; $qcg_vignormalavga=0; $qcg_vignormalavgb=0;
			
			$qcg_sgtdnormalb1=0; $qcg_sgtdnormalb2=0; $qcg_sgtdnormalb3=0; $qcg_sgtdnormalb4=0; $qcg_sgtdnormalb5=0; $qcg_sgtdnormalb6=0; $qcg_sgtdnormalb7=0; $qcg_sgtdnormalb8=0; $qcg_sgtdnormalavga=0; $qcg_sgtdnormalavgb=0; $qcg_sgtdfug1=0; $qcg_sgtdfug2=0; $qcg_sgtdfug3=0; $qcg_sgtdfug4=0; $qcg_sgtdfug5=0; $qcg_sgtdfug6=0; $qcg_sgtdfug7=0; $qcg_sgtdfug8=0; $qcg_sgtdfugavg=0;
			$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole=''; $qcstatus='';
			$cropname=''; $popularname=''; $seedsize=''; $nosior=0; $nosiorfgt=0; $nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2=""; $srfno='';
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			/*$userSR["sloc"] = $slocs;
			$userSR["qctest"] = $state;*/
			$userSR["sampleno"] = $sampleno;
			/*$userSR["spdate"] = $spdate;
			$userSR["sampflg"] = $sampflg;*/
			$userSR["seedsize"] = $seedsize;
			$userSR["noofseedinonerep"] = $nosior;
			$userSR["noofseedinonerepfgt"] = $nosiorfgt;
					
			$userSR["qcg_testtype"] = $qcg_testtype;
			$userSR["qcg_setupflg"] = $qcg_setupflg;
			$userSR["qcg_seedsize"] = $qcg_seedsize;
			$userSR["qcg_noofseedinonerep"] = $qcg_noofseedinonerep;
			$userSR["qcg_sgtoneobflg"] = $qcg_sgtoneobflg;
			$userSR["qcg_sgtnoofrep"] = $qcg_sgtnoofrep;
			$userSR["qcg_sgtoobnormal1"] = $qcg_sgtoobnormal1;
			$userSR["qcg_sgtoobnormal2"] = $qcg_sgtoobnormal2;
			$userSR["qcg_sgtoobnormal3"] = $qcg_sgtoobnormal3;
			$userSR["qcg_sgtoobnormal4"] = $qcg_sgtoobnormal4;
			$userSR["qcg_sgtoobnormal5"] = $qcg_sgtoobnormal5;
			$userSR["qcg_sgtoobnormal6"] = $qcg_sgtoobnormal6;
			$userSR["qcg_sgtoobnormal7"] = $qcg_sgtoobnormal7;
			$userSR["qcg_sgtoobnormal8"] = $qcg_sgtoobnormal8;
			$userSR["qcg_sgtoobnormalavg"] = $qcg_sgtoobnormalavg;
			$userSR["qcg_sgtoobnormaldt"] = $qcg_sgtoobnormaldt;
			$userSR["qcg_sgtnormal1"] = $qcg_sgtnormal1;
			$userSR["qcg_sgtnormal2"] = $qcg_sgtnormal2;
			$userSR["qcg_sgtnormal3"] = $qcg_sgtnormal3;
			$userSR["qcg_sgtnormal4"] = $qcg_sgtnormal4;
			$userSR["qcg_sgtnormal5"] = $qcg_sgtnormal5;
			$userSR["qcg_sgtnormal6"] = $qcg_sgtnormal6;
			$userSR["qcg_sgtnormal7"] = $qcg_sgtnormal7;
			$userSR["qcg_sgtnormal8"] = $qcg_sgtnormal8;
			$userSR["qcg_sgtnormalavg"] = $qcg_sgtnormalavg;
			$userSR["qcg_sgtabnormal1"] = $qcg_sgtabnormal1;
			$userSR["qcg_sgtabnormal2"] = $qcg_sgtabnormal2;
			$userSR["qcg_sgtabnormal3"] = $qcg_sgtabnormal3;
			$userSR["qcg_sgtabnormal4"] = $qcg_sgtabnormal4;
			$userSR["qcg_sgtabnormal5"] = $qcg_sgtabnormal5;
			$userSR["qcg_sgtabnormal6"] = $qcg_sgtabnormal6;
			$userSR["qcg_sgtabnormal7"] = $qcg_sgtabnormal7;
			$userSR["qcg_sgtabnormal8"] = $qcg_sgtabnormal8;
			$userSR["qcg_sgtabnormalavg"] = $qcg_sgtabnormalavg;
			$userSR["qcg_sgthardfug1"] = $qcg_sgthardfug1;
			$userSR["qcg_sgthardfug2"] = $qcg_sgthardfug2;
			$userSR["qcg_sgthardfug3"] = $qcg_sgthardfug3;
			$userSR["qcg_sgthardfug4"] = $qcg_sgthardfug4;
			$userSR["qcg_sgthardfug5"] = $qcg_sgthardfug5;
			$userSR["qcg_sgthardfug6"] = $qcg_sgthardfug6;
			$userSR["qcg_sgthardfug7"] = $qcg_sgthardfug7;
			$userSR["qcg_sgthardfug8"] = $qcg_sgthardfug8;
			$userSR["qcg_sgthardfugavg"] = $qcg_sgthardfugavg;
			$userSR["qcg_sgtdead1"] = $qcg_sgtdead1;
			$userSR["qcg_sgtdead2"] = $qcg_sgtdead2;
			$userSR["qcg_sgtdead3"] = $qcg_sgtdead3;
			$userSR["qcg_sgtdead4"] = $qcg_sgtdead4;
			$userSR["qcg_sgtdead5"] = $qcg_sgtdead5;
			$userSR["qcg_sgtdead6"] = $qcg_sgtdead6;
			$userSR["qcg_sgtdead7"] = $qcg_sgtdead7;
			$userSR["qcg_sgtdead8"] = $qcg_sgtdead8;
			$userSR["qcg_sgtdeadavg"] = $qcg_sgtdeadavg;
			$userSR["qcg_sgtdt"] = $qcg_sgtdt;
			$userSR["qcg_sgtvremark"] = $qcg_sgtvremark;
			$userSR["qcg_sgtflg"] = $qcg_sgtflg;
			$userSR["qcg_vigtesttype"] = $qcg_vigtesttype;
			$userSR["qcg_vigoneobflg"] = $qcg_vigoneobflg;
			$userSR["qcg_vignoofrep"] = $qcg_vignoofrep;
			$userSR["qcg_vigoobnormal1"] = $qcg_vigoobnormal1;
			$userSR["qcg_vigoobnormal2"] = $qcg_vigoobnormal2;
			$userSR["qcg_vigoobnormal3"] = $qcg_vigoobnormal3;
			$userSR["qcg_vigoobnormal4"] = $qcg_vigoobnormal4;
			$userSR["qcg_vigoobnormal5"] = $qcg_vigoobnormal5;
			$userSR["qcg_vigoobnormal6"] = $qcg_vigoobnormal6;
			$userSR["qcg_vigoobnormal7"] = $qcg_vigoobnormal7;
			$userSR["qcg_vigoobnormal8"] = $qcg_vigoobnormal8;
			$userSR["qcg_vigoobnormalavg"] = $qcg_vigoobnormalavg;
			$userSR["qcg_vigoobnormaldt"] = $qcg_vigoobnormaldt;
			$userSR["qcg_vignormal1"] = $qcg_vignormal1;
			$userSR["qcg_vignormal2"] = $qcg_vignormal2;
			$userSR["qcg_vignormal3"] = $qcg_vignormal3;
			$userSR["qcg_vignormal4"] = $qcg_vignormal4;
			$userSR["qcg_vignormal5"] = $qcg_vignormal5;
			$userSR["qcg_vignormal6"] = $qcg_vignormal6;
			$userSR["qcg_vignormal7"] = $qcg_vignormal7;
			$userSR["qcg_vignormal8"] = $qcg_vignormal8;
			$userSR["qcg_vignormalavg"] = $qcg_vignormalavg;
			$userSR["qcg_vigabnormal1"] = $qcg_vigabnormal1;
			$userSR["qcg_vigabnormal2"] = $qcg_vigabnormal2;
			$userSR["qcg_vigabnormal3"] = $qcg_vigabnormal3;
			$userSR["qcg_vigabnormal4"] = $qcg_vigabnormal4;
			$userSR["qcg_vigabnormal5"] = $qcg_vigabnormal5;
			$userSR["qcg_vigabnormal6"] = $qcg_vigabnormal6;
			$userSR["qcg_vigabnormal7"] = $qcg_vigabnormal7;
			$userSR["qcg_vigabnormal8"] = $qcg_vigabnormal8;
			$userSR["qcg_vigabnormalavg"] = $qcg_vigabnormalavg;
			$userSR["qcg_vigdead1"] = $qcg_vigdead1;
			$userSR["qcg_vigdead2"] = $qcg_vigdead2;
			$userSR["qcg_vigdead3"] = $qcg_vigdead3;
			$userSR["qcg_vigdead4"] = $qcg_vigdead4;
			$userSR["qcg_vigdead5"] = $qcg_vigdead5;
			$userSR["qcg_vigdead6"] = $qcg_vigdead6;
			$userSR["qcg_vigdead7"] = $qcg_vigdead7;
			$userSR["qcg_vigdead8"] = $qcg_vigdead8;
			$userSR["qcg_vigdeadavg"] = $qcg_vigdeadavg;
			$userSR["qcg_viglogid"] = $qcg_viglogid;
			$userSR["qcg_vigdt"] = $qcg_vigdt;
			$userSR["qcg_viggermp"] = $qcg_viggermp;
			$userSR["qcg_vigflg"] = $qcg_vigflg;
			$userSR["qcg_vigvremark"] = $qcg_vigvremark;
			$userSR["qcg_oprremark"] = $qcg_oprremark;
			$userSR["fingermpflg"] = $fingermpflg;
			$userSR["qcg_noofseedinonerepfgt"] = $qcg_noofseedinonerepfgt;
			
			
			//$userSR["noofseedinonerepsgtd"] = $nosiorsgtd;
			$userSR["qcg_noofseedinonerepsgtd"] = $qcg_noofseedinonerepsgtd;
			$userSR["qcg_sgtdoneobflg"] = $qcg_sgtdoneobflg;
			$userSR["qcg_sgtdnoofrep"] = $qcg_sgtdnoofrep;
			$userSR["qcg_sgtdoobnormal1"] = $qcg_sgtdoobnormal1;
			$userSR["qcg_sgtdoobnormal2"] = $qcg_sgtdoobnormal2;
			$userSR["qcg_sgtdoobnormal3"] = $qcg_sgtdoobnormal3;
			$userSR["qcg_sgtdoobnormal4"] = $qcg_sgtdoobnormal4;
			$userSR["qcg_sgtdoobnormal5"] = $qcg_sgtdoobnormal5;
			$userSR["qcg_sgdtoobnormal6"] = $qcg_sgdtoobnormal6;
			$userSR["qcg_sgtdoobnormal7"] = $qcg_sgtdoobnormal7;
			$userSR["qcg_sgdtoobnormal8"] = $qcg_sgtdoobnormal8;
			$userSR["qcg_sgtdoobnormalavg"] = $qcg_sgtdoobnormalavg;
			$userSR["qcg_sgtdoobnormaldt"] = $qcg_sgtdoobnormaldt;
			$userSR["qcg_sgtdnormal1"] = $qcg_sgtdnormal1;
			$userSR["qcg_sgtdnormal2"] = $qcg_sgtdnormal2;
			$userSR["qcg_sgtdnormal3"] = $qcg_sgtdnormal3;
			$userSR["qcg_sgtdnormal4"] = $qcg_sgtdnormal4;
			$userSR["qcg_sgtdnormal5"] = $qcg_sgtdnormal5;
			$userSR["qcg_sgtdnormal6"] = $qcg_sgtdnormal6;
			$userSR["qcg_sgtdnormal7"] = $qcg_sgtdnormal7;
			$userSR["qcg_sgtdnormal8"] = $qcg_sgtdnormal8;
			$userSR["qcg_sgtdnormalavg"] = $qcg_sgtdnormalavg;
			$userSR["qcg_sgtdabnormal1"] = $qcg_sgtdabnormal1;
			$userSR["qcg_sgtdabnormal2"] = $qcg_sgtdabnormal2;
			$userSR["qcg_sgtdabnormal3"] = $qcg_sgtdabnormal3;
			$userSR["qcg_sgtdabnormal4"] = $qcg_sgtdabnormal4;
			$userSR["qcg_sgtdabnormal5"] = $qcg_sgtdabnormal5;
			$userSR["qcg_sgtdabnormal6"] = $qcg_sgtdabnormal6;
			$userSR["qcg_sgtdabnormal7"] = $qcg_sgtdabnormal7;
			$userSR["qcg_sgtdabnormal8"] = $qcg_sgtdabnormal8;
			$userSR["qcg_sgtdabnormalavg"] = $qcg_sgtdabnormalavg;
			$userSR["qcg_sgtdhardfug1"] = $qcg_sgtdhardfug1;
			$userSR["qcg_sgtdhardfug2"] = $qcg_sgtdhardfug2;
			$userSR["qcg_sgtdhardfug3"] = $qcg_sgtdhardfug3;
			$userSR["qcg_sgtdhardfug4"] = $qcg_sgtdhardfug4;
			$userSR["qcg_sgtdhardfug5"] = $qcg_sgtdhardfug5;
			$userSR["qcg_sgtdhardfug6"] = $qcg_sgtdhardfug6;
			$userSR["qcg_sgtdhardfug7"] = $qcg_sgtdhardfug7;
			$userSR["qcg_sgtdhardfug8"] = $qcg_sgtdhardfug8;
			$userSR["qcg_sgtdhardfugavg"] = $qcg_sgtdhardfugavg;
			$userSR["qcg_sgtddead1"] = $qcg_sgtddead1;
			$userSR["qcg_sgtddead2"] = $qcg_sgtddead2;
			$userSR["qcg_sgtddead3"] = $qcg_sgtddead3;
			$userSR["qcg_sgtddead4"] = $qcg_sgtddead4;
			$userSR["qcg_sgtddead5"] = $qcg_sgtddead5;
			$userSR["qcg_sgtddead6"] = $qcg_sgtddead6;
			$userSR["qcg_sgtddead7"] = $qcg_sgtddead7;
			$userSR["qcg_sgtddead8"] = $qcg_sgtddead8;
			$userSR["qcg_sgtddeadavg"] = $qcg_sgtddeadavg;
			$userSR["qcg_sgtddt"] = $qcg_sgtddt;
			$userSR["qcg_sgtdvremark"] = $qcg_sgtdvremark;
			$userSR["qcg_sgtdflg"] = $qcg_sgtdflg;
			
			$userSR["qcg_sgtimage"] = $qcg_sgtimage;
			$userSR["qcg_fgtimage"] = $qcg_fgtimage;
			$userSR["qcg_sgtdimage"] = $qcg_sgtdimage;
			$userSR["qcg_sgtremark"] = $qcg_sgtremark;
			$userSR["qcg_fgtremark"] = $qcg_fgtremark;
			$userSR["qcg_sgtdremark"] = $qcg_sgtdremark;
			$userSR["qcg_sgtfcimage"] = $qcg_sgtfcimage;
			$userSR["qcg_fgtfcimage"] = $qcg_fgtfcimage;
			$userSR["qcg_sgtdfcimage"] = $qcg_sgtdfcimage;
			$userSR["qcg_sgtfcremark"] = $qcg_sgtfcremark;
			$userSR["qcg_fgtfcremark"] = $qcg_fgtfcremark;
			$userSR["qcg_sgtdfcremark"] = $qcg_sgtdfcremark;
			
			$userSR["qcg_fgtoprremark"] = $qcg_fgtoprremark;
			$userSR["qcg_sgtdoprremark"] = $qcg_sgtdoprremark;
			
			$userSR["qcg_sgtnormalb1"] = $qcg_sgtnormalb1;
			$userSR["qcg_sgtnormalb2"] = $qcg_sgtnormalb2;
			$userSR["qcg_sgtnormalb3"] = $qcg_sgtnormalb3;
			$userSR["qcg_sgtnormalb4"] = $qcg_sgtnormalb4;
			$userSR["qcg_sgtnormalb5"] = $qcg_sgtnormalb5;
			$userSR["qcg_sgtnormalb6"] = $qcg_sgtnormalb6;
			$userSR["qcg_sgtnormalb7"] = $qcg_sgtnormalb7;
			$userSR["qcg_sgtnormalb8"] = $qcg_sgtnormalb8;
			$userSR["qcg_sgtnormalavga"] = $qcg_sgtnormalavga;
			$userSR["qcg_sgtnormalavgb"] = $qcg_sgtnormalavgb;
			$userSR["qcg_sgtfug1"] = $qcg_sgtfug1;
			$userSR["qcg_sgtfug2"] = $qcg_sgtfug2;
			$userSR["qcg_sgtfug3"] = $qcg_sgtfug3;
			$userSR["qcg_sgtfug4"] = $qcg_sgtfug4;
			$userSR["qcg_sgtfug5"] = $qcg_sgtfug5;
			$userSR["qcg_sgtfug6"] = $qcg_sgtfug6;
			$userSR["qcg_sgtfug7"] = $qcg_sgtfug7;
			$userSR["qcg_sgtfug8"] = $qcg_sgtfug8;
			$userSR["qcg_sgtfugavg"] = $qcg_sgtfugavg;
			$userSR["qcg_vignormalb1"] = $qcg_vignormalb1;
			$userSR["qcg_vignormalb2"] = $qcg_vignormalb2;
			$userSR["qcg_vignormalb3"] = $qcg_vignormalb3;
			$userSR["qcg_vignormalb4"] = $qcg_vignormalb4;
			$userSR["qcg_vignormalb5"] = $qcg_vignormalb5;
			$userSR["qcg_vignormalb6"] = $qcg_vignormalb6;
			$userSR["qcg_vignormalb7"] = $qcg_vignormalb7;
			$userSR["qcg_vignormalb8"] = $qcg_vignormalb8;
			$userSR["qcg_vignormalavga"] = $qcg_vignormalavga;
			$userSR["qcg_vignormalavgb"] = $qcg_vignormalavgb;
			$userSR["qcg_sgtdnormalb1"] = $qcg_sgtdnormalb1;
			$userSR["qcg_sgtdnormalb2"] = $qcg_sgtdnormalb2;
			$userSR["qcg_sgtdnormalb3"] = $qcg_sgtdnormalb3;
			$userSR["qcg_sgtdnormalb4"] = $qcg_sgtdnormalb4;
			$userSR["qcg_sgtdnormalb5"] = $qcg_sgtdnormalb5;
			$userSR["qcg_sgtdnormalb6"] = $qcg_sgtdnormalb6;
			$userSR["qcg_sgtdnormalb7"] = $qcg_sgtdnormalb7;
			$userSR["qcg_sgtdnormalb8"] = $qcg_sgtdnormalb8;
			$userSR["qcg_sgtdnormalavga"] = $qcg_sgtdnormalavga;
			$userSR["qcg_sgtdnormalavgb"] = $qcg_sgtdnormalavgb;
			$userSR["qcg_sgtdfug1"] = $qcg_sgtdfug1;
			$userSR["qcg_sgtdfug2"] = $qcg_sgtdfug2;
			$userSR["qcg_sgtdfug3"] = $qcg_sgtdfug3;
			$userSR["qcg_sgtdfug4"] = $qcg_sgtdfug4;
			$userSR["qcg_sgtdfug5"] = $qcg_sgtdfug5;
			$userSR["qcg_sgtdfug6"] = $qcg_sgtdfug6;
			$userSR["qcg_sgtdfug7"] = $qcg_sgtdfug7;
			$userSR["qcg_sgtdfug8"] = $qcg_sgtdfug8;
			$userSR["qcg_sgtdfugavg"] = $qcg_sgtdfugavg;
			
					
			$userSR["srfno"] = $srfno;
			$userSR["flg"] = 1;
			array_push($user24,$userSR);
            $stmt->close();
           // return false;
        }
		return $userSR;
		/*if(empty($userSR))
		{return false;}
		else
		{return $userSR;}*/
    }


	public function GetGempSetupUpdate($sampleno, $testtype, $sgtnorep, $fgtnorep, $fgtmtype, $docsrefno, $dbtnorep) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $sdt=date("d-m-Y");
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT qcg_sampleno FROM tbl_qcgdata where qcg_sampleno=? and qcg_retestflg=0");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows == 0) 
			{
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior, nosiorfgt FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior, $nosiorfgt);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				
				//$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgdata (qcg_sampleno, qcg_testtype, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtnoofrep, qcg_vigtesttype, qcg_vignoofrep, qcg_setupflg, qcg_setupdt, qcg_noofseedinonerepfgt, qcg_docsrefno, qcg_dbtnorep, qcg_sgtdnoofrep) values(?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				//$stmt_samp->bind_param("sssssssisisss", $sampleno, $testtype, $seedsize, $nosior, $sgtnorep, $fgtmtype, $fgtnorep, $one, $sdt, $nosiorfgt, $docsrefno, $dbtnorep, $dbtnorep);
				$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgdata (qcg_sampleno, qcg_testtype, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtnoofrep, qcg_vigtesttype, qcg_vignoofrep, qcg_setupflg, qcg_setupdt, qcg_noofseedinonerepfgt, qcg_docsrefno, qcg_dbtnorep, qcg_sgtdnoofrep, qcg_crop, qcg_variety, qcg_lotno) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_samp->bind_param("sssssssisissssss", $sampleno, $testtype, $seedsize, $nosior, $sgtnorep, $fgtmtype, $fgtnorep, $one, $sdt, $nosiorfgt, $docsrefno, $dbtnorep, $dbtnorep, $crop, $variety, $lotno);
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			$stmtsamp->close();	
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	
	public function GetGempDataUpdate($sampleno, $testtype, $sgtfcfltype, $fgtfcfltype, $fgtmtype, $seedsize, $noofseedinonerep, $sgtnoofrep, $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $sgtdt, $sgtvremark, $fgtnoofrep, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $fgtdt, $fgtvremark, $oprremark, $scode, $noofseedinonerepfgt, $remarks, $new_retImageString_ret, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $fgtnormalb1, $fgtnormalb2, $fgtnormalb3, $fgtnormalb4, $fgtnormalb5, $fgtnormalb6, $fgtnormalb7, $fgtnormalb8, $fgtnormalavga, $fgtnormalavgb, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $sdt=date("d-m-Y"); $fdt=date("Y-m-d");
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT qcg_sampleno FROM tbl_qcgdata where qcg_sampleno=? and qcg_germpflg!=1 and qcg_retestflg=0");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows > 0) 
			{
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior, nosiorfgt FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior, $nosiorfgt);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				
				if($testtype=="SGT")
				{
					if($sgtfcfltype=="First Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtoobnormal1=?, qcg_sgtoobnormal2=?, qcg_sgtoobnormal3=?, qcg_sgtoobnormal4=?, qcg_sgtoobnormal5=?, qcg_sgtoobnormal6=?, qcg_sgtoobnormal7=?, qcg_sgtoobnormal8=?, qcg_sgtoobnormalavg=?, qcg_sgtoobnormaldt=?, qcg_sgtoobnormallogid=?, qcg_sgtoneobflg=?, qcg_sgtfcremark=?, qcg_sgtfcimage=?, qcg_sgtfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiississis", $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $scode, $one, $remarks, $new_retImageString_ret, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtoobnormal1=?, qcg_sgtoobnormal2=?, qcg_sgtoobnormal3=?, qcg_sgtoobnormal4=?, qcg_sgtoobnormal5=?, qcg_sgtoobnormal6=?, qcg_sgtoobnormal7=?, qcg_sgtoobnormal8=?, qcg_sgtoobnormalavg=?, qcg_sgtoobnormaldt=?, qcg_sgtoobnormallogid=?, qcg_sgtoneobflg=?, qcg_sgtfcremark=?, qcg_sgtfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiissisis", $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $scode, $one, $remarks, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
					
					if($sgtfcfltype=="Final Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtnormal1=?, qcg_sgtnormal2=?, qcg_sgtnormal3=?, qcg_sgtnormal4=?, qcg_sgtnormal5=?, qcg_sgtnormal6=?, qcg_sgtnormal7=?, qcg_sgtnormal8=?, qcg_sgtnormalavg=?, qcg_sgtabnormal1=?, qcg_sgtabnormal2=?, qcg_sgtabnormal3=?, qcg_sgtabnormal4=?, qcg_sgtabnormal5=?, qcg_sgtabnormal6=?, qcg_sgtabnormal7=?, qcg_sgtabnormal8=?, qcg_sgtabnormalavg=?, qcg_sgthardfug1=?, qcg_sgthardfug2=?, qcg_sgthardfug3=?, qcg_sgthardfug4=?, qcg_sgthardfug5=?, qcg_sgthardfug6=?, qcg_sgthardfug7=?, qcg_sgthardfug8=?, qcg_sgthardfugavg=?, qcg_sgtdead1=?, qcg_sgtdead2=?, qcg_sgtdead3=?, qcg_sgtdead4=?, qcg_sgtdead5=?, qcg_sgtdead6=?, qcg_sgtdead7=?, qcg_sgtdead8=?, qcg_sgtdeadavg=?, qcg_sgtlogid=?, qcg_sgtdt=?, qcg_sgtgermp=?, qcg_sgtflg=?, qcg_sgtvremark=?, qcg_oprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_sgtremark=?, qcg_sgtimage=?,  qcg_sgtnormalb1=?, qcg_sgtnormalb2=?, qcg_sgtnormalb3=?, qcg_sgtnormalb4=?, qcg_sgtnormalb5=?, qcg_sgtnormalb6=?, qcg_sgtnormalb7=?, qcg_sgtnormalb8=?, qcg_sgtnormalavga=?, qcg_sgtnormalavgb=?, qcg_sgtfug1=?, qcg_sgtfug2=?, qcg_sgtfug3=?, qcg_sgtfug4=?, qcg_sgtfug5=?, qcg_sgtfug6=?, qcg_sgtfug7=?, qcg_sgtfug8=?, qcg_sgtfugavg=?, qcg_sgtfncopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissiississsiiiiiiiiiiiiiiiiiiiis", $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $scode, $sgtdt, $sgtgermp, $one, $sgtvremark, $oprremark, $two, $fdt, $remarks, $new_retImageString_ret, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtnormal1=?, qcg_sgtnormal2=?, qcg_sgtnormal3=?, qcg_sgtnormal4=?, qcg_sgtnormal5=?, qcg_sgtnormal6=?, qcg_sgtnormal7=?, qcg_sgtnormal8=?, qcg_sgtnormalavg=?, qcg_sgtabnormal1=?, qcg_sgtabnormal2=?, qcg_sgtabnormal3=?, qcg_sgtabnormal4=?, qcg_sgtabnormal5=?, qcg_sgtabnormal6=?, qcg_sgtabnormal7=?, qcg_sgtabnormal8=?, qcg_sgtabnormalavg=?, qcg_sgthardfug1=?, qcg_sgthardfug2=?, qcg_sgthardfug3=?, qcg_sgthardfug4=?, qcg_sgthardfug5=?, qcg_sgthardfug6=?, qcg_sgthardfug7=?, qcg_sgthardfug8=?, qcg_sgthardfugavg=?, qcg_sgtdead1=?, qcg_sgtdead2=?, qcg_sgtdead3=?, qcg_sgtdead4=?, qcg_sgtdead5=?, qcg_sgtdead6=?, qcg_sgtdead7=?, qcg_sgtdead8=?, qcg_sgtdeadavg=?, qcg_sgtlogid=?, qcg_sgtdt=?, qcg_sgtgermp=?, qcg_sgtflg=?, qcg_sgtvremark=?, qcg_oprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_sgtremark=?,  qcg_sgtnormalb1=?, qcg_sgtnormalb2=?, qcg_sgtnormalb3=?, qcg_sgtnormalb4=?, qcg_sgtnormalb5=?, qcg_sgtnormalb6=?, qcg_sgtnormalb7=?, qcg_sgtnormalb8=?, qcg_sgtnormalavga=?, qcg_sgtnormalavgb=?, qcg_sgtfug1=?, qcg_sgtfug2=?, qcg_sgtfug3=?, qcg_sgtfug4=?, qcg_sgtfug5=?, qcg_sgtfug6=?, qcg_sgtfug7=?, qcg_sgtfug8=?, qcg_sgtfugavg=?, qcg_sgtfncopr=?  where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissiississiiiiiiiiiiiiiiiiiiiis", $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $scode, $sgtdt, $sgtgermp, $one, $sgtvremark, $oprremark, $two, $fdt, $remarks, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
			
				}
				
				if($testtype=="FGT")
				{
					if($fgtfcfltype=="First Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vigoobnormal1=?, qcg_vigoobnormal2=?, qcg_vigoobnormal3=?, qcg_vigoobnormal4=?, qcg_vigoobnormal5=?, qcg_vigoobnormal6=?, qcg_vigoobnormal7=?, qcg_vigoobnormal8=?, qcg_vigoobnormalavg=?, qcg_vigoobnormaldt=?, qcg_vigoobnormallogid=?, qcg_vigoneobflg=?, qcg_fgtfcremark=?, qcg_fgtfcimage=?, qcg_fgtfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("siiiiiiiiississis", $fgtmtype, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $scode, $one, $remarks, $new_retImageString_ret, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vigoobnormal1=?, qcg_vigoobnormal2=?, qcg_vigoobnormal3=?, qcg_vigoobnormal4=?, qcg_vigoobnormal5=?, qcg_vigoobnormal6=?, qcg_vigoobnormal7=?, qcg_vigoobnormal8=?, qcg_vigoobnormalavg=?, qcg_vigoobnormaldt=?, qcg_vigoobnormallogid=?, qcg_vigoneobflg=?, qcg_fgtfcremark=?, qcg_fgtfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("siiiiiiiiissisis", $fgtmtype, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $scode, $one, $remarks, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
					
					if($fgtfcfltype=="Final Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vignormal1=?, qcg_vignormal2=?, qcg_vignormal3=?, qcg_vignormal4=?, qcg_vignormal5=?, qcg_vignormal6=?, qcg_vignormal7=?, qcg_vignormal8=?, qcg_vignormalavg=?, qcg_vigabnormal1=?, qcg_vigabnormal2=?, qcg_vigabnormal3=?, qcg_vigabnormal4=?, qcg_vigabnormal5=?, qcg_vigabnormal6=?, qcg_vigabnormal7=?, qcg_vigabnormal8=?, qcg_vigabnormalavg=?, qcg_vigdead1=?, qcg_vigdead2=?, qcg_vigdead3=?, qcg_vigdead4=?, qcg_vigdead5=?, qcg_vigdead6=?, qcg_vigdead7=?, qcg_vigdead8=?, qcg_vigdeadavg=?, qcg_viglogid=?, qcg_vigdt=?, qcg_viggermp=?, qcg_vigflg=?, qcg_vigvremark=?, qcg_fgtoprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_fgtremark=?, qcg_fgtimage=?, qcg_vignormalb1=?, qcg_vignormalb2=?, qcg_vignormalb3=?, qcg_vignormalb4=?, qcg_vignormalb5=?, qcg_vignormalb6=?, qcg_vignormalb7=?, qcg_vignormalb8=?, qcg_vignormalavga=?, qcg_vignormalavgb=?, qcg_fgtfncopr=?  where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("siiiiiiiiiiiiiiiiiiiiiiiiiiissiississsiiiiiiiiiiis", $fgtmtype, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $scode, $fgtdt, $fgtgermp, $one, $fgtvremark, $oprremark, $two, $fdt, $remarks, $new_retImageString_ret, $fgtnormalb1, $fgtnormalb2, $fgtnormalb3, $fgtnormalb4, $fgtnormalb5, $fgtnormalb6, 	$fgtnormalb7, $fgtnormalb8, $fgtnormalavga, $fgtnormalavgb, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vignormal1=?, qcg_vignormal2=?, qcg_vignormal3=?, qcg_vignormal4=?, qcg_vignormal5=?, qcg_vignormal6=?, qcg_vignormal7=?, qcg_vignormal8=?, qcg_vignormalavg=?, qcg_vigabnormal1=?, qcg_vigabnormal2=?, qcg_vigabnormal3=?, qcg_vigabnormal4=?, qcg_vigabnormal5=?, qcg_vigabnormal6=?, qcg_vigabnormal7=?, qcg_vigabnormal8=?, qcg_vigabnormalavg=?, qcg_vigdead1=?, qcg_vigdead2=?, qcg_vigdead3=?, qcg_vigdead4=?, qcg_vigdead5=?, qcg_vigdead6=?, qcg_vigdead7=?, qcg_vigdead8=?, qcg_vigdeadavg=?, qcg_viglogid=?, qcg_vigdt=?, qcg_viggermp=?, qcg_vigflg=?, qcg_vigvremark=?, qcg_fgtoprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_fgtremark=?, qcg_vignormalb1=?, qcg_vignormalb2=?, qcg_vignormalb3=?, qcg_vignormalb4=?, qcg_vignormalb5=?, qcg_vignormalb6=?, qcg_vignormalb7=?, qcg_vignormalb8=?, qcg_vignormalavga=?, qcg_vignormalavgb=?, qcg_fgtfncopr=?    where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("siiiiiiiiiiiiiiiiiiiiiiiiiiissiississiiiiiiiiiiis", $fgtmtype, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $scode, $fgtdt, $fgtgermp, $one, $fgtvremark, $oprremark, $two, $fdt, $remarks, $fgtnormalb1, $fgtnormalb2, $fgtnormalb3, $fgtnormalb4, $fgtnormalb5, $fgtnormalb6, 	$fgtnormalb7, $fgtnormalb8, $fgtnormalavga, $fgtnormalavgb, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
				
				}
				
				if($testtype=="SGT with SGTD")
				{
					if($sgtfcfltype=="First Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdoobnormal1=?,  qcg_sgtdoobnormal2=?, qcg_sgtdoobnormal3=?, qcg_sgtdoobnormal4=?, qcg_sgtdoobnormal5=?, qcg_sgdtoobnormal6=?, qcg_sgtdoobnormal7=?, qcg_sgtdoobnormal8=?, qcg_sgtdoobnormalavg=?, qcg_sgtdoobnormaldt=?, qcg_sgtdoobnormallogid=?, qcg_sgtdoneobflg=?, qcg_sgtdfcremark=?, qcg_sgtdfcimage=?, qcg_sgtdfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiississis", $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $scode, $one, $remarks, $new_retImageString_ret, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdoobnormal1=?,  qcg_sgtdoobnormal2=?, qcg_sgtdoobnormal3=?, qcg_sgtdoobnormal4=?, qcg_sgtdoobnormal5=?, qcg_sgdtoobnormal6=?, qcg_sgtdoobnormal7=?, qcg_sgtdoobnormal8=?, qcg_sgtdoobnormalavg=?, qcg_sgtdoobnormaldt=?, qcg_sgtdoobnormallogid=?, qcg_sgtdoneobflg=?, qcg_sgtdfcremark=?, qcg_sgtdfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiissisis", $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $scode, $one, $remarks, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
					
					if($sgtfcfltype=="Final Count")
					{
						if($new_retImageString_ret!="")
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdnormal1=?,  qcg_sgtdnormal2=?, qcg_sgtdnormal3=?, qcg_sgtdnormal4=?, qcg_sgtdnormal5=?, qcg_sgtdnormal6=?, qcg_sgtdnormal7=?, qcg_sgtdnormal8=?, qcg_sgtdnormalavg=?, qcg_sgtdabnormal1=?, qcg_sgtdabnormal2=?, qcg_sgtdabnormal3=?, qcg_sgtdabnormal4=?, qcg_sgtdabnormal5=?, qcg_sgtdabnormal6=?, qcg_sgtdabnormal7=?, qcg_sgtdabnormal8=?, qcg_sgtdabnormalavg=?, qcg_sgtdhardfug1=?, qcg_sgtdhardfug2=?, qcg_sgtdhardfug3=?, qcg_sgtdhardfug4=?, qcg_sgtdhardfug5=?,  qcg_sgtdhardfug6=?, qcg_sgtdhardfug7=?, qcg_sgtdhardfug8=?, qcg_sgtdhardfugavg=?,  qcg_sgtddead1=?, qcg_sgtddead2=?, qcg_sgtddead3=?, qcg_sgtddead4=?, qcg_sgtddead5=?, qcg_sgtddead6=?, qcg_sgtddead7=?, qcg_sgtddead8=?,  qcg_sgtddeadavg=?, qcg_sgtdlogid=?, qcg_sgtddt=?, qcg_sgtdgermp=?, qcg_sgtdflg=?, qcg_sgtdvremark=?, qcg_sgtdoprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_sgtdremark=?, qcg_sgtdimage=?,  qcg_sgtdnormalb1=?, qcg_sgtdnormalb2=?, qcg_sgtdnormalb3=?, qcg_sgtdnormalb4=?, qcg_sgtdnormalb5=?, qcg_sgtdnormalb6=?, qcg_sgtdnormalb7=?, qcg_sgtdnormalb8=?, qcg_sgtdnormalavga=?, qcg_sgtdnormalavgb=?, qcg_sgtdfug1=?, qcg_sgtdfug2=?, qcg_sgtdfug3=?, qcg_sgtdfug4=?, qcg_sgtdfug5=?, qcg_sgtdfug6=?, qcg_sgtdfug7=?, qcg_sgtdfug8=?, qcg_sgtdfugavg=?, qcg_sgtdfncopr=?   where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissiississsiiiiiiiiiiiiiiiiiiiis", $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $scode, $sgtdt, $sgtgermp, $one, $sgtvremark, $oprremark, $two, $fdt, $remarks, $new_retImageString_ret, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $oprid, $sampleno);
						}
						else
						{
							$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdnormal1=?,  qcg_sgtdnormal2=?, qcg_sgtdnormal3=?, qcg_sgtdnormal4=?, qcg_sgtdnormal5=?, qcg_sgtdnormal6=?, qcg_sgtdnormal7=?, qcg_sgtdnormal8=?, qcg_sgtdnormalavg=?, qcg_sgtdabnormal1=?, qcg_sgtdabnormal2=?, qcg_sgtdabnormal3=?, qcg_sgtdabnormal4=?, qcg_sgtdabnormal5=?, qcg_sgtdabnormal6=?, qcg_sgtdabnormal7=?, qcg_sgtdabnormal8=?, qcg_sgtdabnormalavg=?, qcg_sgtdhardfug1=?, qcg_sgtdhardfug2=?, qcg_sgtdhardfug3=?, qcg_sgtdhardfug4=?, qcg_sgtdhardfug5=?,  qcg_sgtdhardfug6=?, qcg_sgtdhardfug7=?, qcg_sgtdhardfug8=?, qcg_sgtdhardfugavg=?,  qcg_sgtddead1=?, qcg_sgtddead2=?, qcg_sgtddead3=?, qcg_sgtddead4=?, qcg_sgtddead5=?, qcg_sgtddead6=?, qcg_sgtddead7=?, qcg_sgtddead8=?,  qcg_sgtddeadavg=?, qcg_sgtdlogid=?, qcg_sgtddt=?, qcg_sgtdgermp=?, qcg_sgtdflg=?, qcg_sgtdvremark=?, qcg_sgtdoprremark=?, qcg_germpflg=?, qcg_germpdatadt=?, qcg_sgtdremark=?,  qcg_sgtdnormalb1=?, qcg_sgtdnormalb2=?, qcg_sgtdnormalb3=?, qcg_sgtdnormalb4=?, qcg_sgtdnormalb5=?, qcg_sgtdnormalb6=?, qcg_sgtdnormalb7=?, qcg_sgtdnormalb8=?, qcg_sgtdnormalavga=?, qcg_sgtdnormalavgb=?, qcg_sgtdfug1=?, qcg_sgtdfug2=?, qcg_sgtdfug3=?, qcg_sgtdfug4=?, qcg_sgtdfug5=?, qcg_sgtdfug6=?, qcg_sgtdfug7=?, qcg_sgtdfug8=?, qcg_sgtdfugavg=?, qcg_sgtdfncopr=?  where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
							$stmt_samp->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissiississiiiiiiiiiiiiiiiiiiiis", $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $scode, $sgtdt, $sgtgermp, $one, $sgtvremark, $oprremark, $two, $fdt, $remarks, $sgtnormalb1, $sgtnormalb2, $sgtnormalb3, $sgtnormalb4, $sgtnormalb5, $sgtnormalb6, $sgtnormalb7, $sgtnormalb8, $sgtnormalavga, $sgtnormalavgb, $sgtfug1, $sgtfug2, $sgtfug3, $sgtfug4, $sgtfug5, $sgtfug6, $sgtfug7, $sgtfug8, $sgtfugavg, $oprid, $sampleno);
						}
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
			
				}
				
			}
			$stmtsamp->close();	
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }



	public function GetSampleInfoGotAck($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		
		//return "SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=$sampno and yearid='$yearid' ORDER BY gottest_tid DESC";
		
		$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=? and yearid=? and plantcode=? ORDER BY gottest_tid DESC");
        $stmt->bind_param("iss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $totnosamp=''; $state=''; $smpdisploc=''; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $dosdate, $crop, $variety, $lotno, $totnosamp, $state, $smpdisploc);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($totnosamp==NULL){$totnosamp=0;} if($state==NULL){$state='';} if($smpdisploc==NULL){$smpdisploc='';} 
			if($dosdate!='' && $dosdate!='0000-00-00' && $dosdate!=NULL)
			{
				$dosdate1=explode("-",$dosdate);
				$dosdate=$dosdate1[2]."-".$dosdate1[1]."-".$dosdate1[0];
			}
			
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			$flg=0;
			$stmtgsampack = $this->conn_ps->prepare("SELECT gotm_sampleno FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
			$stmtgsampack->bind_param("s", $sampleno);
			$resultgsampack=$stmtgsampack->execute();
			$stmtgsampack->store_result();
			if ($stmtgsampack->num_rows > 0) 
			{
				$flg=1;
			}	
			$stmtgsampack->close();
			
			$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0;	
			$stmtgsampack1 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
			$stmtgsampack1->bind_param("s", $sampleno);
			$resultgsampack1=$stmtgsampack1->execute();
			$stmtgsampack1->store_result();
			if ($stmtgsampack1->num_rows > 0) 
			{
				$stmtgsampack1->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg);
				//looping through all the records 
				$stmtgsampack1->fetch();
			}
			$stmtgsampack1->close();
			
			//$userSR["arrival_id"] = $arrival_id;
			//$userSR["flg"] = $flg;
			$userSR["dosdate"] = $dosdate;
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["sampleno"] = $sampleno;
			$userSR["ackflg"] = $gotm_ackflg;
			$userSR["sowingflg"] = $gotm_sowingflg;
			$userSR["transplantflg"] = $gotm_transplantflg;
			$userSR["fieldmflg"] = $gotm_fieldmflg;
			$userSR["finobrflg"] = $gotm_finobrflg;
			$userSR["resamplingflg"] = $gotm_resamplingflg;
			$userSR["retestflg"] = $gotm_retestflg;
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }

	public function GetSampleGOTAcknowledge($scode, $sampleno, $smpdate, $ackremark, $trtype) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		$flg=0;
		
		if($trtype=="Resampling")
		{
			$flg=3;
		}
		else
		{
			//return "SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno='$sampno' and yearid='$yearid' ORDER BY gottest_tid DESC";
			
			$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=? and yearid=? and plantcode=? ORDER BY gottest_tid DESC");
			$stmt->bind_param("iss", $sampno, $yearid, $plantid);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			$tid=0; 
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($gottest_tid, $gottest_dosdate, $gottest_crop, $gottest_variety, $gottest_lotno, $gottest_totnosamp, $gottest_smpdispstate, $gottest_smpdisploc);
				while($stmt->fetch())
				{
					if($smpdate!='' && $smpdate!='00-00-0000' && $smpdate!=NULL)
					{
						$smpdate1=explode("-",$smpdate);
						$smpdate=$smpdate1[2]."-".$smpdate1[1]."-".$smpdate1[0];
					}
					//else {$smpdate='';}
					$dt=date("Y-m-d"); $one=1;
					if($smpdate!='')
					{
						$stmtgsampack = $this->conn_ps->prepare("SELECT gotm_sampleno FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
						$stmtgsampack->bind_param("s", $sampleno);
						$resultgsampack=$stmtgsampack->execute();
						$stmtgsampack->store_result();
						if ($stmtgsampack->num_rows == 0) 
						{
							//return "Insert into tbl_qcgotmain (gotm_tdate, gotm_dosd, gotm_crop, gotm_variety, gotm_lotno, gotm_sampleno, gotm_noofsamples, gotm_dispstate, gotm_disploc, gotm_ackremark, gotm_ackdate, gotm_ackflg, gotm_gottid, gotm_acklogid) values('$dt', '$gottest_dosdate', '$gottest_crop', '$gottest_variety', '$gottest_lotno', '$sampleno', '$gottest_totnosamp', '$gottest_smpdispstate', '$gottest_smpdisploc', '$ackremark', '$dt', '$one', '$gottest_tid', '$scode') ";
							$croptype='';
							$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, croptype FROM tblcrop WHERE cropid = ? ");
							$stmt_crop->bind_param("i", $gottest_crop);
							$result_crop=$stmt_crop->execute();
							$stmt_crop->store_result();
							if ($stmt_crop->num_rows > 0) {
								$stmt_crop->bind_result($cropid, $cropname, $croptype);
								//looping through all the records 
								$stmt_crop->fetch();
								$stmt_crop->close();
							}
							$stmt_gotsampack = $this->conn_ps->prepare("Insert into tbl_qcgotmain (gotm_tdate, gotm_dosd, gotm_crop, gotm_variety, gotm_lotno, gotm_sampleno, gotm_noofsamples, gotm_dispstate, gotm_disploc, gotm_ackremark, gotm_ackdate, gotm_ackflg, gotm_gottid, gotm_acklogid, gotm_croptype) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
							$stmt_gotsampack->bind_param("sssssssssssiiss", $dt, $gottest_dosdate, $gottest_crop, $gottest_variety, $gottest_lotno, $sampleno, $gottest_totnosamp, $gottest_smpdispstate, $gottest_smpdisploc, $ackremark, $dt, $one, $gottest_tid, $scode, $croptype);
							$result_gotsampack=$stmt_gotsampack->execute();
							if($result_gotsampack)
							{
								$flg=1;
							
								/*$stmt_got = $this->conn_ps->prepare("UPDATE tbl_gottest SET gottest_spdate=?, gottest_bflg=? WHERE gottest_sampleno=? and yearid=? ");
								$stmt_got->bind_param("siss", $smpdate, $one, $sampno, $yearid);
								$result_got=$stmt_got->execute();
								$stmt_got->close();*/
							}
							$stmt_gotsampack->close();
						}
						else
						{
							$flg=2;
						}
						$stmtgsampack->close();
					}
				}
			}
		}
		return $flg;
		/*if($flg==0)
		{return false;}
		else
		{return true;}*/
    }

	


	public function GetSampleDataInfoGot($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		//return "SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc, gottest_srdate, gottest_spdate, gottest_trstage  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno='$sampno' and yearid='$yearid' ORDER BY gottest_tid DESC";
		
		$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc, gottest_srdate, gottest_spdate, gottest_trstage  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=? and yearid=? and plantcode=? ORDER BY gottest_tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $totnosamp=''; $state=''; $smpdisploc=''; $srdate=''; $spdate=''; $trstage='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $dosdate, $crop, $variety, $lotno, $totnosamp, $state, $smpdisploc, $srdate, $spdate, $trstage);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($totnosamp==NULL){$totnosamp=0;} if($state==NULL){$state='';} if($smpdisploc==NULL){$smpdisploc='';} 
			if($dosdate!='' && $dosdate!='0000-00-00' && $dosdate!=NULL)
			{
				$dosdate1=explode("-",$dosdate);
				$dosdate=$dosdate1[2]."-".$dosdate1[1]."-".$dosdate1[0];
			}
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
			}
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			$flg=0;
			
			$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0; $gotm_ackdate='';	
			$stmtgsampack1 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id, gotm_ackdate FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
			$stmtgsampack1->bind_param("s", $sampleno);
			$resultgsampack1=$stmtgsampack1->execute();
			$stmtgsampack1->store_result();
			if ($stmtgsampack1->num_rows > 0) 
			{
				$stmtgsampack1->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id, $gotm_ackdate);
				//looping through all the records 
				$stmtgsampack1->fetch();
			}
			if($gotm_ackdate!='' && $gotm_ackdate!='0000-00-00' && $gotm_ackdate!=NULL)
			{
				$gotm_ackdate1=explode("-",$gotm_ackdate);
				$gotm_ackdate=$gotm_ackdate1[2]."-".$gotm_ackdate1[1]."-".$gotm_ackdate1[0];
			}
			$stmtgsampack1->close();
			$fmvarray=array();
			$gotsow_dosow=''; $gotsow_nurplotno=''; $gotsow_noofseeds=''; $gotsow_sptype=''; $gotsow_state=''; $gotsow_loc=''; $gotsow_noofcellstray=''; $gotsow_nooftraylot=''; $gotsow_bedno=''; $gotsow_direction=''; $gotsow_noofrows=''; $gotsow_noofplants=''; $gottransp_date=''; $gottransp_state=''; $gottransp_loc=''; $gottransp_plotno=''; $gottransp_bedno=''; $gottransp_direction=''; $gottransp_noofrows=''; $gottransp_range=''; $gottransp_noofplants=''; $gotsow_range=''; $gotsow_nurserymedium='';$fmvnumrows=0;
			if($gotm_id>0)
			{
				$stmtgsow = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_nurplotno, gotsow_noofseeds, gotsow_sptype, gotsow_state, gotsow_loc, gotsow_noofcellstray, gotsow_nooftraylot, gotsow_bedno, gotsow_direction, gotsow_noofrows, gotsow_noofplants, gotsow_range, gotsow_nurserymedium  FROM tbl_qcgotsowing WHERE gotm_id = ? ");
				$stmtgsow->bind_param("i", $gotm_id);
				$resultgsow=$stmtgsow->execute();
				$stmtgsow->store_result();
				if ($stmtgsow->num_rows > 0) 
				{
					$stmtgsow->bind_result($gotsow_dosow, $gotsow_nurplotno, $gotsow_noofseeds, $gotsow_sptype, $gotsow_state, $gotsow_loc, $gotsow_noofcellstray, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_direction, $gotsow_noofrows, $gotsow_noofplants, $gotsow_range, $gotsow_nurserymedium);
					//looping through all the records 
					$stmtgsow->fetch();
				}	
				$stmtgsow->close();
				
				
				$stmtgtranspl = $this->conn_ps->prepare("SELECT gottransp_date, gottransp_state, gottransp_loc, gottransp_plotno, gottransp_bedno, gottransp_direction, gottransp_noofrows, gottransp_range, gottransp_noofplants FROM tbl_qcgottranspl WHERE gotm_id = ? ");
				$stmtgtranspl->bind_param("i", $gotm_id);
				$resultgtranspl=$stmtgtranspl->execute();
				$stmtgtranspl->store_result();
				if ($stmtgtranspl->num_rows > 0) 
				{
					$stmtgtranspl->bind_result($gottransp_date, $gottransp_state, $gottransp_loc, $gottransp_plotno, $gottransp_bedno, $gottransp_direction, $gottransp_noofrows, $gottransp_range, $gottransp_noofplants);
					//looping through all the records 
					$stmtgtranspl->fetch();
				}	
				$stmtgtranspl->close();
				
				
				$stmtgfmv = $this->conn_ps->prepare("SELECT gotfmv_date, gotfmv_crophealth, gotfmv_reasons, gotfmv_noofplants FROM tbl_qcgotfmv WHERE gotm_id = ? ");
				$stmtgfmv->bind_param("i", $gotm_id);
				$resultgtranspl=$stmtgfmv->execute();
				$stmtgfmv->store_result();
				$fmvnumrows=$stmtgfmv->num_rows;
				if ($fmvnumrows > 0) 
				{
					$stmtgfmv->bind_result($gotfmv_date, $gotfmv_crophealth, $gotfmv_reasons, $gotfmv_noofplants);
					//looping through all the records 
					while($stmtgfmv->fetch())
					{
					$temp=array('fmv_crophealth'=>$gotfmv_crophealth, 'fmv_reasons'=>$gotfmv_reasons, 'fmv_noofplants'=>$gotfmv_noofplants);
					array_push($fmvarray, $temp);
					}
				}	
				$stmtgfmv->close();
				
				
			}
			
			//$userSR["arrival_id"] = $arrival_id;
			//$userSR["flg"] = $flg;
			
			if($gotsow_dosow==NULL){$gotsow_dosow='';} if($gotsow_nurplotno==NULL){$gotsow_nurplotno='';} if($gotsow_noofseeds==NULL){$gotsow_noofseeds='';} if($gotsow_sptype==NULL){$gotsow_sptype='';} if($gotsow_state==NULL){$gotsow_state='';} if($gotsow_loc==NULL){$gotsow_loc='';} if($gotsow_noofcellstray==NULL){$gotsow_noofcellstray='';} if($gotsow_nooftraylot==NULL){$gotsow_nooftraylot='';} if($gotsow_bedno==NULL){$gotsow_bedno='';} if($gotsow_direction==NULL){$gotsow_direction='';} if($gotsow_noofrows==NULL){$gotsow_noofrows='';} if($gotsow_noofplants==NULL){$gotsow_noofplants='';} if($gottransp_date==NULL){$gottransp_date='';} if($gottransp_state==NULL){$gottransp_state='';} if($gottransp_loc==NULL){$gottransp_loc='';} if($gottransp_plotno==NULL){$gottransp_plotno='';} if($gottransp_bedno==NULL){$gottransp_bedno='';} if($gottransp_direction==NULL){$gottransp_direction='';} if($gottransp_noofrows==NULL){$gottransp_noofrows='';} if($gottransp_range==NULL){$gottransp_range='';} if($gottransp_noofplants==NULL){$gottransp_noofplants='';} if($gotsow_noofcellstray==NULL){$gotsow_noofcellstray='';}if($gotsow_nooftraylot==NULL){$gotsow_nooftraylot='';} if($gotsow_range==NULL){$gotsow_range='';}if($gotsow_nurserymedium==NULL){$gotsow_nurserymedium='';}
			
			
			
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["sampleno"] = $sampleno;
			$userSR["srdate"] = $srdate;
			$userSR["scdate"] = $spdate;
			$userSR["sddate"] = $dosdate;
			$userSR["trstage"] = $trstage;
			$userSR["ackdate"] = $gotm_ackdate;
			$userSR["ackflg"] = $gotm_ackflg;
			$userSR["sowingflg"] = $gotm_sowingflg;
			$userSR["transplantflg"] = $gotm_transplantflg;
			$userSR["fieldmflg"] = $gotm_fieldmflg;
			$userSR["finobrflg"] = $gotm_finobrflg;
			$userSR["resamplingflg"] = $gotm_resamplingflg;
			$userSR["retestflg"] = $gotm_retestflg;
			
			$userSR["dosow"] = $gotsow_dosow;
			$userSR["sow_nurplotno"] = $gotsow_nurplotno;
			$userSR["sow_noofseeds"] = $gotsow_noofseeds;
			$userSR["sow_sptype"] = $gotsow_sptype;
			$userSR["sow_state"] = $gotsow_state;
			$userSR["sow_loc"] = $gotsow_loc;
			$userSR["sow_noofcellstray"] = $gotsow_noofcellstray;
			$userSR["sow_nooftraylot"] = $gotsow_nooftraylot;
			$userSR["sow_bedno"] = $gotsow_bedno;
			$userSR["sow_direction"] = $gotsow_direction;
			$userSR["sow_noofrows"] = $gotsow_noofrows;
			$userSR["sow_noofplants"] = $gotsow_noofplants;
			$userSR["sow_nurrangeno"] = $gotsow_range;
			$userSR["nurserymedium"] = $gotsow_nurserymedium;
			
			$userSR["transp_date"] = $gottransp_date;
			$userSR["transp_state"] = $gottransp_state;
			$userSR["transp_loc"] = $gottransp_loc;
			$userSR["transp_plotno"] = $gottransp_plotno;
			$userSR["transp_bedno"] = $gottransp_bedno;
			$userSR["transp_direction"] = $gottransp_direction;
			$userSR["transp_noofrows"] = $gottransp_noofrows;
			$userSR["transp_range"] = $gottransp_range;
			$userSR["transp_noofplants"] = $gottransp_noofplants;
			
			$userSR["fmvnumrows"] = $fmvnumrows;
			
			$userSR["fmvarray"] = $fmvarray;
			
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }

	public function GetGoTSowingUpdate($sampleno, $dosow, $sow_nurplotno, $sow_noofseeds, $sow_sptype, $scode, $sow_state, $sow_loc, $sow_noofcellstray, $sow_nooftraylot, $sow_bedno, $sow_direction, $sow_noofrows, $sow_noofplants, $retest, $retesttype, $retest_reason, $sow_nurrangeno, $sow_nurserymedium, $sow_treynumber) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		if($dosow!='' && $dosow!='00-00-0000' && $dosow!=NULL)
		{
			$dosow1=explode("-",$dosow);
			$dosow=$dosow1[2]."-".$dosow1[1]."-".$dosow1[0];
		}
		
        $stmt = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgotsowing where gotm_id=?");
				$stmtsamp->bind_param("i", $gotm_id);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				if ($stmtsamp->num_rows == 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotsowing (gotm_id, gotsow_dosow, gotsow_nurplotno, gotsow_noofseeds, gotsow_sptype, gotsow_state, gotsow_loc, gotsow_noofcellstray, gotsow_nooftraylot, gotsow_bedno, gotsow_direction, gotsow_noofrows, gotsow_noofplants, gotsow_range, gotsow_nurserymedium, gotsow_treynumber) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("ississsiissiissi", $gotm_id, $dosow, $sow_nurplotno, $sow_noofseeds, $sow_sptype, $sow_state, $sow_loc, $sow_noofcellstray, $sow_nooftraylot, $sow_bedno, $sow_direction, $sow_noofrows, $sow_noofplants, $sow_nurrangeno, $sow_nurserymedium, $sow_treynumber);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						if($sow_sptype=="Direct Sowing"){$tplflg=2;}
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_sowingflg=?, gotm_transplantflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $tplflg, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }

	public function getStateList() {
      	$userSR = array();
		$stmt_state = $this->conn_ps->prepare("SELECT state_name  FROM tbl_state order by state_name ");
		$result_state=$stmt_state->execute();
		$stmt_state->store_result();
		if ($stmt_state->num_rows > 0) {
			$stmt_state->bind_result($state_name);
			//looping through all the records 
			while($stmt_state->fetch())
			{
				$pcode='';
				$state_name = preg_replace("/[^A-Za-z ]/", "", $state_name);
				$pcode=trim($state_name); 
				array_push($userSR,$pcode);
			}
			$stmt_state->close();
		}
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	
	public function getLocationList($statename) {
      	$userSR = array();
		$stmt_state = $this->conn_ps->prepare("SELECT state_id FROM tbl_state where state_name=? order by state_name ");
		$stmt_state->bind_param("s", $statename);
		$result_state=$stmt_state->execute();
		$stmt_state->store_result();
		if ($stmt_state->num_rows > 0) {
			$stmt_state->bind_result($state_id);
			//looping through all the records 
			$stmt_state->fetch();
			$stmt_gotloc = $this->conn_ps->prepare("SELECT loc_name FROM tbl_gotlocation where state=? order by loc_name ");
			$stmt_gotloc->bind_param("s", $state_id);
			$result_state=$stmt_gotloc->execute();
			$stmt_gotloc->store_result();
			if ($stmt_gotloc->num_rows > 0) {
				$stmt_gotloc->bind_result($loc_name);
				//looping through all the records 
				while($stmt_gotloc->fetch())
				{
					$pcode='';
					$pcode=trim($loc_name); 
					array_push($userSR,$pcode);
				}
				$stmt_gotloc->close();
			}
		}
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }


	public function GetGoTTransplatingingUpdate($sampleno, $transp_date, $transp_state, $transp_loc, $transp_plotno, $transp_bedno, $transp_direction, $transp_noofrows, $transp_range, $transp_noofplants, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		if($transp_date!='' && $transp_date!='00-00-0000' && $transp_date!=NULL)
		{
			$transp_date1=explode("-",$transp_date);
			$transp_date=$transp_date1[2]."-".$transp_date1[1]."-".$transp_date1[0];
		}
		
        $stmt = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgottranspl where gotm_id=?");
				$stmtsamp->bind_param("i", $gotm_id);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				if ($stmtsamp->num_rows == 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgottranspl (gotm_id, gottransp_date, gottransp_state, gottransp_loc, gottransp_plotno, gottransp_bedno, gottransp_direction, gottransp_noofrows, gottransp_range, gottransp_noofplants) values(?,?,?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("issssssisi", $gotm_id, $transp_date, $transp_state, $transp_loc, $transp_plotno, $transp_bedno, $transp_direction, $transp_noofrows, $transp_range, $transp_noofplants);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_transplantflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("ii", $one, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	public function getFMReasonList($crophealth) {
      	$userSR = array();
		$stmt_state = $this->conn_ps->prepare("SELECT qcgr_reason  FROM tbl_qcgotreasons where qcgr_classification=? order by qcgr_reason ");
		$stmt_state->bind_param("s", $crophealth);
		$result_state=$stmt_state->execute();
		$stmt_state->store_result();
		if ($stmt_state->num_rows > 0) {
			$stmt_state->bind_result($qcgr_reason);
			//looping through all the records 
			while($stmt_state->fetch())
			{
				$pcode='';
				$qcgr_reason = preg_replace("/[^A-Za-z ]/", "", $qcgr_reason);
				$pcode=trim($qcgr_reason); 
				array_push($userSR,$pcode);
			}
			$stmt_state->close();
		}
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	public function generateImage($img, $sampleno)
	{

		$folderPath = $_SERVER['DOCUMENT_ROOT']."/wms-test/gotimages/";
		$image_parts = explode(";base64,", $img);
		if(count($image_parts)>1)
		{$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		}
		else{
		$image_base64 = base64_decode($image_parts[0]);
		}
		$file = $folderPath . $sampleno . "_" . uniqid() . '.jpeg';

		if(file_put_contents($file, $image_base64))
		{ return $file; }
	}
	
	public function GetGoTFMVUpdate($sampleno, $fmvdate, $fmv_crophealth, $fmv_reasons, $fmv_noofplants, $scode, $fmvphoto1, $fmvphoto2, $fmvphoto3) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		
		$fmvphoto1 = $this->generateImage($fmvphoto1,$sampleno);
		if($fmvphoto2!=""){$fmvphoto2 = $this->generateImage($fmvphoto2,$sampleno);}
		if($fmvphoto3!=''){$fmvphoto3 = $this->generateImage($fmvphoto3,$sampleno);}
		
        $stmt = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				$stmtsamp = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgotfmv where gotm_id=?");
				$stmtsamp->bind_param("i", $gotm_id);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				//if ($stmtsamp->num_rows == 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotfmv (gotm_id, gotfmv_date, gotfmv_crophealth, gotfmv_reasons, gotfmv_noofplants, gotfmv_image1, gotfmv_image2, gotfmv_image3) values(?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("isssisss", $gotm_id, $fmvdate, $fmv_crophealth, $fmv_reasons, $fmv_noofplants, $fmvphoto1, $fmvphoto2, $fmvphoto3);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_gotr = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=? WHERE gotm_id=? ");
						$stmt_gotr->bind_param("ii", $two, $gotm_id);
						$result_gotr=$stmt_gotr->execute();
						$stmt_gotr->close();
						$flg++;
					}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	
	public function GetGoTFinalObservationUpdate($sampleno, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		if($fnobser_obserdate!='' && $fnobser_obserdate!='00-00-0000' && $fnobser_obserdate!=NULL)
		{
			$fnobser_obserdate1=explode("-",$fnobser_obserdate);
			$fnobser_obserdate=$fnobser_obserdate1[2]."-".$fnobser_obserdate1[1]."-".$fnobser_obserdate1[0];
		}
		
        $stmt = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id, gotm_croptype, gotm_crop FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id, $gotm_croptype, $gotm_crop);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				if($gotm_croptype==NULL)$gotm_croptype='';
				
				$stmtsamp = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgotfnobser where gotm_id=?");
				$stmtsamp->bind_param("i", $gotm_id);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				//if ($gotm_crop == "Bajra Seed") 
				if ($stmtsamp->num_rows == 0) 
				{
					//return "Insert into tbl_qcgotfnobser (gotm_id, fnobser_obserdate, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_late, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks, fnobser_logid, fnobser_croptype, fnobser_crop) values($gotm_id, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop) ";
					
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotfnobser (gotm_id, fnobser_obserdate, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_late, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks, fnobser_logid, fnobser_croptype, fnobser_crop) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
					
					$stmt_samp->bind_param("isiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissss", $gotm_id, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $two, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
					
				}
				/*if ($gotm_crop == "Maize Seed") 
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotfnobser (gotm_id, fnobser_obserdate, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_tallper, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks, fnobser_logid, fnobser_croptype, fnobser_crop) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("issssssssssssssssssssssssssssssssssssssssssss", $gotm_id, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_tallper, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $one, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
				}
				if ($gotm_crop == "Paddy Seed") 
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotfnobser (gotm_id, fnobser_obserdate, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_tallper, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks, fnobser_logid, fnobser_croptype, fnobser_crop) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("issssssssssssssssssssssssssssssssssssssssssss", $gotm_id, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_tallper, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $one, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
				}
				else
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgotfnobser (gotm_id, fnobser_obserdate, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_tallper, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks, fnobser_logid, fnobser_croptype, fnobser_crop) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("issssssssssssssssssssssssssssssssssssssssssss", $gotm_id, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_tallper, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $one, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
				}*/
				$stmtsamp->close();	
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	
	
	public function GetGoTRetestUpdate($sampleno, $retest, $retesttype, $retest_reason) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$oyearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		
		 $gotm_id=''; $gotm_tdate=''; $gotm_dosd=''; $gotm_croptype=''; $gotm_crop=''; $gotm_variety=''; $gotm_lotno=''; $gotm_sampleno=''; $gotm_noofsamples=''; $gotm_disploc=''; $gotm_dispstate=''; $gotm_ackremark=''; $gotm_ackdate=''; $gotm_ackflg=''; $gotm_gottid=''; $gotm_acklogid=''; $gotm_sowingflg=''; $gotm_transplantflg=''; $gotm_fieldmflg=''; $gotm_finobrflg='';
		 
        $stmt = $this->conn_ps->prepare("SELECT gotm_id, gotm_tdate, gotm_dosd, gotm_croptype, gotm_crop, gotm_variety, gotm_lotno, gotm_sampleno, gotm_noofsamples, gotm_disploc, gotm_dispstate, gotm_ackremark, gotm_ackdate, gotm_ackflg, gotm_gottid, gotm_acklogid, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		//$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_id, $gotm_tdate, $gotm_dosd, $gotm_croptype, $gotm_crop, $gotm_variety, $gotm_lotno, $gotm_sampleno, $gotm_noofsamples, $gotm_disploc, $gotm_dispstate, $gotm_ackremark, $gotm_ackdate, $gotm_ackflg, $gotm_gottid, $gotm_acklogid, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				if($retesttype=="With Sample")
				{
					
					$stmtgm = $this->conn_ps->prepare("SELECT gottest_tid, gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno, grade, gottest_aflg, gottest_bflg, gottest_cflg, gottest_btsflg, gottest_btsid, gottest_catid, gottest_totnosamp, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, gottest_smpdispstate, gottest_smpdisploc, yearid, logid, logid1, logid2, genpurity, gottest_sampno FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_resultflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=? and yearid=? ORDER BY gottest_tid DESC");
					$stmtgm->bind_param("ss", $sampno, $oyearid);
					$stmtgm->execute();
					$stmtgm->store_result();
					$userSR = array(); $user24=array();
					if ($stmtgm->num_rows > 0) {
						// user existed 
						$zero=0; $one=1; $dtt='0000-00-00'; $result='RT';
						$stmtgm->bind_result($gottest_tid, $gottest_spdate, $gottest_gotdate, $gottest_dosdate, $gottest_got, $gottest_variety, $gottest_crop, $gottest_lotno, $gottest_oldlot, $gottest_srdate, $gottest_trstage, $gottest_gotstatus, $gottest_sampleno, $grade, $gottest_aflg, $gottest_bflg, $gottest_cflg, $gottest_btsflg, $gottest_btsid, $gottest_catid, $gottest_totnosamp, $gottest_resultflg, $gottest_gotflg, $gottest_gotrefno, $gottest_gotauth, $gottest_gotsampdflg, $gottest_smpdispstate, $gottest_smpdisploc, $yearid, $logid, $logid1, $logid2, $genpurity, $gottest_sampno);
						$stmtgm->fetch();
						
						//return "Insert into tbl_gottest (Insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno, grade, gottest_aflg, gottest_bflg, gottest_cflg, gottest_btsflg, gottest_btsid, gottest_catid, gottest_totnosamp, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, gottest_smpdispstate, gottest_smpdisploc, yearid, logid, logid1, logid2, genpurity, gottest_sampno) values($gottest_spdate, $gottest_gotdate, $dtt, $gottest_got, $gottest_variety, $gottest_crop, $gottest_lotno, $gottest_oldlot, $gottest_srdate, $gottest_trstage, $gottest_gotstatus, $gottest_sampleno, $grade, $gottest_aflg, $gottest_bflg, $gottest_cflg, $gottest_btsflg, $gottest_btsid, $gottest_catid, $gottest_totnosamp, $gottest_resultflg, $gottest_gotflg, $gottest_gotrefno, $gottest_gotauth, $zero, $gottest_smpdispstate, $gottest_smpdisploc, $yearid, $logid, $logid1, $logid2, $genpurity, $gottest_sampno) ";
						
						$stmt_got = $this->conn_ps->prepare("Insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno, grade, gottest_aflg, gottest_bflg, gottest_cflg, gottest_btsflg, gottest_btsid, gottest_catid, gottest_totnosamp, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, gottest_smpdispstate, gottest_smpdisploc, yearid, logid, logid1, logid2, genpurity, gottest_sampno) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_got->bind_param("sssssssssssisiiiiiiiiississssssss", $gottest_spdate, $gottest_gotdate, $dtt, $gottest_got, $gottest_variety, $gottest_crop, $gottest_lotno, $gottest_oldlot, $gottest_srdate, $gottest_trstage, $gottest_gotstatus, $gottest_sampleno, $grade, $gottest_aflg, $gottest_bflg, $gottest_cflg, $gottest_btsflg, $gottest_btsid, $gottest_catid, $gottest_totnosamp, $gottest_resultflg, $gottest_gotflg, $gottest_gotrefno, $gottest_gotauth, $zero, $gottest_smpdispstate, $gottest_smpdisploc, $yearid, $logid, $logid1, $logid2, $genpurity, $gottest_sampno);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						
						$stmt_got1 = $this->conn_ps->prepare("UPDATE tbl_gottest SET gottest_gotstatus=?, gottest_gotflg=?, gottest_resultflg=? WHERE gottest_tid=? ");
						$stmt_got1->bind_param("siii", $result, $one, $one, $gottest_tid);
						$result_got1=$stmt_got1->execute();
						$stmt_got1->close();
					
						$stmt_got2 = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_retestflg=?, gotm_resamplingflg=?, gotm_retestreason=? WHERE gotm_id=? ");
						$stmt_got2->bind_param("iisi", $one, $one, $retest_reason, $gotm_id);
						$result_got2=$stmt_got2->execute();
						$stmt_got2->close();
						$flg=1;
					
					}
					$stmtgm->close();
				}
				else if($retesttype=="Without Sample")
				{
					$stmtgm = $this->conn_ps->prepare("SELECT gottest_tid, gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno, grade, gottest_aflg, gottest_bflg, gottest_cflg, gottest_btsflg, gottest_btsid, gottest_catid, gottest_totnosamp, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, gottest_smpdispstate, gottest_smpdisploc, yearid, logid, logid1, logid2, genpurity, gottest_sampno FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=? and yearid=? ORDER BY gottest_tid DESC");
					$stmtgm->bind_param("ss", $sampno, $oyearid);
					$stmtgm->execute();
					$stmtgm->store_result();
					$userSR = array(); $user24=array();
					if ($stmtgm->num_rows > 0) {
						// user existed 
						$zero=0; $one=1; $dtt='0000-00-00'; $result='RT';
						$stmtgm->bind_result($gottest_tid, $gottest_spdate, $gottest_gotdate, $gottest_dosdate, $gottest_got, $gottest_variety, $gottest_crop, $gottest_lotno, $gottest_oldlot, $gottest_srdate, $gottest_trstage, $gottest_gotstatus, $gottest_sampleno, $grade, $gottest_aflg, $gottest_bflg, $gottest_cflg, $gottest_btsflg, $gottest_btsid, $gottest_catid, $gottest_totnosamp, $gottest_resultflg, $gottest_gotflg, $gottest_gotrefno, $gottest_gotauth, $gottest_gotsampdflg, $gottest_smpdispstate, $gottest_smpdisploc, $yearid, $logid, $logid1, $logid2, $genpurity, $gottest_sampno);
						$stmtgm->fetch();
						
						$stmt_got = $this->conn_ps->prepare("Insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno, grade, gottest_aflg, gottest_bflg, gottest_cflg, gottest_btsflg, gottest_btsid, gottest_catid, gottest_totnosamp, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, gottest_smpdispstate, gottest_smpdisploc, yearid, logid, logid1, logid2, genpurity, gottest_sampno) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_got->bind_param("sssssssssssisiiiiiiiiississssssss", $gottest_spdate, $gottest_gotdate, $gottest_dosdate, $gottest_got, $gottest_variety, $gottest_crop, $gottest_lotno, $gottest_oldlot, $gottest_srdate, $gottest_trstage, $gottest_gotstatus, $gottest_sampleno, $grade, $gottest_aflg, $gottest_bflg, $gottest_cflg, $gottest_btsflg, $gottest_btsid, $gottest_catid, $gottest_totnosamp, $gottest_resultflg, $gottest_gotflg, $gottest_gotrefno, $gottest_gotauth, $gottest_gotsampdflg, $gottest_smpdispstate, $gottest_smpdisploc, $yearid, $logid, $logid1, $logid2, $genpurity, $gottest_sampno);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						
						$stmt_got1 = $this->conn_ps->prepare("UPDATE tbl_gottest SET gottest_gotstatus=?, gottest_gotflg=?, gottest_resultflg=? WHERE gottest_tid=? ");
						$stmt_got1->bind_param("siii", $result, $one, $one, $gottest_tid);
						$result_got1=$stmt_got1->execute();
						$stmt_got1->close();
					
						$stmt_got2 = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_retestflg=?, gotm_retestreason=? WHERE gotm_id=? ");
						$stmt_got2->bind_param("isi", $one, $retest_reason, $gotm_id);
						$result_got2=$stmt_got2->execute();
						$stmt_got2->close();
						
						$stmt_got3 = $this->conn_ps->prepare("Insert into tbl_qcgotmain (gotm_tdate, gotm_dosd, gotm_croptype, gotm_crop, gotm_variety, gotm_lotno, gotm_sampleno, gotm_noofsamples, gotm_disploc, gotm_dispstate, gotm_ackremark, gotm_ackdate, gotm_ackflg, gotm_gottid, gotm_acklogid) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_got3->bind_param("sssssssissssiis", $gotm_tdate, $gotm_dosd, $gotm_croptype, $gotm_crop, $gotm_variety, $gotm_lotno, $gotm_sampleno, $gotm_noofsamples, $gotm_disploc, $gotm_dispstate, $gotm_ackremark, $gotm_ackdate, $gotm_ackflg, $gotm_gottid, $gotm_acklogid);
						$result_got3=$stmt_got3->execute();
						$stmt_got3->close();
						
						$flg=1;
					}
					$stmtgm->close();
				
				}
				else
				{
					$flg=0;
				}
				
				
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	
		
	
	
	//BTS APP Coading start : -
	
	public function GetSampleInfobtsdisp($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		
		//return "SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=$sampno and yearid='$yearid' ORDER BY gottest_tid DESC";
		 $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
		 
		//$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc, gottest_srdate, gottest_spdate, gottest_trstage  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_sampleno=? and yearid=? ORDER BY gottest_tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $sampclrole=''; $state=''; $sampcldate=''; $srdate=''; $spdate=''; $trstage='';
        if ($stmt->num_rows > 0) {
		
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($sampclrole==NULL){$sampclrole='';} if($state==NULL){$state='';} if($sampcldate==NULL){$sampcldate='';} 
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$dosdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			
			$nob=0; $qty=0;  
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;
										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			
			$userSR["crop"] = $cropname;
			$userSR["variety"] = $popularname;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			$userSR["sampleno"] = $sampleno;
			
			array_push($user24,$userSR);
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	public function GetSample_Germination_Update($sampleno, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;$flg=0;
		
		//return "SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=1 and gottest_sampleno=$sampno and yearid='$yearid' ORDER BY gottest_tid DESC";
		$stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole, oldlot  FROM tbl_qctest WHERE sampleno=? and yearid=?  and plantcode=? ORDER BY tid DESC");
		//$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc, gottest_srdate, gottest_spdate, gottest_trstage, gottest_oldlot  FROM tbl_gottest WHERE gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_sampleno=? and yearid=? ORDER BY gottest_tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $sampcldate=''; $state=''; $sampclrole=''; $srdate=''; $spdate=''; $trstage=''; $oldlot='';
        if ($stmt->num_rows > 0) {
		
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole, $oldlot);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($sampcldate==NULL){$sampcldate='';} if($state==NULL){$state='';} if($sampclrole==NULL){$sampclrole='';}  if($oldlot==NULL){$oldlot='';}
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$dosdate1=explode("-",$srdate);
				$dosdate=$dosdate1[2]."-".$dosdate1[1]."-".$dosdate1[0];
			}
			
			$cropname=''; $popularname='';
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname);
					//looping through all the records 
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
			}
			if($variety!=''){
				$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
				$stmt_variety->bind_param("i", $variety);
				$result_variety=$stmt_variety->execute();
				$stmt_variety->store_result();
				if ($stmt_variety->num_rows > 0) {
					$stmt_variety->bind_result($varietyid, $popularname);
					//looping through all the records 
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			}
			if($popularname==''){$popularname=$variety;}
			$farmer_id=''; $agreement_id=''; $lorrycode=''; $pcode=''; $hybridcode='';
			if($oldlot!=''){
			
				$oldlt=str_split($oldlot);
				$old=$oldlt[1].$oldlt[2].$oldlt[3].$oldlt[4].$oldlt[5].$oldlt[6];
				$stmt_lotimp = $this->conn_ps->prepare("SELECT agreement_id FROM tbllotimp WHERE lotnumber = ? ");
				$stmt_lotimp->bind_param("s", $old);
				$result_lotimp=$stmt_lotimp->execute();
				$stmt_lotimp->store_result();
				if ($stmt_lotimp->num_rows > 0) {
					$stmt_lotimp->bind_result($agreement_id);
					//looping through all the records 
					$stmt_lotimp->fetch();
					$stmt_lotimp->close();
					
					$stmt_agreeimps = $this->conn_ps->prepare("SELECT hybridcode, farmerid FROM tbl_agriimportsub WHERE agreementid = ?");
					$stmt_agreeimps->bind_param("s", $agreement_id);
					$result_arrsub=$stmt_agreeimps->execute();
					$stmt_agreeimps->store_result();
					if ($stmt_agreeimps->num_rows > 0) {
						$stmt_agreeimps->bind_result($hybridcode, $farmer_id);
						//looping through all the records 
						$stmt_agreeimps->fetch();
						$stmt_agreeimps->close();
					}
				}				
				
				$stmt_plant = $this->conn_ps->prepare("SELECT code FROM tbl_parameters ");
				$result_plant=$stmt_plant->execute();
				$stmt_plant->store_result();
				if ($stmt_plant->num_rows > 0) {
					$stmt_plant->bind_result($rec_pcode);
					//looping through all the records 
					$stmt_plant->fetch();
					$pcode=$rec_pcode; 
					$stmt_plant->close();
				}
				$pcode=$plantid;
				
				$stmt_arrsub = $this->conn_ps->prepare("SELECT arrival_id FROM tblarrival_sub WHERE orlot = ? ");
				$stmt_arrsub->bind_param("s", $oldlot);
				$result_arrsub=$stmt_arrsub->execute();
				$stmt_arrsub->store_result();
				if ($stmt_arrsub->num_rows > 0) {
					$stmt_arrsub->bind_result($arrival_id);
					//looping through all the records 
					$stmt_arrsub->fetch();
					$stmt_arrsub->close();
				}
				$lorrycode=$pcode.$arrival_id;
			}
			
			$nob=0; $qty=0;  
			if($trstage!="Pack")
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=$lotldg_balbags;
										$slqty=$lotldg_balqty;

										
										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		
			}
			else
			{
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
				$stmt_m->bind_param("s", $lotno);
				$result_m=$stmt_m->execute();
				$stmt_m->store_result();
				if ($stmt_m->num_rows > 0) {
					$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
					while($stmt_m->fetch())
					{
					
						$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
						$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
						$result_s=$stmt_s->execute();
						$stmt_s->store_result();
						if ($stmt_s->num_rows > 0) {
							$stmt_s->bind_result($lotldg_id);
							while($stmt_s->fetch())
							{
								$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
								$stmt_ss->bind_param("i", $lotldg_id);
								$result_ss=$stmt_ss->execute();
								$stmt_ss->store_result();
								if ($stmt_ss->num_rows > 0) {
									$stmt_ss->bind_result($lotldg_balqty);
									while($stmt_ss->fetch())
									{
										$wareh=""; $binn=""; $subbinn="";
				
										$slups=0;
										$slqty=$lotldg_balqty;

										$nob=$nob+$slups;
										$qty=$qty+$slqty;
										
									}	
								}
								$stmt_ss->close();
							}
						}
						$stmt_s->close();
					}
				}
				$stmt_m->close();		

			}
			
			$dt=date("y-m-d"); $scode=''; $yearcode=''; 
			$stmt_gotchk3 = $this->conn_ps->prepare("SELECT * FROM tbl_btssdlgermlist WHERE btssdlgermlist_sampleno=? ");
			$stmt_gotchk3->bind_param("s", $sampleno);
			$result_gotchk3=$stmt_gotchk3->execute();
			$stmt_gotchk3->store_result();
			if ($stmt_gotchk3->num_rows==0) {
				$stmt_got3 = $this->conn_ps->prepare("Insert into tbl_btssdlgermlist (btssdlgermlist_date, btssdlgermlist_sampleno, btssdlgermlist_crop, btssdlgermlist_variety, btssdlgermlist_lotno, btssdlgermlist_nob, btssdlgermlist_qty, btssdlgermlist_stage, btssdlgermlist_yearcode, btssdlgermlist_logid, plant_id, btssdlgermlist_farmerid, btssdlgermlist_agreementid, btssdlgermlist_lorrycode, btssdlgermlist_hybridcode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_got3->bind_param("sssssisssssssss", $dt, $sampleno, $cropname, $popularname, $lotno, $nob, $qty, $trstage, $yearcode, $scode, $pcode, $farmer_id, $agreement_id, $lorrycode, $hybridcode);
				if($result_got3=$stmt_got3->execute())
				{$flg=1;}
				$stmt_got3->close();
			}
			else
			{$flg=2;}
			$stmt_gotchk3->close();
			$stmt->close();
	   		//return $resusers;
        } else {
            // user not existed
			//$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return $flg;}
    }
	
	public function GetSampleInfobtsdisplist($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		
		$stmt = $this->conn_ps->prepare("SELECT btssdlgermlist_crop, btssdlgermlist_variety, btssdlgermlist_lotno, btssdlgermlist_stage, btssdlgermlist_sampleno, btssdlgermlist_nob, btssdlgermlist_qty FROM tbl_btssdlgermlist WHERE btssdlgermlist_sampleno=? and btssdlgermlist_dispflg=0 ORDER BY btssdlgermlist_id DESC");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $totnosamp=''; $state=''; $smpdisploc=''; $srdate=''; $spdate=''; $trstage='';
        if ($stmt->num_rows > 0) {
            // Data existed 
			$stmt->bind_result($crop, $variety, $lotno, $trstage, $sampleno, $nob, $qty);
			$stmt->fetch();
			$userSR["crop"] = $crop;
			$userSR["variety"] = $variety;
			$userSR["lotno"] = $lotno;
			$userSR["trstage"] = $trstage;
			$userSR["sampleno"] = $sampleno;
			$userSR["nob"] = $nob;
			$userSR["qty"] = $qty;
			array_push($user24,$userSR);
			//return $resusers;
			$stmt->close();
		}else {
            // Data not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
	}
	
	public function GetSampleInfobtsdisplist_submit($sampleno, $qc_remarks, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$flg=0;
		
		$stmt_main = $this->conn_ps->prepare("SELECT btssdldispm_id FROM tbl_btssdldispm WHERE btssdldispm_tflg=2 ");
		$stmt_main->execute();
		$stmt_main->store_result();
		
		$stmt_sub = $this->conn_ps->prepare("SELECT btssdldispm_id FROM tbl_btssdldispm_sub WHERE btssdldispms_sampleno=? ");
		$stmt_sub->bind_param("s", $sampleno);
		$stmt_sub->execute();
		$stmt_sub->store_result();
		if ($stmt_sub->num_rows==0) 
		{
			$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $tcode=''; $trstage=''; $farmerid=""; $agrimentid=""; $hybrid=''; $pcode=''; $lorry='';
			if ($stmt_main->num_rows==0) 
			{
				$stmt = $this->conn_ps->prepare("SELECT btssdlgermlist_crop, btssdlgermlist_variety, btssdlgermlist_lotno, btssdlgermlist_stage, btssdlgermlist_sampleno, btssdlgermlist_nob, btssdlgermlist_qty, plant_id, btssdlgermlist_farmerid, btssdlgermlist_agreementid, btssdlgermlist_lorrycode, btssdlgermlist_hybridcode  FROM tbl_btssdlgermlist WHERE btssdlgermlist_sampleno=? and btssdlgermlist_dispflg=0 ORDER BY btssdlgermlist_id DESC");
				$stmt->bind_param("s", $sampleno);
				$stmt->execute();
				$stmt->store_result();
				
				$userSR = array(); $user24=array();
				if ($stmt->num_rows > 0) 
				{

					$stmtsamp = $this->conn_ps->prepare("SELECT MAX(btssdldispm_code) FROM tbl_btssdldispm ");
					$resultsamp=$stmtsamp->execute();
					$stmtsamp->store_result();
					$stmtsamp->bind_result($tcode);
					$tcode=$tcode+1;
				
					$stmt->bind_result($crop, $variety, $lotno, $trstage, $sampleno, $nob, $qty, $pcode, $farmerid, $agrimentid, $lorry, $hybrid);
					$stmt->fetch();
					
					$lott=str_split($lotno);
					$ltno=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7];
					
					$stmt_lotimp = $this->conn_ps->prepare("SELECT farmer_id, agreement_id FROM tbllotimp WHERE lotnumber = ? ");
					$stmt_lotimp->bind_param("s", $ltno);
					$result_lotimp=$stmt_lotimp->execute();
					$stmt_lotimp->store_result();
					if ($stmt_lotimp->num_rows > 0) 
					{
						$stmt_lotimp->bind_result($hybrid);
						//looping through all the records 
						$stmt_lotimp->fetch();
						$stmt_lotimp->close();
						
						
						$stmt_agriimpsub = $this->conn_ps->prepare("SELECT hybridcode FROM tbl_agriimportsub WHERE agreementid = ? ");
						$stmt_agriimpsub->bind_param("s", $agrimentid);
						$result_agriimpsub=$stmt_agriimpsub->execute();
						$stmt_agriimpsub->store_result();
						$stmt_agriimpsub->bind_result($farmerid, $agrimentid);
						$stmt_agriimpsub->fetch();
						$stmt_agriimpsub->close();
					}
					
					$stmt_got3 = $this->conn_ps->prepare("Insert into tbl_btssdldispm (btssdldispm_code, btssdldispm_tflg) values(?,2) ");
					$stmt_got3->bind_param("i", $tcode);
					if($result_got3=$stmt_got3->execute())
					{	
						$tid=$stmt_got3->insert_id;
						$stmt_got1 = $this->conn_ps->prepare("Insert into tbl_btssdldispm_sub (btssdldispm_id, btssdldispms_sampleno, btssdldispms_crop, btssdldispms_variety, btssdldispms_lotno, btssdldispms_stage, btssdldispms_farmerid, btssdldispms_agreementid, btssdldispms_hybrid, btssdldispms_lorry, btssdldispms_plantid, btssdldispms_qcremark) values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_got1->bind_param("isssssssssss", $tid, $sampleno, $crop, $variety, $lotno, $trstage, $farmerid, $agrimentid, $hybrid, $lorry, $pcode, $qc_remarks);
						if($result_got1=$stmt_got1->execute())
						{
							$flg=1;
							$stmt_got1->close();
						}
					}
					$stmt_got3->close();
				}
				else 
				{
					// Data not existed
					$flg=2;
					$stmt->close();
				}
			}
			else
			{
				$stmt_main->bind_result($tid);
				$stmt_main->fetch();
				
				$stmt = $this->conn_ps->prepare("SELECT btssdlgermlist_crop, btssdlgermlist_variety, btssdlgermlist_lotno, btssdlgermlist_stage, btssdlgermlist_sampleno, btssdlgermlist_nob, btssdlgermlist_qty, plant_id, btssdlgermlist_farmerid, btssdlgermlist_agreementid, btssdlgermlist_lorrycode, btssdlgermlist_hybridcode  FROM tbl_btssdlgermlist WHERE btssdlgermlist_sampleno=? and btssdlgermlist_dispflg=0 ORDER BY btssdlgermlist_id DESC");
				$stmt->bind_param("s", $sampleno);
				$stmt->execute();
				$stmt->store_result();
				
				if ($stmt->num_rows > 0) 
				{
					$stmt->bind_result($crop, $variety, $lotno, $trstage, $sampleno, $nob, $qty, $pcode, $farmerid, $agrimentid, $lorry, $hybrid);
					$stmt->fetch();
					
					$lott=str_split($lotno);
					$ltno=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7];
					
					$stmt_lotimp = $this->conn_ps->prepare("SELECT farmer_id, agreement_id FROM tbllotimp WHERE lotnumber = ? ");
					$stmt_lotimp->bind_param("s", $ltno);
					$result_lotimp=$stmt_lotimp->execute();
					$stmt_lotimp->store_result();
					if ($stmt_lotimp->num_rows > 0) 
					{
						$stmt_lotimp->bind_result($hybrid);
						//looping through all the records 
						$stmt_lotimp->fetch();
						$stmt_lotimp->close();
						
						
						$stmt_agriimpsub = $this->conn_ps->prepare("SELECT hybridcode FROM tbl_agriimportsub WHERE agreementid = ? ");
						$stmt_agriimpsub->bind_param("s", $agrimentid);
						$result_agriimpsub=$stmt_agriimpsub->execute();
						$stmt_agriimpsub->store_result();
						$stmt_agriimpsub->bind_result($farmerid, $agrimentid);
						$stmt_agriimpsub->fetch();
						$stmt_agriimpsub->close();
					}
					if($tid==0)
					{
						$stmt_got3 = $this->conn_ps->prepare("Insert into tbl_btssdldispm (btssdldispm_code, btssdldispm_tflg) values(?,2) ");
						$stmt_got3->bind_param("i", $tcode);
						if($result_got3=$stmt_got3->execute())
						{	
							$tid=$stmt_got3->insert_id;
							$stmt_got1 = $this->conn_ps->prepare("Insert into tbl_btssdldispm_sub (btssdldispm_id, btssdldispms_sampleno, btssdldispms_crop, btssdldispms_variety, btssdldispms_lotno, btssdldispms_stage, btssdldispms_farmerid, btssdldispms_agreementid, btssdldispms_hybrid, btssdldispms_lorry, btssdldispms_plantid, btssdldispms_qcremark) values(?,?,?,?,?,?,?,?,?,?,?,?) ");
							$stmt_got1->bind_param("isssssssssss", $tid, $sampleno, $crop, $variety, $lotno, $trstage, $farmerid, $agrimentid, $hybrid, $lorry, $pcode, $qc_remarks);
							if($result_got1=$stmt_got1->execute())
							{
								$flg=1;
								$stmt_got1->close();
							}
						}
						$stmt_got3->close();
					
					}
					else
					{
						$stmt_got1 = $this->conn_ps->prepare("Insert into tbl_btssdldispm_sub (btssdldispm_id, btssdldispms_sampleno, btssdldispms_crop, btssdldispms_variety, btssdldispms_lotno, btssdldispms_stage, btssdldispms_farmerid, btssdldispms_agreementid, btssdldispms_hybrid, btssdldispms_lorry, btssdldispms_plantid, btssdldispms_qcremark) values(?,?,?,?,?,?,?,?,?,?,?,?) ");
						$stmt_got1->bind_param("isssssssssss", $tid, $sampleno, $crop, $variety, $lotno, $trstage, $farmerid, $agrimentid, $hybrid, $lorry, $pcode, $qc_remarks);
						if($result_got1=$stmt_got1->execute())
						{
							$flg=1;
						}
						$stmt_got1->close();
					}
				}
				else 
				{
					// Data not existed
					$flg=2;
					$stmt->close();
				}
			}
		}
		else
		{
			$flg=3;
			$stmt_sub->close();
		}
		$stmt_main->close();
		
		return $flg;
	}
	
	
	// New Density code Start
	
	public function GetSampleDensityInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE  sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			
			$ltnno=str_split($lotno);
			$stagechar=$ltnno[16];
			
			if($trstage=="" && $stagechar=="R"){$trstage="Raw";}
			if($trstage=="" && $stagechar=="C"){$trstage="Condition";}
			if($trstage=="" && $stagechar=="P"){$trstage="Pack";}
			If($trstage!="Raw")
			{
				$user24 = array();
			}
			else
			{
				if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($trstage==NULL){$trstage=0;} if($state==NULL){$state='';} if($spdate==NULL){$spdate='';}  if($sampcldate==NULL){$sampcldate='';}  if($sampclrole==NULL){$sampclrole='';} 
				if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
				{
					$srdate1=explode("-",$srdate);
					$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
				}
				if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
				{
					$spdate1=explode("-",$spdate);
					$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
					$sampflg=1;
				}
				$cropname=''; $popularname='';
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				if($variety!=''){
					$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
					$stmt_variety->bind_param("i", $variety);
					$result_variety=$stmt_variety->execute();
					$stmt_variety->store_result();
					if ($stmt_variety->num_rows > 0) {
						$stmt_variety->bind_result($varietyid, $popularname);
						//looping through all the records 
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
				
				
				
				$nob=0; $qty=0;  $sups="";$sqty=0; $slocs=""; $slocs2="";
				if($trstage!="Pack")
				{
					$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno = ? ");
					$stmt_m->bind_param("s", $lotno);
					$result_m=$stmt_m->execute();
					$stmt_m->store_result();
					if ($stmt_m->num_rows > 0) {
						$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
						while($stmt_m->fetch())
						{
						
							$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? ");
							$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
							$result_s=$stmt_s->execute();
							$stmt_s->store_result();
							if ($stmt_s->num_rows > 0) {
								$stmt_s->bind_result($lotldg_id);
								while($stmt_s->fetch())
								{
									$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_balqty>0 and lotldg_id = ? ");
									$stmt_ss->bind_param("i", $lotldg_id);
									$result_ss=$stmt_ss->execute();
									$stmt_ss->store_result();
									if ($stmt_ss->num_rows > 0) {
										$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty);
										while($stmt_ss->fetch())
										{
											$wareh=""; $binn=""; $subbinn="";
					
											$slups=$lotldg_balbags;
											$slqty=$lotldg_balqty;
											
											$nob=$nob+$slups;
											$qty=$qty+$slqty;
											
											$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
											$stmt_wh->bind_param("i", $lotldg_whid);
											$result_wh=$stmt_wh->execute();
											$stmt_wh->store_result();
											$stmt_wh->bind_result($perticulars);
											$stmt_wh->fetch();
											$wareh=$perticulars."/";
											$stmt_wh->close();
											
											$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
											$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
											$result_bn=$stmt_bn->execute();
											$stmt_bn->store_result();
											$stmt_bn->bind_result($binname);
											$stmt_bn->fetch();
											$binn=$binname."/";
											$stmt_bn->close();
											
											$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
											$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
											$result_sbn=$stmt_sbn->execute();
											$stmt_sbn->store_result();
											$stmt_sbn->bind_result($sname);
											$stmt_sbn->fetch();
											$subbinn=$sname;
											$stmt_sbn->close();
											
											if($slocs!="")
											$slocs=$slocs.",".$wareh.$binn.$subbinn;
											else
											$slocs=$wareh.$binn.$subbinn;	
										}	
									}
									$stmt_ss->close();
								}
							}
							$stmt_s->close();
						}
					}
					$stmt_m->close();		
				}
				else
				{
					$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno = ? ");
					$stmt_m->bind_param("s", $lotno);
					$result_m=$stmt_m->execute();
					$stmt_m->store_result();
					if ($stmt_m->num_rows > 0) {
						$stmt_m->bind_result($lotldg_subbinid, $lotldg_binid, $lotldg_whid);
						while($stmt_m->fetch())
						{
						
							$stmt_s = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? ");
							$stmt_s->bind_param("ss", $lotno, $lotldg_subbinid);
							$result_s=$stmt_s->execute();
							$stmt_s->store_result();
							if ($stmt_s->num_rows > 0) {
								$stmt_s->bind_result($lotldg_id);
								while($stmt_s->fetch())
								{
									$stmt_ss = $this->conn_ps->prepare("SELECT balqty FROM tbl_lot_ldg_pack WHERE balqty>0 and lotdgp_id = ? ");
									$stmt_ss->bind_param("i", $lotldg_id);
									$result_ss=$stmt_ss->execute();
									$stmt_ss->store_result();
									if ($stmt_ss->num_rows > 0) {
										$stmt_ss->bind_result($lotldg_balqty);
										while($stmt_ss->fetch())
										{
											$wareh=""; $binn=""; $subbinn="";
					
											$slups=0;
											$slqty=$lotldg_balqty;
	
											$nob=$nob+$slups;
											$qty=$qty+$slqty;
											
											$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
											$stmt_wh->bind_param("i", $lotldg_whid);
											$result_wh=$stmt_wh->execute();
											$stmt_wh->store_result();
											$stmt_wh->bind_result($perticulars);
											$stmt_wh->fetch();
											$wareh=$perticulars."/";
											$stmt_wh->close();
											
											$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
											$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
											$result_bn=$stmt_bn->execute();
											$stmt_bn->store_result();
											$stmt_bn->bind_result($binname);
											$stmt_bn->fetch();
											$binn=$binname."/";
											$stmt_bn->close();
											
											$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
											$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
											$result_sbn=$stmt_sbn->execute();
											$stmt_sbn->store_result();
											$stmt_sbn->bind_result($sname);
											$stmt_sbn->fetch();
											$subbinn=$sname;
											$stmt_sbn->close();
											
											if($slocs!="")
											$slocs=$slocs.",".$wareh.$binn.$subbinn;
											else
											$slocs=$wareh.$binn.$subbinn;	
										}	
									}
									$stmt_ss->close();
								}
							}
							$stmt_s->close();
						}
					}
					$stmt_m->close();		
	
				}
				$density_rawwtflg=0;
				if($stmt_density = $this->conn_ps->prepare("select density_rawwtflg from tbl_densitydata where density_sampleno = ? "))
				{
				$stmt_density->bind_param("s", $sampleno);
				$stmt_density->execute();
				$stmt_density->store_result();
				if($stmt_density->num_rows>0)
				{
				$stmt_density->bind_result($density_rawwtflg);
				$stmt_density->fetch();
				}
				$stmt_density->close();
				}
	
				$userSR["srdate"] = $srdate;
				$userSR["crop"] = $cropname;
				$userSR["variety"] = $popularname;
				$userSR["lotno"] = $lotno;
				$userSR["trstage"] = $trstage;
				$userSR["nob"] = $nob;
				$userSR["qty"] = $qty;
				$userSR["sloc"] = $slocs;
				$userSR["qctest"] = $state;
				$userSR["sampleno"] = $sampleno;
				$userSR["spdate"] = $spdate;
				$userSR["sampflg"] = $sampflg;
				$userSR["sampcldate"] = $sampcldate;
				$userSR["sampclrole"] = $sampclrole;
				
				$userSR["denrawwtflg"] = $density_rawwtflg;
			
				array_push($user24,$userSR);
				}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			$user24 = array();
            $stmt->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	public function GetSampleDensityUpdate($sampleno, $samplewt, $scode, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("Y-m-d"); $one=1; $two=2;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole, oldlot  FROM tbl_qctest WHERE  sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
        $stmt->bind_param("sss", $sampno, $yearid, $plantid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole=''; $oldlot='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole, $oldlot);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT density_sampleno FROM tbl_densitydata where density_sampleno=?");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows == 0) 
			{
				$stmt_samp = $this->conn_ps->prepare("Insert into tbl_densitydata (density_date, density_crop, density_variety, density_lotno, density_sampleno, density_orlot, density_rawwtdate, density_rawsampwt, density_rawwtflg, oprid) values(?,?,?,?,?,?,?,?,?,?) ");
				$stmt_samp->bind_param("ssssssssii", $dt, $crop, $variety, $lotno, $sampleno, $oldlot, $dt, $samplewt, $one, $oprid);
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			$stmtsamp->close();	
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }
	
	//New Density Code End


	// GOT Reports Code Start




	public function GetGOTReportSummery($reptype) {

			$flg=0; $user24=array();
			
			if($reptype=="sowpending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 ");
				//$stmtgsampack1->bind_param("s", $sampleno);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						//return "SELECT cropid, cropname FROM tblcrop WHERE cropid = $gotm_crop ";
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid=?");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=? ");
						$stmtgotvar->bind_param("s", $gotm_crop);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										$nooflot=$nooflot+1;
									}
								}
								if($nooflot>0)
								{
									$userSR = array();
									$userSR["crop"] = $cropname;
									$userSR["variety"] = $popularname;
									$userSR["nooflots"] = $nooflot;
									array_push($user24,$userSR);
								}
							}
						}
					}
				}
			}
			else if($reptype=="tppending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 ");
				//$stmtgsampack1->bind_param("s", $sampleno);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? ");
						$stmtgotvar->bind_param("s", $gotm_crop);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();
											
											$tdt=date("Y-m-d"); $gsdd="";
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=30;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											//return $tdt."  =  ".$gsdd;
											if($gsdd!="" && ($gsdd<=$tdt))
											{
												$nooflot=$nooflot+1;
											}
										}	
										
										
										
									}
								}
								if($nooflot>0)
								{
									$userSR = array();
									$userSR["crop"] = $cropname;
									$userSR["variety"] = $popularname;
									$userSR["nooflots"] = $nooflot;
									array_push($user24,$userSR);
								}
							}
						}
					}
				}
			}
			else if($reptype=="fmvpending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0 ");
				//$stmtgsampack1->bind_param("s", $sampleno);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0 AND gotm_crop=? ");
						$stmtgotvar->bind_param("s", $gotm_crop);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0  AND gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										
										
										
										
										
										
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();

											$gsdd=""; $gotsow_dosow='';
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												$dt=date("Y-m-d");
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											$gottransp_date=""; $gottransp_state=""; $gottransp_loc=""; $gottransp_bedno=""; $gottransp_direction="";
											$dt=date("Y-m-d"); $tpdd="";
											$stmt_tplanting = $this->conn_ps->prepare("SELECT gottransp_date, gottransp_state, gottransp_loc, gottransp_bedno, gottransp_direction FROM tbl_qcgottranspl WHERE gotm_id=?");
											$stmt_tplanting->bind_param("i", $gotm_id);
											$result_tplanting=$stmt_tplanting->execute();
											$stmt_tplanting->store_result();
											if ($stmt_tplanting->num_rows > 0) {
												$stmt_tplanting->bind_result($gottransp_date, $gottransp_state, $gottransp_loc, $gottransp_bedno, $gottransp_direction);
												//looping through all the records 
												$stmt_tplanting->fetch();
												$stmt_tplanting->close();
												$tplocations=$gottransp_loc." ".$gottransp_state;
												
												if($gottransp_date!='' && $gottransp_date!='0000-00-00' && $gottransp_date!=NULL)
												{
													$arrival_date1=explode("-",$gottransp_date);
													$tpsowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													$tpdd="";
													if($gottransp_date!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gottransp_date!="")
														{
															$tpdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$tpdd="";
													}
												}
												
											}
											
											if($gsdd!="" && $tpdd=""){$tpdd=$gsdd;}
											
											if($gottransp_date==""){$tplocations=$sowingdate;}
											//return $dt."  =  ".$tpdd;
											if($tpdd!="" && ($tpdd<=$dt))
											{
												$nooflot=$nooflot+1;
											}
										}
										
										
										
										
										
									}
								}
								if($nooflot>0)
								{
									$userSR = array();
									$userSR["crop"] = $cropname;
									$userSR["variety"] = $popularname;
									$userSR["nooflots"] = $nooflot;
									array_push($user24,$userSR);
								}
							}
						}
					}
				}
			}
			else if($reptype=="btspending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0 ");
				//$stmtgsampack1->bind_param("s", $sampleno);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0  AND gotm_crop=? ");
						$stmtgotvar->bind_param("s", $gotm_crop);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0  AND gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										
										
										
										
										
										
										
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();
											
											
											$gsdd=""; $gotsow_dosow=''; $dt=date("Y-m-d");
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											$trdd='';
											if($expdtt>0)
											{
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=$expdtt;
														if($gotsow_dosow!="")
														{
															$trdd2=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
															$gsetupdryear=substr($trdd2,0,4);
															$gsetupdrmonth=substr($trdd2,5,2);
															$gsetupdrday=substr($trdd2,8,2);
															$trdd=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear; 
														}
														else
														$trdd="";
													}
												}
											
											}
											
											if($gsdd!="" && $tpdd=""){$tpdd=$gsdd;}
											//return $dt."  =  ".$tpdd;
											if($gsdd!="" && ($gsdd<=$dt))
											{
												$nooflot=$nooflot+1;
											}
										}
										
										
										
										
										
									}
								}
								if($nooflot>0)
								{
									$userSR = array();
									$userSR["crop"] = $cropname;
									$userSR["variety"] = $popularname;
									$userSR["nooflots"] = $nooflot;
									array_push($user24,$userSR);
								}
								
							}
						}
					}
				}
			}
			else
			{
				$user24 = array();
			}
			
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }

	
	
	
	
	
	public function GetGOTReportDetails($reptype, $orcrop, $orvariety) {

			$flg=0; $user24=array();
			
			$stmtcrop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropname=?");
			$stmtcrop->bind_param("s", $orcrop);
			$resultcrop=$stmtcrop->execute();
			$stmtcrop->store_result();
			if ($stmtcrop->num_rows > 0) {
				$stmtcrop->bind_result($crpid, $crpname);
				//looping through all the records 
				$stmtcrop->fetch();
				$stmtcrop->close();
			}
			if($orvariety!=($crpname."-Coded"))
			{
				$stmtvariety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
				$stmtvariety->bind_param("s", $orvariety);
				$resultvariety=$stmtvariety->execute();
				$stmtvariety->store_result();
				if ($stmtvariety->num_rows > 0) {
					$stmtvariety->bind_result($vertid, $vertname);
					//looping through all the records 
					$stmtvariety->fetch();
					$stmtvariety->close();
				}
			}
			else
			{
				$vertid=$orvariety;
			}
			if($reptype=="sowpending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=?");
				$stmtgotcrop->bind_param("s", $crpid);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						//return "SELECT cropid, cropname FROM tblcrop WHERE cropid = $gotm_crop ";
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid=?");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=? and gotm_variety=?");
						$stmtgotvar->bind_param("ss", $gotm_crop, $vertid);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno);
											$stmtgotlot2->fetch();
											
											$lott=str_split($gotm_lotno);
											$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
											
											$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
											
											$arrdate=''; $spcodes=''; $organiser=''; $farmer=''; $ploc=''; $lotstate=''; $pper=''; $gotstatus=''; $slocs=''; $nob=0; $qty=0;
											$stmt_arrsub = $this->conn_ps->prepare("SELECT arrival_id, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, got FROM tblarrival_sub WHERE old=?");
											$stmt_arrsub->bind_param("s", $oldlt);
											$result_arrsub=$stmt_arrsub->execute();
											$stmt_arrsub->store_result();
											if ($stmt_arrsub->num_rows > 0) {
												$stmt_arrsub->bind_result($arrival_id, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $got);
												//looping through all the records 
												$stmt_arrsub->fetch();
												$stmt_arrsub->close();
												
												$spcodes=$spcodef." x ".$spcodem;
												$gotstatus=$got." UT";
												
												$stmt_arrmain = $this->conn_ps->prepare("SELECT arrival_date FROM tblarrival WHERE arrival_id=?");
												$stmt_arrmain->bind_param("i", $arrival_id);
												$result_arrmain=$stmt_arrmain->execute();
												$stmt_arrmain->store_result();
												if ($stmt_arrmain->num_rows > 0) {
													$stmt_arrmain->bind_result($arrival_date);
													//looping through all the records 
													$stmt_arrmain->fetch();
													$stmt_arrmain->close();
													
													if($arrival_date!='' && $arrival_date!='0000-00-00' && $arrival_date!=NULL)
													{
														$arrival_date1=explode("-",$arrival_date);
														$arrdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													}
													
												}
												
											}
											
											$stmt_m = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE orlot = ? ");
											$stmt_m->bind_param("s", $orlot);
											$result_m=$stmt_m->execute();
											$stmt_m->store_result();
											if ($stmt_m->num_rows > 0) {
												$stmt_m->bind_result($lotldg_subbinid);
												while($stmt_m->fetch())
												{
												
													$stmt_s = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot=? and lotldg_subbinid = ? ");
													$stmt_s->bind_param("ss", $orlot, $lotldg_subbinid);
													$result_s=$stmt_s->execute();
													$stmt_s->store_result();
													if ($stmt_s->num_rows > 0) {
														$stmt_s->bind_result($lotldg_id);
														while($stmt_s->fetch())
														{
															$stmt_ss = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty, lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_id = ? ");
															$stmt_ss->bind_param("i", $lotldg_id);
															$result_ss=$stmt_ss->execute();
															$stmt_ss->store_result();
															if ($stmt_ss->num_rows > 0) {
																$stmt_ss->bind_result($lotldg_balbags, $lotldg_balqty, $lotldg_binid, $lotldg_whid);
																while($stmt_ss->fetch())
																{
																	$wareh=""; $binn=""; $subbinn="";
											
																	$slups=$lotldg_balbags;
																	$slqty=$lotldg_balqty;
																	
																	$nob=$nob+$slups;
																	$qty=$qty+$slqty;
																	
																	$stmt_wh = $this->conn_ps->prepare("select perticulars from tbl_warehouse where whid = ? ");
																	$stmt_wh->bind_param("i", $lotldg_whid);
																	$result_wh=$stmt_wh->execute();
																	$stmt_wh->store_result();
																	$stmt_wh->bind_result($perticulars);
																	$stmt_wh->fetch();
																	$wareh=$perticulars."/";
																	$stmt_wh->close();
																	
																	$stmt_bn = $this->conn_ps->prepare("select binname from tbl_bin where binid = ?  and whid = ?");
																	$stmt_bn->bind_param("ii", $lotldg_binid, $lotldg_whid);
																	$result_bn=$stmt_bn->execute();
																	$stmt_bn->store_result();
																	$stmt_bn->bind_result($binname);
																	$stmt_bn->fetch();
																	$binn=$binname."/";
																	$stmt_bn->close();
																	
																	$stmt_sbn = $this->conn_ps->prepare("select sname from tbl_subbin where sid = ? and binid = ?  and whid = ?");
																	$stmt_sbn->bind_param("iii", $lotldg_subbinid, $lotldg_binid, $lotldg_whid);
																	$result_sbn=$stmt_sbn->execute();
																	$stmt_sbn->store_result();
																	$stmt_sbn->bind_result($sname);
																	$stmt_sbn->fetch();
																	$subbinn=$sname;
																	$stmt_sbn->close();
																	
																	if($slocs!="")
																	$slocs=$slocs.",".$wareh.$binn.$subbinn;
																	else
																	$slocs=$wareh.$binn.$subbinn;	
																}	
															}
															$stmt_ss->close();
														}
													}
													$stmt_s->close();
												}
											}
											$stmt_m->close();
										
											$userSR = array();
											$userSR["arrivaldate"] = $arrdate;
											$userSR["crop"] = $cropname;
											$userSR["spcodes"] = $spcodes;
											$userSR["variety"] = $popularname;
											$userSR["lotno"] = $gotm_lotno;
											$userSR["sampleno"] = $gotm_sampleno;
											$userSR["nob"] = $nob;
											$userSR["qty"] = $qty;
											$userSR["gotstatus"] = $gotstatus;
											$userSR["prodloc"] = $ploc;
											$userSR["organizer"] = $organiser;
											$userSR["farmer"] = $farmer;
											$userSR["prodper"] = $pper;
											$userSR["sloc"] = $slocs;
											$userSR["dateofsowing"] = '';
											$userSR["sownurseryloc"] = '';
											$userSR["sowbedno"] = '';
											$userSR["sowtrayno"] = '';
											$userSR["sownooftray"] = '';
											$userSR["tpsowloc"] = '';
											$userSR["dateoftp"] = '';
											$userSR["tpbedno"] = '';
											$userSR["tpdirection"] = '';
											$userSR["ttivresultdate"] = '';
											
											array_push($user24,$userSR);
										}
									}
								}
								
								
							}
						}
					}
				}
			}
			else if($reptype=="tppending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=?");
				$stmtgotcrop->bind_param("s", $crpid);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? and gotm_variety=?");
						$stmtgotvar->bind_param("ss", $gotm_crop, $vertid);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg=0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();
											
											$lott=str_split($gotm_lotno);
											$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
											
											$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
											
											$arrdate=''; $spcodes=''; $organiser=''; $farmer=''; $ploc=''; $lotstate=''; $pper=''; $gotstatus=''; $slocs=''; $nob=0; $qty=0;
											$stmt_arrsub = $this->conn_ps->prepare("SELECT arrival_id, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, got FROM tblarrival_sub WHERE old=?");
											$stmt_arrsub->bind_param("s", $oldlt);
											$result_arrsub=$stmt_arrsub->execute();
											$stmt_arrsub->store_result();
											if ($stmt_arrsub->num_rows > 0) {
												$stmt_arrsub->bind_result($arrival_id, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $got);
												//looping through all the records 
												$stmt_arrsub->fetch();
												$stmt_arrsub->close();
												
												$spcodes=$spcodef." x ".$spcodem;
												$gotstatus=$got." UT";
												
												$stmt_arrmain = $this->conn_ps->prepare("SELECT arrival_date FROM tblarrival WHERE arrival_id=?");
												$stmt_arrmain->bind_param("i", $arrival_id);
												$result_arrmain=$stmt_arrmain->execute();
												$stmt_arrmain->store_result();
												if ($stmt_arrmain->num_rows > 0) {
													$stmt_arrmain->bind_result($arrival_date);
													//looping through all the records 
													$stmt_arrmain->fetch();
													$stmt_arrmain->close();
													
													if($arrival_date!='' && $arrival_date!='0000-00-00' && $arrival_date!=NULL)
													{
														$arrival_date1=explode("-",$arrival_date);
														$arrdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													}
													
												}
												
											}
											
											$tdt=date("Y-m-d"); $gsdd="";
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=30;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											//return $tdt."  =  ".$gsdd;
											if($gsdd!="" && ($gsdd<=$tdt))
											{
												$userSR = array();
												$userSR["arrivaldate"] = $arrdate;
												$userSR["crop"] = $cropname;
												$userSR["spcodes"] = $spcodes;
												$userSR["variety"] = $popularname;
												$userSR["lotno"] = $gotm_lotno;
												$userSR["sampleno"] = $gotm_sampleno;
												$userSR["nob"] = '';
												$userSR["qty"] = '';
												$userSR["gotstatus"] = '';
												$userSR["prodloc"] = '';
												$userSR["organizer"] = '';
												$userSR["farmer"] = '';
												$userSR["prodper"] = '';
												$userSR["sloc"] = '';
												$userSR["dateofsowing"] = $sowingdate;
												$userSR["sownurseryloc"] = $locations;
												$userSR["sowbedno"] = $gotsow_bedno;
												$userSR["sowtrayno"] = $gotsow_treynumber;
												$userSR["sownooftray"] = $gotsow_nooftraylot;
												$userSR["tpsowloc"] = '';
												$userSR["dateoftp"] = '';
												$userSR["tpbedno"] = '';
												$userSR["tpdirection"] = '';
												$userSR["ttivresultdate"] = '';
												
												array_push($user24,$userSR);
											}
										}
									}
								}
								
								
							}
						}
					}
				}
			}
			else if($reptype=="fmvpending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0 and gotm_crop=?");
				$stmtgotcrop->bind_param("s", $crpid);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0 AND gotm_crop=? and gotm_variety=?");
						$stmtgotvar->bind_param("ss", $gotm_crop, $vertid);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=0  AND gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();
											
											$lott=str_split($gotm_lotno);
											$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
											
											$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
											
											$arrdate=''; $spcodes=''; $organiser=''; $farmer=''; $ploc=''; $lotstate=''; $pper=''; $gotstatus=''; $slocs=''; $nob=0; $qty=0;
											$stmt_arrsub = $this->conn_ps->prepare("SELECT arrival_id, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, got FROM tblarrival_sub WHERE old=?");
											$stmt_arrsub->bind_param("s", $oldlt);
											$result_arrsub=$stmt_arrsub->execute();
											$stmt_arrsub->store_result();
											if ($stmt_arrsub->num_rows > 0) {
												$stmt_arrsub->bind_result($arrival_id, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $got);
												//looping through all the records 
												$stmt_arrsub->fetch();
												$stmt_arrsub->close();
												
												$spcodes=$spcodef." x ".$spcodem;
												$gotstatus=$got." UT";
												
												$stmt_arrmain = $this->conn_ps->prepare("SELECT arrival_date FROM tblarrival WHERE arrival_id=?");
												$stmt_arrmain->bind_param("i", $arrival_id);
												$result_arrmain=$stmt_arrmain->execute();
												$stmt_arrmain->store_result();
												if ($stmt_arrmain->num_rows > 0) {
													$stmt_arrmain->bind_result($arrival_date);
													//looping through all the records 
													$stmt_arrmain->fetch();
													$stmt_arrmain->close();
													
													if($arrival_date!='' && $arrival_date!='0000-00-00' && $arrival_date!=NULL)
													{
														$arrival_date1=explode("-",$arrival_date);
														$arrdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													}
													
												}
												
											}
											
											$gsdd=""; $gotsow_dosow='';
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												$dt=date("Y-m-d");
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											$gottransp_date=""; $gottransp_state=""; $gottransp_loc=""; $gottransp_bedno=""; $gottransp_direction="";
											$dt=date("Y-m-d"); $tpdd="";
											$stmt_tplanting = $this->conn_ps->prepare("SELECT gottransp_date, gottransp_state, gottransp_loc, gottransp_bedno, gottransp_direction FROM tbl_qcgottranspl WHERE gotm_id=?");
											$stmt_tplanting->bind_param("i", $gotm_id);
											$result_tplanting=$stmt_tplanting->execute();
											$stmt_tplanting->store_result();
											if ($stmt_tplanting->num_rows > 0) {
												$stmt_tplanting->bind_result($gottransp_date, $gottransp_state, $gottransp_loc, $gottransp_bedno, $gottransp_direction);
												//looping through all the records 
												$stmt_tplanting->fetch();
												$stmt_tplanting->close();
												$tplocations=$gottransp_loc." ".$gottransp_state;
												
												if($gottransp_date!='' && $gottransp_date!='0000-00-00' && $gottransp_date!=NULL)
												{
													$arrival_date1=explode("-",$gottransp_date);
													$tpsowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													$tpdd="";
													if($gottransp_date!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gottransp_date!="")
														{
															$tpdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$tpdd="";
													}
												}
												
											}
											
											if($gsdd!="" && $tpdd=""){$tpdd=$gsdd;}
											if($gottransp_date==""){$tplocations=$sowingdate;}
											//return $dt."  =  ".$tpdd;
											if($tpdd!="" && ($tpdd<=$dt))
											{
												$userSR = array();
												$userSR["arrivaldate"] = $arrdate;
												$userSR["crop"] = $cropname;
												$userSR["spcodes"] = $spcodes;
												$userSR["variety"] = $popularname;
												$userSR["lotno"] = $gotm_lotno;
												$userSR["sampleno"] = $gotm_sampleno;
												$userSR["nob"] = '';
												$userSR["qty"] = '';
												$userSR["gotstatus"] = '';
												$userSR["prodloc"] = '';
												$userSR["organizer"] = '';
												$userSR["farmer"] = '';
												$userSR["prodper"] = '';
												$userSR["sloc"] = '';
												$userSR["dateofsowing"] = '';
												$userSR["sownurseryloc"] = '';
												$userSR["sowbedno"] = '';
												$userSR["sowtrayno"] = '';
												$userSR["sownooftray"] = '';
												$userSR["tpsowloc"] = $tplocations;
												$userSR["dateoftp"] = $tpsowingdate;
												$userSR["tpbedno"] = $gottransp_bedno;
												$userSR["tpdirection"] = $gottransp_direction;
												$userSR["ttivresultdate"] = '';
												
												array_push($user24,$userSR);
											}
										}
									}
								}
								
								
							}
						}
					}
				}
			}
			else if($reptype=="btspending")
			{
				$stmtgotcrop = $this->conn_ps->prepare("SELECT distinct(gotm_crop) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0 and gotm_crop=?");
				$stmtgotcrop->bind_param("s", $crpid);
				$resultgotcrop=$stmtgotcrop->execute();
				$stmtgotcrop->store_result();
				if ($stmtgotcrop->num_rows > 0) 
				{
					$stmtgotcrop->bind_result($gotm_crop);
					while($stmtgotcrop->fetch())
					{
						$gotm_crop = (int)$gotm_crop;
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
						$expdtt=0; 
						$stmtgotvar = $this->conn_ps->prepare("SELECT distinct(gotm_variety) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0  AND gotm_crop=? and gotm_variety=?");
						$stmtgotvar->bind_param("ss", $gotm_crop, $vertid);
						$resultgotvar=$stmtgotvar->execute();
						$stmtgotvar->store_result();
						if ($stmtgotvar->num_rows > 0) 
						{
							$stmtgotvar->bind_result($gotm_variety);
							while($stmtgotvar->fetch())
							{
								if($gotm_variety!=($cropname."-Coded"))
								{
									$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname, expdtt FROM tblvariety WHERE varietyid = ? ");
									$stmt_variety->bind_param("i", $gotm_variety);
									$result_variety=$stmt_variety->execute();
									$stmt_variety->store_result();
									if ($stmt_variety->num_rows > 0) {
										$stmt_variety->bind_result($varietyid, $popularname, $expdtt);
										//looping through all the records 
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
								}
								else
								{
									$popularname=$gotm_variety;
								}
								$nooflot=0;
								$stmtgotlot = $this->conn_ps->prepare("SELECT distinct(gotm_lotno) FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 AND gotm_fieldmflg=1 AND gotm_finobrflg=0  AND gotm_crop=? AND gotm_variety=? ");
								$stmtgotlot->bind_param("ss", $gotm_crop, $gotm_variety);
								$resultgotlot=$stmtgotlot->execute();
								$stmtgotlot->store_result();
								if ($stmtgotlot->num_rows > 0) 
								{
									$stmtgotlot->bind_result($gotm_lotno);
									while($stmtgotlot->fetch())
									{
										
										$stmtgotlot2 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sowingflg=1 and gotm_transplantflg>0 and gotm_crop=? AND gotm_variety=? AND gotm_lotno=? ");
										$stmtgotlot2->bind_param("sss", $gotm_crop, $gotm_variety, $gotm_lotno);
										$resultgotlot2=$stmtgotlot2->execute();
										$stmtgotlot2->store_result();
										if ($stmtgotlot2->num_rows > 0) 
										{
											$stmtgotlot2->bind_result($gotm_sampleno, $gotm_id);
											$stmtgotlot2->fetch();
											
											$lott=str_split($gotm_lotno);
											$oldlt=$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6];	
											
											$orlot=$lott[0].$lott[1].$lott[2].$lott[3].$lott[4].$lott[5].$lott[6].$lott[7].$lott[8].$lott[9].$lott[10].$lott[11].$lott[12].$lott[13].$lott[14].$lott[15];	
											
											$arrdate=''; $spcodes=''; $organiser=''; $farmer=''; $ploc=''; $lotstate=''; $pper=''; $gotstatus=''; $slocs=''; $nob=0; $qty=0;
											$stmt_arrsub = $this->conn_ps->prepare("SELECT arrival_id, spcodef, spcodem, organiser, farmer, ploc, lotstate, pper, got FROM tblarrival_sub WHERE old=?");
											$stmt_arrsub->bind_param("s", $oldlt);
											$result_arrsub=$stmt_arrsub->execute();
											$stmt_arrsub->store_result();
											if ($stmt_arrsub->num_rows > 0) {
												$stmt_arrsub->bind_result($arrival_id, $spcodef, $spcodem, $organiser, $farmer, $ploc, $lotstate, $pper, $got);
												//looping through all the records 
												$stmt_arrsub->fetch();
												$stmt_arrsub->close();
												
												$spcodes=$spcodef." x ".$spcodem;
												$gotstatus=$got." UT";
												
												$stmt_arrmain = $this->conn_ps->prepare("SELECT arrival_date FROM tblarrival WHERE arrival_id=?");
												$stmt_arrmain->bind_param("i", $arrival_id);
												$result_arrmain=$stmt_arrmain->execute();
												$stmt_arrmain->store_result();
												if ($stmt_arrmain->num_rows > 0) {
													$stmt_arrmain->bind_result($arrival_date);
													//looping through all the records 
													$stmt_arrmain->fetch();
													$stmt_arrmain->close();
													
													if($arrival_date!='' && $arrival_date!='0000-00-00' && $arrival_date!=NULL)
													{
														$arrival_date1=explode("-",$arrival_date);
														$arrdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													}
													
												}
												
											}
											
											$gsdd=""; $gotsow_dosow=''; $dt=date("Y-m-d");
											$stmt_sowing = $this->conn_ps->prepare("SELECT gotsow_dosow, gotsow_state, gotsow_loc, gotsow_nooftraylot, gotsow_bedno, gotsow_treynumber FROM tbl_qcgotsowing WHERE gotm_id=?");
											$stmt_sowing->bind_param("i", $gotm_id);
											$result_sowing=$stmt_sowing->execute();
											$stmt_sowing->store_result();
											if ($stmt_sowing->num_rows > 0) {
												$stmt_sowing->bind_result($gotsow_dosow, $gotsow_state, $gotsow_loc, $gotsow_nooftraylot, $gotsow_bedno, $gotsow_treynumber);
												//looping through all the records 
												$stmt_sowing->fetch();
												$stmt_sowing->close();
												$locations=$gotsow_loc." ".$gotsow_state;
												
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=70;
														if($gotsow_dosow!="")
														{
															$gsdd=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
														}
														else
														$gsdd="";
													}
												}
												
											}
											$trdd='';
											if($expdtt>0)
											{
												if($gotsow_dosow!='' && $gotsow_dosow!='0000-00-00' && $gotsow_dosow!=NULL)
												{
													$arrival_date1=explode("-",$gotsow_dosow);
													$sowingdate=$arrival_date1[2]."-".$arrival_date1[1]."-".$arrival_date1[0];
													
													if($gotsow_dosow!='')
													{
														$m=$arrival_date1[1];
														$de=$arrival_date1[2];
														$y=$arrival_date1[0];
														$dt=$expdtt;
														if($gotsow_dosow!="")
														{
															$trdd2=date('Y-m-d',mktime(0,0,0,$m,($de+30),$y)); 
															$gsetupdryear=substr($trdd2,0,4);
															$gsetupdrmonth=substr($trdd2,5,2);
															$gsetupdrday=substr($trdd2,8,2);
															$trdd=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear; 
														}
														else
														$trdd="";
													}
												}
											
											}
											
											if($gsdd!="" && $tpdd=""){$tpdd=$gsdd;}
											//return $dt."  =  ".$tpdd;
											if($gsdd!="" && ($gsdd<=$dt))
											{
												$userSR = array();
												$userSR["arrivaldate"] = $arrdate;
												$userSR["crop"] = $cropname;
												$userSR["spcodes"] = $spcodes;
												$userSR["variety"] = $popularname;
												$userSR["lotno"] = $gotm_lotno;
												$userSR["sampleno"] = $gotm_sampleno;
												$userSR["nob"] = '';
												$userSR["qty"] = '';
												$userSR["gotstatus"] = '';
												$userSR["prodloc"] = '';
												$userSR["organizer"] = '';
												$userSR["farmer"] = '';
												$userSR["prodper"] = '';
												$userSR["sloc"] = '';
												$userSR["dateofsowing"] = $sowingdate;
												$userSR["sownurseryloc"] = '';
												$userSR["sowbedno"] = '';
												$userSR["sowtrayno"] = '';
												$userSR["sownooftray"] = '';
												$userSR["tpsowloc"] = '';
												$userSR["dateoftp"] = '';
												$userSR["tpbedno"] = '';
												$userSR["tpdirection"] = '';
												$userSR["ttivresultdate"] = $trdd;
												
												array_push($user24,$userSR);
											}
										}
									}
								}
								
								
							}
						}
					}
				}
			}
			else
			{
				$user24 = array();
			}
			
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }


	public function GetGempImgDataUpdate($sampleno, $testtype, $observation, $new_retImageString_ret, $oprid) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		
		$flg=0;
		$stmtsamp = $this->conn_ps->prepare("SELECT qcg_sampleno FROM tbl_qcgdata where qcg_sampleno=? and qcg_germpflg!=1 and qcg_retestflg=0");
		$stmtsamp->bind_param("s", $sampleno);
		$resultsamp=$stmtsamp->execute();
		$stmtsamp->store_result();
		if ($stmtsamp->num_rows > 0) 
		{
			if($testtype=="SGT")
			{
				if($observation=="First Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtfcimage=?, qcg_sgtimgupdfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				
				if($observation=="Final Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtimage=?, qcg_sgtimgupdfncopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
		
			}
			
			if($testtype=="FGT")
			{
				if($observation=="First Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_fgtfcimage=?, qcg_fgtimgupdfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				
				if($observation=="Final Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_fgtimage=?, qcg_fgtimgupdfncopr=?  where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
			
			}
			
			if($testtype=="SGT with SGTD")
			{
				if($observation=="First Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdfcimage=?, qcg_sgtdimgupdfrcopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				
				if($observation=="Final Count")
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtdimage=?, qcg_sgtdimgupdfncopr=? where qcg_sampleno=?  and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp->bind_param("sis", $new_retImageString_ret, $oprid, $sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
		
			}
				
		}
		$stmtsamp->close();	
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }




	
	public function GetGempSetupSync($email, $scode) {
		$userSR = array(); $user24=array();
			
			$qcg_sampleno=''; $qcg_testtype=''; $qcg_setupflg=0; $qcg_seedsize=0; $qcg_noofseedinonerep=0; $qcg_sgtoneobflg=0; $qcg_sgtnoofrep=0; $qcg_sgtoobnormal1=0; $qcg_sgtoobnormal2=0; $qcg_sgtoobnormal3=0; $qcg_sgtoobnormal4=0; $qcg_sgtoobnormal5=0; $qcg_sgtoobnormal6=0; $qcg_sgtoobnormal7=0; $qcg_sgtoobnormal8=0; $qcg_sgtoobnormalavg=0; $qcg_sgtoobnormaldt=0; $qcg_sgtnormal1=0; $qcg_sgtnormal2=0; $qcg_sgtnormal3=0; $qcg_sgtnormal4=0; $qcg_sgtnormal5=0; $qcg_sgtnormal6=0; $qcg_sgtnormal7=0; $qcg_sgtnormal8=0; $qcg_sgtnormalavg=0; $qcg_sgtabnormal1=0; $qcg_sgtabnormal2=0; $qcg_sgtabnormal3=0; $qcg_sgtabnormal4=0; $qcg_sgtabnormal5=0; $qcg_sgtabnormal6=0; $qcg_sgtabnormal7=0; $qcg_sgtabnormal8=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfug1=0; $qcg_sgthardfug2=0; $qcg_sgthardfug3=0; $qcg_sgthardfug4=0; $qcg_sgthardfug5=0; $qcg_sgthardfug6=0; $qcg_sgthardfug7=0; $qcg_sgthardfug8=0; $qcg_sgthardfugavg=0; $qcg_sgtdead1=0; $qcg_sgtdead2=0; $qcg_sgtdead3=0; $qcg_sgtdead4=0; $qcg_sgtdead5=0; $qcg_sgtdead6=0; $qcg_sgtdead7=0; $qcg_sgtdead8=0; $qcg_sgtdeadavg=0; $qcg_sgtdt=''; $qcg_sgtvremark=''; $qcg_vigtesttype=''; $qcg_vigoneobflg=0; $qcg_vignoofrep=0; $qcg_vigoobnormal1=0; $qcg_vigoobnormal2=0; $qcg_vigoobnormal3=0; $qcg_vigoobnormal4=0; $qcg_vigoobnormal5=0; $qcg_vigoobnormal6=0; $qcg_vigoobnormal7=0; $qcg_vigoobnormal8=0; $qcg_vigoobnormalavg=0; $qcg_vigoobnormaldt=''; $qcg_vignormal1=0; $qcg_vignormal2=0; $qcg_vignormal3=0; $qcg_vignormal4=0; $qcg_vignormal5=0; $qcg_vignormal6=0; $qcg_vignormal7=0; $qcg_vignormal8=0; $qcg_vignormalavg=0; $qcg_vigabnormal1=0; $qcg_vigabnormal2=0; $qcg_vigabnormal3=0; $qcg_vigabnormal4=0; $qcg_vigabnormal5=0; $qcg_vigabnormal6=0; $qcg_vigabnormal7=0; $qcg_vigabnormal8=0; $qcg_vigabnormalavg=0; $qcg_vigdead1=0; $qcg_vigdead2=0; $qcg_vigdead3=0; $qcg_vigdead4=0; $qcg_vigdead5=0; $qcg_vigdead6=0; $qcg_vigdead7=0; $qcg_vigdead8=0; $qcg_vigdeadavg=0; $qcg_viglogid=0; $qcg_vigdt=0; $qcg_viggermp=0; $qcg_vigflg=0; $qcg_vigvremark=''; $qcg_oprremark=''; $qcg_sgtflg=0; $fingermpflg=0; $qcg_germpflg=0; $qcg_noofseedinonerepfgt=0; $nosiorsgtd=0; $qcg_noofseedinonerepsgtd=0; $qcg_sgtdoneobflg=0; $qcg_sgtdnoofrep=0; $qcg_sgtdoobnormal1=0; $qcg_sgtdoobnormal2=0; $qcg_sgtdoobnormal3=0; $qcg_sgtdoobnormal4=0; $qcg_sgtdoobnormal5=0; $qcg_sgdtoobnormal6=0; $qcg_sgtdoobnormal7=0; $qcg_sgtdoobnormal8=0; $qcg_sgtdoobnormalavg=0; $qcg_sgtdoobnormaldt=0; $qcg_sgtdnormal1=0; $qcg_sgtdnormal2=0; $qcg_sgtdnormal3=0; $qcg_sgtdnormal4=0; $qcg_sgtdnormal5=0; $qcg_sgtdnormal6=0; $qcg_sgtdnormal7=0; $qcg_sgtdnormal8=0; $qcg_sgtdnormalavg=0; $qcg_sgtdabnormal1=0; $qcg_sgtdabnormal2=0; $qcg_sgtdabnormal3=0; $qcg_sgtdabnormal4=0; $qcg_sgtdabnormal5=0; $qcg_sgtdabnormal6=0; $qcg_sgtdabnormal7=0; $qcg_sgtdabnormal8=0; $qcg_sgtdabnormalavg=0; $qcg_sgtdhardfug1=0; $qcg_sgtdhardfug2=0; $qcg_sgtdhardfug3=0; $qcg_sgtdhardfug4=0; $qcg_sgtdhardfug5=0; $qcg_sgtdhardfug6=0; $qcg_sgtdhardfug7=0; $qcg_sgtdhardfug8=0; $qcg_sgtdhardfugavg=0; $qcg_sgtddead1=0; $qcg_sgtddead2=0; $qcg_sgtddead3=0; $qcg_sgtddead4=0; $qcg_sgtddead5=0; $qcg_sgtddead6=0; $qcg_sgtddead7=0; $qcg_sgtddead8=0; $qcg_sgtddeadavg=0; $qcg_sgtddt=0; $qcg_sgtdvremark=0; $qcg_sgtdflg=0; 
			$qcg_sgtimage=''; $qcg_fgtimage=''; $qcg_sgtdimage=''; $qcg_sgtdremark=''; $qcg_sgtfcimage=''; $qcg_fgtfcimage=''; $qcg_sgtdfcimage=''; $qcg_sgtfcremark=''; $qcg_fgtfcremark=''; $qcg_sgtdfcremark=''; $qcg_sgtremark=''; $qcg_fgtremark='';  $qcg_fgtoprremark=''; $qcg_sgtdoprremark=''; $qcg_setupdt='';
			
			
			$stmt_samp = $this->conn_ps->prepare("SELECT qcg_sampleno, qcg_testtype, qcg_setupflg, qcg_setupdt, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtoneobflg, qcg_sgtnoofrep, qcg_sgtoobnormal1, qcg_sgtoobnormal2, qcg_sgtoobnormal3, qcg_sgtoobnormal4, qcg_sgtoobnormal5, qcg_sgtoobnormal6, qcg_sgtoobnormal7, qcg_sgtoobnormal8, qcg_sgtoobnormalavg, qcg_sgtoobnormaldt, qcg_sgtnormal1, qcg_sgtnormal2, qcg_sgtnormal3, qcg_sgtnormal4, qcg_sgtnormal5, qcg_sgtnormal6, qcg_sgtnormal7, qcg_sgtnormal8, qcg_sgtnormalavg, qcg_sgtabnormal1, qcg_sgtabnormal2, qcg_sgtabnormal3, qcg_sgtabnormal4, qcg_sgtabnormal5, qcg_sgtabnormal6, qcg_sgtabnormal7, qcg_sgtabnormal8, qcg_sgtabnormalavg, qcg_sgthardfug1, qcg_sgthardfug2, qcg_sgthardfug3, qcg_sgthardfug4, qcg_sgthardfug5, qcg_sgthardfug6, qcg_sgthardfug7, qcg_sgthardfug8, qcg_sgthardfugavg, qcg_sgtdead1, qcg_sgtdead2, qcg_sgtdead3, qcg_sgtdead4, qcg_sgtdead5, qcg_sgtdead6, qcg_sgtdead7, qcg_sgtdead8, qcg_sgtdeadavg, qcg_sgtdt, qcg_sgtvremark, qcg_vigtesttype, qcg_vigoneobflg, qcg_vignoofrep, qcg_vigoobnormal1, qcg_vigoobnormal2, qcg_vigoobnormal3, qcg_vigoobnormal4, qcg_vigoobnormal5, qcg_vigoobnormal6, qcg_vigoobnormal7, qcg_vigoobnormal8, qcg_vigoobnormalavg, qcg_vigoobnormaldt, qcg_vignormal1, qcg_vignormal2, qcg_vignormal3, qcg_vignormal4, qcg_vignormal5, qcg_vignormal6, qcg_vignormal7, qcg_vignormal8, qcg_vignormalavg, qcg_vigabnormal1, qcg_vigabnormal2, qcg_vigabnormal3, qcg_vigabnormal4, qcg_vigabnormal5, qcg_vigabnormal6, qcg_vigabnormal7, qcg_vigabnormal8, qcg_vigabnormalavg, qcg_vigdead1, qcg_vigdead2, qcg_vigdead3, qcg_vigdead4, qcg_vigdead5, qcg_vigdead6, qcg_vigdead7, qcg_vigdead8, qcg_vigdeadavg, qcg_viglogid, qcg_vigdt, qcg_viggermp, qcg_vigflg, qcg_vigvremark, qcg_oprremark, qcg_sgtflg, qcg_germpflg, qcg_noofseedinonerepfgt, qcg_noofseedinonerepsgtd, qcg_sgtdoneobflg, qcg_sgtdnoofrep, qcg_sgtdoobnormal1, qcg_sgtdoobnormal2, qcg_sgtdoobnormal3, qcg_sgtdoobnormal4, qcg_sgtdoobnormal5, qcg_sgdtoobnormal6, qcg_sgtdoobnormal7, qcg_sgtdoobnormal8, qcg_sgtdoobnormalavg, qcg_sgtdoobnormaldt, qcg_sgtdnormal1, qcg_sgtdnormal2, qcg_sgtdnormal3, qcg_sgtdnormal4, qcg_sgtdnormal5, qcg_sgtdnormal6, qcg_sgtdnormal7, qcg_sgtdnormal8, qcg_sgtdnormalavg, qcg_sgtdabnormal1, qcg_sgtdabnormal2, qcg_sgtdabnormal3, qcg_sgtdabnormal4, qcg_sgtdabnormal5, qcg_sgtdabnormal6, qcg_sgtdabnormal7, qcg_sgtdabnormal8, qcg_sgtdabnormalavg, qcg_sgtdhardfug1, qcg_sgtdhardfug2, qcg_sgtdhardfug3, qcg_sgtdhardfug4, qcg_sgtdhardfug5, qcg_sgtdhardfug6, qcg_sgtdhardfug7, qcg_sgtdhardfug8, qcg_sgtdhardfugavg, qcg_sgtddead1, qcg_sgtddead2, qcg_sgtddead3, qcg_sgtddead4, qcg_sgtddead5, qcg_sgtddead6, qcg_sgtddead7, qcg_sgtddead8, qcg_sgtddeadavg, qcg_sgtddt, qcg_sgtdvremark, qcg_sgtdflg, qcg_sgtimage, qcg_fgtimage, qcg_sgtdimage, qcg_sgtdremark, qcg_sgtfcimage, qcg_fgtfcimage, qcg_sgtdfcimage, qcg_sgtfcremark, qcg_fgtfcremark, qcg_sgtdfcremark, qcg_sgtremark, qcg_fgtremark, qcg_fgtoprremark, qcg_sgtdoprremark FROM tbl_qcgdata WHERE qcg_germpflg!=1 and qcg_setupflg=1 and qcg_vigflg=0 and qcg_testtype NOT IN ('SGT','SGT with SGTD') ");
			//$stmt_samp->bind_param("s", $sampleno);
			$result_samp=$stmt_samp->execute();
			$stmt_samp->store_result();
			if ($stmt_samp->num_rows > 0) {
				$stmt_samp->bind_result($qcg_sampleno, $qcg_testtype, $qcg_setupflg, $qcg_setupdt, $qcg_seedsize, $qcg_noofseedinonerep, $qcg_sgtoneobflg, $qcg_sgtnoofrep, $qcg_sgtoobnormal1, $qcg_sgtoobnormal2, $qcg_sgtoobnormal3, $qcg_sgtoobnormal4, $qcg_sgtoobnormal5, $qcg_sgtoobnormal6, $qcg_sgtoobnormal7, $qcg_sgtoobnormal8, $qcg_sgtoobnormalavg, $qcg_sgtoobnormaldt, $qcg_sgtnormal1, $qcg_sgtnormal2, $qcg_sgtnormal3, $qcg_sgtnormal4, $qcg_sgtnormal5, $qcg_sgtnormal6, $qcg_sgtnormal7, $qcg_sgtnormal8, $qcg_sgtnormalavg, $qcg_sgtabnormal1, $qcg_sgtabnormal2, $qcg_sgtabnormal3, $qcg_sgtabnormal4, $qcg_sgtabnormal5, $qcg_sgtabnormal6, $qcg_sgtabnormal7, $qcg_sgtabnormal8, $qcg_sgtabnormalavg, $qcg_sgthardfug1, $qcg_sgthardfug2, $qcg_sgthardfug3, $qcg_sgthardfug4, $qcg_sgthardfug5, $qcg_sgthardfug6, $qcg_sgthardfug7, $qcg_sgthardfug8, $qcg_sgthardfugavg, $qcg_sgtdead1, $qcg_sgtdead2, $qcg_sgtdead3, $qcg_sgtdead4, $qcg_sgtdead5, $qcg_sgtdead6, $qcg_sgtdead7, $qcg_sgtdead8, $qcg_sgtdeadavg, $qcg_sgtdt, $qcg_sgtvremark, $qcg_vigtesttype, $qcg_vigoneobflg, $qcg_vignoofrep, $qcg_vigoobnormal1, $qcg_vigoobnormal2, $qcg_vigoobnormal3, $qcg_vigoobnormal4, $qcg_vigoobnormal5, $qcg_vigoobnormal6, $qcg_vigoobnormal7, $qcg_vigoobnormal8, $qcg_vigoobnormalavg, $qcg_vigoobnormaldt, $qcg_vignormal1, $qcg_vignormal2, $qcg_vignormal3, $qcg_vignormal4, $qcg_vignormal5, $qcg_vignormal6, $qcg_vignormal7, $qcg_vignormal8, $qcg_vignormalavg, $qcg_vigabnormal1, $qcg_vigabnormal2, $qcg_vigabnormal3, $qcg_vigabnormal4, $qcg_vigabnormal5, $qcg_vigabnormal6, $qcg_vigabnormal7, $qcg_vigabnormal8, $qcg_vigabnormalavg, $qcg_vigdead1, $qcg_vigdead2, $qcg_vigdead3, $qcg_vigdead4, $qcg_vigdead5, $qcg_vigdead6, $qcg_vigdead7, $qcg_vigdead8, $qcg_vigdeadavg, $qcg_viglogid, $qcg_vigdt, $qcg_viggermp, $qcg_vigflg, $qcg_vigvremark, $qcg_oprremark, $qcg_sgtflg, $qcg_germpflg, $qcg_noofseedinonerepfgt, $qcg_noofseedinonerepsgtd, $qcg_sgtdoneobflg, $qcg_sgtdnoofrep, $qcg_sgtdoobnormal1, $qcg_sgtdoobnormal2, $qcg_sgtdoobnormal3, $qcg_sgtdoobnormal4, $qcg_sgtdoobnormal5, $qcg_sgdtoobnormal6, $qcg_sgtdoobnormal7, $qcg_sgtdoobnormal8, $qcg_sgtdoobnormalavg, $qcg_sgtdoobnormaldt, $qcg_sgtdnormal1, $qcg_sgtdnormal2, $qcg_sgtdnormal3, $qcg_sgtdnormal4, $qcg_sgtdnormal5, $qcg_sgtdnormal6, $qcg_sgtdnormal7, $qcg_sgtdnormal8, $qcg_sgtdnormalavg, $qcg_sgtdabnormal1, $qcg_sgtdabnormal2, $qcg_sgtdabnormal3, $qcg_sgtdabnormal4, $qcg_sgtdabnormal5, $qcg_sgtdabnormal6, $qcg_sgtdabnormal7, $qcg_sgtdabnormal8, $qcg_sgtdabnormalavg, $qcg_sgtdhardfug1, $qcg_sgtdhardfug2, $qcg_sgtdhardfug3, $qcg_sgtdhardfug4, $qcg_sgtdhardfug5, $qcg_sgtdhardfug6, $qcg_sgtdhardfug7, $qcg_sgtdhardfug8, $qcg_sgtdhardfugavg, $qcg_sgtddead1, $qcg_sgtddead2, $qcg_sgtddead3, $qcg_sgtddead4, $qcg_sgtddead5, $qcg_sgtddead6, $qcg_sgtddead7, $qcg_sgtddead8, $qcg_sgtddeadavg, $qcg_sgtddt, $qcg_sgtdvremark, $qcg_sgtdflg, $qcg_sgtimage, $qcg_fgtimage, $qcg_sgtdimage, $qcg_sgtdremark, $qcg_sgtfcimage, $qcg_fgtfcimage, $qcg_sgtdfcimage, $qcg_sgtfcremark, $qcg_fgtfcremark, $qcg_sgtdfcremark, $qcg_sgtremark, $qcg_fgtremark, $qcg_fgtoprremark, $qcg_sgtdoprremark);
				//looping through all the records 
			while($stmt_samp->fetch())
			{	
				
				
				if($qcg_testtype=="SGT" && $qcg_sgtflg>0){$fingermpflg=1;}
				else if($qcg_testtype=="SGT" && $qcg_sgtflg==0){$fingermpflg=2;}
				else if($qcg_testtype=="FGT" && $qcg_vigflg>0){$fingermpflg=1;}
				else if($qcg_testtype=="FGT" && $qcg_vigflg==0){$fingermpflg=2;}
				else if($qcg_testtype=="SGT and FGT" && $qcg_sgtflg>0 && $qcg_vigflg>0){$fingermpflg=1;}
				else if($qcg_testtype=="SGT and FGT" && $qcg_sgtflg==0 && $qcg_vigflg>0){$fingermpflg=2;}
				else if($qcg_testtype=="ALL" && $qcg_sgtflg>0 && $qcg_vigflg==0){$fingermpflg=2;}
				else {$fingermpflg=0;}
				
				$samno=str_split($qcg_sampleno);
				$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
				$plantid=$samno[0];
				$yearid=$samno[1];
				
				$stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole, oldlot  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and plantcode=? ORDER BY tid DESC");
				$stmt->bind_param("sss", $sampno, $yearid, $plantid);
				$stmt->execute();
				$stmt->store_result();
				
				$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole=''; $oldlot='';
				if ($stmt->num_rows > 0) {
					// user existed 
					$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole, $oldlot);
					$stmt->fetch();
					$flg=0;
						
					$stmt->close();
			   // return $resusers;
				} 
				
				$cropname=''; $popularname=''; $seedsize=''; $nosior=0; $nosiorfgt=0;
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior, nosiorfgt FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior, $nosiorfgt);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				if($variety!=''){
					$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
					$stmt_variety->bind_param("i", $variety);
					$result_variety=$stmt_variety->execute();
					$stmt_variety->store_result();
					if ($stmt_variety->num_rows > 0) {
						$stmt_variety->bind_result($varietyid, $popularname);
						//looping through all the records 
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
				$userSR = array();
				//$userSR["arrival_id"] = $arrival_id;
				//$userSR["srdate"] = $srdate;
				$userSR["crop"] = $cropname;
				$userSR["variety"] = $popularname;
				$userSR["lotno"] = $lotno;
				$userSR["trstage"] = $trstage;
				$userSR["sampleno"] = $qcg_sampleno;
				$userSR["qcg_testtype"] = $qcg_testtype;
				$userSR["qcg_setupdt"] = $qcg_setupdt;
				$userSR["seedsize"] = $seedsize;
				
				$userSR["qcg_vigtesttype"] = $qcg_vigtesttype;
				$userSR["qcg_noofseedinonerepfgt"] = $qcg_noofseedinonerepfgt;
				$userSR["qcg_vignoofrep"] = $qcg_vignoofrep;
				
				array_push($user24,$userSR);
			}
			$stmt_samp->close();
	   // return $resusers;
        } else {
            // user not existed
			$userSR = array();
            $stmt_samp->close();
           // return false;
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }




	
	public function GetGempDataSync($email, $scode, $jdata, $oprid) {
		$userSR = array(); $user24=array(); $flg=0;
			
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		foreach($phpArray as $lotary)
		{
			$qcg_fgtdoe=''; $qcg_oprremark=''; $qcg_vigabnormal1=''; $qcg_vigabnormal2=''; $qcg_vigabnormal3=''; $qcg_vigabnormal4=''; $qcg_vigabnormal5=''; $qcg_vigabnormal6=''; $qcg_vigabnormal7=''; $qcg_vigabnormal8=''; $qcg_vigabnormalavg=''; $qcg_vigdead1=''; $qcg_vigdead2=''; $qcg_vigdead3=''; $qcg_vigdead4=''; $qcg_vigdead5=''; $qcg_vigdead6=''; $qcg_vigdead7=''; $qcg_vigdead8=''; $qcg_vigdeadavg=''; $qcg_vignormal1=''; $qcg_vignormal2=''; $qcg_vignormal3=''; $qcg_vignormal4=''; $qcg_vignormal5=''; $qcg_vignormal6=''; $qcg_vignormal7=''; $qcg_vignormal8=''; $qcg_vignormalavg=''; $qcg_vigvremark=''; $sampleno=''; 				
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="qcg_fgtdoe") {$qcg_fgtdoe=$sval; }
				if($skey=="qcg_oprremark") {$qcg_oprremark=$sval; }
				if($skey=="qcg_vigabnormal1") {$qcg_vigabnormal1=$sval; }
				if($skey=="qcg_vigabnormal2") {$qcg_vigabnormal2=$sval; }
				if($skey=="qcg_vigabnormal3") {$qcg_vigabnormal3=$sval; }
				if($skey=="qcg_vigabnormal4") {$qcg_vigabnormal4=$sval; }
				if($skey=="qcg_vigabnormal5") {$qcg_vigabnormal5=$sval; }
				if($skey=="qcg_vigabnormal6") {$qcg_vigabnormal6=$sval; }
				if($skey=="qcg_vigabnormal7") {$qcg_vigabnormal7=$sval; }
				if($skey=="qcg_vigabnormal8") {$qcg_vigabnormal8=$sval; }
				if($skey=="qcg_vigabnormalavg") {$qcg_vigabnormalavg=$sval; }
				if($skey=="qcg_vigdead1") {$qcg_vigdead1=$sval; }
				if($skey=="qcg_vigdead2") {$qcg_vigdead2=$sval; }
				if($skey=="qcg_vigdead3") {$qcg_vigdead3=$sval; }
				if($skey=="qcg_vigdead4") {$qcg_vigdead4=$sval; }
				if($skey=="qcg_vigdead5") {$qcg_vigdead5=$sval; }
				if($skey=="qcg_vigdead6") {$qcg_vigdead6=$sval; }
				if($skey=="qcg_vigdead7") {$qcg_vigdead7=$sval; }
				if($skey=="qcg_vigdead8") {$qcg_vigdead8=$sval; }
				if($skey=="qcg_vigdeadavg") {$qcg_vigdeadavg=$sval; }
				if($skey=="qcg_vignormal1") {$qcg_vignormal1=$sval; }
				if($skey=="qcg_vignormal2") {$qcg_vignormal2=$sval; }
				if($skey=="qcg_vignormal3") {$qcg_vignormal3=$sval; }
				if($skey=="qcg_vignormal4") {$qcg_vignormal4=$sval; }
				if($skey=="qcg_vignormal5") {$qcg_vignormal5=$sval; }
				if($skey=="qcg_vignormal6") {$qcg_vignormal6=$sval; }
				if($skey=="qcg_vignormal7") {$qcg_vignormal7=$sval; }
				if($skey=="qcg_vignormal8") {$qcg_vignormal8=$sval; }
				if($skey=="qcg_vignormalavg") {$qcg_vignormalavg=$sval; }
				if($skey=="qcg_vigvremark") {$qcg_vigvremark=$sval; }
				if($skey=="sampleno") {$sampleno=$sval; }
				
			}		
			$stmt_samp = $this->conn_ps->prepare("SELECT qcg_sampleno, qcg_id FROM tbl_qcgdata WHERE qcg_germpflg!=1 and qcg_setupflg=1 and qcg_sampleno=? ");
			$stmt_samp->bind_param("s", $sampleno);
			$result_samp=$stmt_samp->execute();
			$stmt_samp->store_result();
			if ($stmt_samp->num_rows > 0) {
				$stmt_samp->bind_result($qcg_sampleno, $qcg_id);
				//looping through all the records 
				while($stmt_samp->fetch())
				{	
					$stmt_samp2 = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigdt=?, qcg_oprremark=?, qcg_vignormal1=?, qcg_vignormal2=?, qcg_vignormal3=?, qcg_vignormal4=?, qcg_vignormal5=?, qcg_vignormal6=?, qcg_vignormal7=?, qcg_vignormal8=?, qcg_vignormalavg=?, qcg_vigabnormal1=?, qcg_vigabnormal2=?, qcg_vigabnormal3=?, qcg_vigabnormal4=?, qcg_vigabnormal5=?, qcg_vigabnormal6=?, qcg_vigabnormal7=?, qcg_vigabnormal8=?, qcg_vigabnormalavg=?, qcg_vigdead1=?, qcg_vigdead2=?, qcg_vigdead3=?, qcg_vigdead4=?, qcg_vigdead5=?, qcg_vigdead6 =?, qcg_vigdead7=?, qcg_vigdead8=?,  qcg_vigdeadavg =?, qcg_viglogid=?, qcg_vigvremark=?, qcg_fgtfncopr=? where qcg_sampleno=? and qcg_germpflg!=1 and qcg_retestflg=0");
					$stmt_samp2->bind_param("ssiiiiiiiisiiiiiiiisiiiiiiiisssis", $qcg_fgtdoe, $qcg_oprremark, $qcg_vignormal1, $qcg_vignormal2, $qcg_vignormal3, $qcg_vignormal4, $qcg_vignormal5, $qcg_vignormal6, $qcg_vignormal7, $qcg_vignormal8, $qcg_vignormalavg, $qcg_vigabnormal1, $qcg_vigabnormal2, $qcg_vigabnormal3, $qcg_vigabnormal4, $qcg_vigabnormal5, $qcg_vigabnormal6, $qcg_vigabnormal7, $qcg_vigabnormal8, $qcg_vigabnormalavg, $qcg_vigdead1, $qcg_vigdead2, $qcg_vigdead3, $qcg_vigdead4, $qcg_vigdead5, $qcg_vigdead6, $qcg_vigdead7, $qcg_vigdead8, $qcg_vigdeadavg, $scode, $qcg_vigvremark, $oprid, $sampleno);
					$result_samp2=$stmt_samp2->execute();
					if($result_samp2){$flg++;}
					$stmt_samp2->close();
				}
				$stmt_samp->close();
		   		// return $resusers;
			} 
		}
		if($flg==0)
		{return false;}
		else
		{return true;}
    }



	// GOT Reports Code End
	
	
	public function getGOTLocationList($statename) {
      	$userSR = array(); 
			
		$stmt_gotloc = $this->conn_ps->prepare("SELECT gotsow_loc FROM tbl_qcgotsowing where gotsow_state=? and gotsow_sptype='Direct Sowing' group by gotsow_loc order by gotsow_loc ");
		$stmt_gotloc->bind_param("s", $statename);
		$result_state=$stmt_gotloc->execute();
		$stmt_gotloc->store_result();
		if ($stmt_gotloc->num_rows > 0) {
			$stmt_gotloc->bind_result($loc_name);
			//looping through all the records 
			while($stmt_gotloc->fetch())
			{
				$pcode='';
				$pcode=trim($loc_name); 
				array_push($userSR,$pcode);
			}
			$stmt_gotloc->close();
		}
		
		$stmt_gotloc = $this->conn_ps->prepare("SELECT gottransp_loc FROM tbl_qcgottranspl where gottransp_state=? group by gottransp_loc order by gottransp_loc ");
		$stmt_gotloc->bind_param("s", $statename);
		$result_state=$stmt_gotloc->execute();
		$stmt_gotloc->store_result();
		if ($stmt_gotloc->num_rows > 0) {
			$stmt_gotloc->bind_result($loc_name);
			//looping through all the records 
			while($stmt_gotloc->fetch())
			{
				$pcode='';
				$pcode=trim($loc_name); 
				array_push($userSR,$pcode);
			}
			$stmt_gotloc->close();
		}
		$userSR = array_unique($userSR);
		sort($userSR);
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	
	
	public function getGOTSamplePendingList($statename, $location) {
		$user24=array(); 
		$flg=0; $gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0; $gotm_ackdate=''; $gotm_crop='';	 
		$stmtgsampack1 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id, gotm_ackdate, gotm_crop FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_finobrflg=2 order by gotm_sampleno ASC");
		//$stmtgsampack1->bind_param("s", $sampleno);
		$resultgsampack1=$stmtgsampack1->execute();
		$stmtgsampack1->store_result();
		if ($stmtgsampack1->num_rows > 0) 
		{
			$stmtgsampack1->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id, $gotm_ackdate, $gotm_crop);
			//looping through all the records 

			while($stmtgsampack1->fetch())
			{
				if($gotm_ackdate!='' && $gotm_ackdate!='0000-00-00' && $gotm_ackdate!=NULL)
				{
					$gotm_ackdate1=explode("-",$gotm_ackdate);
					$gotm_ackdate=$gotm_ackdate1[2]."-".$gotm_ackdate1[1]."-".$gotm_ackdate1[0];
				}
				
				
				if($gotm_id>0)
				{
					if($gotm_crop!=''){
						$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior, nosiorfgt FROM tblcrop WHERE cropid = ? ");
						$stmt_crop->bind_param("i", $gotm_crop);
						$result_crop=$stmt_crop->execute();
						$stmt_crop->store_result();
						if ($stmt_crop->num_rows > 0) {
							$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior, $nosiorfgt);
							//looping through all the records 
							$stmt_crop->fetch();
							$stmt_crop->close();
						}
					}
					
					$sowgotm_id=0; $tplgotm_id=0; 
					$stmtgsow = $this->conn_ps->prepare("SELECT gotm_id  FROM tbl_qcgotsowing WHERE gotm_id = ? and gotsow_state=? and gotsow_loc=? ");
					$stmtgsow->bind_param("iss", $gotm_id, $statename, $location);
					$resultgsow=$stmtgsow->execute();
					$stmtgsow->store_result();
					if ($stmtgsow->num_rows > 0) 
					{
						$stmtgsow->bind_result($sowgotm_id);
						//looping through all the records 
						$stmtgsow->fetch();
					}	
					$stmtgsow->close();
					
		//return "SELECT gotm_id FROM tbl_qcgottranspl WHERE gotm_id='$gotm_id' and gottransp_state='$statename' and gottransp_loc='$location' ";			
					
					$stmtgtranspl = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgottranspl WHERE gotm_id = ? and gottransp_state=? and gottransp_loc=? ");
					$stmtgtranspl->bind_param("iss", $gotm_id, $statename, $location);
					$resultgtranspl=$stmtgtranspl->execute();
					$stmtgtranspl->store_result();
					if ($stmtgtranspl->num_rows > 0) 
					{
						$stmtgtranspl->bind_result($tplgotm_id);
						//looping through all the records 
						$stmtgtranspl->fetch();
					}	
					$stmtgtranspl->close();
					
					if($sowgotm_id>0 || $tplgotm_id>0)
					{
						$stmtgfmv = $this->conn_ps->prepare("SELECT fnobser_noofplants, fnobser_maleplants, fnobser_femaleplants, fnobser_otherofftype, fnobser_obserdate, fnobser_remarks, fnobser_total FROM tbl_qcgotfnobser WHERE gotm_id = ? ");
						$stmtgfmv->bind_param("i", $gotm_id);
						$resultgtranspl=$stmtgfmv->execute();
						$stmtgfmv->store_result();
						$fmvnumrows=$stmtgfmv->num_rows;
						if ($fmvnumrows > 0) 
						{
							$stmtgfmv->bind_result($fnobser_noofplants, $fnobser_maleplants, $fnobser_femaleplants, $fnobser_otherofftype, $fnobser_obserdate, $fnobser_remarks, $fnobser_total);
							//looping through all the records 
							while($stmtgfmv->fetch())
							{
								if($gotm_sampleno==NULL){$gotm_sampleno='';} if($fnobser_noofplants==NULL){$fnobser_noofplants=0;} if($fnobser_maleplants==NULL){$fnobser_maleplants=0;} if($fnobser_femaleplants==NULL){$fnobser_femaleplants=0;} if($fnobser_otherofftype==NULL){$fnobser_otherofftype=0;} if($fnobser_obserdate==NULL){$fnobser_obserdate='';} if($fnobser_remarks==NULL){$fnobser_remarks='';} if($fnobser_total==NULL){$fnobser_total=0;} 
								
								if($fnobser_obserdate!='' && $fnobser_obserdate!='0000-00-00' && $fnobser_obserdate!=NULL)
								{
									$fnobser_obserdate1=explode("-",$fnobser_obserdate);
									$fnobser_obserdate=$fnobser_obserdate1[2]."-".$fnobser_obserdate1[1]."-".$fnobser_obserdate1[0];
								}
								$gpper=0.00;
								if($fnobser_noofplants>0)
								{
									$fnobser_totalper=round((($fnobser_total/$fnobser_noofplants)*100),2);
									if($fnobser_totalper<100)
									{$gpper=100-$fnobser_totalper;}
									else
									{$gpper=100;}
								}
								$userSR=array();
								$userSR["sampleno"] = $gotm_sampleno;
								$userSR["fnobser_noofplants"] = $fnobser_noofplants;
								$userSR["fnobser_maleplants"] = $fnobser_maleplants;
								$userSR["fnobser_femaleplants"] = $fnobser_femaleplants;
								$userSR["fnobser_otherofftype"] = $fnobser_otherofftype;
								$userSR["fnobser_obserdate"] = $fnobser_obserdate;
								$userSR["fnobser_remarks"] = $fnobser_remarks;
								$userSR["gppercentage"] = $gpper;
								$userSR["cropname"] = $cropname;
								
								array_push($user24,$userSR);
							
							}
						}	
						$stmtgfmv->close();
						
						// return $resusers;
					}   
				}
			}
			$stmtgsampack1->close();
		}
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	
	public function GetSampleDataGot($sampleno) {
		
		$flg=0; $gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0; $gotm_ackdate=''; $gotm_crop=''; $gotm_variety=''; $gotm_lotno='';	$gotm_gottid=0; 
		$stmtgsampack1 = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id, gotm_ackdate, gotm_crop, gotm_variety, gotm_lotno, gotm_gottid FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_finobrflg=2 and gotm_sampleno=?");
		$stmtgsampack1->bind_param("s", $sampleno);
		$resultgsampack1=$stmtgsampack1->execute();
		$stmtgsampack1->store_result();
		if ($stmtgsampack1->num_rows > 0) 
		{
			$stmtgsampack1->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id, $gotm_ackdate, $gotm_crop, $gotm_variety, $gotm_lotno, $gotm_gottid);
			//looping through all the records 
			$stmtgsampack1->fetch();
		}
		if($gotm_ackdate!='' && $gotm_ackdate!='0000-00-00' && $gotm_ackdate!=NULL)
		{
			$gotm_ackdate1=explode("-",$gotm_ackdate);
			$gotm_ackdate=$gotm_ackdate1[2]."-".$gotm_ackdate1[1]."-".$gotm_ackdate1[0];
		}
		$stmtgsampack1->close();
		
		$stmt = $this->conn_ps->prepare("SELECT gottest_tid, gottest_dosdate, gottest_crop, gottest_variety, gottest_lotno, gottest_totnosamp, gottest_smpdispstate, gottest_smpdisploc, gottest_srdate, gottest_spdate, gottest_trstage  FROM tbl_gottest WHERE gottest_tid=? ");
        $stmt->bind_param("i", $gotm_gottid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $dosdate=''; $crop=''; $variety=''; $lotno=''; $totnosamp=''; $state=''; $smpdisploc=''; $srdate=''; $spdate=''; $trstage='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $dosdate, $crop, $variety, $lotno, $totnosamp, $state, $smpdisploc, $srdate, $spdate, $trstage);
			$stmt->fetch();
			
			if($crop==NULL){$crop='';} if($variety==NULL){$variety=0;} if($lotno==NULL){$lotno='';} if($totnosamp==NULL){$totnosamp=0;} if($state==NULL){$state='';} if($smpdisploc==NULL){$smpdisploc='';} 
			if($dosdate!='' && $dosdate!='0000-00-00' && $dosdate!=NULL)
			{
				$dosdate1=explode("-",$dosdate);
				$dosdate=$dosdate1[2]."-".$dosdate1[1]."-".$dosdate1[0];
			}
			if($srdate!='' && $srdate!='0000-00-00' && $srdate!=NULL)
			{
				$srdate1=explode("-",$srdate);
				$srdate=$srdate1[2]."-".$srdate1[1]."-".$srdate1[0];
			}
			if($spdate!='' && $spdate!='0000-00-00' && $spdate!=NULL)
			{
				$spdate1=explode("-",$spdate);
				$spdate=$spdate1[2]."-".$spdate1[1]."-".$spdate1[0];
			}
		}	
		$stmt->close();	
		
		
		
		$cropname=''; $popularname='';
		if($gotm_crop!=''){
			$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname FROM tblcrop WHERE cropid = ? ");
			$stmt_crop->bind_param("i", $gotm_crop);
			$result_crop=$stmt_crop->execute();
			$stmt_crop->store_result();
			if ($stmt_crop->num_rows > 0) {
				$stmt_crop->bind_result($cropid, $cropname);
				//looping through all the records 
				$stmt_crop->fetch();
				$stmt_crop->close();
			}
		}
		if($gotm_variety!=''){
			$stmt_variety = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE varietyid = ? ");
			$stmt_variety->bind_param("i", $gotm_variety);
			$result_variety=$stmt_variety->execute();
			$stmt_variety->store_result();
			if ($stmt_variety->num_rows > 0) {
				$stmt_variety->bind_result($varietyid, $popularname);
				//looping through all the records 
				$stmt_variety->fetch();
				$stmt_variety->close();
			}
			else
			{
				$popularname=$gotm_variety;
			}
		}
		
		if($gotm_id>0)
		{
			$stmtgfmv = $this->conn_ps->prepare("SELECT  fnobser_obserdate, fnobser_croptype, fnobser_noofplants, fnobser_maleplants, fnobser_maleper, fnobser_femaleplants, fnobser_femaleper, fnobser_otherofftype, fnobser_otheroffper, fnobser_blineps, fnobser_blinepsper, fnobser_totalofftype, fnobser_totalofftypeper, fnobser_total, fnobser_totalper, fnobser_self, fnobser_selfper, fnobser_pencilplants, fnobser_pencilplantsper, fnobser_aline, fnobser_alineper, fnobser_blinesh, fnobser_blineshper, fnobser_lg, fnobser_lgper, fnobser_fg, fnobser_fgper, fnobser_bg, fnobser_bgper, fnobser_rt, fnobser_rtper, fnobser_tall, fnobser_tallper, fnobser_late, fnobser_lateper, fnobser_fertile, fnobser_fertileper, fnobser_sterile, fnobser_sterileper, fnobser_outcrosspart, fnobser_outcrosspartper, fnobser_remarks  FROM tbl_qcgotfnobser WHERE gotm_id = ? ");
			$stmtgfmv->bind_param("i", $gotm_id);
			$resultgtranspl=$stmtgfmv->execute();
			$stmtgfmv->store_result();
			$fmvnumrows=$stmtgfmv->num_rows;
			if ($fmvnumrows > 0) 
			{
				$stmtgfmv->bind_result($fnobser_obserdate, $fnobser_croptype, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks);
				//looping through all the records 
				while($stmtgfmv->fetch())
				{
					if($gotm_sampleno==NULL){$gotm_sampleno='';} if($fnobser_noofplants==NULL){$fnobser_noofplants=0;} if($fnobser_maleplants==NULL){$fnobser_maleplants=0;} if($fnobser_femaleplants==NULL){$fnobser_femaleplants=0;} if($fnobser_otherofftype==NULL){$fnobser_otherofftype=0;} if($fnobser_obserdate==NULL){$fnobser_obserdate='';} if($fnobser_remarks==NULL){$fnobser_remarks='';} if($fnobser_total==NULL){$fnobser_total=0;} 
					
					if($fnobser_obserdate!='' && $fnobser_obserdate!='0000-00-00' && $fnobser_obserdate!=NULL)
					{
						$fnobser_obserdate1=explode("-",$fnobser_obserdate);
						$fnobser_obserdate=$fnobser_obserdate1[2]."-".$fnobser_obserdate1[1]."-".$fnobser_obserdate1[0];
					}
					
					$gpper="";
					if($fnobser_total>0 && $fnobser_noofplants>0)
					{
						$fnobser_totalper=round((($fnobser_total/$fnobser_noofplants)*100),2);
						if($fnobser_totalper<100)
						{$gpper=100-$fnobser_totalper;}
						else
						{$gpper=100;}
					}
					
					$userSR["crop"] = $cropname;
					$userSR["variety"] = $popularname;
					$userSR["lotno"] = $gotm_lotno;
					$userSR["sampleno"] = $gotm_sampleno;
					$userSR["srdate"] = $srdate;
					$userSR["scdate"] = $spdate;
					$userSR["sddate"] = $dosdate;
					$userSR["trstage"] = $trstage;
					$userSR["ackdate"] = $gotm_ackdate;
					$userSR["ackflg"] = $gotm_ackflg;
					$userSR["sowingflg"] = $gotm_sowingflg;
					$userSR["transplantflg"] = $gotm_transplantflg;
					$userSR["fieldmflg"] = $gotm_fieldmflg;
					$userSR["finobrflg"] = $gotm_finobrflg;
					$userSR["resamplingflg"] = $gotm_resamplingflg;
					$userSR["retestflg"] = $gotm_retestflg;
					$userSR["sampleno"] = $gotm_sampleno;
					
					$userSR["fnobser_obserdate"] = $fnobser_obserdate;
					$userSR["fnobser_croptype"] = $fnobser_croptype;
					$userSR["fnobser_noofplants"] = $fnobser_noofplants;
					$userSR["fnobser_maleplants"] = $fnobser_maleplants;
					$userSR["fnobser_maleper"] = $fnobser_maleper;
					$userSR["fnobser_femaleplants"] = $fnobser_femaleplants;
					$userSR["fnobser_femaleper"] = $fnobser_femaleper;
					$userSR["fnobser_otherofftype"] = $fnobser_otherofftype;
					$userSR["fnobser_otheroffper"] = $fnobser_otheroffper;
					$userSR["fnobser_blineps"] = $fnobser_blineps;
					$userSR["fnobser_blinepsper"] = $fnobser_blinepsper;
					$userSR["fnobser_totalofftype"] = $fnobser_totalofftype;
					$userSR["fnobser_totalofftypeper"] = $fnobser_totalofftypeper;
					$userSR["fnobser_total"] = $fnobser_total;
					$userSR["fnobser_totalper"] = $fnobser_totalper;
					$userSR["fnobser_self"] = $fnobser_self;
					$userSR["fnobser_selfper"] = $fnobser_selfper;
					$userSR["fnobser_pencilplants"] = $fnobser_pencilplants;
					$userSR["fnobser_pencilplantsper"] = $fnobser_pencilplantsper;
					$userSR["fnobser_aline"] = $fnobser_aline;
					$userSR["fnobser_alineper"] = $fnobser_alineper;
					$userSR["fnobser_blinesh"] = $fnobser_blinesh;
					$userSR["fnobser_blineshper"] = $fnobser_blineshper;
					$userSR["fnobser_lg"] = $fnobser_lg;
					$userSR["fnobser_lgper"] = $fnobser_lgper;
					$userSR["fnobser_fg"] = $fnobser_fg;
					$userSR["fnobser_fgper"] = $fnobser_fgper;
					$userSR["fnobser_bg"] = $fnobser_bg;
					$userSR["fnobser_bgper"] = $fnobser_bgper;
					$userSR["fnobser_rt"] = $fnobser_rt;
					$userSR["fnobser_rtper"] = $fnobser_rtper;
					$userSR["fnobser_tall"] = $fnobser_tall;
					$userSR["fnobser_tallper"] = $fnobser_tallper;
					$userSR["fnobser_late"] = $fnobser_late;
					$userSR["fnobser_lateper"] = $fnobser_lateper;
					$userSR["fnobser_fertile"] = $fnobser_fertile;
					$userSR["fnobser_fertileper"] = $fnobser_fertileper;
					$userSR["fnobser_sterile"] = $fnobser_sterile;
					$userSR["fnobser_sterileper"] = $fnobser_sterileper;
					$userSR["fnobser_outcrosspart"] = $fnobser_outcrosspart;
					$userSR["fnobser_outcrosspartper"] = $fnobser_outcrosspartper;
					$userSR["fnobser_remarks"] = $fnobser_remarks;
					$userSR["gpper"] = $gpper;
					
					array_push($user24,$userSR);
				
				}
			}	
			$stmtgfmv->close();
			
			// return $resusers;
			   
        }
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	




	public function GetGoTFinalObservationEdtUpdate($sampleno, $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
		if($fnobser_obserdate!='' && $fnobser_obserdate!='00-00-0000' && $fnobser_obserdate!=NULL)
		{
			$fnobser_obserdate1=explode("-",$fnobser_obserdate);
			$fnobser_obserdate=$fnobser_obserdate1[2]."-".$fnobser_obserdate1[1]."-".$fnobser_obserdate1[0];
		}
		
        $stmt = $this->conn_ps->prepare("SELECT gotm_sampleno, gotm_ackflg, gotm_sowingflg, gotm_transplantflg, gotm_fieldmflg, gotm_finobrflg, gotm_resamplingflg, gotm_retestflg, gotm_id, gotm_croptype, gotm_crop FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
        $stmt->bind_param("s", $sampleno);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$gotm_sampleno=''; $gotm_ackflg=0; $gotm_sowingflg=0; $gotm_transplantflg=0; $gotm_fieldmflg=0; $gotm_finobrflg=0; $gotm_resamplingflg=0; $gotm_retestflg=0; $gotm_id=0;	
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($gotm_sampleno, $gotm_ackflg, $gotm_sowingflg, $gotm_transplantflg, $gotm_fieldmflg, $gotm_finobrflg, $gotm_resamplingflg, $gotm_retestflg, $gotm_id, $gotm_croptype, $gotm_crop);
			$stmt->fetch();
			$flg=0;
			if($gotm_id>0)
			{
				if($gotm_croptype==NULL)$gotm_croptype='';
				
				$stmtsamp = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgotfnobser where gotm_id=?");
				$stmtsamp->bind_param("i", $gotm_id);
				$resultsamp=$stmtsamp->execute();
				$stmtsamp->store_result();
				//if ($gotm_crop == "Bajra Seed") 
				//return $stmtsamp->num_rows;
				if ($stmtsamp->num_rows > 0) 
				{
					//return "UPDATE tbl_qcgotfnobser  SET fnobser_obserdate='$fnobser_obserdate', fnobser_noofplants='$fnobser_noofplants', fnobser_maleplants='$fnobser_maleplants', fnobser_maleper='$fnobser_maleper', fnobser_femaleplants='$fnobser_femaleplants', fnobser_femaleper='$fnobser_femaleper', fnobser_otherofftype='$fnobser_otherofftype', fnobser_otheroffper='$fnobser_otheroffper', fnobser_blineps='$fnobser_blineps', fnobser_blinepsper='$fnobser_blinepsper', fnobser_totalofftype='$fnobser_totalofftype', fnobser_totalofftypeper='$fnobser_totalofftypeper', fnobser_total='$fnobser_total', fnobser_totalper='$fnobser_totalper', fnobser_self='$fnobser_self', fnobser_selfper='$fnobser_selfper', fnobser_pencilplants='$fnobser_pencilplants', fnobser_pencilplantsper='$fnobser_pencilplantsper', fnobser_aline='$fnobser_aline', fnobser_alineper='$fnobser_alineper', fnobser_blinesh='$fnobser_blinesh', fnobser_blineshper='$fnobser_blineshper', fnobser_lg='$fnobser_lg', fnobser_lgper='$fnobser_lgper', fnobser_fg='$fnobser_fg', fnobser_fgper='$fnobser_fgper', fnobser_bg='$fnobser_bg', fnobser_bgper='$fnobser_bgper', fnobser_rt='$fnobser_rt', fnobser_rtper='$fnobser_rtper', fnobser_tall='$fnobser_tall', fnobser_tallper='$fnobser_tallper', fnobser_late='$fnobser_late', fnobser_lateper='$fnobser_lateper', fnobser_fertile='$fnobser_fertile', fnobser_fertileper='$fnobser_fertileper', fnobser_sterile='$fnobser_sterile', fnobser_sterileper='$fnobser_sterileper', fnobser_outcrosspart='$fnobser_outcrosspart', fnobser_outcrosspartper='$fnobser_outcrosspartper', fnobser_remarks='$fnobser_remarks', fnobser_logid='$scode', fnobser_croptype='$gotm_croptype', fnobser_crop='$gotm_crop' where gotm_id='$gotm_id' ";
;
					
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgotfnobser  SET fnobser_obserdate=?, fnobser_noofplants=?, fnobser_maleplants=?, fnobser_maleper=?, fnobser_femaleplants=?, fnobser_femaleper=?, fnobser_otherofftype=?, fnobser_otheroffper=?, fnobser_blineps=?, fnobser_blinepsper=?, fnobser_totalofftype=?, fnobser_totalofftypeper=?, fnobser_total=?, fnobser_totalper=?, fnobser_self=?, fnobser_selfper=?, fnobser_pencilplants=?, fnobser_pencilplantsper=?, fnobser_aline=?, fnobser_alineper=?, fnobser_blinesh=?, fnobser_blineshper=?, fnobser_lg=?, fnobser_lgper=?, fnobser_fg=?, fnobser_fgper=?, fnobser_bg=?, fnobser_bgper=?, fnobser_rt=?, fnobser_rtper=?, fnobser_tall=?, fnobser_tallper=?, fnobser_late=?, fnobser_lateper=?, fnobser_fertile=?, fnobser_fertileper=?, fnobser_sterile=?, fnobser_sterileper=?, fnobser_outcrosspart=?, fnobser_outcrosspartper=?, fnobser_remarks=?, fnobser_logid=?, fnobser_croptype=?, fnobser_crop=? where gotm_id=? ");
					
					$stmt_samp->bind_param("siiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissssi", $fnobser_obserdate, $fnobser_noofplants, $fnobser_maleplants, $fnobser_maleper, $fnobser_femaleplants, $fnobser_femaleper, $fnobser_otherofftype, $fnobser_otheroffper, $fnobser_blineps, $fnobser_blinepsper, $fnobser_totalofftype, $fnobser_totalofftypeper, $fnobser_total, $fnobser_totalper, $fnobser_self, $fnobser_selfper, $fnobser_pencilplants, $fnobser_pencilplantsper, $fnobser_aline, $fnobser_alineper, $fnobser_blinesh, $fnobser_blineshper, $fnobser_lg, $fnobser_lgper, $fnobser_fg, $fnobser_fgper, $fnobser_bg, $fnobser_bgper, $fnobser_rt, $fnobser_rtper, $fnobser_tall, $fnobser_tallper, $fnobser_late, $fnobser_lateper, $fnobser_fertile, $fnobser_fertileper, $fnobser_sterile, $fnobser_sterileper, $fnobser_outcrosspart, $fnobser_outcrosspartper, $fnobser_remarks, $scode, $gotm_croptype, $gotm_crop, $gotm_id);
					$result_samp=$stmt_samp->execute();
					if($result_samp){
						$one=1; $two=2; $tplflg=0;
						//return "in query submit";
						$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
						$stmt_got->bind_param("iii", $one, $one, $gotm_id);
						$result_got=$stmt_got->execute();
						$stmt_got->close();
						$flg++;
					}
					$stmt_samp->close();
					
				}
				
				$stmtsamp->close();	
			}
			$stmt->close();
	   // return $resusers;
        } else {
            // user not existed
			//$user24 = array();
			$flg=0;
            $stmt->close();
           // return false;
        }
		
		if($flg==0)
		{return false;}
		else
		{return true;}
    }






	public function GetGotSampleFinalSubmit($sampleno) {
		
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;$flg=0;
		//$phpArray = json_decode($jdata, true); 
		$phpArray=explode(",", $sampleno);
		foreach($phpArray as $lotary)
		{
			$stmt = $this->conn_ps->prepare("SELECT gotm_id FROM tbl_qcgotmain WHERE gotm_ackflg=1 and gotm_retestflg=0 and gotm_resamplingflg=0 and gotm_sampleno = ? ");
			$stmt->bind_param("s", $lotary);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			$gotm_id=0;	
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($gotm_id);
				$stmt->fetch();
				
				$stmt_got = $this->conn_ps->prepare("UPDATE tbl_qcgotmain SET gotm_fieldmflg=?, gotm_finobrflg=? WHERE gotm_id=? ");
				$stmt_got->bind_param("iii", $one, $one, $gotm_id);
				$result_got=$stmt_got->execute();
				if($result_got){$flg++;}
				$stmt_got->close();
			}
			  $stmt->close();
		}
		if($flg==0)
		{return false;}
		else
		{return true;}
    }



	public function getQcOprDetails() {
		$userSR = array(); 
		$stmt_plant = $this->conn_ps->prepare("SELECT id, name, qcoprrole  FROM tbl_qcopr where status='Active' ");
		$result_plant=$stmt_plant->execute();
		$stmt_plant->store_result();
		if ($stmt_plant->num_rows > 0) {
			$stmt_plant->bind_result($id, $name, $qcoprrole);
			//looping through all the records 
			while($stmt_plant->fetch())
			{
				$user["oprid"] = $id;
				$user["oprname"] = $name;
				array_push($userSR,$user);
			}
			$stmt_plant->close();
		}
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
    }
	





	
	
	
	
	
	
	
	
}// Main Class close
?>
