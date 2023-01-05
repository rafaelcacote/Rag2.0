
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">
                    Descrição
                    <span class="red-text">*</span>
                </label>
                <input type="text" placeholder="Descrição"
                    class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao"
                    name="descricao" value="{{ $setor->descricao ?? old('descricao') }}">
                @if ($errors->has('descricao'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('descricao') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="sigla">
                    Sigla
                    <span class="red-text">*</span>
                </label>
                <input type="text" placeholder="Descrição"
                    class="form-control {{ $errors->has('sigla') ? 'is-invalid' : '' }}" id="sigla"
                    name="sigla" value="{{ $setor->sigla ?? old('sigla') }}">
                @if ($errors->has('sigla'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('sigla') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>

