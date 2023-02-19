<?php

// STRUCTURAL PATTERN: how to assemble objects and classes into a larger structures, while keeping them flexible and efficient
// ADAPTER is subpattern of structural pattern. It allows objects with incompatible interfaces to collaborate (matches them).
// It serves as the bridge between an existing service code and our app code
// It makes the existing or new incompatible APIs work without changing the existing code

// Target/Client
interface Share{
    
    // Request
    public function shareData();
}

// Adaptee (Service)
class WhatsAppShare{
    
    // Special Request
    public function waShare(String $string){
        echo "Share data via WhatsApp:  $string! \n";
    }
}

// Adapter
class WhatsAppShareAdapter implements Share{
    
    private $whatsapp;
    private $data;
    
    public function __construct(WhatsAppShare $whatsapp, String $data) {
        $this->whatsapp = $whatsapp;
        $this->data = $data;
    }

    
    public function shareData() {
        $this->whatsapp->waShare($this->data);
    }

}

function clientCode(Share $share){
    $share->shareData();
}

$wa = new WhatsAppShare();
$waShare = new WhatsAppShareAdapter($wa, "Hello Whatsapp");
clientCode($waShare);