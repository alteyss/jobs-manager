@php
use App\Models\User;
$users = User::role('client')->get();
@endphp

@if (backpack_user()->hasRole('Admin'))
<a href="#" data-toggle="modal" data-target="#copyModal-{{ $entry->id }}" class="btn btn-sm btn-link">
    <i class="la la-copy"></i> {{ trans('backpack::crud.export.copy') }}
</a>
@endif

<div class="modal fade" id="copyModal-{{ $entry->id }}" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('backpack::crud.export.copy') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="clientSelect">{{ trans('base.customers') }}</label>
                    <select class="form-control" id="clientSelect-{{ $entry->id }}">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('backpack::base.cancel') }}</button>
                <button type="button" class="btn btn-primary" data-id="{{ $entry->id }}" onclick="copyInit(<?php echo $entry->id; ?>);">{{ trans('backpack::crud.export.copy') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyInit(applicationId) {
        var clientId = document.getElementById("clientSelect-" + applicationId).value;

        // window.open(window.origin + '/application/' + applicationId + '/copy/' + client, '_blank').focus();

        fetch(window.origin + '/application/' + applicationId + '/copy/' + clientId);

        $('#copyModal-' + applicationId).modal('hide');

        new Noty({
            type: "success",
            text: 'Application copied',
        }).show();
    }
</script>
