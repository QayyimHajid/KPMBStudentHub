<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;

class StudentAnnouncementEventController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $publishedAnnouncements = Announcement::query()
            ->where('status', 'published')
            ->whereDate('date_published', '<=', $today);

        $upcomingEvents = Event::query()
            ->whereDate('event_date', '>=', $today);

        $activeAnnouncementsCount = (clone $publishedAnnouncements)->count();
        $monthlyEventsCount = (clone $upcomingEvents)
            ->whereYear('event_date', now()->year)
            ->whereMonth('event_date', now()->month)
            ->count();

        $featuredAnnouncement = (clone $publishedAnnouncements)
            ->orderByDesc('date_published')
            ->first();

        $featuredEvent = (clone $upcomingEvents)
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->first();

        $announcements = (clone $publishedAnnouncements)
            ->orderByDesc('date_published')
            ->paginate(5, ['*'], 'announcements_page')
            ->withQueryString();

        $events = (clone $upcomingEvents)
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->paginate(5, ['*'], 'events_page')
            ->withQueryString();

        $calendarEvents = (clone $upcomingEvents)
            ->whereYear('event_date', now()->year)
            ->whereMonth('event_date', now()->month)
            ->get(['event_id', 'event_name', 'event_date']);

        return view('student.announcements-events', compact(
            'announcements',
            'events',
            'activeAnnouncementsCount',
            'monthlyEventsCount',
            'featuredAnnouncement',
            'featuredEvent',
            'calendarEvents'
        ));
    }
}
