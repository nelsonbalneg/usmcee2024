<?php

namespace App\Http\Controllers\Student;

use App\Models\SchoolName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SchoolNamesController extends Controller
{
    public function index()
    {
        return view('student.schools.index');
    }

    public function getData(Request $request)
    {

        if (!$request->hasHeader('X-Requested-With') || $request->header('X-Requested-With') !== 'XMLHttpRequest') {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $data = SchoolName::select([
            'id',
            'schoolid',
            'school_name',
            'school_address'
        ]);

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $searchValue = $request->get('search')['value'];
                    $query->where('schoolid', 'like', "%{$searchValue}%")
                        ->orWhere('school_name', 'like', "%{$searchValue}%")
                        ->orWhere('school_address', 'like', "%{$searchValue}%");
                }
            })
            // ->rawColumns(['action'])
            ->make(true);
    }
}
