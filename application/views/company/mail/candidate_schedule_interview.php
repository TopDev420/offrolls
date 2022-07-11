<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>45+ Jobs</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600%7CRoboto:300i,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . 'application/assets/css/mail/shortlist.css'; ?>">
</head>

<body yahoo bgcolor="#f6f8f1">
    <table width="100%" bgcolor="#f6f8f1">
        <tr>
            <td>
                <table bgcolor="#ffffff" class="content" align="center">
                    <tr>
                        <td bgcolor="#246df8" class="header">
                            <table>
                                <tr>
                                    <td style="width:200px;padding: 0 20px 20px 0;">
                                        <img class="fix" src="<?php echo base_url() . 'application/assets/images/logo.png'; ?>" border="0" alt="" />
                                    </td>
                                    <td style="width:400px;">
                                        <table width="100%">
                                            <tr>
                                                <td class="subhead" style="padding: 0 0 0 3px;">
                                                    Interview
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="h1 title2" style="padding: 5px 0 0 0;">
                                                    Confirmation Email
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom">
                            <table width="100%">
                                <tr>
                                    <td class="h2">
                                        Interview with <?php echo $company['company_name']; ?> for the  position of <?php echo $job['title']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bodycopy">
                                        <p>Dear <?php echo $candidate['name']; ?>,</p>

                                        <p>On behalf of <?php echo $company['company_name']; ?>, I would like to confirm your interview for the <?php echo $job['title']; ?> position. Below are the details of the interview:</p>

                                        <p>When: <?php echo $job['schedule_datetime']; ?></p>

                                        <p>Location: <?php echo $job['schedule_venue']; ?></p>

                                        <p>Please carry the below mentioned document (Mandatory):
                                            <ul>
                                                <li>Updated Resume</li>
                                                <li>Photo ID Proof</li>
                                                <li>2 Passport size Photographs</li>
                                                <li>Candidate should have Pan Card and Government ID Proof
                                            </ul>
                                        </p>

                                        <p>We look forward to have a discussion with you.</p>

                                        <p>If you have any questions, please do not hesitate to contact us.</p>
                                        <br>

                                        <p><strong>Note:</strong> Do not attend the interview if you have attended in last 6 months.</p>
                                        <br>

                                        <p>Kind regards / Best wishes, <br>
                                        <?php echo $company['company_name']; ?></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="footer" bgcolor="#fff">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" class="footercopy">
                                        <a href="#" class="unsubscribe">
                                            <img src="<?php echo base_url() . 'application/assets/images/footer-logo.png'; ?>" title="45+ Jobs" />
                                        </a>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="footercopy">
                                        <p>copyright &copy; <?php echo date('Y'); ?></p>
                                    </td>
                                </tr>
                                <tr class="social-links">
                                    <td align="center" style="padding: 0px 0 0 0;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="text-align: center; padding: 0 10px 0 10px;">
                                                    <a href="http://www.facebook.com/">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </td>
                                                <td style="text-align: center; padding: 0 10px 0 10px;">
                                                    <a href="http://www.twitter.com/">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
