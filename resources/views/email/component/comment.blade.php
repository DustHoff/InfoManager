<table class="subcopy" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            {{$user}}
        </td>
        <td>
            {{$date}}
        </td>
    </tr>
    <tr>
        <td colspan="2">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </td>
    </tr>
</table>