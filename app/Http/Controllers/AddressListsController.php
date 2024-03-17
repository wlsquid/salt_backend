<?php

namespace App\Http\Controllers;

use App\Models\AddressLists;
use Illuminate\Http\Request;

class AddressListsController extends Controller
{
    public function createAddressList(Request $request) {
        $validateAddressList = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $addressList = AddressLists::create([
            'name' => $validateAddressList['name']
        ]);

        
        return $addressList;
    }

    public function getAddressLists() {
        $addressLists = AddressLists::where('archived', 0)->get();

        return $addressLists;
    }
    // TODO: look into soft deletes
    public function archiveAddressList(Request $request) {    
        $addressList = AddressLists::where('id', $request["id"])->first();

        $update = $addressList->update(["archived" => 1]);

        return $update;
    }
}
