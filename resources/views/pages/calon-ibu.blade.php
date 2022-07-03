@extends('../layouts/side-menu')

@section('subhead')
    <title>Stunting - Calon Ibu</title>
@endsection

@section('calon-ibu', 'side-menu--active')
@section('title', 'Calon Ibu')

@section('subcontent')

    @livewire('calon-ibu-index')

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
        title: 'Data Calon Ibu Berhasil disimpan!'
        }) 
    });
</script>