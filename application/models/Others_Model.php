<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Others_Model extends CI_Model
{
	function id($str)
	{
		$number=preg_replace('/[^0-9]/','', $str);
		return str_pad(intval($number) + 1, strlen($number), '0', STR_PAD_LEFT);
	}

	function password($length)
	{
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    return substr(str_shuffle($chars),0,$length);
	}

	function getAllGroups()
	{
		$this->db->select('company_verticals.*,users.name as employee_name');
		$this->db->from('company_verticals');
		$this->db->join('users','users.id=company_verticals.created_by');
		return $this->db->get()->result_array();
	}
	
	public function mail($sendername,$from,$body,$subject,$to,$toname)
		  {
		  
		      require_once(FCPATH.'third_party/class.phpmailer.php');
		      $mail = new PHPMailer;
		     // $mail->isSMTP();
		      $mail->Host = 'smtp.gmail.com';   //Sets the SMTP hosts of your Email hosting, this for Godaddy
		      $mail->Port = '465';                  //Sets the default SMTP server port
		      $mail->SMTPAuth = true;             //Sets SMTP authentication. Utilizes the Username and Password variables\
		      $mail->Username = 'erp@bizzmanweb.com';          //Sets SMTP username 
		      $mail->Password = 'Bizzmanweb@2021';                  //Sets SMTP password
		      $mail->SMTPSecure = 'ssl';              //Sets connection prefix. Options are "", "ssl" or "tls"
		      $mail->From ="$from";          //Sets the From email address for the message
		      $mail->FromName ="'$sendername";
		      $mail->AddReplyTo("$from", "$sendername");
		      $mail->AddAddress("$to", "$toname");   //Adds a "To" address
		      $mail->WordWrap = 50;             //Sets word wrapping on the body of the message to a given number of characters
		      $mail->IsHTML(true); 

		      $mail->Subject = "$subject";        //Sets the Subject of the message 
		      $mail->Body = "$body";             //An HTML or plain text message body
		      if($mail->Send())               //Send an Email. Return true on success or false on error
		      {
		        return true; 
		      }
		      else
		      {
		        return false;
		      }
		  }
}
