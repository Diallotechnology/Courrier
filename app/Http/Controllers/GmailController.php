<?php

namespace App\Http\Controllers;

use Google\Client;
use Google_Client;
use Google\Service;
use Google\Service\Gmail;
use Google_Service_Gmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PulkitJalan\Google\Facades\Google;

class GmailController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function authenticate()
    {
        $gmail = Google::make('Gmail');
        $authUrl = $gmail->getClient()->createAuthUrl();
        return redirect()->away($authUrl);
    }




        /**
     * List Gmail messages for the authenticated user.
     */
    public function listMessages()
    {
        $gmail = Google::make('Gmail');

        $code = $_GET['code'];
        $token = $gmail->getClient()->fetchAccessTokenWithAuthCode($code);
        $accessToken = $token['access_token'];
        $gmail->getClient()->setAccessToken($accessToken);

        // Retrieve messages
        $messages = $gmail->users_messages->listUsersMessages('me');
        $messageIds = $messages->getMessages();
        $messageDetails = [];

        foreach ($messageIds as $messageId) {
            $message = $gmail->users_messages->get('me', $messageId->getId(), ['format' => 'full']);

            $messageDetail = [
                'id' => $messageId->getId(),
                'subject' => '',
                'from' => '',
                'date' => '',
                'snippet' => '',
                'body' => ''
            ];

            foreach ($message->getPayload()->getHeaders() as $header) {
                if ($header->getName() === 'Subject') {
                    $messageDetail['subject'] = $header->getValue();
                } elseif ($header->getName() === 'Date') {
                    $messageDetail['date'] = $header->getValue();
                }
            }

            $messageDetail['snippet'] = $message->getSnippet();
            $messageDetails[] = $messageDetail;
        }

        $rows = new Collection($messageDetails);
    //    \dd($rows);
        return view('backup', compact('rows'));
    }

                // Retrieve the body of the message
            // $parts = $message->getPayload()->getParts();
            // if (count($parts) > 0 && $parts[0]['body'] && $parts[0]['body']->getData()) {
            //     $rawData = $parts[0]['body']->getData();
            //     $sanitizedData = strtr($rawData, '-_', '+/');
            //     $decodedMessage = base64_decode($sanitizedData);

            //     $messageDetail['body'] = $decodedMessage;
            // }
}
