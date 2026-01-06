<div class="card"> <!-- Single root element -->
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 bg-primary rounded-2 p-3">
                <svg class="text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                </svg>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Total Users</h6>
                <h4 class="mb-0">{{ $this->userCount }}</h4>
            </div>
        </div>
    </div>
</div>