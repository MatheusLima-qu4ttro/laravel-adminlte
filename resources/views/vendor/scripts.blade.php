<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    $(document).ready(function() {
        $('.phone-mask').mask('(00) 00000-0000');
        $('.cpf-mask').mask('000.000.000-00', {reverse: true});
        $('.cep-mask').mask('00000-000');
        $('.date-mask').mask('00/00/0000');
        $('.time-mask').mask('00:00:00');
        $('.real-mask').mask('#.##0,00', {reverse: true});
        $('.percent-mask').mask('##0,00%', {reverse: true});
        $('.number-mask').mask('0000000000');
        $('.year-mask').mask('0000');
        $('.month-mask').mask('00');
        $('.day-mask').mask('00');
        $('.hour-mask').mask('00');
        $('.minute-mask').mask('00');
        $('.second-mask').mask('00');
        $('.datetime-mask').mask('00/00/0000 00:00:00');
    });

</script>
{{--mostra mensagem de suceso se existir a variavel sucess--}}
@if(session('success'))
    <script>
        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session('success') }}',
            })
        }, 500);
    </script>
@endif

{{--mostra mensagem de erro se existir a variavel error--}}
@if(session('error'))
    <script>
        setTimeout(function() {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: '{{ session('error') }}',
            })
        }, 500);
    </script>
@endif

