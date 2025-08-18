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

	public function GetSampleInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotldg_lotno = ? ");
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

	public function GetSampleCollect($scode, $sampleno, $smpdate) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		$flg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; 
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid);
			while($stmt->fetch())
			{
				if($smpdate!='' && $smpdate!='00-00-0000' && $smpdate!=NULL)
				{
					$smpdate1=explode("-",$smpdate);
					$smpdate=$smpdate1[2]."-".$smpdate1[1]."-".$smpdate1[0];
				}
				//else {$smpdate='';}
				$dt=date("d-m-Y h:i:sa"); $one=1;
				if($smpdate!=''){
					$stmt_crop = $this->conn_ps->prepare("UPDATE tbl_qctest SET spdate=?, sampcldate=?, sampclrole=?, cflg=? WHERE tid = ? ");
					$stmt_crop->bind_param("sssii", $smpdate, $dt, $scode, $one, $tid);
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

	public function GetSampleMoistInfo($sampleno) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and spdate IS NOT NULL and spdate!='0000-00-00' ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotldg_lotno = ? ");
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
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m1rep1=?, qcm_m1rep2=?, qcm_m1rep3=?, qcm_m1rep4=?, qcm_m1replogid=?, qcm_m1repdt=?  WHERE qcm_sampno = ? ");
					$stmt_samp->bind_param("sssssss", $m1rep1,$m1rep2,$m1rep3,$m1rep4,$scode,$dt,$sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				else
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcmdata (qcm_sampno, qcm_m1rep1, qcm_m1rep2, qcm_m1rep3, qcm_m1rep4, qcm_m1replogid, qcm_m1repdt) values(?,?,?,?,?,?,?) ");
					$stmt_samp->bind_param("sssssss", $sampleno,$m1rep1,$m1rep2,$m1rep3,$m1rep4,$scode,$dt);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				$stmtsamp->close();	
			}
			else if($hmtype=="m2" || $hmtype=="M2")
			{
				$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m2rep1=?, qcm_m2rep2=?, qcm_m2rep3=?, qcm_m2rep4=?, qcm_m2replogid=?, qcm_m2repdt=? WHERE qcm_sampno = ? ");
				$stmt_samp->bind_param("sssssss", $m2rep1,$m2rep2,$m2rep3,$m2rep4,$scode,$dt,$sampleno);
				$result_samp=$stmt_samp->execute();
				if($result_samp){$flg++;}
				$stmt_samp->close();
			}
			else if($hmtype=="m3" || $hmtype=="M3")
			{
				$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_m3rep1=?, qcm_m3rep2=?, qcm_m3rep3=?, qcm_m3rep4=?, qcm_rep1moistper=?, qcm_rep2moistper=?, qcm_rep3moistper=?, qcm_rep4moistper=?, qcm_haommoistper=?, qcm_m3replogid=?, qcm_m3repdt=?, qcm_haomflg=?  WHERE qcm_sampno = ? ");
				$stmt_samp->bind_param("sssssssssssss", $m3rep1,$m3rep2,$m3rep3,$m3rep4,$rep1moistper,$rep2moistper,$rep3moistper,$rep4moistper,$haommoistper,$scode,$dt,$two,$sampleno);
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
				if ($stmtsamp->num_rows > 0) 
				{
					$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_mmrep1=?, qcm_mmrep2=?, qcm_mmrep3=?, qcm_mmrmoistper=?, qcm_mmreplogid=?, qcm_mmrepdt=?, qcm_mmrflg=?  WHERE qcm_sampno = ? ");
					$stmt_samp->bind_param("ssssssis", $mmrep1,$mmrep2,$mmrep3,$mmrmoistper,$scode,$dt,$two,$sampleno);
					$result_samp=$stmt_samp->execute();
					if($result_samp){$flg++;}
					$stmt_samp->close();
				}
				else
				{
					$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcmdata (qcm_mmrep1, qcm_mmrep2, qcm_mmrep3, qcm_mmrmoistper, qcm_mmreplogid, qcm_mmrepdt, qcm_mmrflg, qcm_sampno) values(?,?,?,?,?,?,?,?)");
					$stmt_samp->bind_param("ssssssis", $mmrep1,$mmrep2,$mmrep3,$mmrmoistper,$scode,$dt,$two,$sampleno);
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
	
	
	public function GetSampleMoisFinalSubmit($sampleno, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0;
		$flg=0;
        $stmt = $this->conn_ps->prepare("SELECT tid  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
					
					$stmt_crop = $this->conn_ps->prepare("UPDATE tbl_qcmdata SET qcm_haomflg=?, qcm_mmrflg=?, qcm_moistflg=? WHERE qcm_sampno = ? ");
					$stmt_crop->bind_param("iiis", $haoflg, $mmrflg, $two, $sampleno);
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
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotldg_lotno = ? ");
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
			$stmt_pp = $this->conn_ps->prepare("SELECT qcp_sampleno FROM tbl_qcpdata WHERE qcp_sampleno = ? ");
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
			
				array_push($user24,$userSR);
			} else {
				$user24 = array();
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
	
	public function GetSamplePPUpdate($sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed, $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $ppphoto, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2;
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
				$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcpdata (qcp_sampleno, qcp_samplewt, qcp_pureseed, qcp_pureseedper, qcp_imseed, qcp_imseedper, qcp_lightseed, qcp_lightseedper, qcp_ocseedno, qcp_ocseedinkg, qcp_odvseedno, qcp_odvseedinkg, qcp_dcseed, qcp_dcseedper, qcp_phseedno, qcp_phseedinkg, qcp_pplogid, qcp_ppdatadt, qcp_ppphoto, qcp_ppdataflg) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
				$stmt_samp->bind_param("sssssssssssssssssssi", $sampleno, $samplewt, $pureseed, $pureseedper, $imseed, $imseedper, $lightseed, $lightseedper, $ocseedno, $ocseedinkg, $odvseedno, $odvseedinkg, $dcseed, $dcseedper, $phseedno, $phseedinkg, $scode, $dt, $ppphoto, $two);
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
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? and spdate IS NOT NULL and spdate!='0000-00-00' ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
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
			$cropname=''; $popularname=''; $seedsize=''; $nosior=0;
			if($crop!=''){
				$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior FROM tblcrop WHERE cropid = ? ");
				$stmt_crop->bind_param("i", $crop);
				$result_crop=$stmt_crop->execute();
				$stmt_crop->store_result();
				if ($stmt_crop->num_rows > 0) {
					$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior);
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
				$stmt_m = $this->conn_ps->prepare("SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotldg_lotno = ? ");
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
			
			$qcg_testtype=''; $qcg_setupflg=0; $qcg_seedsize=0; $qcg_noofseedinonerep=0; $qcg_sgtoneobflg=0; $qcg_sgtnoofrep=0; $qcg_sgtoobnormal1=0; $qcg_sgtoobnormal2=0; $qcg_sgtoobnormal3=0; $qcg_sgtoobnormal4=0; $qcg_sgtoobnormal5=0; $qcg_sgtoobnormal6=0; $qcg_sgtoobnormal7=0; $qcg_sgtoobnormal8=0; $qcg_sgtoobnormalavg=0; $qcg_sgtoobnormaldt=0; $qcg_sgtnormal1=0; $qcg_sgtnormal2=0; $qcg_sgtnormal3=0; $qcg_sgtnormal4=0; $qcg_sgtnormal5=0; $qcg_sgtnormal6=0; $qcg_sgtnormal7=0; $qcg_sgtnormal8=0; $qcg_sgtnormalavg=0; $qcg_sgtabnormal1=0; $qcg_sgtabnormal2=0; $qcg_sgtabnormal3=0; $qcg_sgtabnormal4=0; $qcg_sgtabnormal5=0; $qcg_sgtabnormal6=0; $qcg_sgtabnormal7=0; $qcg_sgtabnormal8=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfug1=0; $qcg_sgthardfug2=0; $qcg_sgthardfug3=0; $qcg_sgthardfug4=0; $qcg_sgthardfug5=0; $qcg_sgthardfug6=0; $qcg_sgthardfug7=0; $qcg_sgthardfug8=0; $qcg_sgthardfugavg=0; $qcg_sgtdead1=0; $qcg_sgtdead2=0; $qcg_sgtdead3=0; $qcg_sgtdead4=0; $qcg_sgtdead5=0; $qcg_sgtdead6=0; $qcg_sgtdead7=0; $qcg_sgtdead8=0; $qcg_sgtdeadavg=0; $qcg_sgtdt=''; $qcg_sgtvremark=''; $qcg_vigtesttype=''; $qcg_vigoneobflg=0; $qcg_vignoofrep=0; $qcg_vigoobnormal1=0; $qcg_vigoobnormal2=0; $qcg_vigoobnormal3=0; $qcg_vigoobnormal4=0; $qcg_vigoobnormal5=0; $qcg_vigoobnormal6=0; $qcg_vigoobnormal7=0; $qcg_vigoobnormal8=0; $qcg_vigoobnormalavg=0; $qcg_vigoobnormaldt=''; $qcg_vignormal1=0; $qcg_vignormal2=0; $qcg_vignormal3=0; $qcg_vignormal4=0; $qcg_vignormal5=0; $qcg_vignormal6=0; $qcg_vignormal7=0; $qcg_vignormal8=0; $qcg_vignormalavg=0; $qcg_vigabnormal1=0; $qcg_vigabnormal2=0; $qcg_vigabnormal3=0; $qcg_vigabnormal4=0; $qcg_vigabnormal5=0; $qcg_vigabnormal6=0; $qcg_vigabnormal7=0; $qcg_vigabnormal8=0; $qcg_vigabnormalavg=0; $qcg_vigdead1=0; $qcg_vigdead2=0; $qcg_vigdead3=0; $qcg_vigdead4=0; $qcg_vigdead5=0; $qcg_vigdead6=0; $qcg_vigdead7=0; $qcg_vigdead8=0; $qcg_vigdeadavg=0; $qcg_viglogid=0; $qcg_vigdt=0; $qcg_viggermp=0; $qcg_vigflg=0; $qcg_vigvremark=''; $qcg_oprremark='';

			$stmt_samp = $this->conn_ps->prepare("SELECT qcg_testtype, qcg_setupflg, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtoneobflg, qcg_sgtnoofrep, qcg_sgtoobnormal1, qcg_sgtoobnormal2, qcg_sgtoobnormal3, qcg_sgtoobnormal4, qcg_sgtoobnormal5, qcg_sgtoobnormal6, qcg_sgtoobnormal7, qcg_sgtoobnormal8, qcg_sgtoobnormalavg, qcg_sgtoobnormaldt, qcg_sgtnormal1, qcg_sgtnormal2, qcg_sgtnormal3, qcg_sgtnormal4, qcg_sgtnormal5, qcg_sgtnormal6, qcg_sgtnormal7, qcg_sgtnormal8, qcg_sgtnormalavg, qcg_sgtabnormal1, qcg_sgtabnormal2, qcg_sgtabnormal3, qcg_sgtabnormal4, qcg_sgtabnormal5, qcg_sgtabnormal6, qcg_sgtabnormal7, qcg_sgtabnormal8, qcg_sgtabnormalavg, qcg_sgthardfug1, qcg_sgthardfug2, qcg_sgthardfug3, qcg_sgthardfug4, qcg_sgthardfug5, qcg_sgthardfug6, qcg_sgthardfug7, qcg_sgthardfug8, qcg_sgthardfugavg, qcg_sgtdead1, qcg_sgtdead2, qcg_sgtdead3, qcg_sgtdead4, qcg_sgtdead5, qcg_sgtdead6, qcg_sgtdead7, qcg_sgtdead8, qcg_sgtdeadavg, qcg_sgtdt, qcg_sgtvremark, qcg_vigtesttype, qcg_vigoneobflg, qcg_vignoofrep, qcg_vigoobnormal1, qcg_vigoobnormal2, qcg_vigoobnormal3, qcg_vigoobnormal4, qcg_vigoobnormal5, qcg_vigoobnormal6, qcg_vigoobnormal7, qcg_vigoobnormal8, qcg_vigoobnormalavg, qcg_vigoobnormaldt, qcg_vignormal1, qcg_vignormal2, qcg_vignormal3, qcg_vignormal4, qcg_vignormal5, qcg_vignormal6, qcg_vignormal7, qcg_vignormal8, qcg_vignormalavg, qcg_vigabnormal1, qcg_vigabnormal2, qcg_vigabnormal3, qcg_vigabnormal4, qcg_vigabnormal5, qcg_vigabnormal6, qcg_vigabnormal7, qcg_vigabnormal8, qcg_vigabnormalavg, qcg_vigdead1, qcg_vigdead2, qcg_vigdead3, qcg_vigdead4, qcg_vigdead5, qcg_vigdead6, qcg_vigdead7, qcg_vigdead8, qcg_vigdeadavg, qcg_viglogid, qcg_vigdt, qcg_viggermp, qcg_vigflg, qcg_vigvremark, qcg_oprremark FROM tbl_qcgdata WHERE qcg_germpflg!=1 and qcg_sampleno = ? ");
			$stmt_samp->bind_param("s", $sampleno);
			$result_samp=$stmt_samp->execute();
			$stmt_samp->store_result();
			if ($stmt_samp->num_rows > 0) {
				$stmt_samp->bind_result($qcg_testtype, $qcg_setupflg, $qcg_seedsize, $qcg_noofseedinonerep, $qcg_sgtoneobflg, $qcg_sgtnoofrep, $qcg_sgtoobnormal1, $qcg_sgtoobnormal2, $qcg_sgtoobnormal3, $qcg_sgtoobnormal4, $qcg_sgtoobnormal5, $qcg_sgtoobnormal6, $qcg_sgtoobnormal7, $qcg_sgtoobnormal8, $qcg_sgtoobnormalavg, $qcg_sgtoobnormaldt, $qcg_sgtnormal1, $qcg_sgtnormal2, $qcg_sgtnormal3, $qcg_sgtnormal4, $qcg_sgtnormal5, $qcg_sgtnormal6, $qcg_sgtnormal7, $qcg_sgtnormal8, $qcg_sgtnormalavg, $qcg_sgtabnormal1, $qcg_sgtabnormal2, $qcg_sgtabnormal3, $qcg_sgtabnormal4, $qcg_sgtabnormal5, $qcg_sgtabnormal6, $qcg_sgtabnormal7, $qcg_sgtabnormal8, $qcg_sgtabnormalavg, $qcg_sgthardfug1, $qcg_sgthardfug2, $qcg_sgthardfug3, $qcg_sgthardfug4, $qcg_sgthardfug5, $qcg_sgthardfug6, $qcg_sgthardfug7, $qcg_sgthardfug8, $qcg_sgthardfugavg, $qcg_sgtdead1, $qcg_sgtdead2, $qcg_sgtdead3, $qcg_sgtdead4, $qcg_sgtdead5, $qcg_sgtdead6, $qcg_sgtdead7, $qcg_sgtdead8, $qcg_sgtdeadavg, $qcg_sgtdt, $qcg_sgtvremark, $qcg_vigtesttype, $qcg_vigoneobflg, $qcg_vignoofrep, $qcg_vigoobnormal1, $qcg_vigoobnormal2, $qcg_vigoobnormal3, $qcg_vigoobnormal4, $qcg_vigoobnormal5, $qcg_vigoobnormal6, $qcg_vigoobnormal7, $qcg_vigoobnormal8, $qcg_vigoobnormalavg, $qcg_vigoobnormaldt, $qcg_vignormal1, $qcg_vignormal2, $qcg_vignormal3, $qcg_vignormal4, $qcg_vignormal5, $qcg_vignormal6, $qcg_vignormal7, $qcg_vignormal8, $qcg_vignormalavg, $qcg_vigabnormal1, $qcg_vigabnormal2, $qcg_vigabnormal3, $qcg_vigabnormal4, $qcg_vigabnormal5, $qcg_vigabnormal6, $qcg_vigabnormal7, $qcg_vigabnormal8, $qcg_vigabnormalavg, $qcg_vigdead1, $qcg_vigdead2, $qcg_vigdead3, $qcg_vigdead4, $qcg_vigdead5, $qcg_vigdead6, $qcg_vigdead7, $qcg_vigdead8, $qcg_vigdeadavg, $qcg_viglogid, $qcg_vigdt, $qcg_viggermp, $qcg_vigflg, $qcg_vigvremark, $qcg_oprremark);
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
			$userSR["sampflg"] = $sampflg;*/
			$userSR["seedsize"] = $seedsize;
			$userSR["noofseedinonerep"] = $nosior;
					
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


	public function GetGempSetupUpdate($sampleno, $testtype, $sgtnorep, $fgtnorep, $fgtmtype) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $sdt=date("d-m-Y");
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT qcg_sampleno FROM tbl_qcgdata where qcg_sampleno=?");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows == 0) 
			{
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				
				$stmt_samp = $this->conn_ps->prepare("Insert into tbl_qcgdata (qcg_sampleno, qcg_testtype, qcg_seedsize, qcg_noofseedinonerep, qcg_sgtnoofrep, qcg_vigtesttype, qcg_vignoofrep, qcg_setupflg, qcg_setupdt) values(?,?,?,?,?,?,?,?,?) ");
				$stmt_samp->bind_param("sssssssis", $sampleno, $testtype, $seedsize, $nosior, $sgtnorep, $fgtmtype, $fgtnorep, $one, $sdt);
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
	
	
	
	public function GetGempDataUpdate($sampleno, $testtype, $sgtfcfltype, $fgtfcfltype, $fgtmtype, $seedsize, $noofseedinonerep, $sgtnoofrep, $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $sgtdt, $sgtvremark, $fgtnoofrep, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $fgtdt, $fgtvremark, $oprremark, $scode) {
		$samno=str_split($sampleno);
		$sampno=$samno[2].$samno[3].$samno[4].$samno[5].$samno[6].$samno[7];
		$plantid=$samno[0];
		$yearid=$samno[1];
		$sampflg=0; $dt=date("d-m-Y h:i:sa"); $one=1; $two=2; $sdt=date("d-m-Y");
        $stmt = $this->conn_ps->prepare("SELECT tid, srdate, crop, variety, lotno, trstage, state, spdate, sampcldate, sampclrole  FROM tbl_qctest WHERE qcflg=0 and sampleno=? and yearid=? ORDER BY tid DESC");
        $stmt->bind_param("ss", $sampno, $yearid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$tid=0; $srdate=''; $crop=''; $variety=''; $lotno=''; $trstage=''; $state=''; $spdate=''; $sampcldate=''; $sampclrole='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($tid, $srdate, $crop, $variety, $lotno, $trstage, $state, $spdate, $sampcldate, $sampclrole);
			$stmt->fetch();
			$flg=0;
			$stmtsamp = $this->conn_ps->prepare("SELECT qcg_sampleno FROM tbl_qcgdata where qcg_sampleno=? and qcg_germpflg!=1");
			$stmtsamp->bind_param("s", $sampleno);
			$resultsamp=$stmtsamp->execute();
			$stmtsamp->store_result();
			if ($stmtsamp->num_rows > 0) 
			{
				if($crop!=''){
					$stmt_crop = $this->conn_ps->prepare("SELECT cropid, cropname, seedsize, nosior FROM tblcrop WHERE cropid = ? ");
					$stmt_crop->bind_param("i", $crop);
					$result_crop=$stmt_crop->execute();
					$stmt_crop->store_result();
					if ($stmt_crop->num_rows > 0) {
						$stmt_crop->bind_result($cropid, $cropname, $seedsize, $nosior);
						//looping through all the records 
						$stmt_crop->fetch();
						$stmt_crop->close();
					}
				}
				
				if($testtype=="Standard Germination Test")
				{
					if($sgtfcfltype=="First Count")
					{
						$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtoobnormal1=?, qcg_sgtoobnormal2=?, qcg_sgtoobnormal3=?, qcg_sgtoobnormal4=?, qcg_sgtoobnormal5=?, qcg_sgtoobnormal6=?, qcg_sgtoobnormal7=?, qcg_sgtoobnormal8=?, qcg_sgtoobnormalavg=?, qcg_sgtoobnormaldt=?, qcg_sgtoobnormallogid=?, qcg_sgtoneobflg=? where qcg_sampleno=?  and qcg_germpflg!=1");
						$stmt_samp->bind_param("iiiiiiiiissis", $sgtoobnormal1, $sgtoobnormal2, $sgtoobnormal3, $sgtoobnormal4, $sgtoobnormal5, $sgtoobnormal6, $sgtoobnormal7, $sgtoobnormal8, $sgtoobnormalavg, $sgtoobnormaldt, $scode, $one, $sampleno);
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
					
					if($sgtfcfltype=="Final Count")
					{
						$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_sgtnormal1=?, qcg_sgtnormal2=?, qcg_sgtnormal3=?, qcg_sgtnormal4=?, qcg_sgtnormal5=?, qcg_sgtnormal6=?, qcg_sgtnormal7=?, qcg_sgtnormal8=?, qcg_sgtnormalavg=?, qcg_sgtabnormal1=?, qcg_sgtabnormal2=?, qcg_sgtabnormal3=?, qcg_sgtabnormal4=?, qcg_sgtabnormal5=?, qcg_sgtabnormal6=?, qcg_sgtabnormal7=?, qcg_sgtabnormal8=?, qcg_sgtabnormalavg=?, qcg_sgthardfug1=?, qcg_sgthardfug2=?, qcg_sgthardfug3=?, qcg_sgthardfug4=?, qcg_sgthardfug5=?, qcg_sgthardfug6=?, qcg_sgthardfug7=?, qcg_sgthardfug8=?, qcg_sgthardfugavg=?, qcg_sgtdead1=?, qcg_sgtdead2=?, qcg_sgtdead3=?, qcg_sgtdead4=?, qcg_sgtdead5=?, qcg_sgtdead6=?, qcg_sgtdead7=?, qcg_sgtdead8=?, qcg_sgtdeadavg=?, qcg_sgtlogid=?, qcg_sgtdt=?, qcg_sgtgermp=?, qcg_sgtflg=?, qcg_sgtvremark=?, qcg_oprremark=?, qcg_germpflg=? where qcg_sampleno=?  and qcg_germpflg!=1");
						$stmt_samp->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiissiissis", $sgtnormal1, $sgtnormal2, $sgtnormal3, $sgtnormal4, $sgtnormal5, $sgtnormal6, $sgtnormal7, $sgtnormal8, $sgtnormalavg, $sgtabnormal1, $sgtabnormal2, $sgtabnormal3, $sgtabnormal4, $sgtabnormal5, $sgtabnormal6, $sgtabnormal7, $sgtabnormal8, $sgtabnormalavg, $sgthardfug1, $sgthardfug2, $sgthardfug3, $sgthardfug4, $sgthardfug5, $sgthardfug6, $sgthardfug7, $sgthardfug8, $sgthardfugavg, $sgtdead1, $sgtdead2, $sgtdead3, $sgtdead4, $sgtdead5, $sgtdead6, $sgtdead7, $sgtdead8, $sgtdeadavg, $scode, $sgtdt, $sgtgermp, $one, $sgtvremark, $oprremark, $two, $sampleno);
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
				
				
				}
				
				
				if($testtype=="Field Germination Test")
				{
					if($fgtfcfltype=="First Count")
					{
						$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vigoobnormal1=?, qcg_vigoobnormal2=?, qcg_vigoobnormal3=?, qcg_vigoobnormal4=?, qcg_vigoobnormal5=?, qcg_vigoobnormal6=?, qcg_vigoobnormal7=?, qcg_vigoobnormal8=?, qcg_vigoobnormalavg=?, qcg_vigoobnormaldt=?, qcg_vigoobnormallogid=?, qcg_vigoneobflg=? where qcg_sampleno=?  and qcg_germpflg!=1");
						$stmt_samp->bind_param("siiiiiiiiissis", $fgtmtype, $fgtoobnormal1, $fgtoobnormal2, $fgtoobnormal3, $fgtoobnormal4, $fgtoobnormal5, $fgtoobnormal6, $fgtoobnormal7, $fgtoobnormal8, $fgtoobnormalavg, $fgtoobnormaldt, $scode, $one, $sampleno);
						$result_samp=$stmt_samp->execute();
						if($result_samp){$flg++;}
						$stmt_samp->close();
					}
					
					if($fgtfcfltype=="Final Count")
					{
						$stmt_samp = $this->conn_ps->prepare("UPDATE tbl_qcgdata SET qcg_vigtesttype=?, qcg_vignormal1=?, qcg_vignormal2=?, qcg_vignormal3=?, qcg_vignormal4=?, qcg_vignormal5=?, qcg_vignormal6=?, qcg_vignormal7=?, qcg_vignormal8=?, qcg_vignormalavg=?, qcg_vigabnormal1=?, qcg_vigabnormal2=?, qcg_vigabnormal3=?, qcg_vigabnormal4=?, qcg_vigabnormal5=?, qcg_vigabnormal6=?, qcg_vigabnormal7=?, qcg_vigabnormal8=?, qcg_vigabnormalavg=?, qcg_vigdead1=?, qcg_vigdead2=?, qcg_vigdead3=?, qcg_vigdead4=?, qcg_vigdead5=?, qcg_vigdead6=?, qcg_vigdead7=?, qcg_vigdead8=?, qcg_vigdeadavg=?, qcg_viglogid=?, qcg_vigdt=?, qcg_viggermp=?, qcg_vigflg=?, qcg_vigvremark=?, qcg_oprremark=?, qcg_germpflg=? where qcg_sampleno=?  and qcg_germpflg!=1");
						$stmt_samp->bind_param("siiiiiiiiiiiiiiiiiiiiiiiiiiissiissis", $fgtmtype, $fgtnormal1, $fgtnormal2, $fgtnormal3, $fgtnormal4, $fgtnormal5, $fgtnormal6, $fgtnormal7, $fgtnormal8, $fgtnormalavg, $fgtabnormal1, $fgtabnormal2, $fgtabnormal3, $fgtabnormal4, $fgtabnormal5, $fgtabnormal6, $fgtabnormal7, $fgtabnormal8, $fgtabnormalavg, $fgtdead1, $fgtdead2, $fgtdead3, $fgtdead4, $fgtdead5, $fgtdead6, $fgtdead7, $fgtdead8, $fgtdeadavg, $scode, $fgtdt, $fgtgermp, $one, $fgtvremark, $oprremark, $two, $sampleno);
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


	
	
	
	
	
	
	
	
}// Main Class close
?>
