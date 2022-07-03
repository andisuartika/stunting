@extends('../layouts/side-menu')

@section('subhead')
    <title>Stunting - Balita</title>
@endsection

@section('balita', 'side-menu--active')
@section('title', 'Balita')

@section('subcontent')
@livewire('balita-index')
@endsection

<script>
    window.addEventListener('swal:modalSuccess', event => {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Data Balita Berhasil disimpan!'
        }) 
    });
</script>