@extends('layouts.back-end.app-seller')

@section('title', translate('shop_view'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/shop-info.png') }}" alt="">
                {{ translate('shop_info') }}
            </h2>
        </div>
        @include('vendor-views.shop.inline-menu')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="mb-0 text-capitalize">{{ translate('my_shop_info') }}</h4>
                            </div>
                            <form action="{{ route('vendor.shop.update-availability', $shop->id) }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Day</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                                $availabilityMap = $availabilities->keyBy('day_of_week');
                                            @endphp
                    
                                            @foreach($daysOfWeek as $day)
                                                @php
                                                    $availability = $availabilityMap[$day] ?? null;
                                                @endphp
                                                <tr>
                                                    <td class="align-middle">{{ $day }}</td>
                                                    <td>
                                                        <input type="hidden" name="availability[{{ $day }}][day_of_week]" value="{{ $day }}">
                                                        <input type="time" class="form-control" name="availability[{{ $day }}][start_time]" value="{{ $availability->start_time ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" name="availability[{{ $day }}][end_time]" value="{{ $availability->end_time ?? '' }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                    
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Update Availability
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    


                </div>
            </div>

        </div>
        <div class="row">
          
        </div>
    </div>
    </div>
@endsection
