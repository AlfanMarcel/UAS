<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
</head>

<body>
    <style>
        table, td, th {
          border: 1px solid black;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }

        th {
          height: 10px;
        }
        </style>

    <center>
        <h2>Laporan History</h4>
    </center>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$data->user->name}}</td>
                <td>{{number_format($data->total,2)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
