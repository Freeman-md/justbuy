<?php

namespace App\Http\Livewire\User\Profile;

use Livewire\Component;

class UpdateBillingAddressForm extends Component
{

    public $address;

    protected $rules = [
        'address.fullname' => 'required|string|min:8|max:40',
        'address.country' => 'required|string',
        'address.address' => 'required|string',
        'address.state' => 'required|string',
        'address.city' => 'required|string',
        'address.postcode' => 'required|numeric',
        'address.phone' => 'required|numeric|integer'
    ];

    protected $validationAttributes = [
        'address.fullname' => 'fullname',
        'address.country' => 'country',
        'address.address' => 'address',
        'address.state' => 'state',
        'address.city' => 'city',
        'address.postcode' => 'postcode',
        'address.phone' => 'phone'
    ];

    public function mount() {
        $this->address = is_null(auth()->user()->address) ? [
            'fullname' => '',
            'country' => '',
            'address' => '',
            'state' => '',
            'city' => '',
            'postcode' => '',
            'phone' => ''
        ] : auth()->user()->address->toArray();
    }

    public function updateAddressInformation() {
        $this->validate();

        auth()->user()->address()->update([
            'fullname' => $this->address['fullname'],
            'country' => $this->address['country'],
            'address' => $this->address['address'],
            'state' => $this->address['state'],
            'city' => $this->address['city'],
            'postcode' => $this->address['postcode'],
            'phone' => $this->address['phone'],
        ]);

        $this->emit('billingAddressUpdated');
    }

    public function render()
    {
        return view('profile.update-billing-address-form');
    }
}
