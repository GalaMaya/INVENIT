<div>
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Assets Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                Total Assets</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $totalAssets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Assets Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                Available</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $availableAssets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- In Use Assets Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">
                                In Use</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $inUseAssets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-user-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Damaged Assets Card -->
        <div class="mb-4 col-xl-3 col-md-6">
            <div class="py-2 shadow card border-left-danger h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            <div class="mb-1 text-xs font-weight-bold text-danger text-uppercase">
                                Damaged</div>
                            <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $damagedAssets }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="text-gray-300 fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 col-xl-12 col-md-6">
            <!-- Recent Assets Table -->
            <div class="mb-4 shadow card">
                <div class="py-3 card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="mr-2 fas fa-clock"></i>Recent Assets
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="25%">Name</th>
                                    <th width="15%">Category</th>
                                    <th width="12%">Brand</th>
                                    <th width="15%">Serial Number</th>
                                    <th width="13%">Status</th>
                                    <th width="20%">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAssets as $asset)
                                    <tr>
                                        <td>
                                            <strong>{{ $asset->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="text-gray-600">{{ $asset->category->name }}</span>
                                        </td>
                                        <td>
                                            {{ $asset->brand ?? '-' }}
                                        </td>
                                        <td>
                                            <code class="text-xs">{{ $asset->serial_number ?? '-' }}</code>
                                        </td>
                                        <td>
                                            <span class="badge px-3 py-2 {{ $asset->status_color }}">
                                                {{ $asset->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="mr-1 text-gray-400 fas fa-map-marker-alt"></i>
                                            {{ $asset->location ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 text-center text-gray-500">
                                            <i class="mb-2 fas fa-inbox fa-2x"></i>
                                            <p class="mb-0">No recent assets found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>