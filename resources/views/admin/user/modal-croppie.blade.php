<div class="modal fade" id="editImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Imagem do Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyImage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveCroppedImage">Salvar Imagem</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editIcon = document.getElementById('edit-profile-pic');
        if (editIcon) {
            editIcon.addEventListener('click', function() {
                var uploadInput = $('<input type="file" accept="image/*">');
                uploadInput.on('change', function () {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        var modalBody = $('#modalBodyImage');
                        if (!modalBody.data('croppie')) {
                            modalBody.croppie({
                                viewport: { width: 200, height: 200, type: 'circle' },
                                boundary: { width: 300, height: 300 }
                            });
                        }
                        modalBody.croppie('bind', {
                            url: event.target.result
                        }).then(function() {
                            $('#editImageModal').modal('show');
                        });
                    };
                    reader.readAsDataURL(this.files[0]);
                });
                uploadInput.trigger('click');
            });
        }

        // Listener para o botão Salvar Imagem
        $('#saveCroppedImage').click(function() {
            var modalBody = $('#modalBodyImage');
            modalBody.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(image) {
                // Fazer requisição AJAX para enviar a imagem
                $.ajax({
                    url: '{{ route("user.change-image") }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "image": image,
                        "id": {{ isset($user->id) ? $user->id : 'null' }}
                    },
                    success: function(response) {
                        // Fechar modal e atualizar a imagem no perfil
                        $('#editImageModal').modal('hide');
                        $('.profile-pic img').attr('src', image);
                        // Opção para exibir alguma mensagem de sucesso ou erro, se necessário
                    },
                    error: function(error) {
                        console.error("Erro ao salvar a imagem: ", error);
                        // Opção para exibir alguma mensagem de erro, se necessário
                    }
                });
            });
        });
    });
</script>


<style>
    .profile-pic {
        position: relative;
        display: inline-block;
    }

    .profile-pic:hover .edit-icon {
        display: block;
    }

    .edit-icon {
        position: absolute;
        top: 0;
        right: 0;
        display: none;
        cursor: pointer;
    }
</style>
