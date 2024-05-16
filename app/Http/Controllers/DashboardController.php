<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityCategory;
use App\Models\Reservation;
use App\Models\SatkerMaster;
use App\Models\UkerMaster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $facilityCategories = FacilityCategory::all();
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(20);

        // Calculate time differences for each reservation
        foreach ($reservations as $reservation) {
            $createdAt = Carbon::parse($reservation->created_at);
            $reservation->timeDifference = $createdAt->diffForHumans();
        }

        // Calculate reservation counts per "Satker"
        $reservationCounts = $this->calculateReservationCounts();
        $facilityReservations = $this->calculateFacilityReservations();
        $facilityByCategoryCount = $this->calculateFacilityCategoryReservations();

        $allReservations = Reservation::all();
        $allFacilities = Facility::all();
        $allUsers = User::all();
        $allUkers = UkerMaster::all();
        $allSatkers = SatkerMaster::all();


        return view('dashboard', compact('facilityByCategoryCount','facilityCategories', 'reservations', 'reservationCounts','facilityReservations', 'allReservations', 'allFacilities', 'allUsers', 'allUkers', 'allSatkers'));
    }

    private function calculateReservationCounts()
    {
        $allReservations = Reservation::where('status', 'approved')
            ->get();

        $reservationCounts = $allReservations->groupBy('user.ukerMaster.nama_unit_kerja_eselon_2')
            ->map(function ($reservations) {
                return $reservations->count();
            })->sortDesc()->take(3);

        return $reservationCounts;
    }

    private function calculateFacilityReservations()
    {
        $allReservations = Reservation::whereHas('facility', function ($query) {
            $query->where('status', 'approved');
        })->get();

        $facilityReservations = $allReservations->groupBy(function ($reservation) {
            return $reservation->facility->name . ' ' .'(' . $reservation->facility->facilityCategory->category_str .')';
        })->map(function ($groupedReservations) {
            return $groupedReservations->count();
        })->sortDesc()->take(3);

        return $facilityReservations;
    }

    private function calculateFacilityCategoryReservations()
    {
        $allFacilities = Facility::all();

        $facilityReservations = $allFacilities->groupBy('facilityCategory.category_str')
            ->map(function ($facilities) {
                return $facilities->count();
            });

        return $facilityReservations;
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
        //
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
        //
    }
}
