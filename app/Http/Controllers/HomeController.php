<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;


class HomeController extends ParentController
{

    /**
     * Dashboard
     *
     * @return void
     */
    public function index()
    {
        $response['total_materials'] =0;
        $response['total_boms'] = 0;
        $response['total_vendors'] = 0;
        $response['total_pos'] = 0;
        $response['total_grn'] = 0;
        $response['total_gt'] = 0;
        $response['pending_so'] = 0;
        $response['pending_mr'] = 0;
        $response['pending_qc'] = 0;
        $response['total_invoice'] = 0;

        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();

        // Create an array to store the dates
        $dates = array();

        // Generate the dates and add them to the array
        while ($start_date < $end_date) {
            $dates[] = $start_date->format('Y-m-d');
            $start_date->addDay();
        }

        $response['dates'] = $dates;


        $response['wsr_sales'] = [];
        $response['csr_sales'] = [];

        return Inertia::render('Dashboard/index', $response);
    }
}
