<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.users.index");
    }

    public function getallUsers(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::select(columns: ['id', 'firstname', 'lastname', 'middlename', 'suffix', 'email', 'phone', 'status', 'role', 'created_at']);
            $cacheKey = 'users_data_page_' . request('page', 1); // Cache key based on page
            $data = Cache::remember($cacheKey, now()->addMinutes(60), function () {
                return User::select([
                    'id',
                    'firstname',
                    'lastname',
                    'middlename',
                    'suffix',
                    'email',
                    'phone',
                    'status',
                    'role',
                    'created_at'
                ])->get();
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->id === Auth::user()->id) {
                        return ' <div class="flex gap-3">
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a  class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                    </div>';
                    } else {
                        return ' <div class="flex gap-3">
                        <a data-id=' . $row->id . ' class="view-detail flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="eye" class="inline-block size-3"></i> </a>
                        <a data-id=' . $row->id . '  class="edit-entry flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 edit-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="pencil" class="size-4"></i></a>
                        <a href=' . route('admin.user.destroy', $row->id) . ' class="delete-entry flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 remove-item-btn bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><i data-lucide="trash-2" class="size-4"></i></a>
                    </div>';
                    }
                })

                ->addColumn('status', function ($query) {
                    if ($query->status == 'active') {
                        $button = '<span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status"><i data-lucide="check-circle" class="size-3 mr-1.5"></i> Active</span>';
                    } else if ($query->status == 'inactive') {

                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status"><i data-lucide="loader" class="size-3 mr-1.5"></i> In Active</span>';
                    } else {
                        $button = '<span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status"><i data-lucide="x" class="size-3 mr-1.5"></i> Suspended</span>';
                    }
                    return $button;
                })
                ->addColumn('name', function ($query) {
                    $mname = $query->middlename ? substr($query->middlename, 0, 1) : '';
                    $fullname = $query->lastname . ', ' . $query->firstname . ' ' . $mname . ' ' . $query->suffix;

                    $profile = '<div class="flex items-center gap-2">
                                                        <div class="flex items-center justify-center font-medium rounded-full size-10 shrink-0 bg-slate-200 text-slate-800 dark:text-zink-50 dark:bg-zink-600">
                                                            <img src="./assets/images/avatar-2.png" alt="" class="h-10 rounded-full">
                                                        </div>
                                                        <div class="grow">
                                                            <h6 class="mb-1"><a href="#!" class="name">' . $fullname . '</a></h6>
                                                            <p class="text-slate-500 dark:text-zink-200">' . $query->role . '</p>
                                                        </div>
                                                    </div>';
                    return $profile;
                })
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        // In case of a non-AJAX request, return an error or appropriate response.
        return response()->json(['error' => 'Invalid request'], 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->suffix = $request->suffix;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget('users_data_page_1');

        // Return a response
        return response()->json([
            'success' => true,
            'message' => 'New user added successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
