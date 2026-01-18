<?php
namespace App\Repositories\Dashboard\Messages;


interface IMessagesRepository{

    public function getMessages();
    public function countMessages();
    public function getLastThreeMessages();
}
