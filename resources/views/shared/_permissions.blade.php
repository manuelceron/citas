<?php if(!isset($closed)) $closed = ''; ?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="{{ isset($title) ? $title :  'permissionHeading' }}">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? $title :  'permissionHeading' }}" aria-expanded="{{ $closed or 'true' }}" aria-controls="dd-{{ isset($title) ? $title :  'permissionHeading' }}">
                {{ $title or 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? $title :  'permissionHeading' }}" class="panel-collapse collapse {{ $closed or 'in' }}" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? $title :  'permissionHeading' }}">
        <div class="panel-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $per_found = null;
                        if( isset($role) ) {
                            //$per_found = $role->hasPermissionTo($perm->name);
                        }
                        if( isset($user)) {
                            //$per_found = $user->hasDirectPermission($perm->name);
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>