<?php

namespace App\Http\Controllers;

use App\Models\PatienRegistration;
use App\Models\Transaction;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($id)
    {
        // Fetch the registration data with related models
        $registration = PatienRegistration::with(['patient', 'insurance', 'service_room'])->where('id', $id)->first();
        $transactions = Transaction::with(['treatment'])
            ->where('patien_registration_id', $id)
            ->get();
        $treatments = Treatment::all();

        // Pass the data to the view
        return view('registration.transaction.index', compact('registration', 'transactions', 'treatments'));
    }

    public function store(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'treatment_id' => 'required|exists:treatments,id',
            'amount' => 'required|numeric|min:0',
        ]);

        // Create a new transaction
        Transaction::create([
            'patien_registration_id' => $id,
            'treatment_id' => $validatedData['treatment_id'],
            'amount' => $validatedData['amount'],
            'user_id' => auth()->user()->id,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Transaction created successfully.');
    }

    public function update(Request $request, $transId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'treatment_id' => 'required|exists:treatments,id',
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the transaction and update it
        $transaction = Transaction::findOrFail($transId);
        $transaction->update([
            'treatment_id' => $validatedData['treatment_id'],
            'amount' => $validatedData['amount'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    public function destroy($transId)
    {
        // Find the transaction and delete it
        $transaction = Transaction::findOrFail($transId);
        $transaction->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}
