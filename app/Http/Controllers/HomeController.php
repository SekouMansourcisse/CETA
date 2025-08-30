<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Client;
use App\Models\Projet;
use App\Models\Depense;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stats = [
            'total_projets' => Projet::count(),
            'projets_en_cours' => Projet::where('etat', 'en_cours')->count(),
            'total_clients' => Client::count(),
            'activites_en_cours' => Activite::where('statut', 'en_cours')->count(),
        ];

        // Fetch project status data for the chart
        $projectStatuses = Projet::select('etat', DB::raw('count(*) as count'))
                                ->groupBy('etat')
                                ->pluck('count', 'etat')
                                ->toArray();

        // Prepare data for ApexCharts (labels and series)
        $projectStatusLabels = array_keys($projectStatuses);
        $projectStatusSeries = array_values($projectStatuses);

        // Fetch Realisation status data for the chart
        $realisationStatuses = Activite::where('type', 'realisation')
                                    ->select('statut', DB::raw('count(*) as count'))
                                    ->groupBy('statut')
                                    ->pluck('count', 'statut')
                                    ->toArray();
        $realisationStatusLabels = array_keys($realisationStatuses);
        $realisationStatusSeries = array_values($realisationStatuses);

        // Fetch Etude status data for the chart
        $etudeStatuses = Activite::where('type', 'etude')
                                ->select('statut', DB::raw('count(*) as count'))
                                ->groupBy('statut')
                                ->pluck('count', 'statut')
                                ->toArray();
        $etudeStatusLabels = array_keys($etudeStatuses);
        $etudeStatusSeries = array_values($etudeStatuses);

        // Fetch Expertise status data for the chart
        $expertiseStatuses = Activite::where('type', 'expertise')
                                    ->select('statut', DB::raw('count(*) as count'))
                                    ->groupBy('statut')
                                    ->pluck('count', 'statut')
                                    ->toArray();
        $expertiseStatusLabels = array_keys($expertiseStatuses);
        $expertiseStatusSeries = array_values($expertiseStatuses);

        // Fetch Autorisation status data for the chart
        $autorisationStatuses = Activite::where('type', 'autorisation')
                                        ->select('statut', DB::raw('count(*) as count'))
                                        ->groupBy('statut')
                                        ->pluck('count', 'statut')
                                        ->toArray();
        $autorisationStatusLabels = array_keys($autorisationStatuses);
        $autorisationStatusSeries = array_values($autorisationStatuses);

        return view('home', compact(
            'stats',
            'projectStatusLabels',
            'projectStatusSeries',
            'realisationStatusLabels',
            'realisationStatusSeries',
            'etudeStatusLabels',
            'etudeStatusSeries',
            'expertiseStatusLabels',
            'expertiseStatusSeries',
            'autorisationStatusLabels',
            'autorisationStatusSeries'
        ));
    }
}