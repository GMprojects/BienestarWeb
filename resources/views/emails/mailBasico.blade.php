@component('mail::message')
# {{$subject}}
<br>
@if ($sexoReceptor == 'm') Estimada @else Estimado @endif
{{ ucwords(strtolower($nombreReceptor)) }},
<br>
{{ $mensaje }}
<br><br>
@if ($url != NULL)
@component('mail::button', ['url' => $url, 'color' => 'blue'])
   {{ $accion }}
@endcomponent
@endif
<br><br>
@if ($nombreEmisor!=null)
Atentamente, {{ ucwords(strtolower($nombreEmisor)) }}
@endif
<br>
Gracias,<br>
{{ config('app.name') }}
[Pagina Web]({{ config('app.url') }})

@if ($url != NULL)
@component('mail::subcopy')
Si tiene problemas para hacer clic en el botón {{ $accion }},copie y pegue la siguiente URL en su navegador web: [{{ $url }}]({{ $url }})
@endcomponent
@endif
@endcomponent
