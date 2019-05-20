@if ($msg)

    @php
        switch ($status) {
            case 'success':
                $status = 'success';
                break;
            case 'error':
                $status = 'danger';
                break;
            case 'notification':
                $status = 'warning';
                break;
            default:
                $status = 'secondary';
                break;
        }
    @endphp

    <div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">
        {{ $msg }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif