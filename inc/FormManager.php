<?php
include_once('dbconnection.php');


class FormManager{
	private $conn;

	function __construct(){
		$db = new Database();
		$this->conn = $db->getConnection();
		//var_dump($this->conn);
	}


	/**
	 * get all Team data
	 */
	function getTeamList(){
		$data = array();
		$count = 0;		

		$sql = "SELECT id, team_name FROM team ORDER BY id";
		$result = $this->conn->query($sql);
		if(!$result) {
		   die("query failed: getTeamList()" . mysql_error());
		}

		while ($row = $result->fetch_assoc()) {
			$data[$count]['id'] = $row["id"];
			$data[$count]['team_name'] = $row["team_name"];
			$count++;
		}
		//mysql_free_result($result);
		$result->free();
		return $data;
	}
	/**
	 * get all US State data
	 */
	function getStateList(){
		$data = array();
		$count = 0;		

		$sql = "SELECT state, state_name FROM state ORDER BY id";
		$result = $this->conn->query($sql);
		if (!$result) { 
			die('query failed: getStateList()' . mysql_error());
		}

		while ($row = $result->fetch_assoc()) {
			$data[$count]['state'] = $row["state"];
			$data[$count]['state_name'] = $row["state_name"];
			$count++;
		}
		$result->free();
		return $data;
	}
	/**
	 * get Month for birthday field
	 */
	function getMonthList(){
		$data = array();
		$count = 0;		

		$sql = "select id, month from birthday_month order by id";
		$result = $this->conn->query($sql);
		if (!$result) { die('Invalid query: getMonthList()' . mysql_error()); }

		while ($row = $result->fetch_assoc()) {
			$data[$count]['id'] = $row["id"];
			$data[$count]['month'] = $row["month"];
			$count++;
		}
		$result->free();
		return $data;
	}
	/**
	 * get Day for birthday field
	 */
	function getDayList(){
		$data = array();
		$count = 0;		
		$sql = "SELECT id, day FROM birthday_day ORDER BY id";
		$result = $this->conn->query($sql);
		if (!$result) { die('Invalid query: getDayList()' . mysql_error()); }

		while ($row = $result->fetch_assoc()) {
			$data[$count]['id'] = $row["id"];
			$data[$count]['day'] = $row["day"];
			$count++;
		}
		$result->free();
		return $data;
	}
	/**
	 * get Day for birthday field
	 */
	function getYearList(){
		$data = array();
		$count = 0;		
		$sql = "SELECT year FROM birthday_year ORDER BY id desc";
		$result = $this->conn->query($sql);
		if (!$result) { die('Invalid query: getYearList()' . mysql_error()); }

		while ($row = $result->fetch_assoc()) {
			$data[$count]['year'] = $row["year"];
			$count++;
		}
		$result->free();
		return $data;
	}

	/**
	 * Insert customer infomation
	 */
	function insertContactInfo($data){
		$sql = <<<EOF
INSERT INTO contact_info(billname, address, city, state, country, zip, phone, bday_month, bday_day, bday_year, team_preference, signup_weekly, signup_offer, signup_optout, orderID, telefloraID, registered_date) VALUES (
'{$data['billname']}', 
'{$data['address']}', 
'{$data['city']}', 
'{$data['state']}',  
'{$data['country']}',  
'{$data['zip']}',
'{$data['phone']}',
'{$data['bday_month']}',
'{$data['bday_day']}',
'{$data['bday_year']}',
'{$data['team_preference']}',
'{$data['signup_weekly']}',
'{$data['signup_offer']}',
'{$data['signup_optout']}',
{$data['orderID']},
'{$data['telefloraID']}',
now());
EOF;
		echo $sql;
		$result = $this->conn->query($sql);
		if (!$result) { 
			die('Invalid query: insertContactInfo()' . mysql_error());
		}
		mysqli_close($this->conn);

	}


	/**
	 * Insert customer infomation
	 */
	function goThankyouPage(){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=thankyou.php">';    
		exit; 
	}

	/**
	 * Insert customer infomation
	 */
	function goResultPage($msgtype){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=form_result.php?msgtype=' . $msgtype . '">';    
		exit; 
	}


}

//TEST CODE for test2.php
//$fm = new FormManager();
//$fm->getTotalCount();
?>