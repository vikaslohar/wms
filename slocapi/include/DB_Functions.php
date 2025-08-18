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
	
	public function getPlantdetailsNew($scode) {
        $pcode='';
		$plantcode = $this->getPlantcode($scode);
		$stmt_plant = $this->conn_ps->prepare("SELECT *  FROM tbl_parameters WHERE plantcode=? ");
		$stmt_plant->bind_param("s", $plantcode);
		$result_plant=$stmt_plant->execute();
		$stmt_plant->store_result();
		if ($stmt_plant->num_rows > 0) {
			//$stmt_plant->bind_result($rec_pcode);
			$pcode = $this->fetchAssocStatement($stmt_plant);
			//looping through all the records 
			$stmt_plant->fetch();
			//$pcode=$rec_pcode; 
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

	public function GetTrList($scode, $tmode, $trid) {
	
	$plantcode = $this->getPlantcode($scode);
	if($tmode=="place")
	{
		$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE plantcode='$plantcode' and slnew_id=? and slnew_fromflg=1 ORDER BY slnew_id DESC");
		$stmt->bind_param("i", $trid);
	}
	else
	{
		$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE plantcode='$plantcode' and slnew_logid=? and slnew_fromflg!=1 ORDER BY slnew_id DESC");
		$stmt->bind_param("s", $scode);
	}
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			while($stmt->fetch())
			{
				if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
				if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
				{
					$lnew_date1=explode("-",$lnew_date);
					$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
				}
				
				/*$userSR["trid"] = $slnew_id;
				$userSR["trdate"] = $lnew_date;
				$userSR["fromflg"] = $slnew_fromflg;
				$userSR["toflg"] = $slnew_toflg;
				$userSR["trflg"] = $slnew_tflg;
				$userSR["scode"] = $slnew_logid;*/
				
				$slnf_id=0; $slnf_fdate=''; $slnf_fwh=''; $slnf_fbin=''; $slnf_fsbin=''; $slnf_fextnob=''; $slnf_fextnomp=''; $slnf_fextwb=''; $slnf_fextqty=''; $slnf_fnob=''; $slnf_fnomp=''; $slnf_fwb=''; $slnf_fqty=''; $slnf_fbalnob=''; $slnf_fbalnomp=''; $slnf_fbalwb=''; $slnf_fbalqty ='';
				 $slnf_crop=''; $slnf_variety=''; $slnf_stage=''; $slnf_lotno=''; $slnf_ups=''; $whperticulars=''; $binname=''; $subbinname=''; $slnt_flg =0;
				 
				$stmt_2 = $this->conn_ps->prepare("SELECT  slnf_id, slnew_id, slnf_fdate, slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fextnob, slnf_fextnomp, slnf_fextwb, slnf_fextqty, slnf_fnob, slnf_fnomp, slnf_fwb, slnf_fqty, slnf_fbalnob, slnf_fbalnomp, slnf_fbalwb, slnf_fbalqty, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_ups, slnt_flg   FROM tbl_slocnew_from WHERE slnew_id = ? and slnt_flg!=1");
				$stmt_2->bind_param("i", $slnew_id);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {

					$stmt_2->bind_result($slnf_id, $slnew_id, $slnf_fdate, $slnf_fwh, $slnf_fbin, $slnf_fsbin, $slnf_fextnob, $slnf_fextnomp, $slnf_fextwb, $slnf_fextqty, $slnf_fnob, $slnf_fnomp, $slnf_fwb, $slnf_fqty, $slnf_fbalnob, $slnf_fbalnomp, $slnf_fbalwb, $slnf_fbalqty, $slnf_crop, $slnf_variety, $slnf_stage, $slnf_lotno, $slnf_ups, $slnt_flg );
					//looping through all the records
					while($stmt_2->fetch())
					{
						//if($slnf_fdate==NULL){$slnf_fdate='';} if($slnf_fwh==NULL){$slnf_fwh='';} if($slnf_fbin==NULL){$slnf_fbin='';} if($slnf_fsbin==NULL){$slnf_fsbin='';} if($slnf_fextnob==NULL){$slnf_fextnob='';} if($slnf_fextnomp==NULL){$slnf_fextnomp='';} if($slnf_fextwb==NULL){$slnf_fextwb='';} if($slnf_fextqty==NULL){$slnf_fextqty='';} if($slnf_fnob==NULL){$slnf_fnob='';} if($slnf_fnob==NULL){$slnf_fnob='';} if($slnf_fnomp==NULL){$slnf_fnomp='';} if($slnf_fwb==NULL){$slnf_fwb='';} if($slnf_fqty==NULL){$slnf_fqty='';} if($slnf_fbalnob==NULL){$slnf_fbalnob='';} if($slnf_fbalnomp==NULL){$slnf_fbalnomp='';} if($slnf_fbalwb==NULL){$slnf_fbalwb='';} if($slnf_fbalqty==NULL){$slnf_fbalqty='';}  if($slnf_crop==NULL){$slnf_crop='';}  if($slnf_variety==NULL){$slnf_variety='';}  if($slnf_stage==NULL){$slnf_stage='';}  if($slnf_lotno==NULL){$slnf_lotno='';}  if($slnf_ups==NULL){$slnf_ups='';} 
						if($slnf_fdate==NULL){$slnf_fdate='';} if($slnf_fwh==NULL){$slnf_fwh='';} if($slnf_fbin==NULL){$slnf_fbin='';} if($slnf_fsbin==NULL){$slnf_fsbin='';} if($slnf_fextnob==NULL){$slnf_fextnob=0;} if($slnf_fextnomp==NULL){$slnf_fextnomp=0;} if($slnf_fextwb==NULL){$slnf_fextwb=0;} if($slnf_fextqty==NULL){$slnf_fextqty=0.000;} if($slnf_fnob==NULL){$slnf_fnob=0;} if($slnf_fnob==NULL){$slnf_fnob=0;} if($slnf_fnomp==NULL){$slnf_fnomp=0;} if($slnf_fwb==NULL){$slnf_fwb=0;} if($slnf_fqty==NULL){$slnf_fqty=0.000;} if($slnf_fbalnob==NULL){$slnf_fbalnob=0;} if($slnf_fbalnomp==NULL){$slnf_fbalnomp=0;} if($slnf_fbalwb==NULL){$slnf_fbalwb=0;} if($slnf_fbalqty==NULL){$slnf_fbalqty=0.000;}  if($slnf_crop==NULL){$slnf_crop='';}  if($slnf_variety==NULL){$slnf_variety='';}  if($slnf_stage==NULL){$slnf_stage='';}  if($slnf_lotno==NULL){$slnf_lotno='';}  if($slnf_ups==NULL){$slnf_ups='';} 
						if($slnf_fdate!='' && $slnf_fdate!='0000-00-00' && $slnf_fdate!=NULL)
						{
							$slnf_fdate1=explode("-",$slnf_fdate);
							$slnf_fdate=$slnf_fdate1[2]."-".$slnf_fdate1[1]."-".$slnf_fdate1[0];
						}
						
						$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
						$stmt_crop->bind_param("i", $slnf_crop);
						$stmt_crop->execute();
						$stmt_crop->store_result();
						$stmt_crop->bind_result($cropid, $cropname);
						$stmt_crop->fetch();
						$stmt_crop->close();
						
						$ver=$cropname."-Coded";
						if($slnf_variety==$ver)
						{
							$popularname=$cropname."-Coded";
						}
						else
						{
							$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
							$stmt_variety->bind_param("i", $slnf_variety);
							$stmt_variety->execute();
							$stmt_variety->store_result();
							$stmt_variety->bind_result($varietyid, $popularname);
							$stmt_variety->fetch();
							$stmt_variety->close();
						}
						
												
						$whperticulars=''; $binname=''; $subbinname='';
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
						$stmt_wh->bind_param("ss", $slnf_fwh, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
							$stmt_bin->bind_param("iss", $slnf_fwh, $slnf_fbin, $plantcode);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
								$stmt_sbin->bind_param("iiss", $slnf_fwh, $slnf_fbin, $slnf_fsbin, $plantcode);
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
						$slnttnob=0; $slnttqty=0; $slnttnomp=0;  $slnttwb=0; 
						$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_tqty, slnt_tnob, slnt_textnomp, slnt_textwb, slnt_tnomp, slnt_twb, slnt_tbalnomp, slnt_tbalwb FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? ");
						$stmt_slocto->bind_param("ii", $slnew_id, $slnf_id);
						$stmt_slocto->execute();
						$stmt_slocto->store_result();
						$stmt_slocto->bind_result($slnt_tqty, $slnt_tnob, $slnt_textnomp, $slnt_textwb, $slnt_tnomp, $slnt_twb, $slnt_tbalnomp, $slnt_tbalwb);
						if ($stmt_slocto->num_rows>0) {
							while($stmt_slocto->fetch())
							{
								$slnttnob=$slnttnob+$slnt_tnob;
								$slnttnomp=$slnttnomp+$slnt_tnomp;
								$slnttwb=$slnttwb+$slnt_twb;
								$slnttqty=$slnttqty+$slnt_tqty;
							}
						}
						$stmt_slocto->close();
						
						if($slnttqty!=$slnf_fqty)
						{
							if($slnf_fnob<=0){$slnf_fnob=0;} if($slnf_fwb<=0){$slnf_fwb=0;}if($slnf_fnomp<=0){$slnf_fnomp=0;}if($slnf_fqty<=0){$slnf_fqty=0;}							
							$userSR["fromtrid"] = $slnf_id;
							$userSR["trdate"] = $slnf_fdate;
							$userSR["scode"] = $slnew_logid;
							
							$userSR["crop"] = $cropname;
							$userSR["variety"] = $popularname;
							$userSR["stage"] = $slnf_stage;
							$userSR["lotno"] = $slnf_lotno;
							$userSR["ups"] = $slnf_ups;
							$userSR["wh"] = $whperticulars;
							$userSR["bin"] = $binname;
							$userSR["subbin"] = $subbinname;
							$userSR["extnob"] = $slnf_fnob-$slnttnob;
							$userSR["extnomp"] = $slnf_fnomp-$slnttnomp;
							$userSR["extwb"] = $slnf_fwb-$slnttwb;
							$userSR["extqty"] = $slnf_fqty-$slnttqty;
							$userSR["nob"] = $slnf_fnob;
							$userSR["nomp"] = $slnf_fnomp;
							$userSR["wb"] = $slnf_fwb;
							$userSR["qty"] = $slnf_fqty;
							$userSR["balnob"] = $slnf_fbalnob;
							$userSR["balnomp"] = $slnf_fbalnomp;
							$userSR["balwb"] = $slnf_fbalwb;
							$userSR["balqty"] = $slnf_fbalqty;
							$userSR["tonob"] = $slnttnob;
							$userSR["tonomp"] = $slnttnomp;
							$userSR["towb"] = $slnttwb;
							$userSR["toqty"] = $slnttqty;
							
							array_push($user24,$userSR);
						}
						
					}
					$stmt_2->close();
				}
			
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
	
	
	public function GetTrFlagList($scode) {
		$plantcode = $this->getPlantcode($scode);
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_logid=? AND plantcode='$plantcode' and slnew_tflg!=1 ORDER BY slnew_id DESC");
       $stmt->bind_param("s", $scode);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			$stmt->fetch();
			{
				if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
				if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
				{
					$lnew_date1=explode("-",$lnew_date);
					$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
				}
				
				//$userSR["trid"] = $slnew_id;
				//$userSR["trdate"] = $lnew_date;
				$userSR["fromflg"] = $slnew_fromflg;
				$userSR["toflg"] = $slnew_toflg;
				$userSR["trflg"] = $slnew_tflg;
				//$userSR["scode"] = $slnew_logid;
				
				//array_push($user24,$userSR);
			
			}
			$stmt->close();
			
           // return $resusers;
        } else {
            // user not existed
			$userSR = array();
			$userSR["fromflg"] = 0;
			$userSR["toflg"] = 0;
			$userSR["trflg"] = 0;
            $stmt->close();
           // return false;
        }
		
		if(empty($userSR))
		{return false;}
		else
		{return $userSR;}
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
	
	
	
	
	
	
	public function GetTranSLOCLotList($scode, $whid, $binid, $subbinido) {
	
		$user24=array(); 
		/*$samno=explode("/",$qrcode);
		$whnm=$samno[0];
		$binnm=$samno[1];*/
		$plantcode = $this->getPlantcode($scode);
		
		/*$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
		$stmtwh->bind_param("ss", $whid, $plantcode);
		$resultwh=$stmtwh->execute();
		$stmtwh->store_result();
		if ($stmtwh->num_rows > 0) {
			$stmtwh->bind_result($whperticulars,$whid);
			//looping through all the records 
			$stmtwh->fetch();
			$stmtwh->close();
		}
//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $binnm ";
		$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? and plantcode=? ");
		$stmtbin->bind_param("iss", $whid, $binnm, $plantcode);
		$resultbin=$stmtbin->execute();
		$stmtbin->store_result();
		if ($stmtbin->num_rows > 0) {
			$stmtbin->bind_result($binname, $binid);
			//looping through all the records
			$stmtbin->fetch();
			$stmtbin->close();
		}	*/
		
		
		//return "SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=$whid and lotldg_binid=$binid and plantcode=$plantcode ";
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
									$stmt_ldgraw4->fetch();
									
									$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
									$stmt_crop->bind_param("i", $lotldg_crop);
									$stmt_crop->execute();
									$stmt_crop->store_result();
									$stmt_crop->bind_result($cropid, $cropname);
									$stmt_crop->fetch();
									$stmt_crop->close();
									$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
									else
									{
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
									
														
									$whperticulars=0; $binname=0; $subbinname=0;  $whtype='';
									$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid, whtype FROM tbl_warehouse where whid = ? and plantcode=? ");
									$stmt_wh->bind_param("ss", $whid, $plantcode);
									$result_wh=$stmt_wh->execute();
									$stmt_wh->store_result();
									if ($stmt_wh->num_rows > 0) {
										$stmt_wh->bind_result($whperticulars, $whid, $whtype);
										//looping through all the records 
										$stmt_wh->fetch();
										$stmt_wh->close();
							
										$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
										$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
										$result_bin=$stmt_bin->execute();
										$stmt_bin->store_result();
										if ($stmt_bin->num_rows > 0) {
											$stmt_bin->bind_result($binname, $binid);
											//looping through all the records
											$stmt_bin->fetch();
											$stmt_bin->close();
											
											$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
											$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
									
									$x=0;
									$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id FROM tbl_slocnew_from WHERE slnf_crop=? and slnf_variety=? and slnf_lotno=? and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=? order by slnf_id ASC");
									$stmt_slnf->bind_param("isssss", $lotldg_crop, $lotldg_variety, $lotldg_lotno, $whid, $binid, $subbinid);
									$result_slnf=$stmt_slnf->execute();
									$stmt_slnf->store_result();
									if ($stmt_slnf->num_rows > 0) {
									
										$stmt_slnf->bind_result($slnf_id, $slnew_id);
										//looping through all the records
										while($stmt_slnf->fetch())
										{
											$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
											$stmt_slnt->bind_param("i", $slnew_id);
											$stmt_slnt->execute();
											$stmt_slnt->store_result();
											$stmt_slnt->bind_result($slnt_tqty);
											if ($stmt_slnt->num_rows>0) {
													$x=$x+1;
											}
											$stmt_slnt->close();
										}
									}	
										/*$slflag=0;
										$stmt_slnf2 = $this->conn_ps->prepare("SELECT  slnf_id, slnf_fqty  FROM tbl_slocnew_from WHERE slnew_id = ? and slnf_id=?");
										$stmt_slnf2->bind_param("ii", $slnew_id, $slnf_id);
										$result2=$stmt_slnf2->execute();
										$stmt_slnf2->store_result();
										if ($stmt_slnf2->num_rows > 0) {
											$stmt_slnf2->bind_result($slnf_id, $slnf_fqty);
											//looping through all the records
											while($stmt_slnf2->fetch())
											{
												$slnttqty=0;
												$stmt_slnt = $this->conn_ps->prepare("SELECT  slnt_tqty  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? ");
												$stmt_slnt->bind_param("ii", $slnew_id, $slnf_id);
												$stmt_slnt->execute();
												$stmt_slnt->store_result();
												$stmt_slnt->bind_result($slnt_tqty);
												if ($stmt_slnt->num_rows>0) {
													while($stmt_slnt->fetch())
													{
														$slnttqty=$slnttqty+$slnt_tqty;
													}
												}
												$stmt_slnt->close();
												
												if($slnf_fqty==$slnttqty) {$slflag=$slflag+1;}
											}
										}
									
									
									
									
									
										if($slflag==0)
										{
											$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0;
											
											$userSR["crop"] = $cropname;
											$userSR["variety"] = $popularname;
											$userSR["stage"] = $lotldg_sstage;
											$userSR["lotno"] = $lotldg_lotno;
											$userSR["ups"] = $ups;
											$userSR["wh"] = $whperticulars;
											$userSR["bin"] = $binname;
											$userSR["subbin"] = $subbinname;
											$userSR["extnob"] = $lotldg_balbags;
											$userSR["extwb"] = $wb;
											$userSR["extnmp"] = $nomp;
											$userSR["extqty"] = $lotldg_balqty;
											$userSR["wtmp"] = $wtinmp;
											$userSR["whtype"] = $whtype;
											array_push($user24,$userSR);
										}
									}
									else
									{*/
									if($x==0)
									{
										$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $ups;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $nomp;
										$userSR["extqty"] = $lotldg_balqty;
										$userSR["wtmp"] = $wtinmp;
										$userSR["whtype"] = $whtype;
										array_push($user24,$userSR);
									}
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
		
		
		
		
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype, $wtinmp);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
										
															
										$whperticulars=0; $binname=0; $subbinname=0;  $whtype='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid, whtype FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars, $whid, $whtype);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										$x=0;
										$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id FROM tbl_slocnew_from WHERE slnf_crop=? and slnf_variety=? and slnf_lotno=?  and slnf_fbalqty=0 and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=? order by slnf_id ASC");
										$stmt_slnf->bind_param("isssss", $lotldg_crop, $lotldg_variety, $lotldg_lotno, $whid, $binid, $subbinid);
										$result_slnf=$stmt_slnf->execute();
										$stmt_slnf->store_result();
										if ($stmt_slnf->num_rows > 0) {
											$stmt_slnf->bind_result($slnf_id, $slnew_id);
											while($stmt_slnf->fetch())
											{
												$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
												$stmt_slnt->bind_param("i", $slnew_id);
												$stmt_slnt->execute();
												$stmt_slnt->store_result();
												$stmt_slnt->bind_result($slnt_tqty);
												if ($stmt_slnt->num_rows>0) {
														$x=$x+1;
												}
												$stmt_slnt->close();
											}
										}
											$userSR=array();  $lotldg_sstage='Pack'; $wb=0; $lotldg_balbags=0;
										if($x==0)										
										{
											if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($balnomp<=0){$balnomp=0;}if($balqty<=0){$balqty=0;}										
											$userSR["crop"] = $cropname;
											$userSR["variety"] = $popularname;
											$userSR["stage"] = $lotldg_sstage;
											$userSR["lotno"] = $lotldg_lotno;
											$userSR["ups"] = $packtype;
											$userSR["wh"] = $whperticulars;
											$userSR["bin"] = $binname;
											$userSR["subbin"] = $subbinname;
											$userSR["extnob"] = $lotldg_balbags;
											$userSR["extwb"] = $wb;
											$userSR["extnmp"] = $balnomp;
											$userSR["extqty"] = $balqty;
											$userSR["wtmp"] = $wtinmp;
											$userSR["whtype"] = $whtype;
											array_push($user24,$userSR);
										}
									}
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
		
		
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	
	
	public function GetFromdataUpdate($scode, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array(); $one=1; $two=2; $zero=0;
		$dt=date("Y-m-d");
		
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
		
		foreach($phpArray as $lotary)
		{
			//return print_r($lotary);			
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $stage=''; $extnob='0'; $extqty='0'; $nob='0'; $qty='0'; $balnob='0'; $balqty='0';
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
				
				if($skey=="extwb") {$extwb=$sval; }
				if($skey=="extnmp") {$extnmp=$sval; }
				if($skey=="wb") {$wb=$sval; }
				if($skey=="nmp") {$nmp=$sval; }
				if($skey=="balwb") {$balwb=$sval; }
				if($skey=="balnmp") {$balnmp=$sval; }
				if($skey=="ups") {$ups=$sval; }
				if($skey=="wtmp") {$wtmp=$sval; }
			
				if($wh!="")
				{
					$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
					$stmtwh->bind_param("ss", $wh, $plantcode);
					$resultwh=$stmtwh->execute();
					$stmtwh->store_result();
					if ($stmtwh->num_rows > 0) {
						$stmtwh->bind_result($whperticulars,$whid);
						//looping through all the records 
						$stmtwh->fetch();
						$stmtwh->close();
					}
				}
				if($bin!="")
				{
					//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
					$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
					$stmtbin->bind_param("iss", $whid, $bin, $plantcode);
					$resultbin=$stmtbin->execute();
					$stmtbin->store_result();
					if ($stmtbin->num_rows > 0) {
						$stmtbin->bind_result($binname, $binid);
						//looping through all the records
						$stmtbin->fetch();
						$stmtbin->close();
					}	
				}
				if($subbin!="")
				{
					$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
					$stmt_sbin->bind_param("iiss", $whid, $binid, $subbin, $plantcode);
					$result2=$stmt_sbin->execute();
					$stmt_sbin->store_result();
					if ($stmt_sbin->num_rows > 0) {
						$stmt_sbin->bind_result($subbinname, $subbinid);
						//looping through all the records
						$stmt_sbin->fetch();
						$stmt_sbin->close();
					}
				}
				if($crop!="")
				{
					$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
					$stmt_crop->bind_param("s", $crop);
					$stmt_crop->execute();
					$stmt_crop->store_result();
					$stmt_crop->bind_result($cropid, $cropname);
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
				if($variety!="")
				{
					$var=$crop."-Coded";
					if($variety==$var)
					{
						$varietyid=$cropname."-Coded";
					}
					else
					{
						$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
						$stmt_variety->bind_param("s", $variety);
						$stmt_variety->execute();
						$stmt_variety->store_result();
						$stmt_variety->bind_result($varietyid, $popularname);
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
			}
				//return $wh." = ".$bin." = ".$subbin." = ".$crop." = ".$variety." = ".$lotno." = ".$stage." = ".$extnob." = ".$extqty." = ".$nob." = ".$qty." = ".$balnob." = ".$balqty;
				//return $whid." = ".$binid." = ".$subbinid." = ".$cropid." = ".$varietyid." = ".$lotno." = ".$stage." = ".$extnob." = ".$extqty." = ".$nob." = ".$qty." = ".$balnob." = ".$balqty;
				$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE plantcode='$plantcode' and slnew_logid=? and slnew_fromflg!=1 ORDER BY slnew_id DESC");
			   	$stmt->bind_param("s", $scode);
				$stmt->execute();
				$stmt->store_result();
				$userSR = array(); $user24=array();
				
				if ($stmt->num_rows > 0) {
					// user existed 
					$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
					while($stmt->fetch())
					{
						if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
						if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
						{
							$lnew_date1=explode("-",$lnew_date);
							$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
						}
						
						
						$x=0;
						$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id  FROM tbl_slocnew_from WHERE slnf_crop = ? and slnf_variety = ? and slnf_lotno=? and slnt_flg!=1 and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=?  order by slnf_id ASC");
						$stmt_slnf->bind_param("ssssss", $cropid, $varietyid, $lot_no, $whid, $binid, $subbinid);
						$result_slnf=$stmt_slnf->execute();
						$stmt_slnf->store_result();
						if ($stmt_slnf->num_rows > 0) {
							$stmt_slnf->bind_result($slnf_id, $slnewid);
							while($stmt_slnf->fetch())
							{
								$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
								$stmt_slnt->bind_param("i", $slnewid);
								$stmt_slnt->execute();
								$stmt_slnt->store_result();
								$stmt_slnt->bind_result($slnt_tqty);
								if ($stmt_slnt->num_rows>0) {
										$x=$x+1;
								}
								$stmt_slnt->close();
							}
						}
						if($x==0)	
						{	
							
							$stmt_arrsub = $this->conn_ps->prepare("Insert into tbl_slocnew_from (slnew_id, slnf_fdate, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fextnob, slnf_fextqty, slnf_fnob, slnf_fqty, slnf_fbalnob, slnf_fbalqty, slnf_ups, slnf_fextnomp, slnf_fextwb, slnf_fnomp, slnf_fwb, slnf_fbalnomp, slnf_fbalwb  ) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
							$stmt_arrsub->bind_param("isssssiiiisisissiiiiii", $slnew_id, $dt, $cropid, $varietyid, $stage, $lot_no, $whid, $binid, $subbinid, $extnob, $extqty, $nob, $qty, $balnob, $balqty, $ups, $extnmp, $extwb, $nmp, $wb, $balnmp, $balwb);
							$result_arrsub = $stmt_arrsub->execute();
							if($result_arrsub){$flg=1;}
							$arrsub_id=$stmt_arrsub->insert_id;
							$stmt_arrsub->close();
							
							$stmt_slnf->close();
						}
						
					}
				}
				else
				{
					$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_fromflg!=1 and slnew_toflg=0 and slnew_tflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
					$stmt->bind_param("s", $scode);
					$stmt->execute();
					$stmt->store_result();
					$userSR = array(); $user24=array();
					
					if ($stmt->num_rows == 0) 
					{
						$tcode=0;
						$stmt_slnm = $this->conn_ps->prepare("SELECT MAX(slnew_tcode)  FROM tbl_slocnew WHERE plantcode='$plantcode' order by slnew_id DESC");
						//$stmt_slnm->bind_param("isss", $slnew_id, $cropid, $varietyid, $lot_no);
						$result_slnm=$stmt_slnm->execute();
						$stmt_slnm->store_result();
						if ($stmt_slnm->num_rows > 0) {
							$stmt_slnm->bind_result($slnew_tcode);
							$stmt_slnm->fetch();
							$tcode=$slnew_tcode+1;
						}
						else
						{
							$tcode=1;
						}
						$stmt_arrmain = $this->conn_ps->prepare("Insert into tbl_slocnew ( slnew_date, slnew_tcode, slnew_logid, slnew_tflg, plantcode  ) Values(?,?,?,?,?) ");
						$stmt_arrmain->bind_param("sssss", $dt, $tcode, $scode, $two, $plantcode);
						$result_arrmain = $stmt_arrmain->execute();
						//if($result_arrmain){$flg=1;}
						$slnew_id=$stmt_arrmain->insert_id;
						$stmt_arrmain->close();
						if($slnew_id>0)	
						{
							//$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id  FROM tbl_slocnew_from WHERE slnf_crop = ? and slnf_variety = ? and slnf_lotno=? and slnt_flg!=1 order by slnf_id ASC");
							//$stmt_slnf->bind_param("sss", $cropid, $varietyid, $lot_no);
							$x=0;
							$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id  FROM tbl_slocnew_from WHERE slnf_crop = ? and slnf_variety = ? and slnf_lotno=? and slnt_flg!=1 and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=?  order by slnf_id ASC");
							$stmt_slnf->bind_param("ssssss", $cropid, $varietyid, $lot_no, $whid, $binid, $subbinid);
							$result_slnf=$stmt_slnf->execute();
							$stmt_slnf->store_result();
							if ($stmt_slnf->num_rows > 0) {
								$stmt_slnf->bind_result($slnf_id, $slnewid);
								while($stmt_slnf->fetch())
								{
									$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
									$stmt_slnt->bind_param("i", $slnewid);
									$stmt_slnt->execute();
									$stmt_slnt->store_result();
									$stmt_slnt->bind_result($slnt_tqty);
									if ($stmt_slnt->num_rows>0) {
											$x=$x+1;
									}
									$stmt_slnt->close();
								}
							}
							if($x==0)	
							{	
							
								$stmt_arrsub = $this->conn_ps->prepare("Insert into tbl_slocnew_from (slnew_id, slnf_fdate, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fextnob, slnf_fextqty, slnf_fnob, slnf_fqty, slnf_fbalnob, slnf_fbalqty, slnf_ups, slnf_fextnomp, slnf_fextwb, slnf_fnomp, slnf_fwb, slnf_fbalnomp, slnf_fbalwb  ) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
								$stmt_arrsub->bind_param("isssssiiiisisissiiiiii", $slnew_id, $dt, $cropid, $varietyid, $stage, $lot_no, $whid, $binid, $subbinid, $extnob, $extqty, $nob, $qty, $balnob, $balqty, $ups, $extnmp, $extwb, $nmp, $wb, $balnmp, $balwb);
								$result_arrsub = $stmt_arrsub->execute();
								if($result_arrsub){$flg=1;}
								$arrsub_id=$stmt_arrsub->insert_id;
								$stmt_arrsub->close();
								
								$stmt_slnf->close();
							}
						}	
					}	
				}
			//}
		}	
		if($flg>0)
		{
			$stmt60 = $this->conn_ps->prepare("Update tbl_slocnew SET slnew_fromflg=2 where slnew_id = ? ");
			$stmt60->bind_param("i", $slnew_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
		}
		
		
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
	
	
	
	
	public function GetTodataUpdate($scode, $slocwh, $slocbin, $slocsubbin, $trid, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array(); $cnt=0;
		$dt=date("Y-m-d");
//return "SELECT perticulars,whid FROM tbl_warehouse where perticulars = '$slocwh' and plantcode='$plantcode'";		
		$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
		$stmtwh->bind_param("ss", $slocwh, $plantcode);
		$resultwh=$stmtwh->execute();
		$stmtwh->store_result();
		if ($stmtwh->num_rows > 0) {
			$stmtwh->bind_result($whperticulars, $whid);
			//looping through all the records 
			$stmtwh->fetch();
			$stmtwh->close();
		}
//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $slocbin ";
		$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
		$stmtbin->bind_param("iss", $whid, $slocbin, $plantcode);
		$resultbin=$stmtbin->execute();
		$stmtbin->store_result();
		if ($stmtbin->num_rows > 0) {
			$stmtbin->bind_result($binname, $binid);
			//looping through all the records
			$stmtbin->fetch();
			$stmtbin->close();
		}	
//return "SELECT sname, sid  FROM tbl_subbin WHERE whid = $whid and binid = $binid  and plantcode='$plantcode' and sname='$slocsubbin' order by sname ASC";		
		$stmtsubbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ?  and plantcode=? and sname='$slocsubbin' order by sname ASC");
		$stmtsubbin->bind_param("sss", $whid, $binid, $plantcode);
		$resultsubbin=$stmtsubbin->execute();
		$stmtsubbin->store_result();
		if ($stmtsubbin->num_rows > 0) {
			$stmtsubbin->bind_result($subbinname, $subbinid);
			//looping through all the records
			$stmtsubbin->fetch();
			$stmtsubbin->close();
		}	
			
			
			
		$phpArray = json_decode($jdata, true); 
//return	$phpArray;
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0; $arrsub_id=0;
		
		foreach($phpArray as $lotary)
		{
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $ups=''; $stage=''; $extnob=''; $extqty=''; $nob=''; $qty=''; $balnob=''; $balqty=''; $extnmp=0; $extwb=0; $nmp=0; $wb=0; $balnmp=0; $balwb=0; $arrsub_id=0; $cnt++;
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="fromtrid") {$fromtrid=$sval; }
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="ups") {$ups=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extnmp") {$extnmp=$sval; }
				if($skey=="extwb") {$extwb=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="nmp") {$nmp=$sval; }
				if($skey=="wb") {$wb=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balnmp") {$balnmp=$sval; }
				if($skey=="balwb") {$balwb=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
			}
//return "SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_toflg!=1 and slnew_tflg!=1 and slnew_id=$trid AND plantcode='$plantcode' ORDER BY slnew_id DESC";			
			$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_toflg!=1 and slnew_tflg!=1 and slnew_id=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		   	$stmt->bind_param("s", $trid);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			//return $stmt->num_rows;
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
				$stmt->fetch();
				{
					if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
					if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
					{
						$lnew_date1=explode("-",$lnew_date);
						$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
					}
					
					$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
					$stmt_crop->bind_param("s", $crop);
					$stmt_crop->execute();
					$stmt_crop->store_result();
					$stmt_crop->bind_result($cropid, $cropname);
					$stmt_crop->fetch();
					$stmt_crop->close();
					
					if(!is_string($variety))
					{
						$varietyid=$cropname."-Coded";
					}
					else
					{
						$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
						$stmt_variety->bind_param("s", $variety);
						$stmt_variety->execute();
						$stmt_variety->store_result();
						$stmt_variety->bind_result($varietyid, $popularname);
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
//return "select slnf_id from tbl_slocnew_from where slnew_id=$slnew_id and slnf_crop=$cropid and slnf_variety=$varietyid and slnf_lotno='$lot_no' ";
					$slnf_id=0;
					//$stmt_slocfrom = $this->conn_ps->prepare("select slnf_id from tbl_slocnew_from where slnew_id=? and slnf_crop=? and slnf_variety=? and slnf_lotno=? ");
					$stmt_slocfrom = $this->conn_ps->prepare("select slnf_id from tbl_slocnew_from where slnew_id=? and slnf_id=?");
					$stmt_slocfrom->bind_param("ii", $slnew_id, $fromtrid);
					//$stmt_slocfrom->bind_param("iiis", $slnew_id, $cropid, $varietyid, $lot_no);
					$stmt_slocfrom->execute();
					$stmt_slocfrom->store_result();
					$stmt_slocfrom->bind_result($slnf_id);
					$stmt_slocfrom->fetch();
					$stmt_slocfrom->close();
					if($slnf_id>0)
					{
						$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_id  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? and slnt_twh=? and slnt_tbin=? and slnt_tsbin=? and slnt_lotno=?");
						$stmt_slocto->bind_param("iiiiis", $slnew_id, $slnf_id, $whid, $binid, $subbinid, $lot_no);
						$stmt_slocto->execute();
						$stmt_slocto->store_result();
						//return $stmt_slocto->num_rows;
						if ($stmt_slocto->num_rows==0) { 
//	return "Insert into tbl_slocnew_to ( slnew_id, slnf_id, slnt_tdate, slnt_twh, slnt_tbin, slnt_tsbin, slnt_textnob, slnt_textqty, slnt_tnob, slnt_tqty, slnt_tbalnob, slnt_tbalqty, slnt_crop, slnt_variety, slnt_lotno, slnt_ups, slnt_stage, slnt_textnomp, slnt_textwb, slnt_tnomp, slnt_twb, slnt_tbalnomp, slnt_tbalwb  ) Values($slnew_id, $slnf_id, $dt, $whid, $binid, $subbinid, $extnob, $extqty, $nob, $qty, $balnob, $balqty, $crop, $variety, $lot_no, $ups, $stage, $extnmp, $extwb, $nmp, $wb, $balnmp, $balwb) ";					
							$stmt_arrsub = $this->conn_ps->prepare("Insert into tbl_slocnew_to ( slnew_id, slnf_id, slnt_tdate, slnt_twh, slnt_tbin, slnt_tsbin, slnt_textnob, slnt_textqty, slnt_tnob, slnt_tqty, slnt_tbalnob, slnt_tbalqty, slnt_crop, slnt_variety, slnt_lotno, slnt_ups, slnt_stage, slnt_textnomp, slnt_textwb, slnt_tnomp, slnt_twb, slnt_tbalnomp, slnt_tbalwb  ) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
							$stmt_arrsub->bind_param("iisiiiisisissssssiiiiii", $slnew_id, $slnf_id, $dt, $whid, $binid, $subbinid, $extnob, $extqty, $nob, $qty, $balnob, $balqty, $crop, $variety, $lot_no, $ups, $stage, $extnmp, $extwb, $nmp, $wb, $balnmp, $balwb );
							$result_arrsub = $stmt_arrsub->execute();
							if($result_arrsub){ $flg=1;
							$arrsub_id=$stmt_arrsub->insert_id;}
							$stmt_arrsub->close();
						
						}
						$stmt_slocto->close();
					}
			//return $flg;
				}
			}
		//}	
		
		
		//return "slnt id ".$arrsub_id;
		
		if($slnew_id<=0){$flg=0;}
		
		
			$flag=0;
			if($arrsub_id>0)
			{
				$stmt_slnt = $this->conn_ps->prepare("SELECT  slnt_tqty  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? and slnt_id=? ");
				$stmt_slnt->bind_param("iii", $slnew_id, $slnf_id, $arrsub_id);
				$stmt_slnt->execute();
				$stmt_slnt->store_result();
				$stmt_slnt->bind_result($slnt_tqty);
				if ($stmt_slnt->num_rows>0) {
				
					
					$slnt_tdate=''; $slnt_twh=''; $slnt_tbin=''; $slnt_tsbin=''; $slnt_textnob=''; $slnt_textqty=''; $slnt_tnob='';  $slnt_tqty=''; $slnt_tbalnob='';  $slnt_tbalqty ='';
					 $slnf_crop=''; $slnf_variety=''; $slnf_stage=''; $slnf_lotno=''; $slnf_ups=''; $whperticulars=''; $binname=''; $subbinname='';
					 
					$stmt_2 = $this->conn_ps->prepare("SELECT  slnew_id, slnf_id, slnt_tdate, slnt_twh, slnt_tbin, slnt_tsbin, slnt_textnob, slnt_textqty, slnt_tnob, slnt_tqty, slnt_tbalnob, slnt_tbalqty, slnt_textnomp, slnt_textwb, slnt_tnomp, slnt_twb, slnt_tbalnomp, slnt_tbalwb  FROM tbl_slocnew_to WHERE slnew_id = ? and slnf_id=? and slnt_id=? order by slnf_id ASC");
					$stmt_2->bind_param("iii", $slnew_id, $slnf_id, $arrsub_id);
					$result2=$stmt_2->execute();
					$stmt_2->store_result();
					if ($stmt_2->num_rows > 0) {
	
						$stmt_2->bind_result($slnew_id, $slnf_id, $slnt_tdate, $slnt_twh, $slnt_tbin, $slnt_tsbin, $slnt_textnob, $slnt_textqty, $slnt_tnob, $slnt_tqty, $slnt_tbalnob, $slnt_tbalqty, $slnt_textnomp, $slnt_textwb, $slnt_tnomp, $slnt_twb, $slnt_tbalnomp, $slnt_tbalwb);
						//looping through all the records
						while($stmt_2->fetch())
						{
							$stmt_slocfrom = $this->conn_ps->prepare("SELECT   slnf_fdate, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_ups,  slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fnob, slnf_fqty, slnf_fbalnob, slnf_fbalqty, slnf_fextnomp, slnf_fextwb, slnf_fnomp, slnf_fwb, slnf_fbalnomp, slnf_fbalwb   FROM tbl_slocnew_from WHERE slnew_id=? and slnf_id=?  order by slnf_id ASC");
							$stmt_slocfrom->bind_param("ii", $slnew_id, $slnf_id);
							$stmt_slocfrom->execute();
							$stmt_slocfrom->store_result();
							//if ($stmt_slocfrom->num_rows>0) {
							$stmt_slocfrom->bind_result($slnf_fdate, $slnf_crop, $slnf_variety, $slnf_stage, $slnf_lotno, $slnf_ups,  $slnf_fwh, $slnf_fbin, $slnf_fsbin, $slnf_fnob, $slnf_fqty, $slnf_fbalnob, $slnf_fbalqty, $slnf_fextnomp, $slnf_fextwb, $slnf_fnomp, $slnf_fwb, $slnf_fbalnomp, $slnf_fbalwb );
							$stmt_slocfrom->fetch();
							//}
							$stmt_slocfrom->close();
							
							if($slnt_tdate==NULL){$slnt_tdate='';} if($slnt_twh==NULL){$slnt_twh='';} if($slnt_tbin==NULL){$slnt_tbin='';} if($slnt_tsbin==NULL){$slnt_tsbin='';} if($slnt_textnob==NULL){$slnt_textnob='';}  if($slnt_textqty==NULL){$slnt_textqty='';} if($slnt_tnob==NULL){$slnt_tnob='';}  if($slnt_tqty==NULL){$slnt_tqty='';} if($slnt_tbalnob==NULL){$slnt_tbalnob='';}  if($slnt_tbalqty==NULL){$slnt_tbalqty='';}  if($slnf_crop==NULL){$slnf_crop='';}  if($slnf_variety==NULL){$slnf_variety='';}  if($slnf_stage==NULL){$slnf_stage='';}  if($slnf_lotno==NULL){$slnf_lotno='';}  if($slnf_ups==NULL){$slnf_ups='';} 
							if($slnt_tdate!='' && $slnt_tdate!='0000-00-00' && $slnt_tdate!=NULL)
							{
								$slnt_tdate1=explode("-",$slnt_tdate);
								$slnt_tdate=$slnt_tdate1[2]."-".$slnt_tdate1[1]."-".$slnt_tdate1[0];
							}
							
							if($slnf_stage!="Pack")
							{
							
								$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE  lotldg_subbinid = ? and plantcode=? and lotldg_lotno=? ");
								$stmt_ldgraw->bind_param("iss", $slnf_fsbin, $plantcode, $slnf_lotno);
								$result2=$stmt_ldgraw->execute();
								$stmt_ldgraw->store_result();
		//return $stmt_ldgraw->num_rows;
								if ($stmt_ldgraw->num_rows > 0) {
									$stmt_ldgraw->bind_result($lotno);
									//looping through all the records
									while($stmt_ldgraw->fetch())
									{
		//return "SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = $slnf_fsbin and lotldg_lotno = '$slnf_lotno' and plantcode='$plantcode'";		
								
										$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=? ");
										$stmt_ldgraw2->bind_param("iss", $slnf_fsbin, $slnf_lotno, $plantcode);
										$result2=$stmt_ldgraw2->execute();
										$stmt_ldgraw2->store_result();
		//return $stmt_ldgraw2->num_rows;
										if ($stmt_ldgraw2->num_rows > 0) {
											$stmt_ldgraw2->bind_result($lotldgid);
											//looping through all the records
											while($stmt_ldgraw2->fetch())
											{
												$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_mergerflg, lotldg_unlistflg, leduration, leupto, plantcode FROM tbl_lot_ldg WHERE lotldg_id = ?  and plantcode=?");
												$stmt_ldgraw3->bind_param("is", $lotldgid, $plantcode);
												$result2=$stmt_ldgraw3->execute();
												$stmt_ldgraw3->store_result();
												if ($stmt_ldgraw3->num_rows > 0) {
													$stmt_ldgraw3->bind_result($lotldg_lotno, $lotldg_trtype, $lotldg_trid, $lotldg_trdate, $lotldg_whid, $lotldg_binid, $lotldg_subbinid, $lotldg_opbags, $lotldg_opqty, $lotldg_trbags, $lotldg_trqty, $lotldg_balbags, $lotldg_balqty, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_gs, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $lotldg_genpurity, $lotldg_mergerflg, $lotldg_unlistflg, $leduration, $leupto, $plantcode);
													//looping through all the records
													while($stmt_ldgraw3->fetch())
													{ 
														$typ='SLOCSUO'; $typ2='SLOCSUC';
														
														$balq=$lotldg_balqty-$slnt_tqty;
														$balb=$lotldg_balbags-$slnt_tnob;
														if($balq>0 && $balb<=0){$balb=1;}
														$stmt_arrsub = $this->conn_ps->prepare("Insert into tbl_lot_ldg (lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_mergerflg, lotldg_unlistflg, leduration, leupto, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
														$stmt_arrsub->bind_param("ssisiiiisisisssssssssssssisssssisiisss", $lotno, $typ, $slnew_id, $dt, $slnf_fwh, $slnf_fbin, $slnf_fsbin, $lotldg_balbags, $lotldg_balqty, $slnt_tnob, $slnt_tqty, $balb, $balq, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_gs, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $lotldg_genpurity, $lotldg_mergerflg, $lotldg_unlistflg, $leduration, $leupto, $plantcode);
														$result_arrsub = $stmt_arrsub->execute();
														if($result_arrsub){$flag=1;}
														//$arrsub_id=$stmt_arrsub->insert_id;
														$stmt_arrsub->close();
														
														$stmt_ldgraw2new = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=? ");
														$stmt_ldgraw2new->bind_param("iss", $slnt_tsbin, $lotno, $plantcode);
														$result2new=$stmt_ldgraw2new->execute();
														$stmt_ldgraw2new->store_result();
														$stmt_ldgraw2new->bind_result($lotldgidnew);
														//looping through all the records
														$stmt_ldgraw2new->fetch();
															
														$stmt_ldgraw3new = $this->conn_ps->prepare("SELECT lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ?  and plantcode=?");
														$stmt_ldgraw3new->bind_param("is", $lotldgidnew, $plantcode);
														$result2=$stmt_ldgraw3new->execute();
														$stmt_ldgraw3new->store_result();
														$stmt_ldgraw3new->bind_result($lotldg_balbags, $lotldg_balqty);
														$stmt_ldgraw3new->fetch();
																 
														$balbags=$lotldg_balbags+$slnt_tnob;
														$balqty=$lotldg_balqty+$slnt_tqty;
														$zero=0;
														$stmt_arrsub11 = $this->conn_ps->prepare("Insert into tbl_lot_ldg (lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_mergerflg, lotldg_unlistflg, leduration, leupto, plantcode) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
														$stmt_arrsub11->bind_param("ssisiiiisisisssssssssssssisssssisiisss", $lotno, $typ2, $slnew_id, $dt, $slnt_twh, $slnt_tbin, $slnt_tsbin, $lotldg_balbags, $lotldg_balqty, $slnt_tnob, $slnt_tqty, $balbags, $balqty, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_gs, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $lotldg_genpurity, $lotldg_mergerflg, $lotldg_unlistflg, $leduration, $leupto, $plantcode);
														$result_arrsub11 = $stmt_arrsub11->execute();
														if($result_arrsub11){$flag=2;}
														//$arrsub_id=$stmt_arrsub11->insert_id;
														$stmt_arrsub11->close();
														
														
													}
												}
												$stmt_ldgraw3->close();
											}
										}
										$stmt_ldgraw2->close();
									}
								}
								$stmt_ldgraw->close();
							
							}
							else
							{
								$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE  subbinid = ? and plantcode=? and lotno=? ");
								$stmt_ldgraw->bind_param("iss", $slnf_fsbin, $plantcode, $slnf_lotno);
								$result2=$stmt_ldgraw->execute();
								$stmt_ldgraw->store_result();
		//return $stmt_ldgraw->num_rows;
								if ($stmt_ldgraw->num_rows > 0) {
									$stmt_ldgraw->bind_result($lotno);
									//looping through all the records
									while($stmt_ldgraw->fetch())
									{
		//return "SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = $slnf_fsbin and lotldg_lotno = '$slnf_lotno' and plantcode='$plantcode'";		
								
										$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? and plantcode=? ");
										$stmt_ldgraw2->bind_param("iss", $slnf_fsbin, $slnf_lotno, $plantcode);
										$result2=$stmt_ldgraw2->execute();
										$stmt_ldgraw2->store_result();
		//return $stmt_ldgraw2->num_rows;
										if ($stmt_ldgraw2->num_rows > 0) {
											$stmt_ldgraw2->bind_result($lotldgid);
											//looping through all the records
											while($stmt_ldgraw2->fetch())
											{
												$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT lotno, trtype, lotldg_id, lotldg_trdate, whid, binid, subbinid, opnop, optqty, nop, tqty, balnop, balqty, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, plantcode, opnomp, nomp, balnomp, packtype, packlabels, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ?  and plantcode=?");
												$stmt_ldgraw3->bind_param("is", $lotldgid, $plantcode);
												$result2=$stmt_ldgraw3->execute();
												$stmt_ldgraw3->store_result();
												if ($stmt_ldgraw3->num_rows > 0) {
													$stmt_ldgraw3->bind_result($lotldg_lotno, $lotldg_trtype, $lotldg_trid, $lotldg_trdate, $lotldg_whid, $lotldg_binid, $lotldg_subbinid, $lotldg_opbags, $lotldg_opqty, $lotldg_trbags, $lotldg_trqty, $lotldg_balbags, $lotldg_balqty, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $plantcode, $opnomp, $nomp, $balnomp, $packtype, $packlabels, $wtinmp);
													//looping through all the records
													while($stmt_ldgraw3->fetch())
													{ 
														$typ='SLOCSUO'; $typ2='SLOCSUC';
														
														$balq=$lotldg_balqty-$slnt_tqty;
														$balb=$lotldg_balbags-$slnt_tnob;
														$balmp=$balnomp-$slnt_tnomp;
														
														$stmt_arrsub = $this->conn_ps->prepare("Insert into tbl_lot_ldg_pack (lotno, trtype, lotldg_id, lotldg_trdate, whid, binid, subbinid, opnop, optqty, nop, tqty, balnop, balnomp, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, plantcode, opnomp, nomp, balqty, packtype, packlabels, wtinmp) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
														$stmt_arrsub->bind_param("ssisiiiisisisssssssssssssissssisssssss", $lotno, $typ, $slnew_id, $dt, $slnf_fwh, $slnf_fbin, $slnf_fsbin, $lotldg_balbags, $lotldg_balqty, $slnt_tnob, $slnt_tqty, $balb, $balmp, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $plantcode, $balnomp, $slnt_tnomp, $balq, $packtype, $packlabels, $wtinmp);
														$result_arrsub = $stmt_arrsub->execute();
														if($result_arrsub){$flag=1;}
														$arrsub_id=$stmt_arrsub->insert_id;
														$stmt_arrsub->close();
														$balnop=0; $balnomp=0; $balqty='0.000';
														$stmt_ldgraw2new = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? and plantcode=? ");
														$stmt_ldgraw2new->bind_param("iss", $slnt_tsbin, $lotno, $plantcode);
														$result2new=$stmt_ldgraw2new->execute();
														$stmt_ldgraw2new->store_result();
//return $stmt_ldgraw2new->num_rows;
														if ($stmt_ldgraw2new->num_rows > 0) {
														$stmt_ldgraw2new->bind_result($lotldgidnew);
														//looping through all the records
														$stmt_ldgraw2new->fetch();
															
														$stmt_ldgraw3new = $this->conn_ps->prepare("SELECT balnop, balnomp, balqty FROM tbl_lot_ldg_pack WHERE lotdgp_id = ?  and plantcode=?");
														$stmt_ldgraw3new->bind_param("is", $lotldgidnew, $plantcode);
														$result2=$stmt_ldgraw3new->execute();
														$stmt_ldgraw3new->store_result();
														if ($stmt_ldgraw3new->num_rows > 0) {
														$stmt_ldgraw3new->bind_result($balnop, $balnomp, $balqty);
														$stmt_ldgraw3new->fetch();
														}
														$stmt_ldgraw3new->close();
														}
																 
														$bbags=$balnop+$slnt_tnob;
														$bnomp=$balnomp+$slnt_tnomp;
														$bqty=$balqty+$slnt_tqty;
														if($bbags<=0){$bbags=0;}if($bnomp<=0){$bnomp=0;}if($bqty<=0){$bqty=0;}
														$zero=0;
//return "Insert into tbl_lot_ldg_pack (lotno, trtype, lotldg_id, lotldg_trdate, whid, binid, subbinid, opnop, optqty, nop, tqty, balnop, balnomp, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, plantcode, opnomp, nomp, balqty, packtype, packlabels, wtinmp) Values('$lotno', '$typ2', $slnew_id, '$dt', $slnt_twh, $slnt_tbin, $slnt_tsbin, '$balnop', '$balqty', $slnt_tnob, '$slnt_tqty', $bbags, $bnomp, '$yearcode', '$lotldg_variety', '$lotldg_crop', '$lotldg_sstage', '$lotldg_sstatus', '$lotldg_moisture', '$lotldg_gemp', '$lotldg_vchk', '$lotldg_got1', '$lotldg_qc', '$lotldg_qctestdate', '$orlot', '$lotldg_resverstatus', '$lotldg_revcomment', '$lotldg_gottestdate', '$lotldg_got', '$lotldg_srtyp', '$lotldg_srflg', '$plantcode', '$balnomp', '$slnt_tnomp', '$bqty', '$packtype', '$packlabels', '$wtinmp') ";														
														$stmt_arrsub11=$this->conn_ps->prepare("Insert into tbl_lot_ldg_pack (lotno, trtype, lotldg_id, lotldg_trdate, whid, binid, subbinid, opnop, optqty, nop, tqty, balnop, balnomp, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, plantcode, opnomp, nomp, balqty, packtype, packlabels, wtinmp) Values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
												$stmt_arrsub11->bind_param("ssisiiiisisisssssssssssssissssisssssss", $lotno, $typ2, $slnew_id, $dt, $slnt_twh, $slnt_tbin, $slnt_tsbin, $balnop, $balqty, $slnt_tnob, $slnt_tqty, $bbags, $bnomp, $yearcode, $lotldg_variety, $lotldg_crop, $lotldg_sstage, $lotldg_sstatus, $lotldg_moisture, $lotldg_gemp, $lotldg_vchk, $lotldg_got1, $lotldg_qc, $lotldg_qctestdate, $orlot, $lotldg_resverstatus, $lotldg_revcomment, $lotldg_gottestdate, $lotldg_got, $lotldg_srtyp, $lotldg_srflg, $plantcode, $balnomp, $slnt_tnomp, $bqty, $packtype, $packlabels, $wtinmp);
														$result_arrsub11 = $stmt_arrsub11->execute();
														if($result_arrsub11){$flag=2;}
														//$arrsub_id=$stmt_arrsub11->insert_id;
														$stmt_arrsub11->close();
														
														
													}
												}
												$stmt_ldgraw3->close();
											}
										}
										$stmt_ldgraw2->close();
									}
								}
								$stmt_ldgraw->close();
							}
							
							
							
						}
						$stmt_2->close();
					}
						
					
				}
				$stmt_slnt->close();
			}	
//return $flag." = ".$arrsub_id;
			if($flag!=2){$flag=0;}
			if($flag==0 && $arrsub_id>0)
			{
				$stmt_arrsub = $this->conn_ps->prepare("DELETE FROM tbl_slocnew_to WHERE slnt_id=? ");
				$stmt_arrsub->bind_param("i", $arrsub_id);
				$result_arrsub = $stmt_arrsub->execute();
				$stmt_arrsub->close();
				$flg=0;
			}
			
				
				
				
		
		
		}
//return $cnt;		
		
		
		
		
		
		if($flg>0)
		{
			$stmt60 = $this->conn_ps->prepare("Update tbl_slocnew SET slnew_toflg=2 where slnew_id = ? ");
			$stmt60->bind_param("i", $slnew_id);
			$result60 = $stmt60->execute();
			if($result60){$flg=1;}
			$stmt60->close();
		}
		
		
		if($flg==0)
		{ return false; }
		else
		{return true;}//$this->GetTodataFinalSubmit($trid);}		
	}
	
	
	
	
	
	
	
	public function GetFromdataFinalSubmit($scode) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array();
		$dt=date("Y-m-d");
		
			
		$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_fromflg!=1 and slnew_toflg=0 and slnew_tflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		$stmt->bind_param("s", $scode);
		$stmt->execute();
		$stmt->store_result();
		$userSR = array(); $user24=array();
		
		if ($stmt->num_rows > 0) {
			// user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			while($stmt->fetch())
			{
				$stmt60 = $this->conn_ps->prepare("Update tbl_slocnew SET slnew_fromflg=1 where slnew_id = ? ");
				$stmt60->bind_param("i", $slnew_id);
				$result60 = $stmt60->execute();
				if($result60){$flg=1;}
				$stmt60->close();
			}
		}
			
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
	
	
	
	
	
	
	
	
	
	
	public function GetToSLOCchk($scode, $slocwh, $slocbin, $slocsubbin, $crop, $variety, $lotno, $stage, $trid) {
	//return $stage;
	$plantcode = $this->getPlantcode($scode); $slflg=0;
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id FROM tbl_slocnew WHERE slnew_tflg!=1 and slnew_id=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
        $stmt->bind_param("i", $trid);
        $stmt->execute();
        $stmt->store_result();
	$userSR = array(); $user24=array();
	$slnew_id=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id);
			$stmt->fetch();
			{
				$slnf_id=0;
				
				
				if($slocwh!="")
				{
					$stmtwh = $this->conn_ps->prepare("SELECT perticulars, whid, whtype FROM tbl_warehouse where perticulars = ? and plantcode=?");
					$stmtwh->bind_param("ss", $slocwh, $plantcode);
					$resultwh=$stmtwh->execute();
					$stmtwh->store_result();
					if ($stmtwh->num_rows > 0) {
						$stmtwh->bind_result($whperticulars, $whid, $whtype);
						//looping through all the records 
						$stmtwh->fetch();
						$stmtwh->close();
					}
				}
				if($slocbin!="")
				{
					//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
					$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
					$stmtbin->bind_param("iss", $whid, $slocbin, $plantcode);
					$resultbin=$stmtbin->execute();
					$stmtbin->store_result();
					if ($stmtbin->num_rows > 0) {
						$stmtbin->bind_result($binname, $binid);
						//looping through all the records
						$stmtbin->fetch();
						$stmtbin->close();
					}	
				}
				if($slocsubbin!="")
				{
					$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
					$stmt_sbin->bind_param("iiss", $whid, $binid, $slocsubbin, $plantcode);
					$result2=$stmt_sbin->execute();
					$stmt_sbin->store_result();
					if ($stmt_sbin->num_rows > 0) {
						$stmt_sbin->bind_result($subbinname, $subbinid);
						//looping through all the records
						$stmt_sbin->fetch();
						$stmt_sbin->close();
					}
				}
				//return $subbinid;
				$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
				$stmt_crop->bind_param("s", $crop);
				$stmt_crop->execute();
				$stmt_crop->store_result();
				$stmt_crop->bind_result($cropid, $cropname);
				$stmt_crop->fetch();
				$stmt_crop->close();
				$ver=$cropname."-Coded";
				if($variety==$ver)
				{
					$varietyid=$cropname."-Coded";
				}
				else
				{
					$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
					$stmt_variety->bind_param("s", $variety);
					$stmt_variety->execute();
					$stmt_variety->store_result();
					$stmt_variety->bind_result($varietyid, $popularname);
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
//return "SELECT  slnf_id, slnf_fwh, slnf_fbin, slnf_fsbin FROM tbl_slocnew_from WHERE slnew_id = '$slnew_id' and slnf_crop = '$cropid' and slnf_variety = '$varietyid' and slnf_stage = '$stage' and slnf_lotno = '$lotno'";				 
				$stmt_2 = $this->conn_ps->prepare("SELECT  slnf_id, slnf_fwh, slnf_fbin, slnf_fsbin FROM tbl_slocnew_from WHERE slnew_id = ? and slnf_crop = ? and slnf_variety = ? and slnf_stage = ? and slnf_lotno = ?");
				$stmt_2->bind_param("issss", $slnew_id, $cropid, $varietyid, $stage, $lotno);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
					$stmt_2->bind_result($slnf_id, $whidf, $binidf, $subbinidfln);
					//looping through all the records
					while($stmt_2->fetch())
					{
						if($whid==NULL){$whid='';} if($binid==NULL){$binid='';} if($subbinid==NULL){$subbinid='';} 
						
						
						$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_id,  slnt_crop, slnt_variety, slnt_lotno, slnt_stage, slnt_twh, slnt_tbin, slnt_tsbin   FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? and slnt_lotno=? and slnt_tsbin=?");
						$stmt_slocto->bind_param("iisi", $slnew_id, $slnf_id, $lotno, $subbinid);
						$stmt_slocto->execute();
						$stmt_slocto->store_result();
						//return $stmt_slocto->num_rows;
						if ($stmt_slocto->num_rows==0) {
						
							if($whtype!="Cold")
							{
							//return $whid." = ".$binid." = ".$subbinid;
								//if($stage=="Raw")
								{
									$stg='Test';

//return "SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=$whid and lotldg_binid=$binid and lotldg_subbinid = $subbinid and plantcode=$plantcode  and lotldg_variety!=$varietyid and lotldg_sstage='Raw' ";

									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_variety!=? and lotldg_sstage='Raw' ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
//return $stmt_ldgraw2->num_rows;
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_variety!=? and lotldg_sstage='Raw' ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
//return $stmt_ldgraw3->num_rows;
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Raw' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
//return $stmt_ldgraw4->num_rows;
													if ($stmt_ldgraw4->num_rows > 0) {
														$slflg=1;
														$stg='Raw';
														if($stage!='Raw'){$slflg=1;}
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();
									//return $stg;	

									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_variety=? and lotldg_sstage='Raw' ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
//return $stmt_ldgraw2->num_rows;
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_variety=? and lotldg_sstage='Raw' ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
//return $stmt_ldgraw3->num_rows;
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Raw' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
//return $stmt_ldgraw4->num_rows;
													if ($stmt_ldgraw4->num_rows > 0) {
														if($stage!='Raw'){$slflg=1;}
														if($variety==$ver && $slflg==0)
														{$slflg=1;}
														//return $slflg;}
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();
									
								}
								//else if($stage=="Condition")
								{
//return "SELECT distinct(lotldg_variety) FROM tbl_lot_ldg WHERE lotldg_whid='$whid' and lotldg_binid='$binid' and plantcode='$plantcode' and lotldg_subbinid='$subbinid'  and lotldg_variety!='$varietyid' and lotldg_sstage='Condition'";
									
									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_variety!=? and lotldg_sstage='Condition' ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_variety!=? and lotldg_sstage='Condition' ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Condition' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
														$slflg=2;
														if($stage!='Condition'){$slflg=2;}
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();

									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_variety=? and lotldg_sstage='Condition' ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_variety=? and lotldg_sstage='Condition' ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Condition' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
														
														if($stage!='Condition'){$slflg=2;}
														if($variety==$ver && $slflg==0)
														{$slflg=2;}
														//return $slflg;}
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();
								
								}
								//else
								{
//return "SELECT distinct(lotldg_variety) FROM tbl_lot_ldg_pack WHERE whid='$whid' and binid='$binid' and plantcode='$plantcode' and subbinid='$subbinid'  and lotldg_variety!='$varietyid' ";
									
									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=?  and lotldg_variety!=? ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?  and lotldg_variety!=? ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotno, balnop, balqty FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");

													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
//return $stage;
														$slflg=3;
														if($stage!="Pack"){$slflg=3;}
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();

									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=?  and lotldg_variety=? ");
									$stmt_ldgraw2->bind_param("iiiss", $whid, $binid, $subbinid, $plantcode, $varietyid);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?  and lotldg_variety=? ");
											$stmt_ldgraw3->bind_param("iiisss", $whid, $binid, $subbinid, $lotno, $plantcode, $varietyid);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotno, balnop, balqty FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");

													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
//return $stage;
														if($stage!="Pack"){$slflg=3;}
														if($variety==$ver && $slflg==0)
														{$slflg=3;}
														//return $slflg;}
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
							else
							{
							
							//cold storage validation
							
									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?   and lotldg_sstage='Raw' ");
									$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_sstage='Raw' ");
											$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Raw' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
														$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
														//looping through all the records
														$stmt_ldgraw4->fetch();
														if($stage!="Raw"){$slflg=1;}
														
														$stmtcrop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
														$stmtcrop->bind_param("i", $lotldg_crop);
														$stmtcrop->execute();
														$stmtcrop->store_result();
														$stmtcrop->bind_result($crop_id, $crop_name);
														$stmtcrop->fetch();
														$stmtcrop->close();
														
														if($cropname=="Brinjal" && ($crop_name=="Chilli" || $crop_name=="Tomato")){$slflg=12;}
														if($cropname=="Chilli" && ($crop_name=="Brinjal" || $crop_name=="Tomato")){$slflg=12;}
														if($cropname=="Tomato" && ($crop_name=="Brinjal" || $crop_name=="Chilli")){$slflg=12;}
														
														if($cropid==$lotldg_crop && $varietyid!=$lotldg_variety){$slflg=11;}
														if($variety==$ver && $slflg==0)
														{$slflg=11;}
														//else if($varietyid!=['lotldg_variety']){$slflg=1;}
														//else {}
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();								
									
									
									
									//else if($stage=="Condition")
								
//return "SELECT distinct(lotldg_variety) FROM tbl_lot_ldg WHERE lotldg_whid='$whid' and lotldg_binid='$binid' and plantcode='$plantcode' and lotldg_subbinid='$subbinid'  and lotldg_variety!='$varietyid' and lotldg_sstage='Condition'";
									
									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_sstage='Condition' ");
									$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?  and lotldg_sstage='Condition' ");
											$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? and lotldg_sstage='Condition' ");
													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
														$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
														//looping through all the records
														$stmt_ldgraw4->fetch();
														if($stage!="Condition"){$slflg=2;}
														
														$stmtcrop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
														$stmtcrop->bind_param("i", $lotldg_crop);
														$stmtcrop->execute();
														$stmtcrop->store_result();
														$stmtcrop->bind_result($crop_id, $crop_name);
														$stmtcrop->fetch();
														$stmtcrop->close();
														
														if($cropname=="Brinjal" && ($crop_name=="Chilli" || $crop_name=="Tomato")){$slflg=21;}
														if($cropname=="Chilli" && ($crop_name=="Brinjal" || $crop_name=="Tomato")){$slflg=21;}
														if($cropname=="Tomato" && ($crop_name=="Brinjal" || $crop_name=="Chilli")){$slflg=21;}
														
														if($cropid==$lotldg_crop && $varietyid!=$lotldg_variety){$slflg=22;}
														if($variety==$ver && $slflg==0)
														{$slflg=22;}
														//else if($varietyid!=['lotldg_variety']){$slflg=2;}
														//else {}
														//if($stage!="Condition")$slflg=2;
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();
									
									
								
								//}
								//else
								//{
//return "SELECT distinct(lotldg_variety) FROM tbl_lot_ldg_pack WHERE whid='$whid' and binid='$binid' and plantcode='$plantcode' and subbinid='$subbinid'  and lotldg_variety!='$varietyid' ";
									
									$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=?  ");
									$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
									$result2=$stmt_ldgraw2->execute();
									$stmt_ldgraw2->store_result();
									if ($stmt_ldgraw2->num_rows > 0) {
										$stmt_ldgraw2->bind_result($lotno);
										//looping through all the records
										while($stmt_ldgraw2->fetch())
										{
											$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?  ");
											$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
											$result2=$stmt_ldgraw3->execute();
											$stmt_ldgraw3->store_result();
											if ($stmt_ldgraw3->num_rows > 0) {
												$stmt_ldgraw3->bind_result($lotldgid);
												//looping through all the records
												while($stmt_ldgraw3->fetch())
												{ 
													$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotno, balnop, balqty FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty > 0 and plantcode=? ");

													$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
													$result2=$stmt_ldgraw4->execute();
													$stmt_ldgraw4->store_result();
													if ($stmt_ldgraw4->num_rows > 0) {
														$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotno, $balnop, $balqty);
														//looping through all the records
														$stmt_ldgraw4->fetch();
//return "Stage -".$stage;
														if($stage!="Pack")$slflg=3;
														
														$stmtcrop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
														$stmtcrop->bind_param("i", $lotldg_crop);
														$stmtcrop->execute();
														$stmtcrop->store_result();
														$stmtcrop->bind_result($crop_id, $crop_name);
														$stmtcrop->fetch();
														$stmtcrop->close();
														
														if($cropname=="Brinjal" && ($crop_name=="Chilli" || $crop_name=="Tomato")){$slflg=31;}
														if($cropname=="Chilli" && ($crop_name=="Brinjal" || $crop_name=="Tomato")){$slflg=31;}
														if($cropname=="Tomato" && ($crop_name=="Brinjal" || $crop_name=="Chilli")){$slflg=31;}
														
														if($cropid==$lotldg_crop && $varietyid!=$lotldg_variety){$slflg=33;}
														if($variety==$ver && $slflg==0)
														{$slflg=33;}
														//else if($varietyid!=['lotldg_variety']){$slflg=3;}
														//else {}
														//return $slflg;
													}
													$stmt_ldgraw4->close();
												}
											}
											$stmt_ldgraw3->close();
										}
									}
									$stmt_ldgraw2->close();


										
								
							
							
							
							}
							
							
							
							
							//array_push($user24,$userSR);
						}
						else
						{
							$stmt_slocto->bind_result($slnt_id,  $slnt_crop, $slnt_variety, $slnt_lotno, $slnt_stage, $slnt_twh, $slnt_tbin, $slnt_tsbin);
							$stmt_slocto->fetch();
//return $slnt_id;
							if($whtype=="Regular")
							{
								if($slnt_crop!=$crop && $slnt_variety!=$variety && $slnt_stage!=$stage ) {$slflg=4;}
								
								if($variety==$ver && $slnt_twh==$slocwh && $slnt_tbin=$slocbin && $slnt_tsbin==$slocsubbin ) {$slflg=4;}
								//if($slnt_stage!=$stage && $slnt_twh==$slocwh && $slnt_tbin=$slocbin && $slnt_tsbin==$slocsubbin ) {$slflg=4;}
							}
							else if($whtype=="Cold")
							{
								if($slnt_stage!=$stage) {$slflg=5;}
//return $slnt_crop." = ".$crop." = ".$slnt_variety." = ".$variety." = ".$slnt_twh." = ".$whid." = ".$slnt_tbin." = ".$binid." = ".$slnt_tsbin." = ".$subbinid;								
								if($slnt_crop==$crop && $slnt_variety!=$variety && $slnt_twh==$whid && $slnt_tbin=$binid && $slnt_tsbin==$subbinid ) {$slflg=5;}
								if($variety==$ver && $slnt_twh==$slocwh && $slnt_tbin=$slocbin && $slnt_tsbin==$slocsubbin ) {$slflg=5;}
							}
						}
						$stmt_slocto->close();
						
					}
					$stmt_2->close();
				}
				else
				{
					$slflg=9; return $slflg;
				}
			}
			$stmt->close();
			
           // return $resusers;
        } else {
            // user not existed
			//$userSR = array();
			$slflg=4; return $slflg;
            $stmt->close();
           // return false;
        }
		return $slflg;
		
    }	
	
	
	
	
	
	
	
	
	public function GetToTrList($scode) {
	
		$plantcode = $this->getPlantcode($scode);
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_tflg!=1 AND slnew_toflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
       $stmt->bind_param("s", $scode);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			while($stmt->fetch())
			{
				if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
				if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
				{
					$lnew_date1=explode("-",$lnew_date);
					$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
				}
				
				$userSR["trid"] = $slnew_id;
				$userSR["trdate"] = $lnew_date;
				$userSR["fromflg"] = $slnew_fromflg;
				$userSR["toflg"] = $slnew_toflg;
				$userSR["trflg"] = $slnew_tflg;
				$userSR["scode"] = $slnew_logid;
				
				$slnf_id=0; $slnt_tdate=''; $slnt_twh=''; $slnt_tbin=''; $slnt_tsbin=''; $slnt_textnob=''; $slnt_textqty=''; $slnt_tnob='';  $slnt_tqty=''; $slnt_tbalnob='';  $slnt_tbalqty ='';
				 $slnf_crop=''; $slnf_variety=''; $slnf_stage=''; $slnf_lotno=''; $slnf_ups=''; $whperticulars=''; $binname=''; $subbinname='';
				 
				$stmt_2 = $this->conn_ps->prepare("SELECT   slnew_id, slnf_id, slnt_tdate, slnt_twh, slnt_tbin, slnt_tsbin, slnt_textnob, slnt_textqty, slnt_tnob, slnt_tqty, slnt_tbalnob, slnt_tbalqty FROM tbl_slocnew_to WHERE slnew_id = ? ");
				$stmt_2->bind_param("i", $slnew_id);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {

					$stmt_2->bind_result($slnew_id, $slnf_id, $slnt_tdate, $slnt_twh, $slnt_tbin, $slnt_tsbin, $slnt_textnob, $slnt_textqty, $slnt_tnob, $slnt_tqty, $slnt_tbalnob, $slnt_tbalqty);
					//looping through all the records
					while($stmt_2->fetch())
					{
						$stmt_slocfrom = $this->conn_ps->prepare("SELECT   slnf_fdate, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_ups, slnf_fqty  FROM tbl_slocnew_from WHERE slnew_id=? and slnf_id=? ");
						$stmt_slocfrom->bind_param("ii", $slnew_id, $slnf_id);
						$stmt_slocfrom->execute();
						$stmt_slocfrom->store_result();
						//if ($stmt_slocfrom->num_rows>0) {
						$stmt_slocfrom->bind_result($slnf_fdate, $slnf_crop, $slnf_variety, $slnf_stage, $slnf_lotno, $slnf_ups, $slnf_fqty);
						$stmt_slocfrom->fetch();
						//}
						$stmt_slocfrom->close();
						
						if($slnt_tdate==NULL){$slnt_tdate='';} if($slnt_twh==NULL){$slnt_twh='';} if($slnt_tbin==NULL){$slnt_tbin='';} if($slnt_tsbin==NULL){$slnt_tsbin='';} if($slnt_textnob==NULL){$slnt_textnob='';}  if($slnt_textqty==NULL){$slnt_textqty='';} if($slnt_tnob==NULL){$slnt_tnob='';}  if($slnt_tqty==NULL){$slnt_tqty='';} if($slnt_tbalnob==NULL){$slnt_tbalnob='';}  if($slnt_tbalqty==NULL){$slnt_tbalqty='';}  if($slnf_crop==NULL){$slnf_crop='';}  if($slnf_variety==NULL){$slnf_variety='';}  if($slnf_stage==NULL){$slnf_stage='';}  if($slnf_lotno==NULL){$slnf_lotno='';}  if($slnf_ups==NULL){$slnf_ups='';} 
						if($slnt_tdate!='' && $slnt_tdate!='0000-00-00' && $slnt_tdate!=NULL)
						{
							$slnt_tdate1=explode("-",$slnt_tdate);
							$slnt_tdate=$slnt_tdate1[2]."-".$slnt_tdate1[1]."-".$slnt_tdate1[0];
						}
						
						$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
						$stmt_crop->bind_param("i", $slnf_crop);
						$stmt_crop->execute();
						$stmt_crop->store_result();
						$stmt_crop->bind_result($cropid, $cropname);
						$stmt_crop->fetch();
						$stmt_crop->close();
						
						$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
						$stmt_variety->bind_param("i", $slnf_variety);
						$stmt_variety->execute();
						$stmt_variety->store_result();
						$stmt_variety->bind_result($varietyid, $popularname);
						$stmt_variety->fetch();
						$stmt_variety->close();
						
												
						$whperticulars=''; $binname=''; $subbinname='';
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
						$stmt_wh->bind_param("ss", $slnt_twh, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
							$stmt_bin->bind_param("iss", $whid, $slnt_tbin, $plantcode);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
								$stmt_sbin->bind_param("iiss", $whid, $binid, $slnt_tsbin, $plantcode);
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
						
						$userSR["crop"] = $cropname;
						$userSR["variety"] = $popularname;
						$userSR["stage"] = $slnf_stage;
						$userSR["lotno"] = $slnf_lotno;
						$userSR["ups"] = $slnf_ups;
						$userSR["wh"] = $whperticulars;
						$userSR["bin"] = $binname;
						$userSR["subbin"] = $subbinname;
						$userSR["extnob"] = $slnt_textnob;
						$userSR["extqty"] = $slnt_textqty;
						$userSR["nob"] = $slnt_tnob;
						$userSR["qty"] = $slnt_tqty;
						$userSR["balnob"] = $slnt_tbalnob;
						$userSR["balqty"] = $slnt_tbalqty;
						
						array_push($user24,$userSR);
						
					}
					$stmt_2->close();
				}
			
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
	
	
	
	
	
	
	
	public function GetTodataFinalSubmit($trid, $scode) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode); $zero=0; $one=1; $two=2; $flag=0;  $dt=date("Y-m-d");
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_tflg!=1 AND slnew_toflg!=1 and slnew_id=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
       $stmt->bind_param("s", $trid);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			while($stmt->fetch())
			{
					$stmt60 = $this->conn_ps->prepare("Update tbl_slocnew SET slnew_toflg=1, slnew_tflg=1 where slnew_id = ? ");
					$stmt60->bind_param("i", $slnew_id);
					$result60 = $stmt60->execute();
					if($result60){$flag=1;}
					$stmt60->close();
			}
			$stmt->close();
			
           // return $resusers;
        } else {
            // user not existed
			$userSR = array();
            $stmt->close();
           // return false;
        }
	//return $flag;
	
		if($flag==0)	
		{return false;}
		else
		{return true;}	
	}
	
	
	
	
	
	
	
	
	public function GetFromEditDataUpdate($scode, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array(); $one=1; $two=2; $zero=0;
		$dt=date("Y-m-d");
		
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
		
		foreach($phpArray as $lotary)
		{
			//return print_r($lotary);			
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $stage=''; $extnob='0'; $extqty='0'; $nob='0'; $qty='0'; $balnob='0'; $balqty='0'; $fromtrid=0;
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
				
				if($skey=="extwb") {$extwb=$sval; }
				if($skey=="extnmp") {$extnmp=$sval; }
				if($skey=="wb") {$wb=$sval; }
				if($skey=="nmp") {$nmp=$sval; }
				if($skey=="balwb") {$balwb=$sval; }
				if($skey=="balnmp") {$balnmp=$sval; }
				if($skey=="ups") {$ups=$sval; }
				if($skey=="wtmp") {$wtmp=$sval; }
				if($skey=="fromtrid") {$fromtrid=$sval; }
				
				
				if($wh!="")
				{
					$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
					$stmtwh->bind_param("ss", $wh, $plantcode);
					$resultwh=$stmtwh->execute();
					$stmtwh->store_result();
					if ($stmtwh->num_rows > 0) {
						$stmtwh->bind_result($whperticulars,$whid);
						//looping through all the records 
						$stmtwh->fetch();
						$stmtwh->close();
					}
				}
				if($bin!="")
				{
					//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
					$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
					$stmtbin->bind_param("iss", $whid, $bin, $plantcode);
					$resultbin=$stmtbin->execute();
					$stmtbin->store_result();
					if ($stmtbin->num_rows > 0) {
						$stmtbin->bind_result($binname, $binid);
						//looping through all the records
						$stmtbin->fetch();
						$stmtbin->close();
					}	
				}
				if($subbin!="")
				{
					$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
					$stmt_sbin->bind_param("iiss", $whid, $binid, $subbin, $plantcode);
					$result2=$stmt_sbin->execute();
					$stmt_sbin->store_result();
					if ($stmt_sbin->num_rows > 0) {
						$stmt_sbin->bind_result($subbinname, $subbinid);
						//looping through all the records
						$stmt_sbin->fetch();
						$stmt_sbin->close();
					}
				}
				if($crop!="")
				{
					$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
					$stmt_crop->bind_param("s", $crop);
					$stmt_crop->execute();
					$stmt_crop->store_result();
					$stmt_crop->bind_result($cropid, $cropname);
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
				if($variety!="")
				{
					if(!is_string($variety))
					{
						$varietyid=$cropname."-Coded";
					}
					else
					{
						$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
						$stmt_variety->bind_param("s", $variety);
						$stmt_variety->execute();
						$stmt_variety->store_result();
						$stmt_variety->bind_result($varietyid, $popularname);
						$stmt_variety->fetch();
						$stmt_variety->close();
					}
				}
			}
			//return $wh." = ".$bin." = ".$subbin." = ".$crop." = ".$variety." = ".$lotno." = ".$stage." = ".$extnob." = ".$extqty." = ".$nob." = ".$qty." = ".$balnob." = ".$balqty;
			//return $whid." = ".$binid." = ".$subbinid." = ".$cropid." = ".$varietyid." = ".$lotno." = ".$stage." = ".$extnob." = ".$extqty." = ".$nob." = ".$qty." = ".$balnob." = ".$balqty;
			$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_tflg!=1  and slnew_fromflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		   	$stmt->bind_param("s", $scode);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
				while($stmt->fetch())
				{
					if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
					if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
					{
						$lnew_date1=explode("-",$lnew_date);
						$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
					}
					
					
//return "Insert into tbl_slocnew_from (slnew_id, slnf_fdate, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fextnob, slnf_fextqty, slnf_fnob, slnf_fqty, slnf_fbalnob, slnf_fbalqty ) Values('$slnew_id', '$dt', '$cropid', '$varietyid', '$stage', '$lot_no', '$whid', '$binid', '$subbinid', '$extnob', '$extqty', '$nob', '$qty', '$balnob', '$balqty') ";
					$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id  FROM tbl_slocnew_from WHERE slnew_id = ? and slnf_crop = ? and slnf_variety = ? and slnf_lotno=? and slnf_id=? order by slnf_id ASC");
					$stmt_slnf->bind_param("iissi", $slnew_id, $cropid, $varietyid, $lot_no, $fromtrid);
					$result_slnf=$stmt_slnf->execute();
					$stmt_slnf->store_result();
					if ($stmt_slnf->num_rows > 0) {
						$stmt_slnf->bind_result($slnf_id, $slnewid);
						$stmt_slnf->fetch();
//return "UPDATE tbl_slocnew_from  SET  slnf_fextnob=?, slnf_fextnomp, slnf_fextwb, slnf_fextqty=?, slnf_fnob=?, slnf_fnomp, slnf_fwb, slnf_fqty=?, slnf_fbalnob=?, slnf_fbalnomp, slnf_fbalwb, slnf_fbalqty=? where slnf_id=?  ";						
						$stmt_arrsub = $this->conn_ps->prepare("UPDATE tbl_slocnew_from  SET  slnf_fextnob=?, slnf_fextnomp=?, slnf_fextwb=?, slnf_fextqty=?, slnf_fnob=?, slnf_fnomp=?, slnf_fwb=?, slnf_fqty=?, slnf_fbalnob=?, slnf_fbalnomp=?, slnf_fbalwb=?, slnf_fbalqty=? where slnf_id=?  ");
						$stmt_arrsub->bind_param("iiisiiisiiisi", $extnob, $extnmp, $extwb, $extqty, $nob, $nmp, $wb, $qty, $balnob, $balnmp, $balwb, $balqty, $slnf_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
						
						$stmt_slnf->close();
					}
					
				}
			}
			
		}	
		
		
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
	
	

public function GetFromDeleteData($scode, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array(); $one=1; $two=2; $zero=0;
		$dt=date("Y-m-d");
		
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
		
		foreach($phpArray as $lotary)
		{
			//return print_r($lotary);			
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $stage=''; $extnob='0'; $extqty='0'; $nob='0'; $qty='0'; $balnob='0'; $balqty='0';
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
				
			}
if($wh!="")
				{
					$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
					$stmtwh->bind_param("ss", $wh, $plantcode);
					$resultwh=$stmtwh->execute();
					$stmtwh->store_result();
					if ($stmtwh->num_rows > 0) {
						$stmtwh->bind_result($whperticulars,$whid);
						//looping through all the records 
						$stmtwh->fetch();
						$stmtwh->close();
					}
				}
				if($bin!="")
				{
					//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
					$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
					$stmtbin->bind_param("iss", $whid, $bin, $plantcode);
					$resultbin=$stmtbin->execute();
					$stmtbin->store_result();
					if ($stmtbin->num_rows > 0) {
						$stmtbin->bind_result($binname, $binid);
						//looping through all the records
						$stmtbin->fetch();
						$stmtbin->close();
					}	
				}
				if($subbin!="")
				{
					$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
					$stmt_sbin->bind_param("iiss", $whid, $binid, $subbin, $plantcode);
					$result2=$stmt_sbin->execute();
					$stmt_sbin->store_result();
					if ($stmt_sbin->num_rows > 0) {
						$stmt_sbin->bind_result($subbinname, $subbinid);
						//looping through all the records
						$stmt_sbin->fetch();
						$stmt_sbin->close();
					}
				}
				if($crop!="")
				{
					$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
					$stmt_crop->bind_param("s", $crop);
					$stmt_crop->execute();
					$stmt_crop->store_result();
					$stmt_crop->bind_result($cropid, $cropname);
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
				if($variety!="")
				{
					$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
					$stmt_variety->bind_param("s", $variety);
					$stmt_variety->execute();
					$stmt_variety->store_result();
					$stmt_variety->bind_result($varietyid, $popularname);
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_tflg!=1  and slnew_toflg=0 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		   	$stmt->bind_param("s", $scode);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
				while($stmt->fetch())
				{
					$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id  FROM tbl_slocnew_from WHERE slnew_id = ? and slnf_crop = ? and slnf_variety = ? and slnf_lotno=? order by slnf_id ASC");
					$stmt_slnf->bind_param("iiss", $slnew_id, $cropid, $varietyid, $lot_no);
					$result_slnf=$stmt_slnf->execute();
					$stmt_slnf->store_result();
					if ($stmt_slnf->num_rows > 0) {
						$stmt_slnf->bind_result($slnf_id, $slnewid);
						$stmt_slnf->fetch();
						
						$stmt_arrsub = $this->conn_ps->prepare("DELETE FROM tbl_slocnew_from where slnf_id=?  ");
						$stmt_arrsub->bind_param("i", $slnf_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
						
						$stmt_slnf->close();
					}
					
					$stmt_slocmn = $this->conn_ps->prepare("SELECT  slnf_id  FROM tbl_slocnew_from WHERE slnew_id=? ");
					$stmt_slocmn->bind_param("i", $slnew_id);
					$stmt_slocmn->execute();
					$stmt_slocmn->store_result();
					
					if ($stmt_slocmn->num_rows==0) {
						$stmt_arrsub = $this->conn_ps->prepare("UPDATE tbl_slocnew SET slnew_fromflg=2 where slnew_id=? ");
						$stmt_arrsub->bind_param("i", $slnew_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
					}
					$stmt_slocmn->close();
					
				}
			}
			
		}	
		
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
		
	
	
	public function GetToEditDataUpdate($scode, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array();
		$dt=date("Y-m-d");
		
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
		
		foreach($phpArray as $lotary)
		{
			
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $ups=''; $stage=''; $extnob=''; $extqty=''; $nob=''; $qty=''; $balnob=''; $balqty=''; $extnmp=0; $extwb=0; $nmp=0; $wb=0; $balnmp=0; $balwb=0;
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="ups") {$ups=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extnmp") {$extnmp=$sval; }
				if($skey=="extwb") {$extwb=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="nmp") {$nmp=$sval; }
				if($skey=="wb") {$wb=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balnmp") {$balnmp=$sval; }
				if($skey=="balwb") {$balwb=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
			}
			
			$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_fromflg=1 and slnew_toflg!=1 and slnew_tflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		   	$stmt->bind_param("s", $scode);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
				while($stmt->fetch())
				{
					if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
					if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
					{
						$lnew_date1=explode("-",$lnew_date);
						$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
					}
					
//return "select slnf_id from tbl_slocnew_from where slnew_id=$slnew_id and slnf_crop=$cropid and slnf_variety=$varietyid and slnf_lotno='$lot_no' ";
					$stmt_slocfrom = $this->conn_ps->prepare("select slnf_id from tbl_slocnew_from where slnew_id=? and slnf_crop=? and slnf_variety=? and slnf_lotno=?");
					$stmt_slocfrom->bind_param("iiis", $slnew_id, $cropid, $varietyid, $lot_no);
					$stmt_slocfrom->execute();
					$stmt_slocfrom->store_result();
					$stmt_slocfrom->bind_result($slnf_id);
					$stmt_slocfrom->fetch();
					$stmt_slocfrom->close();
					
					$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_id  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? and slnt_twh=? and slnt_tbin=? and slnt_tsbin=?");
					$stmt_slocto->bind_param("iiiii", $slnew_id, $slnf_id, $whid, $binid, $subbinid);
					$stmt_slocto->execute();
					$stmt_slocto->store_result();
					
					if ($stmt_slocto->num_rows==0) {
						$stmt_slocto->bind_result($slnt_id);
						$stmt_slocto->fetch();

						$stmt_arrsub = $this->conn_ps->prepare("UPDATE tbl_slocnew_to SET slnt_textnob=?, slnt_textqty=?, slnt_tnob=?, slnt_tqty=?, slnt_tbalnob=?, slnt_tbalqty=?, slnt_textnomp=?, slnt_textwb=?, slnt_tnomp=?, slnt_twb=?, slnt_tbalnomp=?, slnt_tbalwb=? where slnt_id=? ");
						$stmt_arrsub->bind_param("isisisiiiiiii", $extnob, $extqty, $nob, $qty, $balnob, $balqty, $extnmp, $extwb, $nmp, $wb, $balnmp, $balwb, $slnt_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
					}
					$stmt_slocto->close();
			//return $flg;
				}
			}
		}	
		
		
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
	
	
	
	public function GetToDeleteData($scode, $jdata) {
	//return $jdata;
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $lots=array();
		$dt=date("Y-m-d");
		
		$phpArray = json_decode($jdata, true); 
		//$lotar=explode(",", $lotarray);
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
		
		foreach($phpArray as $lotary)
		{
			$wh=''; $bin=''; $subbin=''; $crop=''; $variety=''; $lotno=''; $stage=''; $extnob=''; $extqty=''; $nob=''; $qty=''; $balnob=''; $balqty='';
			foreach ($lotary as $sub_key => $sub_val) 
			{
				$skey=$sub_key;	
				$sval=$sub_val;
				
				if($skey=="wh") {$wh=$sval; }
				if($skey=="bin") {$bin=$sval; }
				if($skey=="subbin") {$subbin=$sval; }
				if($skey=="crop") {$crop=$sval; }
				if($skey=="variety") {$variety=$sval; }
				if($skey=="lotno") {$lot_no=$sval; }
				if($skey=="stage") {$stage=$sval; }
				if($skey=="extnob") {$extnob=$sval; }
				if($skey=="extqty") {$extqty=$sval; }
				if($skey=="nob") {$nob=$sval; }
				if($skey=="qty") {$qty=$sval; }
				if($skey=="balnob") {$balnob=$sval; }
				if($skey=="balqty") {$balqty=$sval; }
			}
			if($wh!="")
				{
					$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
					$stmtwh->bind_param("ss", $wh, $plantcode);
					$resultwh=$stmtwh->execute();
					$stmtwh->store_result();
					if ($stmtwh->num_rows > 0) {
						$stmtwh->bind_result($whperticulars,$whid);
						//looping through all the records 
						$stmtwh->fetch();
						$stmtwh->close();
					}
				}
				if($bin!="")
				{
					//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
					$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
					$stmtbin->bind_param("iss", $whid, $bin, $plantcode);
					$resultbin=$stmtbin->execute();
					$stmtbin->store_result();
					if ($stmtbin->num_rows > 0) {
						$stmtbin->bind_result($binname, $binid);
						//looping through all the records
						$stmtbin->fetch();
						$stmtbin->close();
					}	
				}
				if($subbin!="")
				{
					$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
					$stmt_sbin->bind_param("iiss", $whid, $binid, $subbin, $plantcode);
					$result2=$stmt_sbin->execute();
					$stmt_sbin->store_result();
					if ($stmt_sbin->num_rows > 0) {
						$stmt_sbin->bind_result($subbinname, $subbinid);
						//looping through all the records
						$stmt_sbin->fetch();
						$stmt_sbin->close();
					}
				}
				if($crop!="")
				{
					$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropname=?");
					$stmt_crop->bind_param("s", $crop);
					$stmt_crop->execute();
					$stmt_crop->store_result();
					$stmt_crop->bind_result($cropid, $cropname);
					$stmt_crop->fetch();
					$stmt_crop->close();
				}
				if($variety!="")
				{
					$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where popularname=?");
					$stmt_variety->bind_param("s", $variety);
					$stmt_variety->execute();
					$stmt_variety->store_result();
					$stmt_variety->bind_result($varietyid, $popularname);
					$stmt_variety->fetch();
					$stmt_variety->close();
				}
			$stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_fromflg=1 and slnew_toflg!=1 and slnew_tflg!=1 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
		   	$stmt->bind_param("s", $scode);
			$stmt->execute();
			$stmt->store_result();
			$userSR = array(); $user24=array();
			
			if ($stmt->num_rows > 0) {
				// user existed 
				$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
				while($stmt->fetch())
				{
					if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
					if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
					{
						$lnew_date1=explode("-",$lnew_date);
						$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
					}
					
//return "select slnf_id from tbl_slocnew_from where slnew_id=$slnew_id and slnf_crop=$cropid and slnf_variety=$varietyid and slnf_lotno='$lot_no' ";
					$stmt_slocfrom = $this->conn_ps->prepare("select slnf_id from tbl_slocnew_from where slnew_id=? and slnf_crop=? and slnf_variety=? and slnf_lotno=?");
					$stmt_slocfrom->bind_param("iiis", $slnew_id, $cropid, $varietyid, $lot_no);
					$stmt_slocfrom->execute();
					$stmt_slocfrom->store_result();
					$stmt_slocfrom->bind_result($slnf_id);
					$stmt_slocfrom->fetch();
					$stmt_slocfrom->close();
					
					$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_id  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? and slnt_twh=? and slnt_tbin=? and slnt_tsbin=?");
					$stmt_slocto->bind_param("iiiii", $slnew_id, $slnf_id, $whid, $binid, $subbinid);
					$stmt_slocto->execute();
					$stmt_slocto->store_result();
					
					if ($stmt_slocto->num_rows>0) {
						$stmt_slocto->bind_result($slnt_id);
						$stmt_slocto->fetch();

						$stmt_arrsub = $this->conn_ps->prepare("DELETE FROM tbl_slocnew_to where slnt_id=? ");
						$stmt_arrsub->bind_param("i", $slnt_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
					}
					$stmt_slocto->close();
					
					$stmt_slocmn = $this->conn_ps->prepare("SELECT  slnt_id  FROM tbl_slocnew_to WHERE slnew_id=? ");
					$stmt_slocmn->bind_param("i", $slnew_id);
					$stmt_slocmn->execute();
					$stmt_slocmn->store_result();
					
					if ($stmt_slocmn->num_rows==0) {
						$stmt_arrsub = $this->conn_ps->prepare("UPDATE tbl_slocnew SET slnew_toflg=0 where slnew_id=? ");
						$stmt_arrsub->bind_param("i", $slnew_id);
						$result_arrsub = $stmt_arrsub->execute();
						if($result_arrsub){$flg=1;}
						$arrsub_id=$stmt_arrsub->insert_id;
						$stmt_arrsub->close();
					}
					$stmt_slocmn->close();
			//return $flg;
				}
			}
		}	
		
		
		if($flg==0)
		{ return false; }
		else
		{return true;}		
	}
	
	
	
		
	
	
	public function GetToSLOCList($scode, $slocwh, $slocbin, $slocsubbin) {
	
		$plantcode = $this->getPlantcode($scode);
		
		if($slocwh!="")
		{
			$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
			$stmtwh->bind_param("ss", $slocwh, $plantcode);
			$resultwh=$stmtwh->execute();
			$stmtwh->store_result();
			if ($stmtwh->num_rows > 0) {
				$stmtwh->bind_result($whperticularso,$whido);
				//looping through all the records 
				$stmtwh->fetch();
				$stmtwh->close();
			}
		}
		if($slocbin!="")
		{
			//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $bin ";
			$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ?  and plantcode=?");
			$stmtbin->bind_param("iss", $whido, $slocbin, $plantcode);
			$resultbin=$stmtbin->execute();
			$stmtbin->store_result();
			if ($stmtbin->num_rows > 0) {
				$stmtbin->bind_result($binnameo, $binido);
				//looping through all the records
				$stmtbin->fetch();
				$stmtbin->close();
			}	
		}
		if($slocsubbin!="")
		{
			$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sname = ? and plantcode=? order by sname ASC");
			$stmt_sbin->bind_param("iiss", $whido, $binido, $slocsubbin, $plantcode);
			$result2=$stmt_sbin->execute();
			$stmt_sbin->store_result();
			if ($stmt_sbin->num_rows > 0) {
				$stmt_sbin->bind_result($subbinnameo, $subbinido);
				//looping through all the records
				$stmt_sbin->fetch();
				$stmt_sbin->close();
			}
		}
				
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg  FROM tbl_slocnew WHERE slnew_tflg!=1 AND  slnew_fromflg>0 and slnew_logid=? AND plantcode='$plantcode' ORDER BY slnew_id DESC");
        $stmt->bind_param("s", $scode);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0;
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg);
			while($stmt->fetch())
			{
				if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
				if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
				{
					$lnew_date1=explode("-",$lnew_date);
					$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
				}
				
				$userSR["trid"] = $slnew_id;
				$userSR["trdate"] = $lnew_date;
				$userSR["fromflg"] = $slnew_fromflg;
				$userSR["toflg"] = $slnew_toflg;
				$userSR["trflg"] = $slnew_tflg;
				$userSR["scode"] = $slnew_logid;
				
				$slnf_id=0; $slnf_fdate=''; $slnf_fwh=''; $slnf_fbin=''; $slnf_fsbin=''; $slnf_fextnob=''; $slnf_fextnomp=''; $slnf_fextwb=''; $slnf_fextqty=''; $slnf_fnob=''; $slnf_fnomp=''; $slnf_fwb=''; $slnf_fqty=''; $slnf_fbalnob=''; $slnf_fbalnomp=''; $slnf_fbalwb=''; $slnf_fbalqty ='';
				 $slnf_crop=''; $slnf_variety=''; $slnf_stage=''; $slnf_lotno=''; $slnf_ups=''; $whperticulars=''; $binname=''; $subbinname='';
				 
				$stmt_2 = $this->conn_ps->prepare("SELECT  slnf_id, slnew_id, slnf_fdate, slnf_fwh, slnf_fbin, slnf_fsbin, slnf_fextnob, slnf_fextnomp, slnf_fextwb, slnf_fextqty, slnf_fnob, slnf_fnomp, slnf_fwb, slnf_fqty, slnf_fbalnob, slnf_fbalnomp, slnf_fbalwb, slnf_fbalqty, slnf_crop, slnf_variety, slnf_stage, slnf_lotno, slnf_ups  FROM tbl_slocnew_from WHERE slnew_id = ? ");
				$stmt_2->bind_param("i", $slnew_id);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {

					$stmt_2->bind_result($slnf_id, $slnew_id, $slnf_fdate, $slnf_fwh, $slnf_fbin, $slnf_fsbin, $slnf_fextnob, $slnf_fextnomp, $slnf_fextwb, $slnf_fextqty, $slnf_fnob, $slnf_fnomp, $slnf_fwb, $slnf_fqty, $slnf_fbalnob, $slnf_fbalnomp, $slnf_fbalwb, $slnf_fbalqty, $slnf_crop, $slnf_variety, $slnf_stage, $slnf_lotno, $slnf_ups);
					//looping through all the records
					while($stmt_2->fetch())
					{
						if($slnf_fdate==NULL){$slnf_fdate='';} if($slnf_fwh==NULL){$slnf_fwh='';} if($slnf_fbin==NULL){$slnf_fbin='';} if($slnf_fsbin==NULL){$slnf_fsbin='';} if($slnf_fextnob==NULL){$slnf_fextnob='';} if($slnf_fextnomp==NULL){$slnf_fextnomp='';} if($slnf_fextwb==NULL){$slnf_fextwb='';} if($slnf_fextqty==NULL){$slnf_fextqty='';} if($slnf_fnob==NULL){$slnf_fnob='';} if($slnf_fnob==NULL){$slnf_fnob='';} if($slnf_fnomp==NULL){$slnf_fnomp='';} if($slnf_fwb==NULL){$slnf_fwb='';} if($slnf_fqty==NULL){$slnf_fqty='';} if($slnf_fbalnob==NULL){$slnf_fbalnob='';} if($slnf_fbalnomp==NULL){$slnf_fbalnomp='';} if($slnf_fbalwb==NULL){$slnf_fbalwb='';} if($slnf_fbalqty==NULL){$slnf_fbalqty='';}  if($slnf_crop==NULL){$slnf_crop='';}  if($slnf_variety==NULL){$slnf_variety='';}  if($slnf_stage==NULL){$slnf_stage='';}  if($slnf_lotno==NULL){$slnf_lotno='';}  if($slnf_ups==NULL){$slnf_ups='';} 
						if($slnf_fdate!='' && $slnf_fdate!='0000-00-00' && $slnf_fdate!=NULL)
						{
							$slnf_fdate1=explode("-",$slnf_fdate);
							$slnf_fdate=$slnf_fdate1[2]."-".$slnf_fdate1[1]."-".$slnf_fdate1[0];
						}
						
						$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
						$stmt_crop->bind_param("i", $slnf_crop);
						$stmt_crop->execute();
						$stmt_crop->store_result();
						$stmt_crop->bind_result($cropid, $cropname);
						$stmt_crop->fetch();
						$stmt_crop->close();
						
						$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
						$stmt_variety->bind_param("i", $slnf_variety);
						$stmt_variety->execute();
						$stmt_variety->store_result();
						$stmt_variety->bind_result($varietyid, $popularname);
						$stmt_variety->fetch();
						$stmt_variety->close();
						
												
						$whperticulars=''; $binname=''; $subbinname='';
						$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
						$stmt_wh->bind_param("ss", $slnf_fwh, $plantcode);
						$result_wh=$stmt_wh->execute();
						$stmt_wh->store_result();
						if ($stmt_wh->num_rows > 0) {
							$stmt_wh->bind_result($whperticulars,$whid);
							//looping through all the records 
							$stmt_wh->fetch();
							$stmt_wh->close();
				
							$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
							$stmt_bin->bind_param("iss", $slnf_fwh, $slnf_fbin, $plantcode);
							$result_bin=$stmt_bin->execute();
							$stmt_bin->store_result();
							if ($stmt_bin->num_rows > 0) {
								$stmt_bin->bind_result($binname, $binid);
								//looping through all the records
								$stmt_bin->fetch();
								$stmt_bin->close();
								
								$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
								$stmt_sbin->bind_param("iiss", $slnf_fwh, $slnf_fbin, $slnf_fsbin, $plantcode);
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
						
						$slnttnob=0; $slnttqty=0; $xflg=0; $zflg=0; 
						$stmt_slocto = $this->conn_ps->prepare("SELECT  slnt_tqty, slnt_tnob, slnt_twh, slnt_tbin, slnt_tsbin  FROM tbl_slocnew_to WHERE slnew_id=? and slnf_id=? ");
						$stmt_slocto->bind_param("ii", $slnew_id, $slnf_id);
						$stmt_slocto->execute();
						$stmt_slocto->store_result();
						$stmt_slocto->bind_result($slnt_tqty, $slnt_tnob, $slnt_twh, $slnt_tbin, $slnt_tsbin);
						if ($stmt_slocto->num_rows>0) {
							while($stmt_slocto->fetch())
							{
								$slnttnob=$slnttnob+$slnt_tnob;
								$slnttqty=$slnttqty+$slnt_tqty;
								
								if($slnt_twh==$whido && $slnt_tbin==$binido &&  $slnt_tsbin==$subbinido){$zflg=1;}
							}
						}
						$stmt_slocto->close();
						if($slnttqty==$slnf_fqty) {$xflg=1;}
						if($zflg==1) {$xflg=1;}
						
						
						
						if($xflg==0)
						{
							$userSR["crop"] = $cropname;
							$userSR["variety"] = $popularname;
							$userSR["stage"] = $slnf_stage;
							$userSR["lotno"] = $slnf_lotno;
							$userSR["ups"] = $slnf_ups;
							$userSR["wh"] = $whperticulars;
							$userSR["bin"] = $binname;
							$userSR["subbin"] = $subbinname;
							$userSR["extnob"] = $slnf_fextnob;
							$userSR["extqty"] = $slnf_fextqty;
							$userSR["nob"] = $slnf_fnob;
							$userSR["qty"] = $slnf_fqty;
							$userSR["balnob"] = $slnf_fbalnob;
							$userSR["balqty"] = $slnf_fbalqty;
							$userSR["tonob"] = $slnttnob;
							$userSR["toqty"] = $slnttqty;
							
							array_push($user24,$userSR);
						}
						
					}
					$stmt_2->close();
				}
			
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
	
	
	
	
	
	// WH, Bin, SubBin code start
	
	
	public function GetWHList($scode, $mobile1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT whid, perticulars FROM tbl_warehouse where plantcode=? order by perticulars ASC ");
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
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT binid, binname FROM tbl_bin WHERE whid = ? order by binname ASC");
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
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT sid, sname FROM tbl_subbin WHERE whid=? and binid=? order by sname ASC ");
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
	
	
	
	// WH, Bin, SubBin code start
	
	
	
	public function GetWhBinList($scode, $mobile1, $qrcode) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array();
		$samno=explode("/",$qrcode);
		$whnm=$samno[0];
		$binnm=$samno[1];
		$temp=array();
		$stmt_wh = $this->conn_ps->prepare("SELECT whid, perticulars FROM tbl_warehouse where plantcode=? and perticulars=?");
		$stmt_wh->bind_param("ss", $plantcode, $whnm);
		$result_wh=$stmt_wh->execute();
		$stmt_wh->store_result();
		if ($stmt_wh->num_rows > 0) {
			$stmt_wh->bind_result($whid, $perticulars);
			//looping through all the records 
			$stmt_wh->fetch();
			$temp['whid']=$whid;
			array_push($userSR, $temp);
			$stmt_wh->close();
		}
		$temp=array();
		$stmt_bin = $this->conn_ps->prepare("SELECT binid, binname FROM tbl_bin WHERE whid = ? and binname=?");
		$stmt_bin->bind_param("is", $whid, $binnm);
		$result_pnps=$stmt_bin->execute();
		$stmt_bin->store_result();
		if ($stmt_bin->num_rows > 0) {
			$stmt_bin->bind_result($binid, $binname);
			//looping through all the records 
			$stmt_bin->fetch();
			$temp['binid']=$binid;
			array_push($userSR, $temp);
			$stmt_bin->close();
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
	
	
	
	//Search WH-Bin-SubBin output
	
	
	public function GetSearchSLOCLotList($scode, $whid, $binid, $subbinido) {
	
		$user24=array(); 
		$plantcode = $this->getPlantcode($scode);
		
		/*$stmtwh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where perticulars = ? and plantcode=?");
		$stmtwh->bind_param("ss", $whnm, $plantcode);
		$resultwh=$stmtwh->execute();
		$stmtwh->store_result();
		if ($stmtwh->num_rows > 0) {
			$stmtwh->bind_result($whperticulars,$whid);
			//looping through all the records 
			$stmtwh->fetch();
			$stmtwh->close();
		}
//return "SELECT binname, binid  FROM tbl_bin WHERE whid = $whid and binname = $binnm ";
		$stmtbin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binname = ? and plantcode=? ");
		$stmtbin->bind_param("iss", $whid, $binnm, $plantcode);
		$resultbin=$stmtbin->execute();
		$stmtbin->store_result();
		if ($stmtbin->num_rows > 0) {
			$stmtbin->bind_result($binname, $binid);
			//looping through all the records
			$stmtbin->fetch();
			$stmtbin->close();
		}	
		
		$stmtsbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
		$stmtsbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
		$result2=$stmtsbin->execute();
		$stmtsbin->store_result();
		if ($stmtsbin->num_rows > 0) {
			$stmtsbin->bind_result($subbinname, $subbinid);
			//looping through all the records
			$stmtsbin->fetch();
			$stmtsbin->close();
		}*/
		
		//return "SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=$whid and lotldg_binid=$binid and plantcode=$plantcode ";
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
									$stmt_ldgraw4->fetch();
									if($lotldg_balqty > 0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
										else
										{
											$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
											$stmt_variety->bind_param("i", $lotldg_variety);
											$stmt_variety->execute();
											$stmt_variety->store_result();
											$stmt_variety->bind_result($varietyid, $popularname);
											$stmt_variety->fetch();
											$stmt_variety->close();
										}
										
															
										$whperticulars=0; $binname=0; $subbinname=0;
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										$ups=''; $nomp=0; $wb=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}
										$userSR=array(); 
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $ups;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $nomp;
										$userSR["extqty"] = $lotldg_balqty;
										
										array_push($user24,$userSR);
									}
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
		
		
		
		
		
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
										
															
										$whperticulars=0; $binname=0; $subbinname=0;
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										
										$userSR=array();  $lotldg_sstage='Pack'; $wb=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($balnomp<=0){$balnomp=0;}if($balqty<=0){$balqty=0;}
										
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $packtype;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $balnomp;
										$userSR["extqty"] = $balqty;
										array_push($user24,$userSR);
									}
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
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	//Search Lot output
	
	
	public function GetSearchLotList($scode, $orlot) {
	
		$user24=array(); 
		$plantcode = $this->getPlantcode($scode);
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_lotno LIKE '%$orlot%'  and plantcode=? ");
		$stmt_ldgraw->bind_param("s", $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_lotno LIKE '%$orlot%' and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("is", $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = ? and lotldg_lotno=? and plantcode=?");
						$stmt_ldgraw3->bind_param("iss", $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty, lotldg_whid,  lotldg_binid, lotldg_subbinid FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty, $lotldg_whid,  $lotldg_binid, $lotldg_subbinid);
									$stmt_ldgraw4->fetch();
									if($lotldg_balqty > 0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
										else
										{
											$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
											$stmt_variety->bind_param("i", $lotldg_variety);
											$stmt_variety->execute();
											$stmt_variety->store_result();
											$stmt_variety->bind_result($varietyid, $popularname);
											$stmt_variety->fetch();
											$stmt_variety->close();
										}
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $lotldg_whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $lotldg_whid, $lotldg_binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $lotldg_whid, $lotldg_binid, $lotldg_subbinid, $plantcode);
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
										$ups=''; $nomp=0; $wb=0; $wtinmp=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}
										$userSR=array(); 
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $ups;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $nomp;
										$userSR["extqty"] = $lotldg_balqty;
										$userSR["wtmp"] = $wtinmp;
										
										array_push($user24,$userSR);
									}
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
		
		
		
		
		
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE lotno LIKE '%$orlot%' and plantcode=? ");
		$stmt_ldgraw->bind_param("s", $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE lotno LIKE '%$orlot%' and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("is", $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iss", $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype, whid, binid, subbinid, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype, $whid, $binid, $subbinid, $wtinmp);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										
										$userSR=array();  $lotldg_sstage='Pack'; $wb=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($balnomp<=0){$balnomp=0;}if($balqty<=0){$balqty=0;}										
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $packtype;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $balnomp;
										$userSR["extqty"] = $balqty;
										$userSR["wtmp"] = $wtinmp;
										array_push($user24,$userSR);
									}
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
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
		
	
	public function GetPlaceTrList($scode) {
	
		$plantcode = $this->getPlantcode($scode);
        $stmt = $this->conn_ps->prepare("SELECT  slnew_id, slnew_date, slnew_logid, slnew_fromflg, slnew_toflg, slnew_tflg, slnew_tcode  FROM tbl_slocnew WHERE plantcode='$plantcode' and slnew_fromflg=1 and slnew_toflg!=1 ORDER BY slnew_id ASC");
       // $stmt->bind_param("s", $scode);
        $stmt->execute();
        $stmt->store_result();
		$userSR = array(); $user24=array();
		$slnew_id=0; $lnew_date=''; $slnew_logid=''; $slnew_fromflg=0; $slnew_toflg=0; $slnew_tflg=0; $slnew_tcode='';
        if ($stmt->num_rows > 0) {
            // user existed 
			$stmt->bind_result($slnew_id, $lnew_date, $slnew_logid, $slnew_fromflg, $slnew_toflg, $slnew_tflg, $slnew_tcode);
			while($stmt->fetch())
			{
				if($lnew_date==NULL){$lnew_date='';} if($slnew_id==NULL){$slnew_id=0;} if($slnew_logid==NULL){$setuplogid='';} if($slnew_fromflg==NULL){$slnew_fromflg=0;} if($slnew_toflg==NULL){$slnew_toflg=0;} if($slnew_tflg==NULL){$slnew_tflg=0;} 
				if($lnew_date!='' && $lnew_date!='0000-00-00' && $lnew_date!=NULL)
				{
					$lnew_date1=explode("-",$lnew_date);
					$lnew_date=$lnew_date1[2]."-".$lnew_date1[1]."-".$lnew_date1[0];
				}
				
				$stmt_2 = $this->conn_ps->prepare("SELECT  slnf_id, slnew_id FROM tbl_slocnew_from WHERE slnew_id = ? and slnt_flg!=1");
				$stmt_2->bind_param("i", $slnew_id);
				$result2=$stmt_2->execute();
				$stmt_2->store_result();
				if ($stmt_2->num_rows > 0) {
						$userSR["trid"] = $slnew_id;
						$userSR["trcode"] = "SLOC/".$plantcode."/".$slnew_tcode;
						$userSR["trdate"] = $lnew_date;
						$userSR["scode"] = $slnew_logid;
						
						array_push($user24,$userSR);
											
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
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	public function GetWHTypeList($slocwh) {
       $whtype='';
	    $stmt = $this->conn_ps->prepare("SELECT whtype,whid FROM tbl_warehouse where whid = ? ");
        $stmt->bind_param("s", $slocwh);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
	    $stmt->bind_result($whtype, $whid);
	    $stmt->fetch();	
            $stmt->close();
            return $whtype;
        } else {
            // user not existed
            $stmt->close();
            return $whtype;
        }
    }
	
	
	
	public function GetLotList($scode, $orlot) {
	
		$user24=array(); 
		$plantcode = $this->getPlantcode($scode);
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_lotno=?  and plantcode=? ");
		$stmt_ldgraw->bind_param("ss", $orlot, $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_lotno=? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("sis", $orlot, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iss", $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty, lotldg_whid,  lotldg_binid, lotldg_subbinid FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty, $lotldg_whid,  $lotldg_binid, $lotldg_subbinid);
									$stmt_ldgraw4->fetch();
									if($lotldg_balqty > 0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
										else
										{
											$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
											$stmt_variety->bind_param("i", $lotldg_variety);
											$stmt_variety->execute();
											$stmt_variety->store_result();
											$stmt_variety->bind_result($varietyid, $popularname);
											$stmt_variety->fetch();
											$stmt_variety->close();
										}
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $lotldg_whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $lotldg_whid, $lotldg_binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $lotldg_whid, $lotldg_binid, $lotldg_subbinid, $plantcode);
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
										
										
										$x=0;
										$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id FROM tbl_slocnew_from WHERE slnf_crop=? and slnf_variety=? and slnf_lotno=?  and slnt_flg!=1 and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=? order by slnf_id ASC");
										$stmt_slnf->bind_param("isssss", $lotldg_crop, $lotldg_variety, $lotldg_lotno, $lotldg_whid, $lotldg_binid, $lotldg_subbinid);
										$result_slnf=$stmt_slnf->execute();
										$stmt_slnf->store_result();
										if ($stmt_slnf->num_rows > 0) {
											$stmt_slnf->bind_result($slnf_id, $slnew_id);
											while($stmt_slnf->fetch())
											{
												$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
												$stmt_slnt->bind_param("i", $slnew_id);
												$stmt_slnt->execute();
												$stmt_slnt->store_result();
												$stmt_slnt->bind_result($slnt_tqty);
												if ($stmt_slnt->num_rows>0) {
														$x=$x+1;
												}
												$stmt_slnt->close();
											}
										}
										if($x==0)	
										{
											$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0;
											if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}
											
											$userSR["crop"] = $cropname;
											$userSR["variety"] = $popularname;
											$userSR["stage"] = $lotldg_sstage;
											$userSR["lotno"] = $lotldg_lotno;
											$userSR["ups"] = $ups;
											$userSR["wh"] = $whperticulars;
											$userSR["bin"] = $binname;
											$userSR["subbin"] = $subbinname;
											$userSR["extnob"] = $lotldg_balbags;
											$userSR["extwb"] = $wb;
											$userSR["extnmp"] = $nomp;
											$userSR["extqty"] = $lotldg_balqty;
											$userSR["wtmp"] = $wtinmp;
											array_push($user24,$userSR);
										}
									}
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
		
		
		
		
		
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE lotno=? and plantcode=? ");
		$stmt_ldgraw->bind_param("ss", $orlot, $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE lotno=? and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("sis", $orlot, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iss", $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype, whid, binid, subbinid, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype, $whid, $binid, $subbinid, $wtinmp);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										
										$x=0;	
										$stmt_slnf = $this->conn_ps->prepare("SELECT slnf_id, slnew_id FROM tbl_slocnew_from WHERE slnf_crop=? and slnf_variety=? and slnf_lotno=?  and slnt_flg!=1 and slnf_fwh=? and slnf_fbin=? and slnf_fsbin=? order by slnf_id ASC");
										$stmt_slnf->bind_param("isssss", $lotldg_crop, $lotldg_variety, $lotldg_lotno, $whid, $binid, $subbinid);
										$result_slnf=$stmt_slnf->execute();
										$stmt_slnf->store_result();
										if ($stmt_slnf->num_rows > 0) {
											$stmt_slnf->bind_result($slnf_id, $slnew_id);
											while($stmt_slnf->fetch())
											{
												$stmt_slnt = $this->conn_ps->prepare("SELECT  slnew_id  FROM tbl_slocnew WHERE slnew_id=? and slnew_tflg!=1 ");
												$stmt_slnt->bind_param("i", $slnew_id);
												$stmt_slnt->execute();
												$stmt_slnt->store_result();
												$stmt_slnt->bind_result($slnt_tqty);
												if ($stmt_slnt->num_rows>0) {
														$x=$x+1;
												}
												$stmt_slnt->close();
											}
										}
										if($x==0)	
										{
											$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0; $lotldg_sstage='Pack'; 
											if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;} if($nomp<=0){$nomp=0;} if($balqty<=0){$balqty=0;}
											
											$userSR["crop"] = $cropname;
											$userSR["variety"] = $popularname;
											$userSR["stage"] = $lotldg_sstage;
											$userSR["lotno"] = $lotldg_lotno;
											$userSR["ups"] = $ups;
											$userSR["wh"] = $whperticulars;
											$userSR["bin"] = $binname;
											$userSR["subbin"] = $subbinname;
											$userSR["extnob"] = $lotldg_balbags;
											$userSR["extwb"] = $wb;
											$userSR["extnmp"] = $nomp;
											$userSR["extqty"] = $balqty;
											$userSR["wtmp"] = $wtinmp;
											array_push($user24,$userSR);
										}
									}
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
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	
		
	
	public function GetCropList($scode, $mobile1) {
		$plantcode = $this->getPlantcode($scode);
		$flg=0; $userSR=array(); $zero=0; $one=1; $two=2;
				
		$stmt_pnps = $this->conn_ps->prepare("SELECT cropid, croptype, cropname FROM tblcrop");
		//$stmt_pnps->bind_param("i", $cropid);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($cropid, $croptype, $cropname);
			//looping through all the records 
			while($stmt_pnps->fetch())
			{
				array_push($userSR, $cropname);
			}
			$stmt_pnps->close();
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
		
		
		$stmt_pnps = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE cropname = ? ");
		$stmt_pnps->bind_param("i", $cropid);
		$result_pnps=$stmt_pnps->execute();
		$stmt_pnps->store_result();
		if ($stmt_pnps->num_rows > 0) {
			$stmt_pnps->bind_result($varietyid, $popularname);
			//looping through all the records 
			while($stmt_pnps->fetch())
			{
			array_push($userSR, $popularname);
			}
			$stmt_pnps->close();
		}
		$vname=$cropname."-Coded";
		array_push($userSR, $vname);	
		
		if(empty($userSR))
		{return false;}
		else
		{
		array_unique($userSR);
		return $userSR;
		}			
	}
	
	
	
	
	public function GetCVwiseLotList($scode, $cropname, $varietyname) {
	
		$user24=array(); 
		$plantcode = $this->getPlantcode($scode);
		
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
		
		
		$vname=$cropname."-Coded";
		if($varietyname==$vname)
		{
			$varietyid=$cropname."-Coded";
		}
		else
		{
			$stmt_pnps = $this->conn_ps->prepare("SELECT varietyid, popularname FROM tblvariety WHERE popularname = ? ");
			$stmt_pnps->bind_param("s", $varietyname);
			$result_pnps=$stmt_pnps->execute();
			$stmt_pnps->store_result();
			if ($stmt_pnps->num_rows > 0) {
				$stmt_pnps->bind_result($varietyid, $popularname);
				//looping through all the records 
				$stmt_pnps->fetch();
				//array_push($userSR, $popularname);
				$stmt_pnps->close();
			}
		}
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_crop=? and lotldg_variety=?  and plantcode=? ");
		$stmt_ldgraw->bind_param("sss", $cropid, $varietyid, $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_crop=? and lotldg_variety=? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("ssis", $cropid, $varietyid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_crop=? and lotldg_variety=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("ssiss", $cropid, $varietyid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty, lotldg_whid,  lotldg_binid, lotldg_subbinid FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty, $lotldg_whid,  $lotldg_binid, $lotldg_subbinid);
									$stmt_ldgraw4->fetch();
									if($lotldg_balqty > 0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$vname=$cropname."-Coded";
										if($lotldg_variety==$vname)
										{
											$popularname=$cropname."-Coded";
										}
										else
										{
											$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
											$stmt_variety->bind_param("i", $lotldg_variety);
											$stmt_variety->execute();
											$stmt_variety->store_result();
											$stmt_variety->bind_result($varietyid, $popularname);
											$stmt_variety->fetch();
											$stmt_variety->close();
										}
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $lotldg_whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $lotldg_whid, $lotldg_binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $lotldg_whid, $lotldg_binid, $lotldg_subbinid, $plantcode);
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
										
										$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}
										
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $ups;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $nomp;
										$userSR["extqty"] = $lotldg_balqty;
										$userSR["wtmp"] = $wtinmp;
										array_push($user24,$userSR);
										
									}
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
		
		
		
		
		
		
		$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE lotldg_crop=? and lotldg_variety=? and plantcode=? ");
		$stmt_ldgraw->bind_param("sss", $cropid, $varietyid, $plantcode);
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE lotldg_crop=? and lotldg_variety=?  and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("ssis", $cropid, $varietyid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotldg_crop=? and lotldg_variety=? and subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("ssiss", $cropid, $varietyid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype, whid, binid, subbinid, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype, $whid, $binid, $subbinid, $wtinmp);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
										
															
										$whperticulars=''; $binname=''; $subbinname='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars,$whid);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										
										
										$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0; $lotldg_sstage='Pack'; 
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($balqty<=0){$balqty=0;}

										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $ups;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $nomp;
										$userSR["extqty"] = $balqty;
										$userSR["wtmp"] = $wtinmp;
										array_push($user24,$userSR);
										
									}
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
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	
	
	public function GetTranToSLOCLotList($scode, $whid, $binid, $subbinido) {
	
		$user24=array(); 
		$plantcode = $this->getPlantcode($scode);
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
									$stmt_ldgraw4->fetch();
									
									$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
									$stmt_crop->bind_param("i", $lotldg_crop);
									$stmt_crop->execute();
									$stmt_crop->store_result();
									$stmt_crop->bind_result($cropid, $cropname);
									$stmt_crop->fetch();
									$stmt_crop->close();
									
									$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
									else
									{
										$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
										$stmt_variety->bind_param("i", $lotldg_variety);
										$stmt_variety->execute();
										$stmt_variety->store_result();
										$stmt_variety->bind_result($varietyid, $popularname);
										$stmt_variety->fetch();
										$stmt_variety->close();
									}
														
									$whperticulars=''; $binname=''; $subbinname=''; $whtype='';
									$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid, whtype FROM tbl_warehouse where whid = ? and plantcode=? ");
									$stmt_wh->bind_param("ss", $whid, $plantcode);
									$result_wh=$stmt_wh->execute();
									$stmt_wh->store_result();
									if ($stmt_wh->num_rows > 0) {
										$stmt_wh->bind_result($whperticulars, $whid, $whtype);
										//looping through all the records 
										$stmt_wh->fetch();
										$stmt_wh->close();
							
										$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
										$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
										$result_bin=$stmt_bin->execute();
										$stmt_bin->store_result();
										if ($stmt_bin->num_rows > 0) {
											$stmt_bin->bind_result($binname, $binid);
											//looping through all the records
											$stmt_bin->fetch();
											$stmt_bin->close();
											
											$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
											$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
									
									$userSR=array();  $ups=''; $nomp=0; $wb=0; $wtinmp=0;
									if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($nomp<=0){$nomp=0;}if($lotldg_balqty<=0){$lotldg_balqty=0;}

									$userSR["crop"] = $cropname;
									$userSR["variety"] = $popularname;
									$userSR["stage"] = $lotldg_sstage;
									$userSR["lotno"] = $lotldg_lotno;
									$userSR["ups"] = $ups;
									$userSR["wh"] = $whperticulars;
									$userSR["bin"] = $binname;
									$userSR["subbin"] = $subbinname;
									$userSR["extnob"] = $lotldg_balbags;
									$userSR["extwb"] = $wb;
									$userSR["extnmp"] = $nomp;
									$userSR["extqty"] = $lotldg_balqty;
									$userSR["wtmp"] = $wtinmp;
									$userSR["whtype"] = $whtype;
									array_push($user24,$userSR);
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
		
		
		
		
		
		if($subbinido!="ALL" && $subbinido!="All" && $subbinido!="all" && $subbinido!="" && $subbinido!=" ")
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iiis", $whid, $binid, $subbinido, $plantcode);
		}
		else
		{
			$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and plantcode=? ");
			$stmt_ldgraw->bind_param("iis", $whid, $binid, $plantcode);
		}
		$result2=$stmt_ldgraw->execute();
		$stmt_ldgraw->store_result(); 
		if ($stmt_ldgraw->num_rows > 0) {
			$stmt_ldgraw->bind_result($subbinid);
			//looping through all the records
			while($stmt_ldgraw->fetch())
			{
				$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=? ");
				$stmt_ldgraw2->bind_param("iiis", $whid, $binid, $subbinid, $plantcode);
				$result2=$stmt_ldgraw2->execute();
				$stmt_ldgraw2->store_result();
				if ($stmt_ldgraw2->num_rows > 0) {
					$stmt_ldgraw2->bind_result($lotno);
					//looping through all the records
					while($stmt_ldgraw2->fetch())
					{
						$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=?");
						$stmt_ldgraw3->bind_param("iiiss", $whid, $binid, $subbinid, $lotno, $plantcode);
						$result2=$stmt_ldgraw3->execute();
						$stmt_ldgraw3->store_result();
						if ($stmt_ldgraw3->num_rows > 0) {
							$stmt_ldgraw3->bind_result($lotldgid);
							//looping through all the records
							while($stmt_ldgraw3->fetch())
							{ 

								$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype, wtinmp FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
								$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
								$result2=$stmt_ldgraw4->execute();
								$stmt_ldgraw4->store_result();
								if ($stmt_ldgraw4->num_rows > 0) {
									$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype, $wtinmp);
									$stmt_ldgraw4->fetch();
									if($balqty>0)
									{
										$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
										$stmt_crop->bind_param("i", $lotldg_crop);
										$stmt_crop->execute();
										$stmt_crop->store_result();
										$stmt_crop->bind_result($cropid, $cropname);
										$stmt_crop->fetch();
										$stmt_crop->close();
										
										$pname=$cropname."-Coded";

									if($lotldg_variety==$pname)
									{
										$popularname=$lotldg_variety;
									}
										else
										{
											$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
											$stmt_variety->bind_param("i", $lotldg_variety);
											$stmt_variety->execute();
											$stmt_variety->store_result();
											$stmt_variety->bind_result($varietyid, $popularname);
											$stmt_variety->fetch();
											$stmt_variety->close();
										}
															
										$whperticulars=''; $binname=''; $subbinname='';  $whtype='';
										$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid, whtype FROM tbl_warehouse where whid = ? and plantcode=? ");
										$stmt_wh->bind_param("ss", $whid, $plantcode);
										$result_wh=$stmt_wh->execute();
										$stmt_wh->store_result();
										if ($stmt_wh->num_rows > 0) {
											$stmt_wh->bind_result($whperticulars, $whid, $whtype);
											//looping through all the records 
											$stmt_wh->fetch();
											$stmt_wh->close();
								
											$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
											$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
											$result_bin=$stmt_bin->execute();
											$stmt_bin->store_result();
											if ($stmt_bin->num_rows > 0) {
												$stmt_bin->bind_result($binname, $binid);
												//looping through all the records
												$stmt_bin->fetch();
												$stmt_bin->close();
												
												$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
												$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
										$userSR=array();  $lotldg_sstage='Pack'; $wb=0; $lotldg_balbags=0;
										if($lotldg_balbags<=0){$lotldg_balbags=0;} if($wb<=0){$wb=0;}if($balnomp<=0){$balnomp=0;}if($balqty<=0){$balqty=0;}	
										
										$userSR["crop"] = $cropname;
										$userSR["variety"] = $popularname;
										$userSR["stage"] = $lotldg_sstage;
										$userSR["lotno"] = $lotldg_lotno;
										$userSR["ups"] = $packtype;
										$userSR["wh"] = $whperticulars;
										$userSR["bin"] = $binname;
										$userSR["subbin"] = $subbinname;
										$userSR["extnob"] = $lotldg_balbags;
										$userSR["extwb"] = $wb;
										$userSR["extnmp"] = $balnomp;
										$userSR["extqty"] = $balqty;
										$userSR["wtmp"] = $wtinmp;
										$userSR["whtype"] = $whtype;
										array_push($user24,$userSR);
										
									}
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
		
		
		
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	
	
	
	public function GetCVWiseSearchList($scode, $whid, $cropname, $varietyname) {
	
		$user24=array();  $newarr=array();
		$plantcode = $this->getPlantcode($scode);
		
		$stmt_crop = $this->conn_ps->prepare("select cropid from tblcrop where cropname=?");
		$stmt_crop->bind_param("s", $cropname);
		$stmt_crop->execute();
		$stmt_crop->store_result();
		$stmt_crop->bind_result($cropid);
		$stmt_crop->fetch();
		$stmt_crop->close();
		
		$stmt_variety = $this->conn_ps->prepare("select varietyid from tblvariety where popularname=?");
		$stmt_variety->bind_param("s", $varietyname);
		$stmt_variety->execute();
		$stmt_variety->store_result();
		if ($stmt_variety->num_rows > 0) {
			$stmt_variety->bind_result($varietyid);
			$stmt_variety->fetch();
		}
		else
		{
			$varietyid=$cropname."-Coded";
		}
		$stmt_variety->close();
		
//return "SELECT distinct(lotldg_binid) FROM tbl_lot_ldg WHERE lotldg_whid=$whid and plantcode='$plantcode'  and lotldg_crop=$cropid and lotldg_variety=$varietyid";		
		$stmt_ldgbin = $this->conn_ps->prepare("SELECT distinct(lotldg_binid) FROM tbl_lot_ldg WHERE lotldg_whid=? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
		$stmt_ldgbin->bind_param("isss", $whid, $plantcode, $cropid, $varietyid);
		$result_bin=$stmt_ldgbin->execute();
		$stmt_ldgbin->store_result(); 
//return $stmt_ldgbin->num_rows;
		if ($stmt_ldgbin->num_rows > 0) {
			$stmt_ldgbin->bind_result($binid);
			//looping through all the records
			while($stmt_ldgbin->fetch())
			{
				$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(lotldg_subbinid) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
				$stmt_ldgraw->bind_param("iisss", $whid, $binid, $plantcode, $cropid, $varietyid);
				$result2=$stmt_ldgraw->execute();
				$stmt_ldgraw->store_result(); 
				if ($stmt_ldgraw->num_rows > 0) {
					$stmt_ldgraw->bind_result($subbinid);
					//looping through all the records
					while($stmt_ldgraw->fetch())
					{
//if($subbinid==3166){return "SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=$whid and lotldg_binid=$binid and lotldg_subbinid = $subbinid and plantcode='$plantcode'  and lotldg_crop=$cropid and lotldg_variety=$varietyid";}
						$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotldg_lotno) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
						$stmt_ldgraw2->bind_param("iiisss", $whid, $binid, $subbinid, $plantcode, $cropid, $varietyid);
						$result2=$stmt_ldgraw2->execute();
						$stmt_ldgraw2->store_result();
						if ($stmt_ldgraw2->num_rows > 0) {
							$stmt_ldgraw2->bind_result($lotno);
							//looping through all the records
							while($stmt_ldgraw2->fetch())
							{
								$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_whid=? and lotldg_binid=? and lotldg_subbinid = ? and lotldg_lotno = ? and plantcode=? and lotldg_crop=? and lotldg_variety=?");
								$stmt_ldgraw3->bind_param("iiissss", $whid, $binid, $subbinid, $lotno, $plantcode, $cropid, $varietyid);
								$result2=$stmt_ldgraw3->execute();
								$stmt_ldgraw3->store_result();
								if ($stmt_ldgraw3->num_rows > 0) {
									$stmt_ldgraw3->bind_result($lotldgid);
									//looping through all the records
									while($stmt_ldgraw3->fetch())
									{ 
		
										$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_lotno, lotldg_balbags, lotldg_balqty FROM tbl_lot_ldg WHERE lotldg_id = ? and lotldg_balqty > 0 and plantcode=? ");
										$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
										$result2=$stmt_ldgraw4->execute();
										$stmt_ldgraw4->store_result();

//if($lotno=="DV00332/00028/00C" && $subbinid==3166){ return "Total Records ".$lotldgid." - ".$stmt_ldgraw4->num_rows;}

										if ($stmt_ldgraw4->num_rows > 0) {
											$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $lotldg_balqty);
											$stmt_ldgraw4->fetch();
											if($lotldg_balqty > 0)
											{
												$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
												$stmt_crop->bind_param("i", $lotldg_crop);
												$stmt_crop->execute();
												$stmt_crop->store_result();
												$stmt_crop->bind_result($cropid, $cropname);
												$stmt_crop->fetch();
												$stmt_crop->close();
												
												if(!is_string($lotldg_variety))
												{
													$popularname=$cropname."-Coded";
												}
												else
												{
													$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
													$stmt_variety->bind_param("i", $lotldg_variety);
													$stmt_variety->execute();
													$stmt_variety->store_result();
													$stmt_variety->bind_result($varietyid, $popularname);
													$stmt_variety->fetch();
													$stmt_variety->close();
												}
																	
												$whperticulars=''; $binname=''; $subbinname='';
												$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
												$stmt_wh->bind_param("ss", $whid, $plantcode);
												$result_wh=$stmt_wh->execute();
												$stmt_wh->store_result();
												if ($stmt_wh->num_rows > 0) {
													$stmt_wh->bind_result($whperticulars,$whid);
													//looping through all the records 
													$stmt_wh->fetch();
													$stmt_wh->close();
										
													$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
													$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
													$result_bin=$stmt_bin->execute();
													$stmt_bin->store_result();
													if ($stmt_bin->num_rows > 0) {
														$stmt_bin->bind_result($binname, $binid);
														//looping through all the records
														$stmt_bin->fetch();
														$stmt_bin->close();
														
														$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
														$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
												$ups=''; $nomp=0; $wb=0;
												$userSR=array(); 
												if(!in_array($subbinid,$newarr))
												{
													$userSR["bin"] = $binname;
													$userSR["subbin"] = $subbinname;
													array_push($user24,$userSR);
													array_push($newarr,$subbinid);
												}
											}
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
			}
		}
		$stmt_ldgbin->close();
		
		//return "SELECT distinct(binid) FROM tbl_lot_ldg_pack WHERE whid=$whid and plantcode='$plantcode'  and lotldg_crop=$cropid and lotldg_variety=$varietyid";
		
		$stmt_ldgbin = $this->conn_ps->prepare("SELECT distinct(binid) FROM tbl_lot_ldg_pack WHERE whid=? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
		$stmt_ldgbin->bind_param("isss", $whid, $plantcode, $cropid, $varietyid);
		$result_bin=$stmt_ldgbin->execute();
		$stmt_ldgbin->store_result(); 
		if ($stmt_ldgbin->num_rows > 0) {
			$stmt_ldgbin->bind_result($binid);
			//looping through all the records
			while($stmt_ldgbin->fetch())
			{
	//return "SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=$whid and binid=$binid and plantcode='$plantcode'  and lotldg_crop=$cropid and lotldg_variety=$varietyid";		
				$stmt_ldgraw = $this->conn_ps->prepare("SELECT distinct(subbinid) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
				$stmt_ldgraw->bind_param("iisss", $whid, $binid, $plantcode, $cropid, $varietyid);
				
				$result2=$stmt_ldgraw->execute();
				$stmt_ldgraw->store_result(); 
				if ($stmt_ldgraw->num_rows > 0) {
					$stmt_ldgraw->bind_result($subbinid);
					//looping through all the records
					while($stmt_ldgraw->fetch())
					{
						$stmt_ldgraw2 = $this->conn_ps->prepare("SELECT distinct(lotno) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and plantcode=?  and lotldg_crop=? and lotldg_variety=?");
						$stmt_ldgraw2->bind_param("iiisss", $whid, $binid, $subbinid, $plantcode, $cropid, $varietyid);
						$result2=$stmt_ldgraw2->execute();
						$stmt_ldgraw2->store_result();
						if ($stmt_ldgraw2->num_rows > 0) {
							$stmt_ldgraw2->bind_result($lotno);
							//looping through all the records
							while($stmt_ldgraw2->fetch())
							{
								$stmt_ldgraw3 = $this->conn_ps->prepare("SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE whid=? and binid=? and subbinid = ? and lotno = ? and plantcode=? and lotldg_crop=? and lotldg_variety=?");
								$stmt_ldgraw3->bind_param("iiissss", $whid, $binid, $subbinid, $lotno, $plantcode, $cropid, $varietyid);
								$result2=$stmt_ldgraw3->execute();
								$stmt_ldgraw3->store_result();
								if ($stmt_ldgraw3->num_rows > 0) {
									$stmt_ldgraw3->bind_result($lotldgid);
									//looping through all the records
									while($stmt_ldgraw3->fetch())
									{ 
		
										$stmt_ldgraw4 = $this->conn_ps->prepare("SELECT lotldg_crop, lotldg_variety, lotldg_sstage, lotno, balnop, balnomp, balqty, packtype FROM tbl_lot_ldg_pack WHERE lotdgp_id = ? and balqty>0 and plantcode=? ");
										$stmt_ldgraw4->bind_param("is", $lotldgid, $plantcode);
										$result2=$stmt_ldgraw4->execute();
										$stmt_ldgraw4->store_result();
										if ($stmt_ldgraw4->num_rows > 0) {
											$stmt_ldgraw4->bind_result($lotldg_crop, $lotldg_variety, $lotldg_sstage, $lotldg_lotno, $lotldg_balbags, $balnomp, $balqty, $packtype);
											$stmt_ldgraw4->fetch();
											if($balqty>0)
											{
												$stmt_crop = $this->conn_ps->prepare("select cropid, cropname from tblcrop where cropid=?");
												$stmt_crop->bind_param("i", $lotldg_crop);
												$stmt_crop->execute();
												$stmt_crop->store_result();
												$stmt_crop->bind_result($cropid, $cropname);
												$stmt_crop->fetch();
												$stmt_crop->close();
												
												if(!is_string($lotldg_variety))
												{
													$popularname=$cropname."-Coded";
												}
												else
												{
													$stmt_variety = $this->conn_ps->prepare("select varietyid, popularname from tblvariety where varietyid=?");
													$stmt_variety->bind_param("i", $lotldg_variety);
													$stmt_variety->execute();
													$stmt_variety->store_result();
													$stmt_variety->bind_result($varietyid, $popularname);
													$stmt_variety->fetch();
													$stmt_variety->close();
												}
																	
												$whperticulars=''; $binname=''; $subbinname='';
												$stmt_wh = $this->conn_ps->prepare("SELECT perticulars,whid FROM tbl_warehouse where whid = ? and plantcode=? ");
												$stmt_wh->bind_param("ss", $whid, $plantcode);
												$result_wh=$stmt_wh->execute();
												$stmt_wh->store_result();
												if ($stmt_wh->num_rows > 0) {
													$stmt_wh->bind_result($whperticulars,$whid);
													//looping through all the records 
													$stmt_wh->fetch();
													$stmt_wh->close();
										
													$stmt_bin = $this->conn_ps->prepare("SELECT binname, binid  FROM tbl_bin WHERE whid = ? and binid = ? and plantcode=? ");
													$stmt_bin->bind_param("iss", $whid, $binid, $plantcode);
													$result_bin=$stmt_bin->execute();
													$stmt_bin->store_result();
													if ($stmt_bin->num_rows > 0) {
														$stmt_bin->bind_result($binname, $binid);
														//looping through all the records
														$stmt_bin->fetch();
														$stmt_bin->close();
														
														$stmt_sbin = $this->conn_ps->prepare("SELECT sname, sid  FROM tbl_subbin WHERE whid = ? and binid = ? and sid = ? and plantcode=? order by sname ASC");
														$stmt_sbin->bind_param("iiss", $whid, $binid, $subbinid, $plantcode);
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
												
												$userSR=array();  $lotldg_sstage='Pack'; $wb=0;
																						
												if(!in_array($subbinid,$newarr))
												{
													$userSR["bin"] = $binname;
													$userSR["subbin"] = $subbinname;
													array_push($user24,$userSR);
													array_push($newarr,$subbinid);
												}
												//array_push($user24,$userSR);
											}
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
			}
		}
		$stmt_ldgbin->close();
		
		if(empty($user24))
		{return false;}
		else
		{return $user24;}
    }
	
	
	
	


	
	
	
	
	
	
	
	
	
	
	
}// Main Class close
?>

