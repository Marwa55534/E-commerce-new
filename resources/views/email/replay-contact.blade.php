<x-mail::message>
# Hello {{$clientName}},

Thank you for

**Oure Response:**
{{$replayMessage}}

if you have any

<x-mail::button :url="config('app.url')">
Visit Our WebSite
</x-mail::button>

Best Regards
**{{ config('app.name') }}**
{{ config('app.url') }}

</x-mail::message>
