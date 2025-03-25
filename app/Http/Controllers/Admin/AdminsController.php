<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public function index(Request $request): View
    {
        $admins = Admin::paginate(20);
        return view('admin.admins.index', compact('admins'));
    }

    public function store(AdminStoreRequest $request): RedirectResponse
    {
        $data = $request->safe()->only(['name', 'email', 'active']);
        $data['active'] = $data['active'] ?? false;
        $data['password'] = Hash::make($request->password);
        if (is_file($request->profile_pic)) {
            $data['profile_pic'] = $request->profile_pic->store('admins');
        }
        $admin = Admin::create($data);
        notyf()->addSuccess(__('Successfully created.'));

        return redirect()->route('admin.admins.index');
    }

    public function edit(Admin $admin)
    {
        return response()->json($admin);
    }

    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $data = $request->safe()->only(['name', 'email', 'active']);
        $data['active'] = $data['active']??false;
        if(is_file($request->profile_pic)) {
            $data['profile_pic'] = $request->profile_pic->store('admins');
            if($admin->profile_pic)
                File::delete(storage_path('app/public/' . $admin->profile_pic));
        }
        if($request->has('password') && !empty($request->password))
            $data['password'] = Hash::make($request->password);
        $admin->update($data);
        notyf()->addSuccess(__('Successfully updated.'));
        if ($request->expectsJson()) {
            return response()->json(['message' => __('Successfully updated.'), 'redirect' => route('admin.admins.index')]);
        }
        return redirect()->route('admin.admins.index');
    }

    public function destroy(Request $request, Admin $admin): RedirectResponse
    {
        if (auth()->guard('admin')->id() == $admin->id)
            notyf()->addError(__('You can not delete your own account.'));
        else {
            if($admin->profile_pic)
                File::delete(storage_path('app/public/' . $admin->profile_pic));
            $admin->delete();
            notyf()->addSuccess(__('Successfully deleted.'));
        }

        return redirect()->route('admin.admins.index');
    }
}
