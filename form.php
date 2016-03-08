<?php
include_once('inc/FormManager.php');
/********** Page Logic *************/
$formManger = new FormManager();
$insert_array = array();
//valuses from confirmation page
$billname = "";
$billadd1 = "";
$city = "";
$state="";
$zip="";
$orderID = "";
$telefloraID = "";

if($_POST['go'] == 1){
		$billname = $_POST['billname'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$phone = $_POST['phone'];
		$bday_month = $_POST['bday_month'];
		$bday_day = $_POST['bday_day'];
		$bday_year = $_POST['bday_year'];
		$team_preference = $_POST['team_preference'];

		/* signup_options */
		$signup_weekly = "no";
		$signup_offer = "no";
		$signup_optout = "no";
		if(isset($_POST['signup_weekly'])){
			$signup_weekly = $_POST['signup_weekly'];
		}
		if( isset($_POST['signup_offer'])){
			$signup_offer = $_POST['signup_offer'];
		}
		if( isset($_POST['signup_optout'])){
			$signup_optout = $_POST['signup_optout'];
		}

		/* IDs */
		$orderID = $_POST['orderID'];
		$telefloraID = $_POST['telefloraID'];

		if($signup_optout == 'yes'){
			$insert_array = array(
				'billname' => '', 
				'address' => '', 
				'city' => '', 
				'state' => '', 
				'country' => '', 
				'zip' => '', 
				'phone' => '', 
				'bday_month' => '', 
				'bday_day' => '', 
				'bday_year' => '', 
				'team_preference' => '',
				'signup_weekly' => '',
				'signup_offer' => '',
				'signup_optout' => $signup_optout,
				'orderID' => $orderID,
				'telefloraID' => $telefloraID
			);
			//insert data in contact_info table
			$formManger -> insertContactInfo($insert_array);
			$formManger -> goResultPage(2); 
		}else{
			//Preparing insert data
			$insert_array = array(
				'billname' => $billname, 
				'address' => $address, 
				'city' => $city, 
				'state' => $state, 
				'country' => $country, 
				'zip' => $zip, 
				'phone' => $phone, 
				'bday_month' => $bday_month, 
				'bday_day' => $bday_day, 
				'bday_year' => $bday_year, 
				'team_preference' => $team_preference,
				'signup_weekly' => $signup_weekly,
				'signup_offer' => $signup_offer,
				'signup_optout' => $signup_optout,
				'orderID' => $orderID,
				'telefloraID' => $telefloraID
			);
			//insert data in contact_info table
			$formManger -> insertContactInfo($insert_array);
			$formManger -> goResultPage(1);
		}
}else{
	$array_team = $formManger -> getTeamList();
	$array_state = $formManger -> getStateList();
	$array_month = $formManger -> getMonthList();
	$array_day = $formManger -> getDayList();
	$array_year = $formManger -> getYearList();

	$billname = $_GET['billname'];
	$billadd1 = $_GET['billadd1'];
	$billadd2 = $_GET['billadd2'];
	$orderID = $_GET['t_orderid'];
	$telefloraID = $_GET['tfid'];
	
	$city = $_GET['city'];
	$state = $_GET['state'];
	$zip = $_GET['zip'];
	$country = $_GET['country'];

}
/***********************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NBA Survey Form</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="margin:0; padding:0">

<div id="NBAForm-container">
	<div id="headline"><img src="images/form_headline.gif" width="600" height="149" border="0" alt="You're almost there!" /></div>
	<div id="form-container">

    <div id="messageBox"></div>

    <form name="NBASurveyForm" id="NBASurveyForm" action="form.php" method="post">
    <div class="label-container clearfix" id="customer-name">
        <label for="billname">Name</label>
        <div class="billing-name"><?=$billname?></div>
    </div>
    <div class="label-container" id="customer-address">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?=$billadd1?>" />
    </div>

    <div class="label-container clearfix" id="customer-city">
        <label for="city">City</label>
        <input type="text" name="city" id="city" value="<?=$city?>"   />
    </div>
    
    <div class="label-container" id="customer-state">
    <label for="state">State/Province</label>
    <select name="state" id="state" >
        <option value="">State</option>
<?php 
	for($i=0; $i < count($array_state); $i++){
		$flag = 0;
		if($array_state[$i]['state'] == $state){
			$flag = 1;
		}
?>
        <option value="<?=$array_state[$i]['state'] ?>" <?=($flag)? "selected" : "" ?>><?=$array_state[$i]['state_name']?></option>
<?php
	}
?>	
    </select>
    </div>
    
    <div class="label-container" id="customer-country">
        <label for="country">Country</label>
	    <select name="country" id="country" >
            <option value="United States" <?=($country=='United States')? 'selected' : '' ?>>United States</option>
            <option value="Canada" <?=($country=='Canada')? 'selected' : '' ?>>Canada</option>
		</select>
    </div>    
    
    <div class="label-container clearfix" id="customer-zip">
        <label for="zip">Zip/Postal Code</label>
        <input type="text" name="zip" id="zip" value="<?=$zip?>" maxlength="6" />
    </div>

    <div class="label-container" id="customer-phone">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" value=""  />
    </div>
    <div class="label-container clearfix" id="customer-birthday">
        <label for="bday">Birthdate (mm/dd/yyyy)</label>
		<!-- birth month -->
	    <select name="bday_month" id="bday_month">
        <option value="">Month</option>
<?php 
	for($i=0; $i < count($array_month); $i++){
?>
        <option value="<?=$array_month[$i]['id'] ?>" ><?=$array_month[$i]['month']?></option>
<?php
	}
?>	
		</select>
		<!-- birth day -->
	    <select name="bday_day" id="bday_day">
        <option value="">Day</option>
<?php 
	for($i=0; $i < count($array_day); $i++){
?>
        <option value="<?=$array_day[$i]['id'] ?>"><?=$array_day[$i]['day']?></option>
<?php
	}
?>	
		</select>
		<!-- birth year -->
	    <select name="bday_year" id="bday_year">
        <option value="">Year</option>
<?php 
	for($i=0; $i < count($array_year); $i++){
?>
        <option value="<?=$array_year[$i]['year'] ?>"><?=$array_year[$i]['year']?></option>
<?php
	}
?>	
		</select>
    </div>

    <div class="label-container clearfix" id="customer-team">
        <label for="team">NBA team preference</label>
	    <select name="team_preference" id="team_preference">
        <option value="">Please Select...</option>
<?php 
	for($i=0; $i < count($array_team); $i++){
?>
        <option value="<?=$array_team[$i]['id'] ?>"><?=$array_team[$i]['team_name']?></option>
<?php
	}
?>	
    	</select>        
    </div>
	<div style="clear:both"></div>

    <div class="label-container" id="customer_signup">
        <div class="signup_container"><input type="checkbox" name="signup_weekly" id="signup_weekly" value="yes" />Sign me up for weekly headlines and highlights, exclusive offers, and special promotions from the NBA</span></div>
        <div class="signup_container"><input type="checkbox" name="signup_offer" id="signup_offer" value="yes" checked />Sign me up for exclusive offers and discounts from Teleflora</div>
        <div class="signup_container"><input type="checkbox" name="signup_optout" id="signup_optout"  value="yes" />I'd like to opt out of the Send &amp; Score Sweepstakes</div>
    </div>

    <div class="label-container" id="customer-submit-btn">
    <input type="hidden" name="go" id="go"  value="1" />
    <input type="hidden" name="orderID" id="orderID" value="<?=$orderID?>" />
    <input type="hidden" name="billname" id="billname" value="<?=$billname?>" />
    <input type="hidden" name="telefloraID" id="telefloraID" value="<?=$telefloraID?>" />
    <input type="image" src="images/submit-btn.gif" width="165" height="46" border="0" />
    </div>
    </form>
</div><!-- /form-container -->
</div><!-- /NBAForm-container -->

<script type="text/javascript">
jQuery(function($) {
      $('#phone').mask('(999) 999-9999');
});

$("#NBASurveyForm").submit(function( event ) {
	var errorArray=new Array(); 
	var optout_flag = 0;
	var errorString = "";
	var msg = "";
	
	if ($('#signup_optout').is(':checked')) {
		optout_flag = 1;
	}
	if(optout_flag){
		return true; //Submit Form WITHOUT CHECKING REQUIRED FIELDS.
	}else{
		/* CHECKING REQUIRED FIELDS */
		if($('#address').val()==""){
			errorArray.push("address");
		}
		if($('#city').val()==""){
			errorArray.push("city");
		}
		if($('#state').val()==""){
			errorArray.push("state");
		}
		if($('#zip').val()==""){
			errorArray.push("zip");
		}
		if( $('#phone').val() ==""){
			errorArray.push("phone");
		}		

		if( $('#bday_month').val() ==""){
			errorArray.push("bday_month");
		}
		if( $('#bday_day').val() ==""){
			errorArray.push("bday_day");
		}
		if( $('#bday_year').val() ==""){
			errorArray.push("bday_year");
		}
		if($('#team_preference').val()==""){
			errorArray.push("team_preference");
		}
//		errorString = errorArray.toString();
//		alert(errorString);

		/* reset */
		$( ":input" ).removeClass('error_fields');

		if(errorArray.length != 0 ){
			for(i=0; i<errorArray.length; i++){
				field_name = errorArray[i];
				$('#' + field_name).addClass('error_fields');
			}
		//	alert(errorString); 

			$('#messageBox').text('Please enter required fields.');
			event.preventDefault();
		}else{
			return true; //Submit Form!
		}
	}
});
</script>


</body>
</html>
