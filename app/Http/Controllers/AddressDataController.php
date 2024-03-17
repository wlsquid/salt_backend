<?php

namespace App\Http\Controllers;

use App\Models\AddressData;
use Illuminate\Http\Request;

class AddressDataController extends Controller
{   
    // TODO: add more validation
    public function importAddressDataFromCSV(Request $request) {
        $file = $request->file('file');
        $addressListId = $request["addressListId"];
        if(!$file) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $fileContents = file($file->getPathname());
        $i = 0;
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            if ($i < 1 && ($data[0] != 'address' || $data[1] != 'postcode')) {
                return response()->json([
                    'error' => true,
                    'message' => 'Inavlid csv format',
                ], 401);
            }
            if ($i > 0) {
                //more optimized way to do this or with transactions but this is fine
                AddressData::create([
                    'address' => $data[0],
                    'postcode' => $data[1],
                    'address_list_id' => $addressListId
                ]);
            }
            $i++;
        }

        return response()->json([
            'success' => true,
            'message' => 'CSV import successful',
        ]);
    }
    
    public function updateAddressData(Request $request, $dataId) {
        
        $validateAddressData = $request->validate([
            'address' => 'required|string|max:255',
            'postcode' => 'required|integer',
            'name' => 'string|max:255|nullable',
            'contact_phone' => 'string|max:255|nullable',
            'landlord' => 'string|max:255|nullable',
            'issues' => 'string|nullable',
            'support_level_explanation' => 'string|max:255|nullable',
            'interested_in' => 'string|max:255|nullable',
            'support_level_id' => 'integer|nullable'            
        ]);
        // TODO handle error if no address data found with id
        $updateData = AddressData::where('id', intval($dataId))->first()->update(
            [
            'address' => $validateAddressData['address'],
            'postcode' => $validateAddressData['postcode'],
            'name' => $validateAddressData['name'],
            'contact_phone' => $validateAddressData['contact_phone'],
            'landlord' => $validateAddressData['landlord'],
            'issues' => $validateAddressData['issues'],
            'support_level_explanation' => $validateAddressData['support_level_explanation'],
            'interested_in' => $validateAddressData['interested_in'],
            'support_level_id' => $validateAddressData['support_level_id']
            ]
        );
        
        return $updateData;
    }

    public function getAddressDataForList($listId) {
        // TODO: THIS IS WRONG need to put operators in
        $addressLists = AddressData::where([
            ['archived', '=', 0],
            ['address_list_id', '=', $listId]
        ])->get();

        return $addressLists;
    }

    //TODO gonna check soft deletes first tho
    public function archiveAddressData(Request $request) {
        
    }
}
