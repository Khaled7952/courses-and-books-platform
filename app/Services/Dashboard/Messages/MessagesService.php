<?php
namespace App\Services\Dashboard\Messages;

use App\Repositories\Dashboard\Messages\IMessagesRepository;

class MessagesService implements  IMessagesService {

    protected $iMessageRepository;

    public function __construct(IMessagesRepository $iMessageRepository)
    {
        $this->iMessageRepository = $iMessageRepository;
    }

  public function getMessages() {

    return $this->iMessageRepository->getMessages();
  }

  public function countMessages(){

    return $this->iMessageRepository->countMessages();
  }

  public function getLastThreeMessages() {
    return $this->iMessageRepository->getLastThreeMessages();
  }


}
