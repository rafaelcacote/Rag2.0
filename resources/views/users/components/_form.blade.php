<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">
                Nome
                <span class="red-text">*</span>
            </label>
            <input type="text" placeholder="Nome"
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                name="name" value="{{ $user->name ?? old('name') }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="email">
                Email
            </label>
            <input type="email" placeholder="email"
                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                name="email" value="{{ $user->email ?? old('email') }}">
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>
    </div>

        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control">
                @if ($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
        </div>


        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control">
                @if ($errors->has('confirm-password'))
                <p class="help-block" style="color: red">
                        {{ $errors->first('confirm-password') }}
                    </p>
                @endif
            </div>
        </div>

    <div class="col-sm-12">
        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
            <label for="roles">Perfil*</label>
            <select name="roles[]" id="roles" class="form-control select2-multiple" multiple="multiple">
                @foreach ($roles as $id => $roles)
                    @if (isset($userRole)) {
                        <option value="{{ $id }}"
                        {{ in_array($id, old('roles', [])) || (isset($user) && $userRole) ? 'selected' : '' }}>
                        {{ $roles }}
                    </option>
                    }
                    @else
                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                        {{ $roles }}
                    </option>
                    @endif

                @endforeach
            </select>
            @if ($errors->has('roles'))
            <p class="help-block" style="color: red">
                    {{ $errors->first('roles') }}
                </p>
            @endif

        </div>
    </div>



</div>
