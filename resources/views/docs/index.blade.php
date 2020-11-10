<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documentation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Endpoint</th>
                    <th>Method</th>
                    <th>Data</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>/login</td>
                    <td>POST</td>
                    <td>email, password</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td>/register</td>
                    <td>POST</td>
                    <td>name, email, password, password_confirmation</td>
                    <td>-</td>
                </tr>
                
                <tr>
                    <td>/getAuthenticatedUser</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data user yang login</td>
                </tr>

                <tr>
                    <td>/user/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Menampilkan user berdasarkan id</td>
                </tr>

                <tr>
                    <td>/user/detail</td>
                    <td>POST</td>
                    <td>user_id, phone_number, address, avatar(optional)</td>
                    <td>Mengupdate 'detail' user berdasarkan id</td>
                </tr>

                <tr>
                    <td>/user/update/{id}</td>
                    <td>POST</td>
                    <td>name, email, password, password_confirmation</td>
                    <td>Mengupdate user berdasarkan id</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>