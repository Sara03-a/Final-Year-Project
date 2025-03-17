<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Quote;
use App\Models\Measurement;

class CustomerSearch extends Component
{
    public $search = '';
    public $customers;
    public $perPage = 10;
    public $editingCustomerId = null;
    
    protected $queryString = ['search'];
    
    protected $listeners = ['refreshCustomers' => '$refresh'];
    
    public function mount()
    {
        $this->customers = collect();
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = User::query()
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('addresses', function($q) {
                          $q->where('street_address', 'like', '%' . $this->search . '%')
                            ->orWhere('city', 'like', '%' . $this->search . '%');
                      });
            })
            ->where('usertype', 'user')
            ->with(['quotes', 'measurements', 'addresses']);
            
        $this->customers = $query->paginate($this->perPage);
        
        return view('livewire.admin.customer-search', [
            'customers' => $this->customers
        ]);
    }
    
    public function edit($customerId)
    {
        $this->editingCustomerId = $customerId;
        return redirect()->route('admin.customers.edit', ['id' => $customerId]);
    }

    public function delete($customerId)
    {
        $customer = User::findOrFail($customerId);
        $customer->quotes()->delete();
        $customer->measurements()->delete();
        $customer->addresses()->delete();
        $customer->delete();
        
        session()->flash('message', 'Customer deleted successfully.');
        $this->emit('refreshCustomers');
    }
}