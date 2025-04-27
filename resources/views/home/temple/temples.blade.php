
@extends('home.layouts.main')

@section('title', 'Temples')

@push('css')
    <style>
        .badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    color: white;
    border-radius: 5px;
}

.badge-upcoming {
    background-color: #28a745; /* Green */
}

.badge-ongoing {
    background-color: #ffc107; /* Yellow */
    color: #000;
}

.badge-completed {
    background-color: #6c757d; /* Gray */
}

    </style>
@endpush

@section('main-content')
    <!-- ================> PageHeader section start here <================== -->
    <div class="pageheader">
        <div class="container">
            <div class="pageheader__area">
                <div class="pageheader__left">
                    <h3>Temples</h3>
                </div>
                <div class="pageheader__right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">temples</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> PageHeader section end here <================== -->


    <!-- ================> Event section start here <================== -->
    <div class="event padding--top padding--bottom bg-light">
        <div class="container">
            <div class="section__header text-center" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
                <!-- Season Filter (Left) -->
                <select id="seasonFilter" class="form-control" style="max-width: 160px;">
                    <option value="" selected disabled>Filter Season</option>
                    <option value="winter">Winter</option>
                    <option value="summer">Summer</option>
                    <option value="monsoon">Monsoon</option>
                    <option value="autumn">Autumn</option>
                    <option value="all">All Season</option>
                </select>

                <!-- Center Title -->
                <h2 style="margin: 0;">Temples</h2>

                <!-- State Filter (Right) -->
                <select id="stateFilter" class="form-control" style="max-width: 160px;">
                    <option value="" selected disabled>Filter by State</option>
                    <option value="all">All</option> <!-- Show all temples -->
                    @foreach ($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center" id="templeList">
                    @foreach ($temples as $temple)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="event__item">
                                <div class="event__inner">
                                    <div class="event__thumb">
                                        <a href="{{ route('home.viewtemple', $temple->id) }}">
                                            <img src="{{ asset($temple->main_image) }}" alt="event thumb" style="max-width: 366px; max-height: 205px; width: 100%; height: auto; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="event__content">
                                        <a href="{{ route('home.viewtemple', $temple->id) }}">
                                            <h5>{{ $temple->name }}</h5>
                                        </a>
                                        <span class="badge bg-success" style=" color: white; padding: 5px 10px; font-size: 12px;">
                                            {{ ucfirst($temple->season) }}
                                        </span>
                                        <span class="badge bg-secondary" style=" color: white; padding: 5px 10px; font-size: 12px;">
                                            {{ ucfirst($temple->state) }}
                                        </span>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-map-marker-alt"></i> {{ $temple->city }}, {{ $temple->state }}, {{ $temple->country }}</li>
                                        </ul>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-id-badge"></i> {{ $temple->phone }}</li>
                                        </ul>
                                        <ul class="event__metapost-info">
                                            <li><i class="fas fa-envelope"></i> {{ $temple->email }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-5">
                        {{-- Previous Page Link --}}
                        @if ($temples->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $temples->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($temples->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $page == $temples->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($temples->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $temples->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        @endif
                    </ul>
                </nav>

            </div>
        </div>
    </div>
    <!-- ================> Event section end here <================== -->
@endsection


@push('script')
{{-- <script>
    document.getElementById('stateFilter').addEventListener('change', function () {
        let selectedState = this.value;

        if (selectedState === "clear" || selectedState === "all") {
            this.selectedIndex = 0; // Reset dropdown to default
            selectedState = ""; // Fetch all data
        }

        // Show SweetAlert loading animation
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we fetch the data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Start loading animation
            }
        });

        fetch('{{ route("home") }}?state=' + selectedState)
            .then(response => response.text())
            .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            let newContent = doc.getElementById('templeList');

            if (newContent && newContent.innerHTML.trim() !== "") {
                document.getElementById('templeList').innerHTML = newContent.innerHTML;
            } else {
                document.getElementById('templeList').innerHTML = `
                    <div class="col-12 text-center">
                        <h4 style="color: red;">No Temple Found</h4>
                    </div>
                `;
            }

            Swal.close();
        })
        .catch(error => {
            console.error("Fetch error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Please try again.',
            });
        });
});
</script> --}}
<script>
    function applyFilters() {
        let selectedState = document.getElementById('stateFilter').value || "";
        let selectedSeason = document.getElementById('seasonFilter').value || "";

        let queryParams = new URLSearchParams();
        if (selectedState && selectedState !== "all") {
            queryParams.append("state", selectedState);
        }
        if (selectedSeason && selectedSeason !== "all") {
            queryParams.append("season", selectedSeason);
        }

        // Show SweetAlert loading animation
        Swal.fire({
            title: 'Loading...',
            text: 'Please wait while we fetch the data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('{{ route("home") }}?' + queryParams.toString())
            .then(response => response.text())
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');
                let newContent = doc.getElementById('templeList').innerHTML.trim();

    if (newContent === "") {
        document.getElementById('templeList').innerHTML = '<div style="color:red" class="col-12 text-center"><h4>No Temples Found</h4></div>';
    } else {
        document.getElementById('templeList').innerHTML = newContent;
    }

    Swal.close();
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Something went wrong. Please try again.',
                });
            });
    }

    document.getElementById('stateFilter').addEventListener('change', applyFilters);
    document.getElementById('seasonFilter').addEventListener('change', applyFilters);
</script>
@endpush



