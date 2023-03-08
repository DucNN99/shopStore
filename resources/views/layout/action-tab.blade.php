<div class="d-sm-flex align-items-center justify-content-between mb-3 breardcumb-cs">
    <h3 class="h3 mb-0 text-gray-800">
    @foreach($title as $key => $value)
        <a href="{{ $value['url'] != '' ? $value['url'] : '#' }}">{{ $value['name'] }}</a>
        @if($key < count($title) - 1)
            >
        @endif
    @endforeach
    </h3>
    @if(isset($button))
        @foreach($button as $key => $item)
            <a href="{{ $item['url'] != '' ? $item['url'] : '#' }}" class="d-none d-sm-inline-block btn btn-sm {{ $item['class'] }} shadow-sm">
                <i class="fas {{ $item['icon'] }} fa-sm"></i> {{ $item['name'] }}
            </a>
        @endforeach
    @endif
</div>
@if(isset($other))
<div class="d-sm-flex align-items-center justify-content-between mb-2 breardcumb-cs">
    <div class="col-sm-1" style="padding:0">
        <select id="paginate" class="form-control form-control-sm">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
        </select>
    </div>
    <div class="col-md-6 text-right" style="padding:0">
        <div class="form div-select">
            <input id="search" class="form-control form-control-sm" type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
</div>
@endif
