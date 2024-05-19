<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        // $manager = $request->input('manager');
        // $pemohon = $request->input('pemohon');

        $reservations = Reservation::query()
            ->when($search, function ($query, $search) {
                $query->where('event', 'like', '%'.$search.'%')
                    ->orWhere('reservation_start', 'like', '%'.$search.'%')
                    ->orWhere('reservation_end', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                                $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                            });
                    });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            // ->when($manager, function ($query, $manager) {
            //     $query->whereHas('facility', function ($facilityQuery) use ($manager) {
            //         $facilityQuery->whereHas('ukerMaster', function ($ukerQuery) use ($manager) {
            //             $ukerQuery->where('nama_unit_kerja_eselon_2', $manager);
            //         });
            //     });
            // })
            // ->when($pemohon, function ($query, $pemohon) {
            //     $query->whereHas('user', function ($userQuery) use ($pemohon) {
            //         $userQuery->whereHas('ukerMaster', function ($ukerQuery) use ($pemohon) {
            //             $ukerQuery->where('nama_unit_kerja_eselon_2', $pemohon);
            //         });
            //     });
            // })
            ->get();

        $events = [];

        foreach ($reservations as $reservation) {
            $events[] = [
                'id' => $reservation->id, // Unique identifier
                'title' => $reservation->event,
                'start' => $reservation->reservation_start->toDateTimeString(),
                'end' => $reservation->reservation_end->toDateTimeString(),
                'status' => $reservation->status,
                'uker' => $reservation->user->ukerMaster->nama_unit_kerja_eselon_2, // Additional field
                'color' => $reservation->status == 'pending' ? '#857e05' : ($reservation->status == 'rejected' ? '#b00e13' : '#324729'),
                'facility' => $reservation->facility->name . ', ' . $reservation->facility->facilityCategory->category_str
                // Add more fields as needed
            ];
        }

        return view('events.index', compact('events'));
    }
    public function landingIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        // $manager = $request->input('manager');
        // $pemohon = $request->input('pemohon');

        $reservations = Reservation::query()
            ->when($search, function ($query, $search) {
                $query->where('event', 'like', '%'.$search.'%')
                    ->orWhere('reservation_start', 'like', '%'.$search.'%')
                    ->orWhere('reservation_end', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhereHas('ukerMaster', function ($ukerQuery) use ($search) {
                                $ukerQuery->where('nama_unit_kerja_eselon_2', 'like', '%'.$search.'%');
                            });
                    });
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            // ->when($manager, function ($query, $manager) {
            //     $query->whereHas('facility', function ($facilityQuery) use ($manager) {
            //         $facilityQuery->whereHas('ukerMaster', function ($ukerQuery) use ($manager) {
            //             $ukerQuery->where('nama_unit_kerja_eselon_2', $manager);
            //         });
            //     });
            // })
            // ->when($pemohon, function ($query, $pemohon) {
            //     $query->whereHas('user', function ($userQuery) use ($pemohon) {
            //         $userQuery->whereHas('ukerMaster', function ($ukerQuery) use ($pemohon) {
            //             $ukerQuery->where('nama_unit_kerja_eselon_2', $pemohon);
            //         });
            //     });
            // })
            ->get();

        $events = [];

        foreach ($reservations as $reservation) {
            $events[] = [
                'id' => $reservation->id, // Unique identifier
                'title' => $reservation->event,
                'start' => $reservation->reservation_start->toDateTimeString(),
                'end' => $reservation->reservation_end->toDateTimeString(),
                'status' => $reservation->status,
                'uker' => $reservation->user->ukerMaster->nama_unit_kerja_eselon_2, // Additional field
                'color' => $reservation->status == 'pending' ? '#857e05' : ($reservation->status == 'rejected' ? '#b00e13' : '#324729'),
                'facility' => $reservation->facility->name . ', ' . $reservation->facility->facilityCategory->category_str
                // Add more fields as needed
            ];
        }

        return view('landing.content.calendar', compact('events'));
    }
}