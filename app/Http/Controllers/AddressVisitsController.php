<?php

namespace App\Http\Controllers;

use App\Models\AddressVisits;
use Illuminate\Http\Request;

class AddressVisitsController extends Controller
{
    public function addAddressVisit(Request $request) {
        $validateVisit = $request->validate([
            'address_data_id' => 'required|integer',
            'doorknock_response_id' => 'required|integer',
            'response_explanation' => 'required|string|max:255',            
            'user_id' => 'required|integer'
            ]
        );

        $visit = AddressVisits::create([
            'address_data_id' => $validateVisit['address_data_id'],
            'doorknock_response_id' => $validateVisit['doorknock_response_id'],
            'response_explanation' => $validateVisit['response_explanation'],            
            'user_id' => $validateVisit['user_id']
        ]);

        return $visit;
    }
    //TODO later
    public function editAddressVisit(Request $request, $vistId) {
        $validateVisit = $request->validate([
            'address_data_id' => 'required|integer',
            'doorknock_response_id' => 'required|integer',
            'response_explanation' => 'required|string|max:255',            
            'user_id' => 'required|integer'
            ]
        );

        $visit = AddressVisits::where('id', intval($vistId))->first()->update([
            'address_data_id' => $validateVisit['address_data_id'],
            'doorknock_response_id' => $validateVisit['doorknock_response_id'],
            'response_explanation' => $validateVisit['response_explanation'],            
            'user_id' => $validateVisit['user_id']
        ]);

        return $visit;
    }

    public function getLatestAddressVisit($vistId) {
        $visit = AddressVisits::where('id', intval($vistId))->lastest()->get();

        return $visit;
    }

    public function getAllAddressVisitForData($dataId) {
        $visit = AddressVisits::where('address_data_id', intval($dataId))->lastest()->get();

        return $visit;
    }
}
