<?php

require_once 'PaymentProfile.php';

class Customer{

    private ?PaymentProfile $paymentProfile = null;

    public function getPaymentProfile(): ?getPaymentProfile {
        return $this->paymentProfile;
    }

}