<div>
    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Asset Management</h1>
        <button class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary" 
                wire:click="$dispatch('open-modal', 'asset-form')">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Asset
        </button>
    </div>

    <!-- Filters Card -->
    <div class="mb-4 shadow card">
        <div class="card-body">
            <div class="row">
                <!-- Search -->
                <div class="mb-3 col-md-4 mb-md-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               class="form-control" 
                               placeholder="Search name, brand, or serial...">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="mb-3 col-md-3 mb-md-0">
                    <select wire:model.live="filterStatus" class="form-control">
                        <option value="all">All Status</option>
                        <option value="available">Available</option>
                        <option value="in_use">In Use</option>
                        <option value="damaged">Damaged</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="mb-3 col-md-3 mb-md-0">
                    <select wire:model.live="filterCategory" class="form-control">
                        <option value="all">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Per Page -->
                <div class="col-md-2">
                    <select wire:model.live="perPage" class="form-control">
                        <option value="10">10 / page</option>
                        <option value="25">25 / page</option>
                        <option value="50">50 / page</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Assets Table -->
    <div class="mb-4 shadow card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $index => $asset)
                            <tr>
                                <td>{{ $assets->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $asset->name }}</strong><br>
                                    <small class="text-muted">{{ $asset->brand }} {{ $asset->model }}</small>
                                </td>
                                <td>{{ $asset->category->name }}</td>
                                <td><code class="text-xs">{{ $asset->serial_number ?? '-' }}</code></td>
                                <td>
                                    <span class="badge px-3 py-2 {{ $asset->status_color }}">
                                        {{ $asset->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <i class="mr-1 text-gray-400 fas fa-map-marker-alt"></i>
                                    {{ $asset->location ?? '-' }}
                                </td>
                                <td>
                                    <!-- Tombol aksi (nanti kita isi di Task 3.3 & 4) -->
                                    {{-- <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a> --}}
                                    {{-- <button wire:click="$dispatch('open-modal', 'asset-form', { assetId: {{ $asset->id }} })" 
                                            class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500">
                                    <i class="mb-2 fas fa-inbox fa-2x"></i>
                                    <p class="mb-0">No assets found matching your criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $assets->links() }}
            </div>
        </div>
    </div>

    <!-- Placeholder untuk Modal Form (akan kita buat di Task 3.2) -->
    {{-- <livewire:assets.asset-form /> --}}
</div>