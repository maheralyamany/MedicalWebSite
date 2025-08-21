<?php
$userPermissions = [];
$userRoles = [];
if (isset($user)) {
    if (isset($user->permissions)) {
        foreach ($user->permissions as $perm) {
            $userPermissions[] = $perm->slug;
        }
    }
    if (isset($user->roles)) {
        foreach ($user->roles as $rol) {
            $userRoles[] = $rol->slug;
        }
    }
}
?>
@foreach ($roles as $rol)
<tr>
    <td>
        <label class="form-check-label" style="width: 100%;" for="rol{{ $rol->id }}">
            <input type="checkbox" action="role" role="{{ $rol->slug }}" name="userRole[]"
                id="rol{{ $rol->id }}" value="{{ $rol->id }}"
                {{ in_array($rol->slug, $userRoles) ? 'checked' : '' }}> {{ trans_role_title($rol->slug) }}
        </label>
    </td>
    <td>
        <div class="row">
            @foreach ($rol->permissions as $perm)
                <div class="form-check col-3">
                    <label class="form-check-label" for="perm{{ $perm->id }}">
                        <input type="checkbox" action="perm" role="{{ $rol->slug }}"
                            id="perm{{ $perm->id }}" name="userPermission[]" value="{{ $perm->id }}"
                            {{ in_array($perm->slug, $userPermissions) ? 'checked' : '' }}>     {{ trans_permission_title($perm->name) }}
                    </label>
                </div>
            @endforeach
        </div>
    </td>
</tr>
@endforeach
