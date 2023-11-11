<div class="row">
    <div class="col-xl-3 col-xxl-3 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body">
                <div class="media">
    									<span class="mr-3">
    										<i class="la la-users"></i>
    									</span>
                    <div class="media-body text-white">
                        <p class="mb-1">Total Users</p>
                        <h3 class="text-white">{{$totalUsers}}</h3>
                        <div class="progress mb-2 bg-white">
                            <div class="progress-bar progress-animated bg-light" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-sm-6">
        <div class="widget-stat card bg-warning">
            <div class="card-body">
                <div class="media">
    									<span class="mr-3">
    										<i class="la la-user"></i>
    									</span>
                    <div class="media-body text-white">
                        <p class="mb-1">Total Clients</p>
                        <h3 class="text-white">{{$totalClients}}</h3>
                        <div class="progress mb-2 bg-white">
                            <div class="progress-bar progress-animated bg-light" style="width: 100%"></div>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-sm-6">
        <div class="widget-stat card bg-secondary">
            <div class="card-body">
                <div class="media">
    									<span class="mr-3">
    										<i class="la la-graduation-cap"></i>
    									</span>
                    <div class="media-body text-white">
                        <p class="mb-1">Total Products</p>
                        <h3 class="text-white">{{$totalProducts}}</h3>
                        <div class="progress mb-2 bg-white">
                            <div class="progress-bar progress-animated bg-light" style="width: 100%"></div>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-3 col-sm-6">
        <div class="widget-stat card bg-danger">
            <div class="card-body">
                <div class="media">
    									<span class="mr-3">
    										<i class="la la-dollar"></i>
    									</span>
                    <div class="media-body text-white">
                        <p class="mb-1">Total Product Categories</p>
                        <h3 class="text-white">{{$totalProductCategories}}</h3>
                        <div class="progress mb-2 bg-white">
                            <div class="progress-bar progress-animated bg-light" style="width: 100%"></div>
                        </div>
                        {{--                        <small>30% Increase in 30 Days</small>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-xxl-6 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Products By Category</h3>
            </div>
            <div class="card-body">
                <div style="height: 300px !important;">

                    <livewire:livewire-column-chart
                        key="{{ $productsByCategory->reactiveKey() }}"
                        :column-chart-model="$productsByCategory"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-xxl-6 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Policies By Provider</h3>
            </div>
            <div class="card-body">
                <div style="height: 300px !important;">

                    <livewire:livewire-column-chart
                        key="{{ $policyHoldersByProvider->reactiveKey() }}"
                        :column-chart-model="$policyHoldersByProvider"/>
                </div>
            </div>
        </div>
    </div>

</div>
