<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CMS BKIPM - Orders</title>
  
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
  
  </head>
  <style>
    table {
      width: 100%;
    }
    table, th, td {
      border: 1px solid black;
    }
  </style>
  <body onload="window.print()">
    <table>
      <tr style="text-align: right;">
        <td>20 Juli 2021</td>
      </tr>
      <tr>
        <td>Nama : {{ @$order->customers->nama  }}</td>
      </tr>
      <tr>
        <td>Alamat : {{ @$order->customers->alamat  }}</td>
      </tr>
      <tr>
        <td>No. HP : {{ @$order->customers->no_tlp  }}</td>
      </tr>
      <tr>
        <td>
          Pesanan :
          <ul>
            @if(@$items != null)
              @foreach(@$items as $item)
                <li>{{ @$item->total }} x {{ @$item->products->nama_produk }} / {{ @$item->size->size }}</li>
              @endforeach
            @endif
          </ul>
        </td>
      </tr>
      <tr>
        <td><strong>{{ @$order->delivery->delivery  }}</strong></td>
      </tr>
      <tr>
        <td>
          Dari {{ config('app.name') }}<br>
          {{ config('app.telephone') }}
        </td>
      </tr>
      <tr>
        <td><strong><i class="icon-warning"></i> FRAGILE! JANGAN DIBANTING!</strong></td>
      </tr>
    </table>
  </body>
</html>