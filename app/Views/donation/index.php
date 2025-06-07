
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <script src="<?= base_url('assets/js/jquery-3.5.1.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Donation</title>
  </head>
  <body>
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AY_ZCKmx284vw_krs0hcDCCtJXIP7C7l2YINSydSL6Tu6ECp7i1NT-nBLIuhg9QplPf84TYVfTzC5eRN&currency=AUD"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>">Discussion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Navigation
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= site_url('forum') ?>">Discussion Board</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('forum/note') ?>">Study Notes Share</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('dashboard') ?>">User Profile</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('donation') ?>">Donate Us</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <!-- Please note that below block of code is from the PayPal offical website for the usage of Integrate PayPal Checkout for online payments -->
    <!-- reference & source: https://developer.paypal.com/docs/checkout/standard/integrate/ -->
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container" style="justify-content: center;"></div>
        <script>
        paypal.Buttons({
            // Order is created on the server and the order id is returned
            createOrder() {
            return fetch("/my-server/create-paypal-order", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                },
                // use the "body" param to optionally pass additional order information
                // like product skus and quantities
                body: JSON.stringify({
                cart: [
                    {
                    sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                    quantity: "YOUR_PRODUCT_QUANTITY",
                    },
                ],
                }),
            })
            .then((response) => response.json())
            .then((order) => order.id);
            },
            // Finalize the transaction on the server after payer approval
            onApprove(data) {
            return fetch("/my-server/capture-paypal-order", {
                method: "POST",
                headers: {
                "Content-Type": "application/json",
                },
                body: JSON.stringify({
                orderID: data.orderID
                })
            })
            .then((response) => response.json())
            .then((orderData) => {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                // When ready to go live, remove the alert and show a success message within this page. For example:
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  window.location.href = 'thank_you.html';
            });
            }
        }).render('#paypal-button-container');
        </script>
  </body>
</html>
