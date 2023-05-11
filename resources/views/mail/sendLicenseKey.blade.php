<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LDM send License Key</title>
</head>
<body>
    <div class="card">
        <p>There are license key:</p><br>
        <div class="table-responsive text-wrap">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên phần mềm</th>
                        <th>Phiên bản</th>
                        <th>Licence key</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $user->software_info as $key => $software )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><strong>{{ $software['name'] }}</strong></td>

                        <td>{{ $software['version'] }}</td>
                        <td>{{ $software['license_key'] }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
