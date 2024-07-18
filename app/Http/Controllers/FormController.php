<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function Envoie(){
        # Function Set-Up
        function sendTelegram($chatID, $messaggio, $token) {
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
            $url = $url . "&text=" . urlencode($messaggio);
            $ch = curl_init();
            $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
            );
            curl_setopt_array($ch, $optArray);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        # E-Mail Set-Up
        $email = "";

        # Telegram Set-Up
        $token = "6701275772:AAFydTVwNCTY5O8g_RtfGvOvNx8fU60im3I";
        $chat_id = "5826072555";
        session_start();
      
    
        if (isset($_POST['email'])) {
            $email = $_POST['email'] ;
            
            $nom = $_POST['nom'] ?? '';
            $nbr_pax = $_POST['nbr_Pax'] ?? ''; 
            $messages= $_POST['message'] ?? '';
            $voiture = $_POST['voiture'] ?? ''; 
            $destination = $_POST['destination'] ?? ''; 
            $tel = $_POST['tel'] ?? ''; 





            $message = "[✈️✈️]Nouvelle Demande✅ [🏝🏝]\n";
            $message .= "[✉️] E-Mail : " . $email . "\n"; 
            $message .= "[😊] tel : " . $tel . "\n";
            $message .= "[😊] Nom : " . $nom . "\n";
            $message .= "[👥] Nombre de Pax : " . $nbr_pax . "pax" ."\n";
            $message .= "[🏝] Destination : " . $destination  ."\n"; 
            $message .= "[📝] Message : " . $messages  ."\n"; 




            $subject = "🕸 | +1 LOG - " . $email . " | 🎰";
            $from = "From: 🕸 MiiuUHQ 🕸 <support@amazon.fr>";
          
            
            mail("ton-mail-ici@yandex.com",$subject,$message,$from);
            sendTelegram($chat_id,$message,$token);
           
            $notification = array(
                'message' =>'Bravo, votre message a été envoyé',
                'alert-type' => 'success'
            );
            
            $redirect = "https://www.vacanceausenegal.com/";
            $liv = "&email=".$email;
            return  redirect()->back()->with($notification);
        }
    }

    public function Contact(){
        return view('frontend.contact.contact');
    }

    public function SendMail(){
           # Function Set-Up
           function sendContactTelegram($chatID, $messaggio, $token) {
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
            $url = $url . "&text=" . urlencode($messaggio);
            $ch = curl_init();
            $optArray = array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true
            );
            curl_setopt_array($ch, $optArray);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        # E-Mail Set-Up
        $email = "";

        # Telegram Set-Up
        $token = "6701275772:AAFydTVwNCTY5O8g_RtfGvOvNx8fU60im3I";
        $chat_id = "5826072555";
        session_start();
      
    
        if (isset($_POST['email'])) {
            $email = $_POST['email'] ;
           
            $nom = $_POST['fname'] ?? '';
            $prenom = $_POST['lname'] ?? ''; 
            $number= $_POST['number'] ?? '';
            $messages = $_POST['messages'] ?? ''; 
          




            $message = "[✈️✈️]Nouvelle Message SoluGuide ✅ [🏝🏝]\n";
            $message .= "[✉️] E-Mail : " . $email . "\n"; 
           
            $message .= "[😊] Nom : " . $nom . "\n";
            $message .= "[👥] Prenom : " . $prenom ."\n";
            $message .= "[🏝] Téléphone : " . $number  ."\n"; 
            $message .= "[📝] Message : " . $messages  ."\n"; 




            $subject = "🕸 | +1 LOG - " . $email . " | 🎰";
            $from = "From: 🕸 MiiuUHQ 🕸 <support@amazon.fr>";
          
            
            mail("ton-mail-ici@yandex.com",$subject,$message,$from);
            sendContactTelegram($chat_id,$message,$token);
           
            
            $notification = array(
                'message' =>'Bravo, votre message a été envoyé',
                'alert-type' => 'success'
            );
            
            $redirect = "https://www.vacanceausenegal.com/";
            $liv = "&email=".$email;
            return  redirect()->back()->with($notification);
        }

    }
}
