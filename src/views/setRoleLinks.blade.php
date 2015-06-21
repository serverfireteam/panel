@extends('panelViews::mainTemplate')
@section('page-wrapper')

<div class="row">
	<div class="col-xs-4">
		@if (!empty($links))
			<form method="post" action="{!! url('panel/setRoleLinks') !!}">
				<input type="hidden" name="id" value="{{ $id }}" />			
				<fieldset>
					<legend>{{ \Lang::get('panel::fields.permissions') }} ({{ $role }})</legend>
					@foreach ($links as $link)
						@if ($permissions && in_array($link['id'], $permissions))
							<input name="links[]" type="checkbox" value="{{ $link['id'] }}" checked="checked" />
						@else
							<input name="links[]" type="checkbox" value="{{ $link['id'] }}" />
						@endif
						<label>{{ $link['display'] }}</label><br />
					@endforeach
				</fieldset>
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input class="btn btn-default" type="submit" value="{{ \Lang::get('panel::fields.setPermissions') }}">
			</form>
		@else
			<div>{{ \Lang::get('panel::fields.noLinkExists') }}</div>
		@endif
	</div>
</div>

@stop
