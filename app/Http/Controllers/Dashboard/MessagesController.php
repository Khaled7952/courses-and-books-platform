<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\Messages\IMessagesService;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $iMessageService;

    public function __construct(IMessagesService $iMessageService)
    {
        $this->iMessageService = $iMessageService;
  }
    public function index() {
        $messages =  $this->iMessageService->getMessages();
        return view('dashboard.messages.index' , compact('messages'));
    }




}
