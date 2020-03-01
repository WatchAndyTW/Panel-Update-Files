<?php

namespace Pterodactyl\Http\Controllers\Base;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AnnouncementsController extends Controller
{
    /**
     * AnnouncementsController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $announcements = DB::table('announcements')->orderBy('updated_at', 'DESC')->paginate(5);

        return view('base.announcements', [
            'announcements' => $announcements
        ]);
    }
}
