<?php

namespace App\Controller;

use App\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

use function Amp\Iterator\toArray;

class APIController extends AbstractController
{

    public function pics()
    {



        $day = rand(1, 1000);

        $client = HttpClient::create(); //requête API

        $response = $client->request('GET', 'https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?sol='
        . $day . '&api_key=aQmwVh6jmW441qXrteA6TwCL2foMZTaMsdeDadnb');

        $statusCode = $response->getStatusCode();

        $pictures = ['']; //création variable

        if ($statusCode === 200) {
            $album = $response->toArray();

            $pictures = $album["photos"];
        }
        return $this->twig->render('pics.html.twig', [ 'pictures' => $pictures]);
    }
}
