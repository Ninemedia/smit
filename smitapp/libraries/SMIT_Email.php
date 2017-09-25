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
            $mailserver_port = config_item('mailserver_port');
			$transport = Swift_SmtpTransport::newInstance($mailserver_host, $mailserver_port, 'ssl');
			
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
	 * Send email forgot password function.
	 *
     * @param string    $id_user    (Required)  ID User
     * @param string    $password   (Required)  Password that forgot
	 * @return Mixed
	 */
	function send_email_forgot_password( $id_user, $password ) {
		if ( ! $user = smit_get_userdata_by_id( $id_user ) )
			return false;
        
        $message    = trim( get_option('be_notif_forgot_password') );
        $message    = str_replace("{%username%}",     $user->username, $message);
        $message    = str_replace("{%name%}",   strtoupper($user->name), $message);
        $message    = str_replace("{%password%}",     $password, $message);
        
        $html_message           = smit_notification_template_clear($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $user->email, 'Reset Password', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email registration pengusul function.
	 *
     * @param string    $to             (Required)  Email Destination
     * @param string    $username       (Required)  Username of Pengusul
	 * @return Mixed
	 */
	function send_email_registration_pengusul( $to, $username ) {
        if ( !$to ) return false;
        if ( !$username ) return false;
        
        $message    = trim( get_option('be_notif_registration_pengusul') );
        $message    = str_replace("{%username%}", $username, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Pendaftaran Pengusul', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email registration user function.
	 *
     * @param string    $to             (Required)  Email Destination
     * @param string    $username       (Required)  Username of user
	 * @return Mixed
	 */
	function send_email_registration_user( $to, $username, $status ) {
        if ( !$to ) return false;
        if ( !$username ) return false;
        //if( empty($status) ) $status = 'AKTIF';
        
        $message    = trim( get_option('be_notif_registration_user') );
        $message    = str_replace("{%username%}", $username, $message);
        $message    = str_replace("{%status%}", $status, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Pendaftaran User', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email registration juri function.
	 *
     * @param string    $to             (Required)  Email Destination
     * @param string    $username       (Required)  Username of user
     * @param string    $password       (Required)  Password of user
	 * @return Mixed
	 */
	function send_email_registration_juri( $to, $username, $password, $type ) {
        if ( !$to ) return false;
        if ( !$username ) return false;
        if ( !$password ) return false;
        if ( !$type ) return false;
        
        $message    = trim( get_option('be_notif_registration_juri') );
        $message    = str_replace("{%username%}", $username, $message);
        $message    = str_replace("{%password%}", $password, $message);
        $message    = str_replace("{%type%}", $type, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Pendaftaran', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email registration for admin function.
	 *
     * @param string    $to             (Required)  Email Destination
     * @param string    $from           (Required)  Email Sender
     * @param string    $username       (Required)  Username of user
     * @param string    $name           (Required)  Name of user
	 * @return Mixed
	 */
	function send_email_registration_for_admin( $to, $from, $username, $name ) {
        if ( !$to ) return false;
        if ( !$from ) return false;
        if ( !$username ) return false;
        if ( !$name ) return false;
        
        $message    = trim( get_option('be_notif_registration_for_admin') );
        $message    = str_replace("{%username%}", $username, $message);
        $message    = str_replace("{%name%}", $name, $message);
        
        $html_message           = smit_notification_template_clear($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Pendaftaran User', $mail_message, $from, $name );
	}
    
    /**
	 * Send email registration selection function.
	 *
     * @param string    $to             (Required)  Email Destionation
     * @param string    $event_title    (Required)  Title of Selection
	 * @return Mixed
	 */
	function send_email_registration_selection( $to, $event_title ) {
        if ( !$to ) return false;
        if ( !$event_title ) return false;
        
        $message    = trim( get_option('be_notif_registration_selection') );
        $message    = str_replace("{%event_title%}", $event_title, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $to, 'Konfirmasi Kegiatan Seleksi ', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email rated confirmation function.
	 *
     * @param string    $to             (Required)  Email Destionation
	 * @return Mixed
	 */
	function send_email_rated_confirmation( $to, $step ) {
        if ( !$to ) return false;
        if ( !$step ) return false;
        
        $message    = trim( get_option('be_notif_rated_selection') );
        $message    = str_replace("{%step%}", 'Proses penilaian Tahap '.$step, $message);
        
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
	 * Send email selection not success step 1 function.
	 *
     * @param array object  $selection_setting  (Required)  Selection Setting
     * @param array object  $data               (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_not_success_step1 ($selection_setting, $data  ) {
        if ( !$selection_setting ) return false;
        if ( !$data ) return false;
        
        $adm_date   = date('j', strtotime($selection_setting->selection_date_adm_start)) . 
            ' - ' . date('j', strtotime($selection_setting->selection_date_adm_end)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_adm_end)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_adm_end));
            
        $curdate    = date('j') .' '. smit_indo_month( date('F') ) .' '. date('Y');
 
        $message    = trim( get_option('be_notif_praincubation_not_success') );
        $message    = str_replace("{%curdate%}",            $curdate, $message);
        $message    = str_replace("{%selection_year%}",     $selection_setting->selection_year_publication, $message);
        $message    = str_replace("{%user_name%}",          $data->name, $message);
        $message    = str_replace("{%adm_date%}",           $adm_date, $message);
        $message    = str_replace("{%event_title%}",        $data->event_title, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Tidak Lolos Seleksi Tahap Awal', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email selection not success step 2 function.
	 *
     * @param array object  $selection_setting  (Required)  Selection Setting
     * @param array object  $data               (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_not_success_step2 ($selection_setting, $data  ) {
        if ( !$selection_setting ) return false;
        if ( !$data ) return false;
        
        $adm_date   = date('j', strtotime($selection_setting->selection_date_adm_start)) . 
            ' - ' . date('j', strtotime($selection_setting->selection_date_adm_end)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_adm_end)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_adm_end));
            
        $curdate    = date('j') .' '. smit_indo_month( date('F') ) .' '. date('Y');
 
        $message    = trim( get_option('be_notif_praincubation_not_success2') );
        $message    = str_replace("{%curdate%}",            $curdate, $message);
        $message    = str_replace("{%selection_year%}",     $selection_setting->selection_year_publication, $message);
        $message    = str_replace("{%user_name%}",          $data->name, $message);
        $message    = str_replace("{%adm_date%}",           $adm_date, $message);
        
        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Tidak Lolos Seleksi', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
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
        
        $adm_date   = date('j', strtotime($selection_setting->selection_date_adm_start)) . 
            ' - ' . date('j', strtotime($selection_setting->selection_date_adm_end)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_adm_end)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_adm_end));
            
        $curdate    = date('j') .' '. smit_indo_month( date('F') ) .' '. date('Y');
        $inv_day    = smit_indo_day( date('D', strtotime($selection_setting->selection_date_invitation_send) ) );
        $inv_date   = date('j', strtotime($selection_setting->selection_date_invitation_send)) . 
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
    
    /**
	 * Send email selection accepted function.
	 *
     * @param array object  $selection_setting  (Required)  Selection Setting
     * @param array object  $data               (Required)  Pra-Incubation Selection Data
	 * @return Mixed
	 */
	function send_email_selection_accepted( $selection_setting, $data  ) {
        if ( !$selection_setting ) return false;
        if ( !$data ) return false;
        
        $adm_date   = date('j', strtotime($selection_setting->selection_date_adm_start)) . 
            ' - ' . date('j', strtotime($selection_setting->selection_date_adm_end)) . 
            ' ' . smit_indo_month( date('F', strtotime($selection_setting->selection_date_adm_end)) ) . 
            ' ' . date('Y', strtotime($selection_setting->selection_date_adm_end));
            
        $curdate    = date('j') .' '. smit_indo_month( date('F') ) .' '. date('Y');
        
        $message    = trim( get_option('be_notif_praincubation_accepted') );
        $message    = str_replace("{%curdate%}",            $curdate, $message);
        $message    = str_replace("{%selection_year%}",     $selection_setting->selection_year_publication, $message);
        $message    = str_replace("{%user_name%}",          $data->name, $message);
        $message    = str_replace("{%adm_date%}",           $adm_date, $message);

        $html_message           = smit_notification_template($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $data->email, 'Konfirmasi Seleksi Diterima', $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
	}
    
    /**
	 * Send email forgot password function.
	 *
     * @param string    $id_user    (Required)  ID User
     * @param string    $password   (Required)  Password that forgot
	 * @return Mixed
	 */
	function send_email_contact( $email, $contact_name, $contact_email, $contact_title, $contact_desc ) {
		if ( !$contact_name ) return false;
        if ( !$contact_email ) return false;
        if ( !$contact_title ) return false;
        if ( !$contact_desc ) return false;
        
        $message    = trim( get_option('be_notif_contact') );
        $message    = str_replace("{%name%}",   strtoupper($contact_name), $message);
        $message    = str_replace("{%email%}",     $contact_email, $message);
        $message    = str_replace("{%title%}",     $contact_title, $message);
        $message    = str_replace("{%description%}",     $contact_desc, $message);
        
        $html_message           = smit_notification_template_clear($message);
        
        $mail_message			= new stdClass();
        $mail_message->plain	= $message;
        $mail_message->html		= $html_message;
		
		return $this->send( $email, $contact_title, $mail_message, get_option( 'mail_sender_admin' ), 'Admin ' . get_option( 'company_name' ) );
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