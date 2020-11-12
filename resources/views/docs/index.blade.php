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
                    <th colspan="4" class="center"><h5>User</h5></th>
                </tr>
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
                    <td>name, email</td>
                    <td>Mengupdate user berdasarkan id</td>
                </tr>

                <tr>
                    <td>/user/delete/</td>
                    <td>POST</td>
                    <td>user_id, password</td>
                    <td>Menghapus user berdasarkan id</td>
                </tr>

                <tr>
                    <td>/user/password/{id}</td>
                    <td>PATCH</td>
                    <td>old_password, password, password_confirmation</td>
                    <td>Mengubah password user</td>
                </tr>
                
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Shop</h5></th>
                </tr>
                <tr>
                    <th>Endpoint</th>
                    <th>Method</th>
                    <th>Data</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>/shop</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil semua data shop</td>
                </tr>

                <tr>
                    <td>/shop/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data shop berdasar id shop</td>
                </tr>

                <tr>
                    <td>/myshop/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data shop berdasar id user yang login</td>
                </tr>

                <tr>
                    <td>/shop</td>
                    <td>POST</td>
                    <td>shop_name, description, image(optional), user_id</td>
                    <td>Menambahkan / Mengupdate shop</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Product</h5></th>
                </tr>
                <tr>
                    <th>Endpoint</th>
                    <th>Method</th>
                    <th>Data</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>/product</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil semua data produk</td>
                </tr>

                <tr>
                    <td>/product/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data produk berdasar id produk</td>
                </tr>

                <tr>
                    <td>/product</td>
                    <td>POST</td>
                    <td>product_name, description, price, stock, image(optional), category_id, shop_id</td>
                    <td>Menambahkan produk</td>
                </tr>

                <tr>
                    <td>/product/{id}</td>
                    <td>PATCH</td>
                    <td>product_name, description, price, stock, image(optional), category_id</td>
                    <td>Mengubah produk</td>
                </tr>

                <tr>
                    <td>/product/{id}</td>
                    <td>DELETE</td>
                    <td>-</td>
                    <td>Menghapus produk</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>