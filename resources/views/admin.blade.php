<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
@if(count($results) > 0)
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Register Date</th>
                <th>Count</th>

              </tr>
              @foreach ( $results as $i=>$result )
              <tr>
              <td>
                  {{ $i+1 }}
            </td>
            <td>
                {{ $result->name }}
            </td>

            <td>
                {{ $result->email }}
            </td>

            <td>
                {{ $result->created_at }}
            </td>
            <td>
                {{ count($result->referrals) }}
            </td>
              </tr>
              @endforeach
        </table>
        {!! $results->links() !!}
@else
No Users Yet!
@endif
</body>
</html>
