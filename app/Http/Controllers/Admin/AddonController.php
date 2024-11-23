<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\AddonResource;
use App\Models\Addon;
use App\Models\Setting;
use App\Services\AddonInstallerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddonController extends BaseController
{
    public function index(Request $request)
    {
        $rows = (new Addon)->listAll($request->query('search'));

        return Inertia::render('Admin/Addons/Index', [
            'title' => __('Addons'),
            'rows' => AddonResource::collection($rows), 
            'filters' => $request->all(),
            'config' => Setting::get()
        ]);
    }

    public function store(Request $request)
    {
        $settings = $request->settings;

        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert([
                'key' => $key
            ],[
                'value' => $value,
            ]);
        }

        return redirect('/admin/addons')->with(
            'status', [
                'type' => 'success', 
                'message' => __('Addon updated successfully!')
            ]
        );
    }

    public function install(Request $request)
    {
        $addonInstallerService = new addonInstallerService;

        return $addonInstallerService->install($request);
    }
}