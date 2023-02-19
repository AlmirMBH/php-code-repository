<!DOCTYPE html>
<html lang="en">
<head><title>Simple news service model</title>
</head>
<body>
    <h1>Simple news service model</h1>
    
    <?php
        // simple news service model

        // provides access to news services
        interface INews
        {
            public function getNews();
        }


        // service configuration
        class ApiConfig
        {    
            protected $NYTimes = [
                'url' => 'https://www.nytimes.com/' // register with nyt and replace url with api keys
            ];
            
            protected $Independent = [
                'url' => 'https://www.independent.co.uk/' // register with bbc and replace url with api keys
            ];
            
            public function getNewsServiceConfig($service){                
                return $this->$service['url'];
            }
        }       


        // gets configuration and fetches news
        class NewsCurl extends ApiConfig
        {
            public function get($service){                
                $url = $this->getNewsServiceConfig($service);
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                
                return curl_exec($curl);
            }                       
        }


        // provides news from all services
        class NewsProvider extends NewsCurl
        {
            public function getNewsService(INews $newsService){
                return $newsService->getNews();
            }
        }

        // news services; process news posts here or in helper classes
        class NYTimes extends NewsCurl implements INews
        {
            public function getNews(){                                
                return $this->get(__CLASS__);
            }
        }
        

        class Independent extends NewsCurl implements INews
        {
            public function getNews(){                
                return $this->get(__CLASS__); // use any flag as a method argument
            }
        }



        // output
        $newsProvider = new NewsProvider();
        $nyTimes = new NYTimes();
        $independent = new Independent();
       
        echo $newsProvider->getNewsService($independent);
        // echo $newsProvider->getNewsService($nyTimes);        
        
       
        
         
    ?>
</body>
</html>