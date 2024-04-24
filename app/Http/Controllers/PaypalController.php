<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\AdminOrderConfirmation;
use App\Notifications\OrderConfirmation;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Routing\Controller;

class PaypalController extends Controller
{
    //
    public function paypal(Request $request)
    {
        //dd(json_decode($request->seats));

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);
        //dd($response);

        if(isset($response['id']) && $response != null){
            foreach($response['links'] as $link){
                if($link['rel'] == 'approve'){
                    session()->put('flight_id', $request->flight_id);
                    session()->put('quantity', $request->quantity);
                    session()->put('seats', json_decode($request->seats));

                    return redirect()->away($link['href']);
                }
            }
        }else{
            session()->flash('message', 'Something went wrong with your payment, please try again.');

            return redirect()->route('home');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);

        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            //Insert payment data in DB
            $payment = new Payment;
            $payment->payment_id = $response['id'];
            $payment->flight_id = session()->get('flight_id');
            $payment->user_id = auth()->user()->id;
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'] . " " . $response['payer']['name']['surname'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'Paypal';
            $payment->save();

            //Generate tickets
            $seats = session()->get('seats');
            foreach($seats as $seat){
                $ticket = new Ticket;
                $ticket->user_id = auth()->user()->id;
                $ticket->ticket_code =  uniqid();
                $ticket->seat = $seat;
                $ticket->flight_id = session()->get('flight_id');
                $ticket->save();
            }

            //Update available seats
            $flight = Flight::find(session()->get('flight_id'));
            $flight->available_seats -= count($seats);
            $flight->save();

            //Notify user via email
            $ticket->user->notify(new OrderConfirmation(auth()->user()->id, $flight->id));

            //Notify admins via email
            $admins = User::where('rol', 1)->get();

            foreach($admins as $admin){
                $admin->notify(new AdminOrderConfirmation($admin->id, $flight->id));
            }

            session()->flash('message', 'Your payment has been successfully completed! Please check below for your tickets.');

            return redirect()->route('flights.index');

            unset($_SESSION['flight_id']);
            unset($_SESSION['quantity']);
            unset($_SESSION['seats']);
        }else{
            session()->flash('message', 'Something went wrong with your payment, please try again.');

            return redirect()->route('home');
        }
    }

    public function cancel()
    {
        return "Payment is cancelled.";
    }
}
