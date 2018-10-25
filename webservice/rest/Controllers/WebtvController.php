<?php 

    class WebtvController
    {      
        public function PegaLink()
        {            
            $arrLive = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCy0IxwMjJfnLu2qHUGdmkKQ&eventType=live&type=video&key=AIzaSyCJjpQWy6bbyUn8XGF70kCKlFkobGwCqlg');
            $arrLive = json_decode($arrLive);

             if (isset($arrLive->items) && count($arrLive->items)>0) {
                 echo "https://www.youtube.com/embed/".$arrLive->items[0]->id->videoId."?autoplay=1";
             } else {
                 echo 0;
             }    
        }

        public function ListaTransmissoes()
        {            
            $sPageToken = "";

            if (isset($_GET['pageToken']) && ($_GET['pageToken'] !== "")) {
                $sPageToken = "&pageToken=".$_GET['pageToken'];
            }

            $arrVideos = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCy0IxwMjJfnLu2qHUGdmkKQ&key=AIzaSyCJjpQWy6bbyUn8XGF70kCKlFkobGwCqlg&order=date&maxResults=2'.$sPageToken);

            echo $arrVideos;
        }

    }

?>