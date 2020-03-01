<?php
/**
 * Pterodactyl - Panel
 * Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com>.
 *
 * This software is licensed under the terms of the MIT license.
 * https://opensource.org/licenses/MIT
 */

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prologue\Alerts\AlertsMessageBag;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnnouncementsController extends Controller
{
    /**
     * @var \Prologue\Alerts\AlertsMessageBag
     */
    protected $alert;

    /**
     * LocationController constructor.
     *
     * @param \Prologue\Alerts\AlertsMessageBag $alert
     */
    public function __construct(AlertsMessageBag $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Return the location overview page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $announcements = DB::table('announcements')->orderBy('updated_at', 'DESC')->get();

        return view('admin.announcements.list', [
            'announcements' => $announcements
        ]);
    }

    public function create()
    {
        return view('admin.announcements.new');
    }

    public function edit($id)
    {
        $id = (int) $id;

        $announcement = DB::table('announcements')->where('id', '=', $id)->get();
        if (count($announcement) < 1) {
            $this->alert->danger('找不到公告！')->flash();
            return redirect()->route('admin.announcements');
        }

        return view('admin.announcements.edit', [
            'announcement' => $announcement[0]
        ]);
    }

    public function new(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required'
        ]);

        $title = trim(strip_tags($request->input('title')));
        $body = trim($request->input('body'));

        DB::table('announcements')->insert([
            'title' => $title,
            'body' => $body,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $this->alert->success('您已經成功建立了一個公告')->flash();

        return redirect()->route('admin.announcements');
    }

    public function update(Request $request, $id)
    {
        $id = (int) $id;

        $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required'
        ]);

        $title = trim(strip_tags($request->input('title')));
        $body = trim($request->input('body'));

        $isset = DB::table('announcements')->where('id', '=', $id)->get();
        if (count($isset) < 1) {
            $this->alert->danger('找不到公告！')->flash();
            return redirect()->route('admin.announcements.edit', $id);
        }

        DB::table('announcements')->where('id', '=', $id)->update([
            'title' => $title,
            'body' => $body,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $this->alert->success('您已經成功建立了一個公告')->flash();

        return redirect()->route('admin.announcements');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $id = (int) $request->input('id');

        $isset = DB::table('announcements')->where('id', '=', $id)->get();
        if (count($isset) < 1) {
            return response()->json(['success' => false, 'error' => 'Announcement not found!']);
        }

        DB::table('announcements')->where('id', '=', $id)->delete();

        return response()->json(['success' => true]);
    }
}
