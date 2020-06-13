<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function index(){
        return [
            'read' => NotificationResource::collection(auth()->user()->readNotifications()->get()),
            'unread' => NotificationResource::collection(auth()->user()->unReadNotifications()->get()),
        ];
    }

    public function markAsRead(Request $request){
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}
