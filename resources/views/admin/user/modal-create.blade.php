<div class="modal fade" id="createProfileModal" tabindex="-1" aria-labelledby="createProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProfileModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Edição -->
                <form id="editProfileForm" method="post" action="{{ route('user.create') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label for="userName">Nome Completo</label>
                            <input placeholder="Exemplo: Ana Maria Silva" name="name" type="text" class="form-control" id="userName">
                        </div>
                        <div class="form-group col">
                            <label for="role">Perfil</label>
                            <select name="role" class="form-control" id="role">
                                @foreach([
                                    ['id' => 'operador', 'name' => 'Operador'],
                                    ['id' => 'administrador', 'name' => 'Administrador'],
                                    ['id' => 'superusuario', 'name' => 'Superusuário']
                                ] as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="userEmail">Email</label>
                            <input placeholder="Exemplo: exemplo@email.com" name="email" type="email" class="form-control" id="userEmail">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="userPhone">Telefone</label>
                            <input placeholder="Exemplo: (00) 00000-0000" name="phone" type="text" class="form-control phone-mask" id="userPhone">
                        </div>
                        <div class="form-group col">
                            <label for="country">Pais</label>
                            <select name="country" class="form-control" id="country">
                                <option value="">Selecione o Pais</option>
                                @foreach(\Illuminate\Support\Facades\DB::table('countries')->get()->toArray() as $country)
                                    <option value="{{ $country->id }}">{{ $country->nome }}</option>
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
                                    <option value="{{ $uf->id }}">{{ $uf->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="city">Cidade</label>
                            <select name="city" class="form-control" id="city">
                                <option value="">Selecione a Cidade</option>
                                @foreach(\Illuminate\Support\Facades\DB::table('cities')->get()->toArray() as $city)
                                    <option value="{{ $city->id }}">{{ $city->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="address">Rua</label>
                            <input placeholder="Exemplo: Rua Paraíba" name="address" type="text" class="form-control" id="address">
                        </div>
                        <div class="form-group col">
                            <label for="number">Número</label>
                            <input placeholder="Exemplo: 133" name="number" type="text" class="form-control number-mask" id="number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="userName">Senha</label>
                            <input placeholder="Exemplo: ********" name="password" type="password" class="form-control" id="password">
                        </div>
                        <div class="form-group col">
                            <label for="userName">Confirmação de senha</label>
                            <input placeholder="Exemplo: ********" name="password-confirm" type="password" class="form-control" id="password-confirm">
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
    $(document).ready(function() {
        $('#editProfileForm').submit(function(event) {
            // Prevenir o envio padrão do formulário
            event.preventDefault();

            // Capturar os valores dos campos de senha
            var password = $('#password').val();
            var confirmPassword = $('#password-confirm').val();

            // Verificar os requisitos da senha
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                // Se a senha não atende aos requisitos, mostrar um alerta SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Senha Insegura!',
                    text: 'Sua senha deve ter pelo menos 8 caracteres, incluir uma letra maiúscula, um número e um caractere especial.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return; // Sair da função para não prosseguir para as outras verificações
            }

            // Verificar se as senhas coincidem
            if (password === confirmPassword) {
                // Se as senhas coincidirem, submeter o formulário

                this.submit();
            } else {
                // Se as senhas não coincidirem, mostrar um alerta SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'As senhas não coincidem. Tente novamente.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

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
