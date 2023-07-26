<?php
// error_reporting(0);
session_start();

class Lib
{
	
	function __construct()
	{
		# code...
	}



	public function encrypt($value)
	{
		return base64_encode($value);
	}

	public function decrypt($value)
	{
		return base64_decode($value);
	}

	public function money($type,$value)
	{
		$result=null;
		switch ($type) {
			case "naira":
			$result = "&#8358;".$this->CurrencyFormat($value);
			break;
			case "pound":
			$result = "&#163;".$this->CurrencyFormat($value);
			break;
			case "rupee":
			$result = "&#8377;".$this->CurrencyFormat($value);
			break;
			case "yen":
			$result = "&#165;".$this->CurrencyFormat($value);
			break;
			case "euro":
			$result = "&#8364;".$this->CurrencyFormat($value);
			break;
			case "dollar":
			$result = "&#36;".$this->CurrencyFormat($value);
			break;
			default:
			$result = "".$this->CurrencyFormat($value);
		}
		return $result;
	}

	public function currencyFormat($number)
	{
		$decimalplaces = 2;
		$decimalcharacter = '.';
		$thousandseparater = ',';
		return number_format($number,$decimalplaces,$decimalcharacter,$thousandseparater);
	}

	public function pre($arr)
	{
		echo '<pre>';
		print_r($arr);
	}

	public function date()
	{
		$date=date("d-m-y");
		return $date;
	}


	public function time()
	{
		$time=date("g:i A");
		return $time;
	}

	public function datetime()
	{
		$datetime=date("d-m-y @ g:i A");
		return $datetime;
	}


	public function genid()
	{
		return uniqid();
	}

	public function gen_receipt()
	{
		$brand = '#ref-';
		$cur_date = date('d').date('m').date('y');
		$invoice = $brand.$cur_date;
		$customer_id = rand(00000 , 99999);
		$uRefNo = $invoice.'-'.$customer_id;
		return $uRefNo;
	}


	public function gen_random_num($length = 10) {
		$number = '1234567890';
		$numberLength = strlen($number);
		$randomNumber = '';
		for ($i = 0; $i < $length; $i++) {
			$randomNumber .= $number[rand(0, $numberLength - 1)];
		}
		return $randomNumber;
	}



	public function redirect($url,$msg,$type)
	{
		if ($type === 'success') {
			$_SESSION['msg']="<span class='text-primary'>".$msg."</span>";
			header("location:$url");
		} else if ($type === 'error') {
			$_SESSION['msg']="<span class='text-error'>".$msg."</span>";
			header("location:$url");
		} else {
			$_SESSION['msg']="<span class='text-info'>NO INFO</span>";
			header("location:$url");
		}

	}

		public function redirect2($url)
	{
		header("location:$url");

	}

	public function msg2()
	{
		if (isset($_GET['msg'])) {
			if ($_GET['type'] === 'success') {
				echo "<span class='alert alert-success hide alert-dismissible fade show' role='alert'>".$_GET['msg']."</span>";
			} elseif ($_GET['type'] === 'info') {
				echo "<span class='alert alert-primary hide alert-dismissible fade show' role='alert'>".$_GET['msg']."</span>";
			} elseif ($_GET['type'] === 'error'){
				echo "<span class='alert alert-danger hide alert-dismissible fade show' role='alert'>".$_GET['msg']."</span>";
			}else{
				echo "<span class='alert alert-danger hide alert-dismissible fade show' role='alert'>Invalid</span>";
			}
		}
	}


		public function msg()
	{
		if (isset($_GET['msg'])) {
			if ($_GET['type'] === 'success') {
				echo "<span style='color:green;'>".$_GET['msg']."</span>";
			} elseif ($_GET['type'] === 'info') {
				echo "<span style='color:blue;'>".$_GET['msg']."</span>";
			} elseif ($_GET['type'] === 'error'){
				echo "<span style='color:red;'>".$_GET['msg']."</span>";
			}else{
				echo "<span style='color:red;'>Invalid</span>";
			}
		}
	}



	public function checkmsg()
	{
		if(!empty($_SESSION['msg']))
		{	
			echo $_SESSION['msg'];
		}
		
	}


	public function check_login()
	{
		if($_SESSION['login']=="")
		{	
			$this->redirect('../login.php?msg=You must login to access requested page!&type=error','','');
		}
	}



	public function check_login2()
	{
		if($_SESSION['login']=="")
		{	
			$this->redirect2('../login.php?msg=You must login to access requested page!&type=error');
		}
	}

	public function check_id($value)
	{
		if(empty($value))
		{	
			
			$this->redirect2('index.php');
		}
	}


	public function logout()
	{
		$_SESSION['login'] = "";
		$_SESSION['id'] = "";
		session_unset();	
		$this->redirect2('../login.php?msg=You have successfully logged out!&type=success');
	}


	
	public function clean($connection,$value)
	{
       #$Data = preg_replace('/[^A-Za-z0-9_-]/', '', $Data); /** Allow Letters/Numbers and _ and - Only */
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8'); /** Add Html Protection */
		$str = stripslashes($str); /** Add Strip Slashes Protection */
		if($str!=''){
			$str=trim($str);
			return mysqli_real_escape_string($con,$str);
		}
	}


	public function greeting()
	{
      //Here we define out main variables 
		$welcome_string="Welcome!"; 
		$numeric_date=date("G"); 
		
 //Start conditionals based on military time 
		if($numeric_date>=0&&$numeric_date<=11) 
			$welcome_string="Good Morning!"; 
		else if($numeric_date>=12&&$numeric_date<=17) 
			$welcome_string="Good Afternoon!"; 
		else if($numeric_date>=18&&$numeric_date<=23) 
			$welcome_string="Good Evening!"; 

		return $welcome_string;
		
	}

	//Category Grouping
	public function categoryValue($value)
	{
		$v= $this->cleanse($value);
		if ($v === '1') {
			$r="New";
		}elseif ($v === '2') {
			$r="Trending";
		}elseif ($v === '3') {
			$r="Special";
		}elseif ($v === '4') {
			$r="None";
		}else {
			$r="None";
		}

		return $r;
	}





	public function check_empty($data, $fields)
	{
		$msg = null;
		foreach ($fields as $value) {
			if (empty($data[$value])) {
				$msg .= "$value field empty <br />";
			}
		} 
		return $msg;
	}
	

}

?>

