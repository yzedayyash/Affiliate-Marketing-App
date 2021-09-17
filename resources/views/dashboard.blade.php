<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <ul class="list-group mt-3">
        <li class="list-group-item" >Referral link: <p id='ref'> {{URl('/register?ref=') . Auth::user()->referral_code }} </p></li> <button class="copy" onclick="copy()"> copy</button>


        <li class="list-group-item">Refferal count: {{ $referrals->total() }}</li>
        <li class="list-group-item">Visitors: {{ $user->views }}</li>


@if(count($referrals) > 0)
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
              @foreach ( $referrals as $i=>$referral )
              <tr>
              <td>
                  {{ $i+1 }}
            </td>
            <td>
                {{ $referral->name }}
            </td>

            <td>
                {{ $referral->email }}
            </td>
              </tr>
              @endforeach
        </table>
        {!! $referrals->links() !!}
@else
No Referrals Yet!
@endif
    </ul>


<canvas id="chart" style="width:100%;max-width:700px;max-height:300px;"></canvas>


</body>
</html>

<script
src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.js">
</script>




    <script>
function copy() {
    const area = document.getElementById('ref').textContent
    navigator.clipboard.writeText(area);
}





</script>


<script>
document.addEventListener("DOMContentLoaded", function(event) {

    var csrf_token ='{{csrf_token()}}';


      var req = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object

      req.open('get', '/chart', true); // set the request


      req.send('_token='+csrf_token); //sends csrf_token

      // If the response is successfully received, sets csrf_token
      req.onreadystatechange = function(){
        if(req.readyState ==4){
          var resp = JSON.parse(req.responseText);

          dates = [];
    values = [];
    colors = [];
    for (var key in resp) {
 dates.push(resp[key].date);
 values.push(resp[key].total_users);
 colors.push('#'+Math.floor(Math.random()*16777215).toString(16)) ;

}

console.log(colors)
    var xValues =dates;
    var yValues = values;




    new Chart("chart", {
      type: "bar",
      label: 'Last 14 Days Data',
      data: {
        labels: xValues,

        datasets: [{
            backgroundColor: colors,
          data: yValues
        }]
      },  options: {
    scales: {
        yValues: {
        beginAtZero: true,
       ticks:{
           stepSize:1
       }

      }
    },
    plugins: {
            legend: {
                display: false,
            }
        }
      }

    });


        }
      }

    });
    </script>
