<?php

namespace views\admin;

require_once 'autoload.php';

use Exception;
use db\ProductDb;
use model\user\Role;

session_start();

// redirect if not admin
if ($_SESSION['userRole'] != Role::$ADMIN) {
    header('Location: ./redirect');
}


if (!isset($_SESSION["isLogin"])) {
    $_SESSION["loginError"] = "You're not login!. Login First";
    header('Location: ./login');
    exit();
}

//redirect to login page if not login
if ($_SESSION["isLogin"] == false) {
    header('Location: ./login');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Admin</title>
    <!-- Bootsrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <!-- fontawesoome -->
    <script src="https://kit.fontawesome.com/f0632fdfe1.js" crossorigin="anonymous"></script>

</head>

<body>

    <style>
        .img-small {
            width: 100px;
            height: 100px;
        }

        .bg-nav {
            background-color: #4aa4e4;
        }

        .nav-link {
            padding: 10px 30px !important;
            background-color: #138afe;
            border-radius: 20px;
            color: white !important;
        }
    </style>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-nav p-3">
        <a class="navbar-brand" href="#">
            <img src="./resources/images/store.png" width="30" height="30" alt="">
            COMBRA ADMIN
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="gap:10px">
                <li class="nav-item">
                    <a class="nav-link" href="#">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="mx-auto container-fluid" style="max-width: 1400px">

        <div class="p-2">
            <button class="btn btn-primary add-product">Add Product</button>

            <div class='table-responsive my-2' style='max-height:530px;'>
                <table class='table table-bordered table-hover table-light table-product'>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $hiddenContent = 0;

                    try {

                        $count = 0;

                        // get all products then loop
                        foreach (ProductDb::getAllProducts() as $product) {

                            $imageFinalPath =  $product->getImagePath();

                            echo "<tr id='", $product->getId(), "'>";
                            echo "<td>", ++$count, "</td>";
                            echo "<td>", $product->getId(), "</td>";
                            echo "<td>", $product->getName(), "</td>";
                            echo "<td style='min-width:40ch'>", $product->getDescription(), "</td>";
                            echo "<td>", $product->getPrice(), "</td>";
                            echo "<td>", $product->getCategory(), "</td>";
                            echo "<td>", $product->getStock(), "</td>";
                            echo "<td> ", "<img class='img-small' src=\"$imageFinalPath\">", "</td>";
                            echo "<td><i class='d-block product-edit  mb-2 btn btn-primary fa-solid fa-pen-to-square' onclick='updateProduct(", $product->getId(), ")'></i>
                                        <i class='d-block product-delete  btn btn-danger fa-solid fa-trash' onclick='deleteProduct(", $product->getId(), ")'></i>
                                        </td>";
                            echo "</tr>";
                        }
                    } catch (Exception $e) {
                        echo "<p class='text-danger'>", $e->getMessage(), "</p>";
                    }

                    ?>
                </table>
            </div>
        </div>

        <!--modal for add product-->
        <div class="modal" tabindex="-1" role="dialog" id="confirmation">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>ADD PRODUCT</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="" class="form">
                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" class="form-control" id="image" accept="image/png, image/gif, image/jpeg" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" maxlength="30" minlength="3" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea class="form-control" rows="5" id="description" maxlength="600" minlength="10" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" class="form-control" id="price" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <input type="text" name="category" id="category" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Stock</label>
                                    <input type="number" class="form-control" id="stock" min="0" required>
                                </div>
                                <div class="form-group my-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary" id="sureLogout">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--modal for update product-->
        <div class="modal" tabindex="-1" role="dialog" id="update-dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>UPDATE PRODUCT</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="" class="form">
                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" class="form-control" id="update-image" accept="image/png, image/gif, image/jpeg" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="update-name" maxlength="30" minlength="3" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea class="form-control" rows="5" id="udpate-description" maxlength="600" minlength="10" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" class="form-control" id="update-price" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" id="update-category" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Stock</label>
                                    <input type="number" class="form-control" id="update-stock" min="0" required>
                                </div>
                                <div class="form-group my-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="update-product">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script>
        // for adding product
        // product details
        const productImage = document.getElementById('image');
        const productName = document.getElementById('name');
        const productDescription = document.getElementById('description');
        const productPrice = document.getElementById('price');
        const productCategory = document.getElementById('category');
        const productStock = document.getElementById('stock');

        // product popup show button
        const addProductBtn = document.querySelector('.add-product');

        // form
        const form = document.querySelector('.form');

        // product tbale
        const productTable = document.querySelector('.table-product');

        form.addEventListener('submit', addProduct);

        async function addProduct(event) {
            // prevent form from sending data
            event.preventDefault();

            //  1,048,576  -> 1 mb
            // limit file size of image
            if (productImage.files[0].size > 1048576) {
                alert("Image is to big: 1mb limit.");
                return;
            };

            // save image as form data
            const form_data = new FormData();

            form_data.append('sample_image', productImage.files[0]);
            form_data.append('name', productName.value);
            form_data.append('price', productPrice.value);
            form_data.append('description', productDescription.value);
            form_data.append('category', productCategory.value);
            form_data.append('stock', productStock.value);

            // post first the image
            const imagePath = await fetch('./product-controller', {
                    method: "POST",
                    body: form_data,
                })
                .then(res => {
                    if (res.ok) return res.json();
                }).then(res => {
                    console.log(res);
                    renderProductInTable(res.message);
                    form.reset();
                    // hide product form
                    $('#confirmation').modal('hide');
                    window.alert('Product Added');
                })
                .catch(res => {
                    console.log(res);
                    window.alert('Unable to add product');
                })
        }

        // show/hide product popup
        addProductBtn.addEventListener('click', function(event) {
            event.preventDefault();
            $('#confirmation').modal('show');
        });

        function renderProductInTable(product) {

            let row = document.createElement('tr');
            row.setAttribute('id', product.id);

            // numbering
            let data = document.createElement('td');
            let content = document.createTextNode(productTable.children[0].children.length);
            row.appendChild(data);
            data.appendChild(content);

            // content
            for (const key in product) {

                data = document.createElement('td');
                content = document.createTextNode(product[key]);

                // for image 
                if (key === 'imagePath') {
                    let img = document.createElement('img');
                    img.setAttribute('src', product[key]);
                    img.setAttribute('class', 'img-small');
                    row.appendChild(data);
                    data.appendChild(img);
                    continue;
                }

                row.appendChild(data);
                data.appendChild(content);

            }

            let actionRow = document.createElement('td');
            let editAction = document.createElement('i');
            let deleteAction = document.createElement('i');
            editAction.setAttribute('class', 'd-block product-edit mb-2 btn btn-primary fa-solid fa-pen-to-square');
            deleteAction.setAttribute('class', 'd-block product-delete  btn btn-danger fa-solid fa-trash');

            actionRow.appendChild(editAction);
            actionRow.appendChild(deleteAction);

            row.appendChild(actionRow);

            // target table product body
            productTable.children[0].appendChild(row);

            editAction.addEventListener('click', (event) => {
                updateProduct(product.id);
            })

            deleteAction.addEventListener('click', (event) => {
                deleteProduct(product.id);
            })
        }

        //==== important! for edit and delete action ====
        async function deleteProduct(productId) {

            const res = await fetch('./delete-product', {
                method: 'POST',
                body: JSON.stringify({
                    id: productId,
                }),
            }).then(res => {
                if (res.ok) return res.json();
            }).then(res => {
                const row = document.getElementById(productId);
                row.remove();
                alert("Product deleted");
            }).catch(res => {
                alert("Unable to delete product");
            })
        }

        // Update product

        function updateProduct(productId) {

            const name = document.querySelector('#update-name');
            const description = document.querySelector('#udpate-description');
            const price = document.querySelector('#update-price');
            const category = document.querySelector('#update-category');
            const stock = document.querySelector('#update-stock');
            const imageSrc = document.querySelector('#update-image');

            $('#update-dialog').modal('show');

            // array | targer the <th> that contains the details of the product
            const productWrapper = document.getElementById(productId);

            name.value = productWrapper.children[2].innerHTML;
            description.value = productWrapper.children[3].innerHTML;
            price.value = productWrapper.children[4].innerHTML;
            category.value = productWrapper.children[5].innerHTML;
            stock.value = productWrapper.children[6].innerHTML;

            const origImage = productWrapper.children[7].children[0].src;

            const updateProductBtn = document.querySelector('#update-product');

            // send an update request
            updateProductBtn.addEventListener('click', updateToServer);

            async function updateToServer(event) {

                event.preventDefault();

                const form_data = new FormData();
                form_data.append('sample_image', imageSrc.files[0]);
                form_data.append('image', origImage);
                form_data.append('id', productId);
                form_data.append('name', name.value);
                form_data.append('price', price.value);
                form_data.append('description', description.value);
                form_data.append('category', category.value);
                form_data.append('stock', stock.value);

                await fetch('./update-product', {
                        method: "POST",
                        body: form_data,
                    })
                    .then(res => {
                        if (res.ok) return res.json();
                    }).then(res => {
                        console.log(res.message);
                        renderUpdateProduct(res.message);
                        $('#update-dialog').modal('hide');
                        window.alert('Product Update Success');
                    }).catch(res => {
                        window.alert('Update Failed');
                        console.log(res);
                    })
            }

            function renderUpdateProduct(product) {
                productWrapper.children[1].innerHTML = product.id;
                productWrapper.children[2].innerHTML = product.name;
                productWrapper.children[3].innerHTML = product.description;
                productWrapper.children[4].innerHTML = product.price;
                productWrapper.children[5].innerHTML = product.category;
                productWrapper.children[6].innerHTML = product.stock;

                if (product.imagePath != null) {
                    productWrapper.children[7].children[0].src = product.imagePath;
                }
            }
        }
    </script>
</body>

</html>