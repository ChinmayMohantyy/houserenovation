<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use mail;
class Helper
{
    public static function getCleanSlug($string, $delimiter = '-'){
        // Remove special characters
        $string = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/", "", $string);
        // Replace blank space with delimeter
        $string = preg_replace("/[\/_|+ -]+/", $delimiter, $string);
        // Remove the last -, if there is one
        if (substr($string, -1) === '-') {
            $string = substr($string, 0, -1); // Remove last char
        }
        return mb_strtolower($string);
        
    }

    public static function getAdminId(){
        $admin_id = Auth::guard('admin')->user()->id;
        if(isset(Auth::guard('admin')->user()->parent_id) && Auth::guard('admin')->user()->parent_id!=''){
            $admin_id = Auth::guard('admin')->user('admin')->parent_id;
        }
        return $admin_id;
    }

    public static function sendMailBySendgrid($template,$data,$subject = 'Marketing Tool', $to_email, $to_name='', $attachments=''){
        // dd($to_email);
        $html = view('emails.'.$template, compact('data'))->render();
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $email->setSubject($subject); 

        if(is_array($to_email)){ // send email to multiple ids
            foreach($to_email as $to){
                $email->addTo($to);
            }
        } else {
        // send email to single ids
          $email->addTo($to_email, $to_name);

        }
        
        $email->addContent(
            "text/html", $html
        );
        if ($attachments) {
            $email->setAttachments(@$attachments);
        }
        // echo getenv('SENDGRID_API_KEY');
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        // dd($sendgrid);
        try {
            $response = $sendgrid->send($email);
            // dd($response);
        } catch (Exception $e) {
            $fp = fopen(storage_path('logs/email.log'), 'a+');
            fwrite($fp, '\n\t Exception occured on dt:-' . date('m-d-Y H:i:s') . "\n\t " . $e->getMessage());
            fclose($fp);
            return false;
        }
    }
}

