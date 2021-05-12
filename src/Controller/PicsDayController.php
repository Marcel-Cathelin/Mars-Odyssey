<?php

namespace App\Controller;

use App\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

use function Amp\Iterator\toArray;

class PicsDayController extends AbstractController
{

    public function form()
    {
        return $this->twig->render('form.html.twig');
    }


    public function picsDay()
    {



        $birthday = $_POST['jour'];
        $birthmonth = $_POST['mois'];


         $client = HttpClient::create(); //requête API
            $url = 'https://api.nasa.gov/mars-photos/api/v1/rovers/Curiosity/'
            . 'photos?earth_date=2020-'
            . $birthmonth . '-' . $birthday . '&api_key=aQmwVh6jmW441qXrteA6TwCL2foMZTaMsdeDadnb';

            $response = $client->request('GET', $url);

        $statusCode = $response->getStatusCode();

        $pictures = ['']; //création variable

        if ($statusCode === 200) {
            $album = $response->toArray();

            $pictures = $album["photos"];
        }
        return $this->twig->render('picsDay.html.twig', [ 'pictures' => $pictures]);
    }
}
