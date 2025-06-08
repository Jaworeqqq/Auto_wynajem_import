<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;
use App\Models\Car;
use Illuminate\Support\Str;
use Google\Auth\Middleware\AuthTokenMiddleware;
class ImportCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cars from Google Sheets into the cars table';

    public function handle()
    {
        $credentialsPath = config('services.google_sheets.credentials');
        $spreadsheetId   = config('services.google_sheets.spreadsheet_id');
        $range           = config('services.google_sheets.range');

        // 1) Wczytaj i zwaliduj JSON key
        $jsonKey = file_get_contents($credentialsPath);
        $keyData = json_decode($jsonKey, true);
        if (!isset($keyData['client_email'])) {
            $this->error('Nieprawidłowy plik credentials JSON');
            return 1;
        }

        // 2) Autoryzacja i pobranie tokena
        $creds       = new ServiceAccountCredentials(
            ['https://www.googleapis.com/auth/spreadsheets.readonly'],
            $keyData
        );
        $tokenArray  = $creds->fetchAuthToken();
        $accessToken = $tokenArray['access_token'] ?? null;
        if (! $accessToken) {
            $this->error('Brak access_token w odpowiedzi Google');
            return 1;
        }

        // 3) Request do Sheets API
        $client = new Client();
        $response = $client->get(
            "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$range}",
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$accessToken,
                    'Accept'        => 'application/json',
                ],
            ]
        );

        $body   = json_decode((string) $response->getBody(), true);
        $values = $body['values'] ?? [];
        if (count($values) < 2) {
            $this->warn('Brak danych w arkuszu.');
            return 0;
        }

        $headers = array_shift($values);
        $rows    = array_map(fn($r) => array_combine($headers, $r), $values);

        // 4) Import do bazy
        $googleIds = [];
        foreach ($rows as $row) {
            $id = $row['id'] ?? null;
            if (! $id) continue;
            $googleIds[] = $id;

            Car::updateOrCreate(
                ['google_id' => $id],
                [
                    'brand'           => $row['brand']           ?? null,
                    'model'           => $row['model']           ?? null,
                    'year'            => $row['year']            ?? null,
                    'price_per_month' => $row['price_per_month'] ?? null,
                    'fuel'            => $row['fuel']            ?? null,
                    'transmission'    => $row['transmission']    ?? null,
                    'segment'         => $row['segment']         ?? null,
                    'specs'           => isset($row['specs'])
                        ? json_encode(['specs' => $row['specs']])
                        : null,
                    'images'          => isset($row['images'])
                        ? json_encode(explode(',', $row['images']))
                        : null,
                    'slug'            => Str::slug("{$row['brand']} {$row['model']} {$row['year']}"),
                ]
            );
        }

        Car::whereNotIn('google_id', $googleIds)->delete();

        $this->info('Import zakończony. Zaimportowano '.count($googleIds).' rekordów.');
        return 0;
    }

}
