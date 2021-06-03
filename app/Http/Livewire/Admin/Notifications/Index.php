<?php

namespace App\Http\Livewire\Admin\Notifications;

use Livewire\Component;

class Index extends Component
{
    public $unreadNotifications, $notifications;

    protected $listeners = ['readNotifications'];

    public function readNotifications() {
        $this->markAllAsRead();
    }

    public function mount() {
        $this->unreadNotifications = auth()->user()->unreadNotifications;
        $this->notifications = auth()->user()->notifications;
    }

    public function markAllAsRead() {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.admin.notifications.index');
    }
}
