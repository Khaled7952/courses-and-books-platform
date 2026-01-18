<?php
namespace App\Services\Dashboard\Messages;

interface IMessagesService {

    public function getMessages();
    public function countMessages();
    public function getLastThreeMessages();
}
