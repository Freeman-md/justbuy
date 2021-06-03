<?php

namespace App\Http\Livewire\Includes;

use App\Events\Subscribed;
use App\Models\Subscriber;
use Livewire\Component;

class Subscribe extends Component
{

    public $subscriber = [
        'email' => ''
    ];

    public $rules = [
        'subscriber.email' => ['required', 'string', 'email', 'unique:subscribers,email', 'max:255']
    ];

    protected $messages = [
        'subscriber.email.required' => 'Please enter your email address.'
    ];

    protected $validationAttributes = [
        'subscriber.email' => 'email'
    ];

    public function subscribe() {
        $this->validate();

        // Create new subscriber
        Subscriber::create(['email' => $this->subscriber['email']]);

        // Call/Emit event
        event(new Subscribed($this->subscriber['email']));

        $this->emit('subscribed');

        $this->reset();

    }

    public function render()
    {
        return view('livewire.includes.subscribe');
    }
}
