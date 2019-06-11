            <?php
        	// Razorpay Integration Files Include
			require('PaymentGatewayLib/config.php');
			require('PaymentGatewayLib/razorpay-php/Razorpay.php');

			// Create the Razorpay Order
			use Razorpay\Api\Api;
              $api = new Api($keyId, $keySecret);

              //
              // We create an razorpay order using orders api
              // Docs: https://docs.razorpay.com/docs/orders
              //
              $orderData = [
                  'receipt'         => 3456,
                  'amount'          => 2000 * 100, // 2000 rupees in paise
                  'currency'        => 'INR',
                  'payment_capture' => 1 // auto capture
              ];

              $razorpayOrder = $api->order->create($orderData);

              $razorpayOrderId = $razorpayOrder['id'];

              $_SESSION['razorpay_order_id'] = $razorpayOrderId;

              $displayAmount = $amount = $orderData['amount'];

              if ($displayCurrency !== 'INR')
              {
                  $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                  $exchange = json_decode(file_get_contents($url), true);

                  $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
              }

              $checkout = 'automatic';
              $data = [
                  "key"               => $keyId,
                  "amount"            => $amount,
                  "name"              => "Biryani Bazaar",
                  "description"       => "Biryani Bazaar Payment",
                  "image"             => "http://biryanibazaar.in/assets/images/logo-bb.png",
                  "prefill"           => [
                  "name"              => "Nikhil Vats",
                  "email"             => "emailknv@gmail.com",
                  "contact"           => "9470668481",
                  ],
                  "notes"             => [
                  "address"           => "N/A",
                  "merchant_order_id" => "12312321",
                  ],
                  "theme"             => [
                  "color"             => "#F37254"
                  ],
                  "order_id"          => $razorpayOrderId,
              ];

              if ($displayCurrency !== 'INR')
              {
                  $data['display_currency']  = $displayCurrency;
                  $data['display_amount']    = $displayAmount;
              }

              $json = json_encode($data);

              require("PaymentGatewayLib/checkout/{$checkout}.php");

              ?>