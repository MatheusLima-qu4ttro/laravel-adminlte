<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Edição -->
                <form id="editProfileForm" method="post" action="{{route("user.update")}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="form-group col">
                            <label for="userName">Nome Completo</label>
                            <input placeholder="Exemplo: Ana Maria Silva" name="name" type="text" class="form-control" id="userName" value="{{$user->name}}">
                        </div>
                        <div class="form-group col">
                            <label for="role">Perfil</label>
                            <select name="role" class="form-control" id="role">
                                @foreach([
                                    ['id' => 'operador', 'name' => 'Operador'],
                                    ['id' => 'administrador', 'name' => 'Administrador'],
                                    ['id' => 'superusuario', 'name' => 'Superusuário']
                                ] as $role)
                                    <option value="{{$role['id']}}"
                                            @if($user->role == $role['id'])
                                                selected
                                        @endif>{{$role['name']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="userEmail">Email</label>
                            <input placeholder="Exemplo: exemplo@email.com" name="email" type="email" class="form-control" id="userEmail" value="{{$user->email}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="userPhone">Telefone</label>
                            <input placeholder="Exemplo: (00) 00000-0000" name="phone" type="text" class="form-control phone-mask" id="userPhone" value="{{$user->phone ?? ''}}">
                        </div>
                        <div class="form-group col">
                            <label for="country">Pais</label>
                            <select name="country" class="form-control" id="country">
                                <option value="">Selecione o Pais</option>
                                @foreach(\Illuminate\Support\Facades\DB::table('countries')->get()->toArray() as $country)
                                    <option value="{{$country->id}}"
                                            @if($user->country == $country->id)
                                                selected
                                        @endif>{{$country->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="uf">Estado</label>
                            <select name="uf" class="form-control" id="uf">
                                <option value="">Selecione o Estado</option>
                                @foreach(\Illuminate\Support\Facades\DB::table('ufs')->get()->toArray() as $uf)
                                    <option value="{{$uf->id}}"
                                            @if($user->uf == $uf->id)
                                                selected
                                        @endif>{{$uf->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="city">Cidade</label>
                            <select name="city" class="form-control" id="city">
                                <option value="">Selecione a Cidade</option>
                                @foreach(\Illuminate\Support\Facades\DB::table('cities')->get()->toArray() as $city)
                                    <option value="{{$city->id}}"
                                            @if($user->city == $city->id)
                                                selected
                                        @endif>{{$city->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="address">Rua</label>
                            <input placeholder="Exemplo: Rua paraiba" name="address" type="text" class="form-control" id="address" value="{{$user->address ?? ''}}">
                        </div>
                        <div class="form-group col">
                            <label for="number">Numero</label>
                            <input placeholder="Exemplo: 133" name="number" type="text" class="form-control number-mask" id="number" value="{{$user->number ?? ''}}">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="$('#editProfileForm').submit()">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        function loadStates(countryId, selectedStateId = null) {
            if (countryId) {
                $.ajax({
                    url: '/get-ufs/' + countryId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#uf').empty();
                        $('#uf').append('<option value="">Selecione o Estado</option>');
                        $.each(data, function (key, value) {
                            $('#uf').append('<option value="' + key + '">' + value + '</option>');
                        });
                        if (selectedStateId) {
                            $('#uf').val(selectedStateId); // Set selected state if provided
                        }
                    }
                });
            } else {
                $('#uf').empty();
                $('#uf').append('<option value="">Selecione o Estado</option>');
            }
        }

        function loadCities(stateId, selectedCityId = null) {
            if (stateId) {
                $.ajax({
                    url: '/get-cities/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Selecione a Cidade</option>');
                        $.each(data, function (key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                        if (selectedCityId) {
                            $('#city').val(selectedCityId); // Set selected city if provided
                        }
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Selecione a Cidade</option>');
            }
        }

        // Check for pre-selected country and load states accordingly
        var initialCountryId = $('#country').val();
        var initialStateId = $('#uf').val(); // Grab pre-selected state if any
        loadStates(initialCountryId, initialStateId);

        // Check for pre-selected state and load cities accordingly
        var initialCityId = $('#city').val(); // Grab pre-selected city if any
        if (initialStateId) {
            loadCities(initialStateId, initialCityId);
        }

        // Event listeners for changes
        $('#country').change(function () {
            loadStates($(this).val());
        });

        $('#uf').change(function () {
            loadCities($(this).val());
        });
    });
</script>
