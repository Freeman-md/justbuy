<?php

namespace App\Http\Livewire\User\Profile;

use Livewire\Component;

class UpdateCreditCardInformationForm extends Component
{

    public $creditCard = [
        'digits' => '',
        'expiryDate' => '',
        'authorizationCode' => ''
    ];

    protected $rules = [
        'creditCard.digits' => 'required|numeric|digits:16',
        'creditCard.expiryDate' => 'required|string',
        'creditCard.authorizationCode' => 'required|numeric|digits:3',
    ];

    protected $validationAttributes = [
        'creditCard.digits' => 'digits',
        'creditCard.expiryDate' => 'expiry date',
        'creditCard.authorizationCode' => 'authorization code',
    ];

    public function updateCreditCardInformation() {
        $this->validate();

        auth()->user()->creditCard()->update([
            'digits' => $this->creditCard['digits'],
            'expiry_date' => $this->creditCard['expiryDate'],
            'authorization_code' => $this->creditCard['authorizationCode'],
        ]);

        $this->emit('creditCardInformationUpdated');
    }

    public function render()
    {
        return view('profile.update-credit-card-information-form');
    }
}
