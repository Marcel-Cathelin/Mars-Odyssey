<?php

namespace App\Controller;

use App\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

use function Amp\Iterator\toArray;

class PicsDayController extends AbstractController
{

    public function picsDay()
    {



        $birthday = rand(1, 30);
        $birthmonth = rand(1, 12);

        $client = HttpClient::create(); //requête API

        $response = $client->request('GET', 'https://api.nasa.gov/mars-photos/api/v1/rovers/Curiosity/
        photos?earth_date=2020-'
        . $birthmonth . '-' . $birthday . '&api_key=aQmwVh6jmW441qXrteA6TwCL2foMZTaMsdeDadnb');

        $statusCode = $response->getStatusCode();

        $pictures = ['']; //création variable

        if ($statusCode === 200) {
            $album = $response->toArray();

            $pictures = $album["photos"];
        }
        return $this->twig->render('picsDay.html.twig', [ 'pictures' => $pictures]);
    }
}
