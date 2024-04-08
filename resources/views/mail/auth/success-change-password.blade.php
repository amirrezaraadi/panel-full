<x-mail::message>
# Change Password

Dear user <span style="font-size: large ; color: #3869d4">{{ $name  }}</span>, your password has been changed correctly

<x-mail::button :url="env('SITE_NAME')">
Enter the site
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
