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
                    <td>/logout</td>
                    <td>GET</td>
                    <td>-</td>
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
                    <td>/myshop/{user_id}</td>
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

                <tr>
                    <td>/shop/{id}/products</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil semua produk yang ada di shop berdasar id shop</td>
                </tr>

                <tr>
                    <td>/shop/{shop_id}/category</td>
                    <td>POST</td>
                    <td>category_id</td>
                    <td>Mengambil semua produk yang ada di shop berdasar id shop dan id category</td>
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

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Cart</h5></th>
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
                    <td>/user/cart/{user_id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data keranjang dari user</td>
                </tr>

                <tr>
                    <td>/user/cart</td>
                    <td>POST</td>
                    <td>product_id, user_id, shop_id, qty</td>
                    <td>Menambahkan produk ke keranjang</td>
                </tr>

                <tr>
                    <td>/user/cart/{id}</td>
                    <td>DELETE</td>
                    <td>-</td>
                    <td>Menghapus produk dari keranjang</td>
                </tr>

                <tr>
                    <td>/user/cart/{id}</td>
                    <td>PATCH</td>
                    <td>qty</td>
                    <td>Mengubah keranjang</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Transaction</h5></th>
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
                    <td>/user/{user_id}/transaction</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data transaksi user</td>
                </tr>

                <tr>
                    <td>/transaction/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data transaksi berdasarkan id</td>
                </tr>

                <tr>
                    <td>/transaction</td>
                    <td>POST</td>
                    <td>user_id, product_id, shop_id, qty</td>
                    <td>Menambah data transaksi</td>
                </tr>

                <tr>
                    <td>/transaction/{id}</td>
                    <td>PATCH</td>
                    <td>status(pending, proccess, done)</td>
                    <td>Mengubah status transaksi</td>
                </tr>

            </tbody>
        </table>

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>