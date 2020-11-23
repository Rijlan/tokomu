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

                <tr>
                    <td>/shop/{shop_id}/transaction</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data pesanan shop</td>
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

                <tr>
                    <td>/product/category/{category_id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mencari Produk berdasarkan kategori</td>
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
                    <td>product_id, user_id, qty</td>
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
                    <td>user_id, product_id, qty</td>
                    <td>Menambah data transaksi</td>
                </tr>

                <tr>
                    <td>/transaction/{id}</td>
                    <td>PATCH</td>
                    <td>status(belum dibayar, diproses, dikirim, selesai, dibatalkan)</td>
                    <td>Mengubah status transaksi</td>
                </tr>

                <tr>
                    <td>/transaction/approve</td>
                    <td>POST</td>
                    <td>transaction_id, receipt, delivery_service</td>
                    <td>Mengkonfirmasi Pembayaran</td>
                </tr>

                <tr>
                    <td>/shop/{shop_id}/transaction/status</td>
                    <td>POST</td>
                    <td>status(belum dibayar, diproses, dikirim, selesai, dibatalkan)</td>
                    <td>Mengambil list transaksi pada toko berdasarkan statusnya</td>
                </tr>

                <tr>
                    <td>/transaction/{id}</td>
                    <td>DELETE</td>
                    <td>-</td>
                    <td>Menghapus data transaksi berdasarkan id</td>
                </tr>

            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Payment</h5></th>
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
                    <td>/payment/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data pembayaran user berdasarkan id</td>
                </tr>

                <tr>
                    <td>/payment/transaction/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil data pembayaran user berdasarkan id transaksi</td>
                </tr>

                <tr>
                    <td>/payment</td>
                    <td>POST</td>
                    <td>transaction_id, image</td>
                    <td>Menambah bukti pembayaran</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Invoice</h5></th>
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
                    <td>/invoice/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil resi berdasarkan id</td>
                </tr>

                <tr>
                    <td>/invoice/transaction/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil resi berdasarkan id transaksi</td>
                </tr>

                <tr>
                    <td>/invoice/{id}</td>
                    <td>PATCH</td>
                    <td>receipt, delivery_service</td>
                    <td>Mengupdate resi</td>
                </tr>

                <tr>
                    <td>/invoice/{id}</td>
                    <td>DELETE</td>
                    <td>-</td>
                    <td>Menghapus resi</td>
                </tr>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Account</h5></th>
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
                    <td>/account/{id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil rekening berdasarkan id</td>
                </tr>
    
                <tr>
                    <td>/shop/account/{shop_id}</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil rekening berdasarkan id</td>
                </tr>

                <tr>
                    <td>/shop/account</td>
                    <td>POST</td>
                    <td>shop_id, nama_rekening, no_rekening, nama_bank, kode_bank</td>
                    <td>Menambahkan rekening pada shop</td>
                </tr>

                <tr>
                    <td>/account/{id}</td>
                    <td>PATCH</td>
                    <td>nama_rekening, no_rekening, nama_bank, kode_bank</td>
                    <td>Mengubah rekening pada shop</td>
                </tr>

                <tr>
                    <td>/account/{id}</td>
                    <td>DELETE</td>
                    <td>-</td>
                    <td>Menghapus rekening berdasarkan id</td>
                </tr>

            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Chat</h5></th>
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
                    <td>/user/{user_id}/chat</td>
                    <td>GET</td>
                    <td>-</td>
                    <td>Mengambil list yang pernah chat</td>
                </tr>

                <tr>
                    <td>/chat/user/{user_id}</td>
                    <td>POST</td>
                    <td>from</td>
                    <td>Mengambil chat dari user yang login dan satunya</td>
                </tr>

                <tr>
                    <td>/chat/send/{user_id}</td>
                    <td>POST</td>
                    <td>to, chat</td>
                    <td>Mengirim chat</td>
                </tr>

            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4" class="center"><h5>Other</h5></th>
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
                    <td>/search</td>
                    <td>POST</td>
                    <td>keyword</td>
                    <td>Memcari toko atau produk</td>
                </tr>

            </tbody>
        </table>

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>