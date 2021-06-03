<?php

namespace App\Http\Livewire;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Livewire\Component;
use Cart;

class Checkout extends Component
{

    public function mount() {
        foreach (Cart::content() as $item) {
            if ($item->model->stock->availability == 'Out of Stock') {
                session()->flash('info', 'Remove products that are out of stock to continue');
                return $this->redirect(route('user-store-cart'));
            }
        }
        
        session()->flash('success', 'Checked out successfully');

        // $this->generateInvoice();
    }

    public function getClient() {
        return new Party([
            'name'          => env('APP_NAME'),
            'address'       => env('SELLER_ADDRESS'),
            'phone'         => env('SELLER_PHONE'),
        ]);
    }

    public function getCustomer() {
        $address = auth()->user()->address;
        return new Party([
            'name'          => $address->fullname,
            'address'       => $address->address.', '.trim($address->city).', '.trim($address->state).'.',
            'phone'         => $address->phone,
            'custom_fields' => [
                'country'   => $address->country,
                'postcode'  => $address->postcode,
            ],
        ]);
    }

    public function createInvoiceItem($item) {
        try {
            return (new InvoiceItem())
                ->title($item->name)
                ->pricePerUnit($item->price)
                ->quantity($item->qty)
                ->discount($item->model->discount_amount)
                ->tax($item->tax)
                ->subTotalPrice(($item->price+$item->tax) * $item->qty);
        } catch (\Exception $e) {
            abort('500', 'An error has occurred');
        }
    }

    public function getInvoiceItems() {
        $items = [];
        foreach (Cart::content() as $item) {
            array_push($items, $this->createInvoiceItem($item));
        }
        return $items;
    }

    public function generateInvoice() {

        $invoice = Invoice::make('receipt')
            ->series('BIG')
            ->sequence(667)
            ->seller($this->getClient())
            ->buyer($this->getCustomer())
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->addItems($this->getInvoiceItems())
            ->save();

        $invoice->save('public');

        $this->emit('success', 'Checked out successfully');


        /*$invoice->download();*/
    }

    public function render()
    {
        $address = auth()->user()->address;
        return view('livewire.checkout', compact('address'));
    }
}
