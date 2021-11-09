<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class CreatePaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = PaymentGateway::where('slug','paystack')->orWhere('slug','flutter')->get();
        if(count($check) < 1){
            \DB::table('payment_gateways')->insert(array (
                    0 => 
                    array (
                        'name' => 'Paystack',
                        'slug' => 'paystack',
                        'public_key' => 'Your public key',
                        'secret_key' => 'Your secret key',
                        'logo' => '',
                        'status' => 1,
                    ),
                    1 => 
                    array (
                        'name' => 'Flutterwave',
                        'slug' => 'flutter',
                        'public_key' => 'Your public key',
                        'secret_key' => 'Your secret key',
                        'logo' => '',
                        'status' => 1,
                    ),
            ));
        }
    }
}
