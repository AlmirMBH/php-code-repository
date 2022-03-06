<!DOCTYPE html>
<html lang="en">
<head><title>Error handling</title></head>
<body>
    <h1>Error handling</h1>
        
    <?php

        // Exceptions introduced in php5
        // Exception objects cannot be cloned but exceptions can be linked to each other
        // Exception (all exceptions including user defined) and 
        // Error (php internal errors since php7) classes implement Throwable 
        // Majority of exception classes e.g. InvalidArgumentException extend Exception class

        const NLINE = "<br>";


        class Customer{
            protected array $billingInfo = [];

            public function __construct($billingInfo){ 
                $this->billingInfo = $billingInfo; 
            }

            public function getBillingInfo(){ 
                return $this->billingInfo; 
            }
        }




        class Invoice{
            protected $customer;
            
            public function __construct(Customer $customer){ 
                $this->customer = $customer; 
            }

            public function process(float $amount){
                if($amount <= 0){                    
                    throw new InvalidArgumentException('Invalid invoice amount');
                }

                if($amount > 25){                    
                    throw new CustomInfoException();
                }

                if(empty($this->customer->getBillingInfo())){            
                    throw new MissingBillingInfoException();
                }                
                
                if(array_sum($this->customer->getBillingInfo()) > 1 ){
                    throw CustomInvoiceException::message();
                }

                echo "Processing $" . $amount . ' invoice - ';
                sleep(1); // delay execution for 1 sec
                echo "OK";
            }
        }



        // custom exception classes
        class MissingBillingInfoException extends Exception{
            protected $message = 'Missing billing information';
        }

        class CustomInfoException extends Exception{
            protected $message = 'Max amount is 25';            
        }

        class CustomInvoiceException extends Exception{
            public static function message(){
                return new static('Billing info cannot be larger than 100!');
            }
        }



        
        $invoice = new Invoice(new Customer([40, 61]));

        try{
            $invoice->process(25);
        }        
        catch(MissingBillingInfoException $e){                                  // $e is not required since php8
            echo $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine();
        }
        catch(InvalidArgumentException | CustomInfoException $e){               // multiple exceptions split by pipe
            echo $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine();
        }
        // as the above exceptions extend Exception class, they can be removed and the Exception will throw the same messages
        catch(Exception $e){ 
            echo $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine();
        }
        finally{            
            echo "   Default exception   "; // always executed
        }

        

        // GLOBAL EXCEPTION HANDLER (GEH)
        // registering GEH
        
        set_exception_handler(function(Throwable $e){ // Throwable typehinted to include more handlings and avoid try-catch
            var_dump($e->getMessage());
        });
        
        echo array_rand([], 3);
    
    ?>

</body>
</html>