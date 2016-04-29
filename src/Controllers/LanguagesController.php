<?php namespace HeppyKarlsson\ETrans\Controllers;

use File;
use GuzzleHttp\Client;

class LanguagesController
{

    public function install($language) {
        $guzzle = new Client();

        $endpoint = config('etrans.server-endpoint', 'http://etrans.elicitdemo.se');

        $response = $guzzle->request(
            'get',
            $endpoint . '/api/language/' . $language
        );

        $groups = json_decode($response->getBody());

        foreach($groups as $group) {
            $translationsList = [];
            $response = $guzzle->request(
                'get',
                $endpoint . '/api/language/' . $language . "/" . $group
            );

            $translations = json_decode($response->getBody());
            foreach($translations as $translation) {
                $translationsList[$translation->item] = $translation->text;
            }

            $languageFolder = base_path('resources/lang/' . $language);

            // Check if language folder exists
            if(!File::exists($languageFolder)) {
                mkdir($languageFolder);
            }

            // Create a etrans file for each category.
            $newFile = $languageFolder . '/etrans_' . $group . ".php";
            if(file_exists($newFile)) {
                $old_array = include($newFile);
                $translationsList = array_merge($translationsList, $old_array);
            }

            file_put_contents($newFile, "<?php return " . var_export($translationsList, true) . ";");
        }
    }

}