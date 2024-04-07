<x-mail::message>
# Introduction
Hello, dear user, sir/madam: {{ $name  }}

<x-mail::panel :url="''">
Code :  <strong style="color: black">{{$code}}</strong>
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
