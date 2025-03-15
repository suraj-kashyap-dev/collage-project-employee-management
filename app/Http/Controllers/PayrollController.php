<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('admin.payroll.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();

        $today =today();

        $dates = [];

        for ($i = 1; $i <= $today->daysInMonth; ++$i) {
            $dates[] = $i;
        }
        
        return view('admin.payroll.create', compact('employees','dates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // foreach ($request->employee_id as $index => $employeeId) {
        //     $data = [
        //         'employee_id' => $employeeId,
        //         'basic' => $request->basic[$index],
        //         'house_rent' => $request->house_rent[$index],
        //         'medical' => $request->medical[$index],
        //         'transport' => $request->transport[$index],
        //         'special' => $request->special[$index],
        //         'bonus' => $request->bonus[$index],
        //         'present' => $request->present[$index],
        //         'absent' => $request->absent[$index],
        //         'gross_salary' => $request->gross_salary[$index],
        //         'provident_fund' => $request->provident_fund[$index],
        //         'advanced' => $request->advanced[$index],
        //         'tax' => $request->tax[$index],
        //         'life_insurance' => $request->life_insurance[$index],
        //         'health_insurance' => $request->health_insurance[$index],
        //         'deduction' => $request->deduction[$index],
        //         'net_salary' => $request->net_salary[$index],
        //     ];
    
        //     // Create a new payroll entry
        //     Payroll::create($employees);
        // }
    
        // return redirect()->back()->with('success', 'Payroll data has been saved successfully.');
    }

    public function grossSalary() {
        $employees = Employee::all();

        return view('admin.payroll.gross', compact('employees'));
    }

    public function calculatePayroll(Request $request) {
        if (isset($request->payroll)) {
            foreach ($request->payroll as $employeeId => $payrollData) {
                $currentYear = date('Y');
                $currentMonth = date('m');
                
                if (Employee::whereId($employeeId)->first()) {
                    $data = new Payroll();
                    $data->employee_id = $employeeId;
                    
                    $data->year = $currentYear;
                    $data->month = $currentMonth;
                    
                    $data->basic = $payrollData['basic'];
                    $data->house_rent = $payrollData['house_rent'];
                    $data->medical = $payrollData['medical'];
                    $data->transport = $payrollData['transport'];
                    $data->phone_bill = $payrollData['phone_bill'];
                    $data->internet_bill = $payrollData['internet_bill'];
                    $data->special = $payrollData['special'];
                    $data->days_present = $payrollData['days_present'];
                    $data->days_absent = $payrollData['days_absent'];
                    $data->gross_salary = $payrollData['gross_salary'];
                    $data->provident_fund = $payrollData['provident_fund'];
                    $data->income_tax = $payrollData['income_tax'];
                    $data->life_insurance = $payrollData['life_insurance'];
                    $data->health_insurance = $payrollData['health_insurance'];
                    $data->deduction = $payrollData['deduction'];
                    $data->net_salary = $payrollData['net_salary'];
                    
                    $data->save();
                }
            }
        }

        return back();
    }

    public function sheetReport()
    {
        $employees = Employee::all();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        return view('admin.payroll.report', compact('employees', 'months'));
    }

    public function generateReport(Request $request)
    {
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $employees = Employee::all();
        $salaryData = [];

        if ($selectedYear && $selectedMonth) {
            $salaryData = Payroll::whereIn('employee_id', $employees->pluck('id'))
                ->whereYear('year', $selectedYear)
                ->whereMonth('month', $selectedMonth)
                ->get();
        }


        return view('admin.payroll.report', compact('employees', 'selectedYear', 'selectedMonth', 'salaryData'));
    }
}
