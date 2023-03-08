<div class="select-box">
	<div class="input-group" id="{{ $position }}" data-type="{{ $type }}">
		<input type="text" id="{{ $id }}" class="form-control {{ isset($class) ? $class:  'search-suggest '}}" {{ isset($required) ? $required : '' }} autocomplete="off" {{ isset($disabled) ? $disabled : '' }}>
		<input type="hidden" class="name" id="{{ $name }}" name="{{ $name }}" value="{{ isset($value) ? $value : (isset($transaction) ? \App\Taikhoan::where('sotk', $transaction)->where('company_id', Auth::user()->company_id)->select('id')->first()->id : '') }}">
		<div class="input-group-append">
			<button class="btn btn-info btn-show-modal-select btn-sm" type="button" data-toggle="modal" data-target="#modal-select">
				<i class="fas fa-search"></i>
			</button>
		</div>
	</div>
</div>


