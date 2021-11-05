<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function contract(Request $request)
    {
        $request->validate(
            [
                'privacy_policy' => 'required',
                'account_contracts' => 'required',
                'distance_sales_agreement' => 'required',
                'illumination_and_consent_text' => 'required',
                'return_conditions' => 'required',
            ],
            [
                'privacy_policy.required' => __('words.privacy-policy-required'),
                'account_contracts.required' => __('words.account-contracts-required'),
                'distance_sales_agreement.required' => __('words.distance-sales-agreement-required'),
                'illumination_and_consent_text.required' => __('words.illumination-and-consent-text-required'),
                'return_conditions.required' => __('words.return-conditions-required'),
            ]
        );
        $contracts = [
            'privacy_policy' => $request->privacy_policy,
            'account_contracts' => $request->account_contracts,
            'distance_sales_agreement' => $request->distance_sales_agreement,
            'illumination_and_consent_text' => $request->illumination_and_consent_text,
            'return_conditions' => $request->return_conditions,
        ];
        setting($contracts)->save();
        return back()->with('success', 'başarılı lo');
    }
}
