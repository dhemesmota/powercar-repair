<div class="table-responsive-lg">
    <table class="table table-hover">
        <thead>
            <tr>
                @foreach ($columnList as $key => $value)
                    <th scope="col">{{ $value }}</th>      
                @endforeach
                <th scope="col" class="text-right">{{ __('linguagem.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $value)
            <tr>
                @foreach ($columnList as $key2 => $value2)
                    @if ($key2 == 'id')
                        <th scope="row">@php echo $value->{$key2} @endphp</th>
                    @elseif($key2 == 'image')
                        <td>
                            <img style="max-width: 40px;" class="img-fluid rounded" src="{{$value->$key2}}" alt="perfil">
                        </td>
                    @elseif($key2 == 'value')
                        <td>@php echo "R$ ".$value->{$key2} @endphp</td>
                    @else
                        <td>@php echo $value->{$key2} @endphp</td>
                    @endif
                @endforeach
                <td class="text-right">
                    @can($permissionShow)
                        <a href="{{ route($routeName.'.show',$value->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    @endcan
                    @can($permissionEdit)
                        <a href="{{ route($routeName.'.edit',$value->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                    @can($permissionDelete)
                        <a href="{{ route($routeName.'.show',[$value->id,'delete=1']) }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>