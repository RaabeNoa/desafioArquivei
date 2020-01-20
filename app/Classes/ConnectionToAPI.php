<?php


namespace App\Classes;

class ConnectionToAPI
{
    public function getContent($header = array(), $url)
    {
        try {

            $ch = curl_init($url);

            if (!empty($header)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

            $response = json_decode(curl_exec($ch));

            curl_close($ch);

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $response;
    }
}

?>
