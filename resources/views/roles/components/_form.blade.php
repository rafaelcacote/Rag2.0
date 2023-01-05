
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">
                    Nome
                    <span class="red-text">*</span>
                </label>
                <input type="text" placeholder="Nome"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                    name="name" value="{{ $role->name ?? old('name') }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissões:</strong>
                <br/>
                @foreach ($permission as $value)
                        @if (isset($rolePermissions))
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label><br/>
                        @else
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}</label><br/>
                        @endif

                @endforeach

            </div>
        </div>
    </div>

