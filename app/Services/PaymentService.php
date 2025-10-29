<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;

class PaymentService
{
    public function processPayment(Order $order, array $paymentData)
    {
        // This is a basic payment service structure
        // You can integrate with actual payment gateways like Stripe, PayPal, etc.
        
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => $paymentData['method'],
            'transaction_id' => $this->generateTransactionId(),
            'amount' => $order->total_amount,
            'status' => Payment::STATUS_PENDING,
            'gateway_response' => []
        ]);

        // Simulate payment processing
        $success = $this->simulatePaymentGateway($paymentData);

        if ($success) {
            $payment->update([
                'status' => Payment::STATUS_COMPLETED,
                'gateway_response' => ['status' => 'success', 'message' => 'Payment completed successfully']
            ]);

            $order->update(['payment_status' => 'completed']);
        } else {
            $payment->update([
                'status' => Payment::STATUS_FAILED,
                'gateway_response' => ['status' => 'failed', 'message' => 'Payment failed']
            ]);
        }

        return $payment;
    }

    private function generateTransactionId()
    {
        return 'TXN_' . time() . '_' . rand(1000, 9999);
    }

    private function simulatePaymentGateway(array $paymentData)
    {
        // Simulate payment gateway response
        // In real implementation, this would call actual payment gateway APIs
        return rand(1, 10) > 2; // 80% success rate for simulation
    }
}
