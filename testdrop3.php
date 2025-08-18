<style type="text/css">
#cvaccordion {
    margin: 50px 0 0;
    font-family: "Poppins", sans-serif;
}
.cvaccordion-tab {
    position: relative;
    width: 100%;
    max-width: 1000px;
    margin: 0 auto 10px; /* 10px adds to bottom */
    border-radius: 4px;
    background-color: #00843e;
    box-shadow: 0 0 0 1px #ececec;
}
.cvaccordion-tab:hover {
    box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.11);
}
.cvaccordion-input {
    display: none;
}
.cvaccordion-input:checked ~ .cvaccordion-content + .cvaccordion-tab-content {
    max-height: 3000px;
}
.cvaccordion-input:checked ~ .cvaccordion-content:after {
    transform: rotate(0);
}
.cvaccordion-label {
    position: absolute;
    width: 100%;
    height: 100%;
    max-height: 80px;
    z-index: 1;
    cursor: pointer;
}
.cvaccordion-content {
    position: relative;
    height: 40px;
    padding: 0 87px 0 30px;
    white-space: nowrap;
}
.cvaccordion-content:before, .cvaccordion-content:after {
    content: '';
    display: inline-block;
    vertical-align: middle;
}
.cvaccordion-content:before {
    height: 100%;
}
.cvaccordion-label:hover ~ .cvaccordion-content:after {
  background-image: url("cvaccordion-arrow-hover.svg");
}
.cvaccordion-content:after {
    width: 24px;
    height: 100%;
    background-image: url("cvaccordion-arrow.svg");
    background-repeat: no-repeat;
    background-position: center;
    transform: rotate(180deg);
}
.cvaccordion-content + .cvaccordion-tab-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height .3s;
}
.cvaccordion-content > div, .total-games > div {
    display: inline-block;
    vertical-align: middle;
}
.cvaccordion-info {
    width: 95%;
}
.cvaccordion-tab-content {
    background-color: #f9f9f9;
    color: #363636;
    font-size: 13px;
    font-weight: 400;
    border-radius: 0 0 4px 4px;
}
.wrapper {
  padding: 1px;
}
.platform-image {
    display: inline-block;
    height: 44px;
    width: 44px;
    border-radius: 50%;
    background-color: #e4e4e4;
    vertical-align: middle;
}
.platform-name {
    font-size: 14px;
    color: #242a32;
    width: 75%;
    margin-left: 16px;
    font-weight: 500;
    color: #242a32;
    vertical-align: middle;
}
.total-games {
    font-size: 14px;
    color: #5d5d5d;
}
.game-image {
    display: inline-block;
    height: 44px;
    width: 44px;
    border-radius: 50%;
    background-color: #e4e4e4;
    vertical-align: middle;
}
.game-name {
    font-size: 14px;
    color: #242a32;
    width: 75%;
    margin-left: 16px;
    font-weight: 500;
    color: #242a32;
    vertical-align: middle;
}
</style>
<div id="cvaccordion" >
<?php
global $wpdb;
$a=1; $sts='Active';
	$querymain="SELECT distinct crop_segment FROM ". Variety_Db::$varietys_table . " where status='$sts' order by crop_segment asc";
    $rowsparmain = $wpdb->get_results($querymain, ARRAY_A);

	foreach ($rowsparmain as $rowparmain) {
	$crop_segment=$rowparmain['crop_segment'];
?>
<div class="cvaccordion-tab"> <input type="radio" id="radio-<?php echo $a;?>" class="cvaccordion-input" name="cvaccordion">
                <label class="cvaccordion-label" for="radio-<?php echo $a;?>"></label>
				<div class="cvaccordion-content">
                    <div class="cvaccordion-info">
                        <span class="platform-name"><?php echo $crop_segment;?></span>
                    </div>
                </div>
				
				<div class="cvaccordion-tab-content">
                    <div class="wrapper">
					<?php 
					$c=$a+1; $d=1;
					$query="SELECT distinct crop FROM ". Variety_Db::$varietys_table . " where crop_segment='".$crop_segment."' and status='$sts' order by crop asc";
					$rowspar3 = $wpdb->get_results($query, ARRAY_A);
					foreach ($rowspar3 as $rowpar3) {
					$crp=$rowpar3['crop'];
					?>
                       <div class="cvaccordion-tab">
                            <input type="radio" id="radio-<?php echo $c;?>" class="cvaccordion-input" name="sub-cvaccordion-<?php echo $d;?>">
                            <label class="cvaccordion-label" for="radio-<?php echo $c;?>"></label>
                            <div class="cvaccordion-content">
                                <div class="cvaccordion-info">
                                    <span class="game-name"><?php echo $crp;?></span>
                                </div>
                            </div>
                            <div class="cvaccordion-tab-content">
                                <div class="wrapper">
                                    <div>
									<?php 
									$query1="SELECT * FROM ". Variety_Db::$varietys_table . " where crop='$crp' and status='$sts' order by variety_name asc";
									$rowspar1 = $wpdb->get_results($query1, ARRAY_A);
									foreach ($rowspar1 as $rowpar1) {
									$var=$rowpar1['variety_name'];
										$varid=$rowpar1['id'];
									?>
                                        <span><a href="https://www.vnrseeds.com/products/vnr-variety/?vdb=<?php echo $varid;?>#varietydetails_anchortag" ><?php echo $var;?></a></span>
									<?php } ?>
									
                                    </div>
                                </div>
                            </div>
							
                        </div>
						<?php $c++; $d++;}?>
                    </div>
                </div>
</div>
<?php $a=$c;}?>
</div>