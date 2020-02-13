<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Setting;
use App\VKApi;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index')->with([
            'settings' => Setting::where('user_id', Auth::id())->get(),
        ]);
    }

    public function create()
    {
        return view('backend.setting.create');
    }

    public function edit(Request $request, $id)
    {
        return view('backend.setting.edit')->with('setting', Setting::find($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'confirmation_token' => 'required|max:255',
            'secret_key' => 'required|max:255',
            'vk_url_group' => 'required|max:255',
        ]);

        $path = parse_url($request->input('vk_url_group'))['path'];
        $group_name = array_filter(explode('/', $path));
        $group_name = reset($group_name);
        try {
            $group_info = VKApi::groupsGetById($group_name);
        } catch (\Exception $e) {
            return back()->withErrors('Не корректно указана ссылка на группу')->withInput();
        }

        $setting = Setting::create([
            'user_id' => Auth::id(),
            'confirmation_token' => $request->input('confirmation_token'),
            'secret_key' => $request->input('secret_key'),
            'access_token' => $request->input('access_token'),
            'vk_id_group' => $group_info[0]['id'],
            'name' => $group_info[0]['name'],
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Настройки сохранены');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'confirmation_token' => 'required|max:255',
            'secret_key' => 'required|max:255',
            'access_token' => 'required|max:255',
            'vk_url_group' => 'required|max:255',
        ]);

        $setting = Setting::find($id);
        $setting->update([
            'confirmation_token' => $request->input('confirmation_token'),
            'secret_key' => $request->input('secret_key'),
            'access_token' => $request->input('access_token'),
            'vk_id_group' => $request->input('vk_url_group'),
        ]);

        return redirect()->route('admin.setting.index')->with('success', 'Настройки сохранены');
    }

    public function destroy($id)
    {
        Setting::destroy($id);

        return redirect()->route('admin.setting.index')->with('success', 'Группа удалена');
    }
}
