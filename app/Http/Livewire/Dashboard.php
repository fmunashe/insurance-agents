<?php

namespace App\Http\Livewire;

use App\Traits\Analytics;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class Dashboard extends Component
{
    use Analytics;

    public $showAnimation = true;
    public $showDataLabels = true;
    public $showLegend = true;
    public $colors = [
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43',
        '#003438',
        '#d3004d',
        '#ffa600',
        '#f6ad55',
        '#fc8181',
        '#90cdf4',
        '#66DA26',
        '#cbd5e0',
        '#73b641',
        '#1a151a',
        '#003438',
        '#d3004d',
        '#003f5c',
        '#2f4b7c',
        '#665191',
        '#a05195',
        '#d45087',
        '#f95d6a',
        '#ff7c43'
    ];

    public function render()
    {
        $totalUsers = $this->totalUsers();
        $totalClients = $this->totalClients();
        $totalProducts = $this->totalProducts();
        $totalProductCategories = $this->totalProductCategories();
        $policyExpiringThisMonth = $this->policiesExpiringThisMonth();
        $totalPremium = $this->totalPremium();
        $totalCommission = $this->totalCommission();

        $productsByCategory = $this->productsByCategory()
            ->reduce(
                function ($chart, $item, $key) {
                    return $chart->addColumn($item->category, $item->count, $this->colors[$key]);
                },
                LivewireCharts::columnChartModel()
                    ->setAnimated($this->showAnimation)
                    ->setTitle("Products By Category")
                    ->setOpacity(0.9)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->withGrid()
            );

        $policyHoldersByProvider = $this->policyByProvider()
            ->reduce(
                function ($chart, $item, $key) {
                    return $chart->addColumn($item->provider, $item->count, $this->colors[rand(0, 150)]);
                },
                LivewireCharts::columnChartModel()
                    ->setAnimated($this->showAnimation)
                    ->setTitle("Policies By Provider")
                    ->setOpacity(0.9)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->withGrid()
            );

        $commissionByRiskCategory = $this->commissionByRiskCategory()
            ->reduce(
                function ($chart, $item, $key) {
                    return $chart->addColumn($item->category, $item->count, $this->colors[rand(0, 150)]);
                },
                LivewireCharts::columnChartModel()
                    ->setAnimated($this->showAnimation)
                    ->setTitle("Commission By Risk Category")
                    ->setOpacity(0.9)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->withGrid()
            );

        $commissionByInsuranceProvider = $this->commissionByInsuranceProvider()
            ->reduce(
                function ($chart, $item, $key) {
                    return $chart->addColumn($item->provider, $item->count, $this->colors[rand(0, 150)]);
                },
                LivewireCharts::columnChartModel()
                    ->setAnimated($this->showAnimation)
                    ->setTitle("Commission By Insurance Provider")
                    ->setOpacity(0.9)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->withGrid()
            );


        return view('livewire.dashboard')->with([
            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalProducts' => $totalProducts,
            'totalProductCategories' => $totalProductCategories,
            'productsByCategory' => $productsByCategory,
            'policyHoldersByProvider' => $policyHoldersByProvider,
            'policyExpiringThisMonth' => $policyExpiringThisMonth,
            'totalPremium' => $totalPremium,
            'totalCommission' => $totalCommission,
            'commissionByRiskCategory' => $commissionByRiskCategory,
            'commissionByInsuranceProvider' => $commissionByInsuranceProvider,
        ]);
    }
}
