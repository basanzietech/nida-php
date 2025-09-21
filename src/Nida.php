<?php

namespace Nida;

use GuzzleHttp\Client;
use Exception;

class Nida
{
    private string $BASE_URL = "https://ors.brela.go.tz/um/load/load_nida/%s";
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                "Content-Type" => "application/json",
                "Content-Length" => "0",
                "Connection" => "keep-alive",
                "Accept-Encoding" => "gzip, deflate, br"
            ]
        ]);
    }

    /**
     * Fetch user data from NIDA
     */
    public function loadUser(string $nationalId, bool $asJson = false)
    {
        try {
            $response = $this->client->post(sprintf($this->BASE_URL, $nationalId));
            $data = json_decode($response->getBody(), true);

            if (isset($data["obj"]["result"])) {
                $userData = $data["obj"]["result"];
                return $asJson ? $userData : $this->preprocessUserData($userData);
            }

            return null;
        } catch (Exception $e) {
            throw new Exception("Connection error: " . $e->getMessage());
        }
    }

    /**
     * Process user data (capitalize keys + decode images)
     */
    private function preprocessUserData(array $userData): array
    {
        $capitalized = [];
        foreach ($userData as $key => $value) {
            $capitalized[ucfirst(strtolower($key))] = $value;
        }

        if (isset($capitalized["Photo"])) {
            $capitalized["Photo"] = $this->decodeImage($capitalized["Photo"]);
        }
        if (isset($capitalized["Signature"])) {
            $capitalized["Signature"] = $this->decodeImage($capitalized["Signature"]);
        }

        return $capitalized;
    }

    /**
     * Decode base64 image and save it locally
     */
    private function decodeImage(string $base64): ?string
    {
        try {
            $imageData = base64_decode($base64);
            $filePath = sys_get_temp_dir() . '/' . uniqid("nida_", true) . ".png";
            file_put_contents($filePath, $imageData);
            return $filePath;
        } catch (Exception $e) {
            return null;
        }
    }
}