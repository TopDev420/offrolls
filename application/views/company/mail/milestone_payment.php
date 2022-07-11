<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Payment Mail</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                color: #3c3c3c;
                margin: 0;
                padding: 0;
                width: 100%;
                height: auto;
            }

            p {
                font-size: 18px;
            }

            table td {
                text-align: left;
                padding: 8px;
            }
            .show-100 {
                width: 100%;
                display: block;
            }

            .show-50 {
                width: 50%;
                display: block;
            }

            .table-title {
                font-size: 18px;
                background-color: #EFEFEF;
                font-weight: bold;
                text-align: left;
                padding: 10px;
            }

            .top-header td {
                border: 0;
            }

            .detail table {
                border-collapse: collapse;
                width: 100%;
                border-top: 1px solid #DDDDDD;
                border-left: 1px solid #DDDDDD;
                margin-bottom: 20px;
            }

            .detail table td {
                border-right: 1px solid #DDDDDD;
                border-bottom: 1px solid #DDDDDD;
            }
        </style>
    </head>
    <body>
        <div style="width: 680px;">
            <br>
            <div class="top-header show-100">
                <table>
                    <thead>
                        <tr>
                            <td>
                                <h2>Dear <?php echo $company->company_name ; ?>,</h2>
                                <p>Thank you for your order<p>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

            <br>
            <div class="show-50 detail">
                <table>
                    <thead>
                      <tr>
                        <td class="table-title">
                        Registration Id
                        </td>
                        <td class="table-title">
                        Payment Id
                        </td>
                        <td class="table-title">
                        Payment Date
                        </td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                            <p><?php echo $company->company_id; ?><br /></p>
                        </td>
                        <td>
                            <p> <?php echo $milestone->cjm_payment_id; ?><br /></p>
                        </td>
                        <td>
                            <p> <?php echo date('d/M/Y', strtotime($milestone->cjm_date_added)); ?><br /></p>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="detail">
                <table>
                    <thead>
                      <tr>
                        <td class="table-title" colspan="2">
                        Billing Detail
                        </td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                            <p><b>Name : </b> <?php echo $company->company_name; ?><br /></p>
                            <p><b>Email : </b> <?php echo $company->email; ?><br /></p>
                            <p><b>Mobile : </b> <?php echo $company->mobile; ?><br /></p>
                            <p><b>Pay Mode : </b> <?php echo $milestone->cjm_instrument_type; ?> (<?php echo $milestone->billing_instrument; ?>)<br /></p>
                        </td>
                        <td>
                            <p><b>Pay For: </b> <?php echo ucfirst(str_replace('_', ' ', $milestone->payment_type)); ?></p>
                            <p><b>Amount: </b> <?php echo format_currency($milestone->amount); ?></p>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
            <?php if($job){ ?>
                <div class="detail">
                    <table>
                        <thead>
                          <tr>
                            <td class="table-title" colspan="2">
                            Course
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                                <p><b>Name : </b> <?php echo $job->title; ?><br /></p>
                                <p><b>Duration : </b> <?php echo $milestone->cjm_duration; ?><br /></p>
                                <p><b>Fees : </b> <?php echo format_currency($milestone->cjm_amount); ?><br /></p>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
      </body>
</html>



