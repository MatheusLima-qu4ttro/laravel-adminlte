<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Alteração de senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Edição -->
                <form id="changePasswordForm" method="post" action="{{route("profile.change-password")}}">
                    @csrf
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
                <button type="button" class="btn btn-primary" onclick="$('#changePasswordForm').submit()">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#changePasswordForm').submit(function(event) {
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
</script>
