<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?= ROOT_ASSEST ?>css/invoice.css" rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Invoice</title>
    <style>
        body {
        font-family: sans-serif;
        }

        .box-container {
        padding: 2rem;
        border: 1px solid #f2f2f2;
        border-radius: 5px;
        background-color: #ffffff;
        margin-left: 10%;
        margin-right: 10%;
        }

        .box-container .title {
        font-weight: bold;
        padding: 1rem;
        border-bottom: 1px solid #f2f2f2;
        background-color: #f2f2f2;
        }

        .transaction-box {
        margin-top: 1rem;
        }

        .transaction-box .item {
        display: table;
        width: 100%;
        margin-bottom: 1rem;
        }

        .transaction-box .item>* {
        display: table-cell;
        vertical-align: middle;
        }

        .transaction-box .item> :first-child {
        text-align-last: left;
        }

        .transaction-box .item> :last-child {
        text-align-last: right;
        font-weight: bold;
        }

        .transaction_details_box {
        margin-top: 3rem;
        border-radius: 5px;
        display: table;
        width: 100%;
        margin-bottom: 3rem;
        }

        .transaction_details_box .left {
        display: table;
        margin-bottom: 1rem;
        width: 100%;
        }

        .transaction_details_box .left>* {
        display: table-cell;
        vertical-align: middle;
        }



        .transaction_details_box .left .item {
            display: table;
            width: 100%;
            float: left;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item>* {
        display: table-cell;
        vertical-align: middle;

        width: 100%;
        margin-bottom: 1rem;
        }

        .transaction_details_box .left .item> :first-child {
        text-align: left;
        }

        .transaction_details_box .left .item> :last-child {
        text-align: right;
        }

        .transaction_details_box .right {
            display: table;
            width: 100%;
        }

        .transaction_details_box .right table {
            width: 100%;
        }

        .transaction_details_box .right .payment_tile {
        margin-top: 2rem;
        margin-bottom: 2rem;
        text-transform: uppercase;
        font-weight: bold;
        }

        th {
        background: #8a97a0;
        color: #fff;
        }

        tr {
        background: #f4f7f8;
        }

        tr:nth-child(even) {
        background: #e8eeef;
        }

        th,
        td {
        padding: 0.5rem;
        }

        .single_item .value {
        font-weight: bold;
        }
    </style>
</head>

<body>

<div class="box-container">

    <div class="title">
        <b>Payment Invoice</b>
    </div>

    <div class="transaction-box">

        <div class="item">
            <div class="label">Employer ID:</div>
            <div class="value">Emp<?= $paymentFullInfo['employer']->id ?></div>
        </div>
        <div class="item">
            <div class="label">First Name & Last Name:</div>
            <div class="value"><?= $paymentFullInfo['employer']->firstName.' '.$paymentFullInfo['employer']->lastName  ?></div>
        </div>
        <div class="item">
            <div class="label">Department:</div>
            <div class="value"><?= $paymentFullInfo['departement']->name ?></div>
        </div>
        <div class="item">
            <div class="label">Month & Year:</div>
            <div class="value"><?= Glb::getMonthName($paymentFullInfo['payment']->month) .' '. $paymentFullInfo['payment']->year?> </div>
        </div>

    </div>

    <div class="last_item">

        <div class="title"> Transaction Summary
        </div>
        <div class="transaction_details_box">
            <div class="">

                <div class="item">
                    <div class="label">Reference: <?= $paymentFullInfo['payment']->reference ?></div>
                    
                </div>
                <div class="item">
                    <div class="label">Fees : 0</div>
                </div>
            </div>
            <div class="right">
                <div class="payment_tile">Payment Details</div>
                <table>
                    <thead>
                        <th>Transaction  Date</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $paymentFullInfo['payment']->launch_date_time ?></td>
                            <td><i class="fas fa-dollar-sign"></i> <?= $paymentFullInfo['payment']->amount ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="single_item"> <span>Total</span>
                                    <span class="value"><?= $paymentFullInfo['payment']->amount ?> Dollar</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="single_item">
                                    <span>Total Fees</span>
                                    <span class="value">0</span>
                                </div>
                                <div class="single_item">
                                    <span>Total Paid</span>
                                    <span class="value">0</span>
                                </div>
                                <div class="single_item">
                                    <span>Amount Remaining</span>
                                    <span class="value">0</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

    
</body>

</html>
