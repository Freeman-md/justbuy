<?php

namespace App\Http\Livewire\Includes;

use App\Events\FeedbackSent;
use Livewire\Component;

class Feedback extends Component
{

    public $feedback = [
        'name' => '',
        'email' => '',
        'subject' => '',
        'message' => ''
    ];

    protected $rules = [
        'feedback.name' => ['required', 'string', 'max:255'],
        'feedback.email' => ['required', 'string', 'email', 'max:255'],
        'feedback.subject' => ['required', 'string', 'max:1000'],
        'feedback.message' => ['required', 'string'],
    ];

    protected $validationAttributes = [
        'feedback.name' => 'name',
        'feedback.email' => 'email',
        'feedback.subject' => 'subject',
        'feedback.message' => 'message',
    ];

    protected $messages = [
        'feedback.name.required' => 'Please enter your name',
        'feedback.email.required' => 'Please enter your email address',
        'feedback.subject.required' => 'Please enter a subject',
        'feedback.message.required' => 'Please enter a message',
    ];

    public function sendFeedback() {
        $this->validate();

        event(new FeedbackSent($this->feedback));

        $this->emit('sent');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.includes.feedback');
    }
}
