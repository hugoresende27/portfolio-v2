<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Artisan;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $lastUpdate = $this->getLastUpdated();
        $quote = $this->inspire();
        return view('layouts.guest',compact('lastUpdate', 'quote'));
    }


    /**
     * @return string
     */
    public function getLastUpdated(): string
    {
        // Get the latest commit information
        $latestCommit = shell_exec('git log -1 --date=iso');

        // Extract the date and time from the commit information
        if (preg_match('/Date:\s+(.*)\s+(.*)/', $latestCommit, $matches)) {
            $lastUpdated = $matches[1] . ' ' . $matches[2];
        } else {
            $lastUpdated = 'Unknown';
        }



        // Output the last updated date and time
        return 'Last updated on ' . $lastUpdated;
    }


    /**
     * @return string
     */
    private function inspire(): string
    {
        Artisan::call('inspire');
        return (Artisan::output());
    }

}
