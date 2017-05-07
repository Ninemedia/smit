<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SMIT_Email Class
 *
 * @package		SMIT
 * @subpackage	Libraries
 * @category	SMIT_Email
 * @author		Iqbal
 */
class SMIT_Email 
{
	var $CI;
	var $active;
    
	/**
	 * Constructor - Sets up the object properties.
	 */
	function __construct()
    {
        $this->CI       =& get_instance();
		$this->active	= config_item('email_active');
		
        require_once SWIFT_MAILSERVER;
	}
	
    /**
	 * Send email function.
	 *
     * @param string    $to         (Required)  To email destination
     * @param string    $subject    (Required)  Subject of email
     * @param string    $message    (Required)  Message of email
     * @param string    $from       (Optional)  From email
     * @param string    $from_name  (Optional)  From name email
	 * @return Mixed
	 */
	function send($to, $subject, $message, $from = '', $from_name = ''){
		if (!$this->active) return false;
		
		$transport = false;	
		
		if ($mailserver_host = config_item('mailserver_host')) {
			$transport = Swift_SmtpTransport::newInstance($mailserver_host, 25);
			
			if ( $username = config_item('mailserver_username') )
				$transport->setUsername( $username );
			
			if ( $password = config_item('mailserver_password') )
				$transport->setPassword( $password );
		}
		
		try{
            // Create the Transport
            if(!$transport) $transport  = Swift_MailTransport::newInstance();
			else $transport  = Swift_MailTransport::newInstance($transport);
            // Create the message
            $mail       = Swift_Message::newInstance();
            // Give the message a subject
            $mail->setSubject($subject)
                 ->setFrom(array($from => $from_name))
                 ->setTo($to)
                 ->setBody($message->plain)
                 ->addPart($message->html, 'text/html');
	        // Create the Mailer using your created Transport
	        $mailer     = Swift_Mailer::newInstance($transport);
	        // Send the message
	        $result     = $mailer->send($mail);	
	        
			return $result;
		}catch (Exception $e){
			// Should be database log in here
			smit_log('SEND_EMAIL', 'ERROR', $e->getMessage());
		}

		return false;
	}
    
    /**
	 * Send email test function.
	 * @return Mixed
	 */
	function send_email_test( $to ) {
        if ( !$to ) return false;
            
        $message                = 'This is test email using Swiftmailer.';        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Test Email Swiftmailer', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email reset password function.
	 *
     * @param string    $id_user    (Required)  ID User
     * @param string    $password   (Required)  Password that reset
	 * @return Mixed
	 */
	function send_email_reset_password( $id_user, $password ) {
		if ( ! $user = smit_get_userdata_by_id( $id_user ) )
			return false;
        
        $message    = trim( get_option('email_format_cpassword') );
        $message    = str_replace("%username%",     $user->username, $message);
        $message    = str_replace("%password%",     $password, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $user->email, 'Reset Password', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email registration selection function.
	 *
     * @param string    $to             (Required)  Email Destionation
     * @param string    $event_title    (Required)  Title of Selection
	 * @return Mixed
	 */
	function send_email_regitration_selection( $to, $event_title ) {
        if ( !$to ) return false;
        if ( !$event_title ) return false;
        
        $message    = trim( get_option('be_notif_registration_selection') );
        $message    = str_replace("{%event_title%}", $event_title, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Seleksi Pra-Inkubasi', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email rated confirmation function.
	 *
     * @param string    $to             (Required)  Email Destionation
	 * @return Mixed
	 */
	function send_email_rated_confirmation( $to ) {
        if ( !$to ) return false;
        
        $message    = trim( get_option('be_notif_rated_confirm') );
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Penilaian', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email selection confirmation step 1 function.
	 *
     * @param string    $data       (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_confirmation_step1( $data ) {
        if ( !$data ) return false;
        
        $message    = trim( get_option('be_notif_praincubation_confirm') );
        $message    = str_replace("{%event_title%}", $data->event_title, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Seleksi Pra-Inkubasi', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email selection confirmation step 2 function.
	 *
     * @param string    $data       (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_confirmation_step2( $data ) {
        if ( !$data ) return false;
        
        $message    = trim( get_option('be_notif_praincubation_confirm2') );
        $message    = str_replace("{%event_title%}", $data->event_title, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Seleksi Pra-Inkubasi', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email selection success function.
	 *
     * @param array object  $selection_setting  (Required)  Selection Setting
     * @param array object  $data               (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_success( $selection_setting, $data  ) {
        if ( !$selection_setting ) return false;
        if ( !$data ) return false;
        
        $adm_date   = date('d', strtotime($selection_setting->selection_date_adm_start)) . 
            ' - ' . date('d', strtotime($selection_setting->selection_date_adm_end)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_adm_end)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_adm_end));
            
        $curdate    = date('d') .' '. smit_indo_month( date('F') ) .' '. date('Y');
        $inv_day    = smit_indo_day( date('F', $selection_setting->selection_date_invitation_send ) );
        $inv_date   = date('d', strtotime($selection_setting->selection_date_invitation_send)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_invitation_send)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_invitation_send));
        
        $message    = trim( get_option('be_notif_praincubation_success') );
        $message    = str_replace("{%curdate%}",            $curdate, $message);
        $message    = str_replace("{%selection_year%}",     $selection_setting->selection_year_publication, $message);
        $message    = str_replace("{%user_name%}",          $data->name, $message);
        $message    = str_replace("{%adm_date%}",           $adm_date, $message);
        $message    = str_replace("{%interview_date%}",     $inv_day .', '.$inv_date, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Lolos Seleksi', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
}

/*
CHANGELOG
---------
Insert new changelog at the top of the list.
-----------------------------------------------
Version	YYYY/MM/DD  Person Name		Description
-----------------------------------------------
1.0.0   2017/01/20  Iqbal           - Created this changelog
*/