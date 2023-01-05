
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">
                    Nome Permissão
                    <span class="red-text">*</span>
                </label>
                <input type="text" placeholder="Nome Permissão"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                    name="name" value="{{ $role->name ?? old('name') }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

