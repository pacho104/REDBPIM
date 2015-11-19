<?php namespace App;

use App\Http\Controllers\MensajeController;
use DateTime;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use pmill\Chat\ConnectedClient;
use pmill\Chat\Interfaces\ConnectedClientInterface;
use Ratchet\ConnectionInterface;
use App\Mensaje;

class MensajeSala extends Chat {


     protected function makeUserWelcomeMessage(ConnectedClientInterface $client, $timestamp)
    {

        return vsprintf('Bienvenido %s!', array($client->getName()));
    }

    protected function makeUserConnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s se ha unido a la sala', array($client->getName()));
    }

    protected function makeUserDisconnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s ha salido de la sala', array($client->getName()));
    }

    protected function makeMessageReceivedMessage(ConnectedClientInterface $from, $message, $timestamp)
    {

        return $message;
    }

    /**
     * @param ConnectedClientInterface $from
     * @param $roomId
     * @param string $message
     * @param int $timestamp
     */
    protected function logMessageReceived(ConnectedClientInterface $from,$roomId,$message,$timestamp)
    {

        /** save messages to a database, etc... */


    }

    protected function createClient(ConnectionInterface $conn, $name)
    {
        $client = new ConnectedClient;
        $client->setResourceId($conn->resourceId);
        $client->setConnection($conn);
        $client->setName($name);

        return $client;
    }

}
