<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    public function Index()
    {
        $expenses = Expense::with('expense_type')->get();
        //return $expenses;
        return view('expenses.index', compact('expenses'));
    }
    public function create()
    {
        $expenses_types = ExpenseType::get();
        return view('expenses.create', compact('expenses_types'));
    }

    public function expenses_type_store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|unique:expense_types,name|max:255',
        ]);

        ExpenseType::create($input);

        return redirect()->back()->with('success', 'Successfully Added Expenses Type');
    }
    public function expenses_store(Request $request)
    {
        $input = $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'description' => 'nullable',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

        Expense::create($input);

        return redirect()->route('expenses.index')->with('success', 'Successfully Added Expenses');
    }


    public function edit($id)
    {
        $expenses_types = ExpenseType::get();
        $expense = Expense::find($id);
        return view('expenses.edit', compact('expenses_types','expense'));
    }
    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'description' => 'nullable',
            'amount' => 'required|integer',
            'date' => 'required|date',
        ]);

       $update_expense= Expense::find($id);
       $update_expense->update($input);

        return redirect()->route('expenses.index')->with('success', 'Successfully Update Expenses');
    }
}
