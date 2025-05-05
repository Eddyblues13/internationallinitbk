<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Notification - International Linit Bank</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #1a365d;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .bank-description {
            font-size: 14px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .content {
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        .transaction-details {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #4a5568;
        }

        .amount {
            font-size: 24px;
            font-weight: bold;

            color: {
                    {
                    $transactionType ==='credit' ? '#38a169': '#e53e3e'
                }
            }

            ;
            text-align: center;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #718096;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;

            background-color: {
                    {
                    $transactionType ==='credit' ? '#c6f6d5': '#fed7d7'
                }
            }

            ;

            color: {
                    {
                    $transactionType ==='credit' ? '#22543d': '#742a2a'
                }
            }

            ;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .copyright {
            margin-top: 10px;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>International Linit Bank</h2>
        <div class="bank-description">
            Your trusted global banking partner since 1985 - Providing innovative financial solutions worldwide
        </div>
    </div>

    <div class="content">
        <h3>Hello {{ $user->name }},</h3>

        <p>Your {{ $type }} account has been {{ $transactionType }}ed with the following details:</p>

        <div class="amount">
            {{ $currency }}{{ number_format($amount, 2) }}
        </div>

        <div class="transaction-details">
            <div class="detail-row">
                <span class="detail-label">Transaction ID:</span>
                <span>{{ $transactionId }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date & Time:</span>
                <span>{{ $transactionDate }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Account Type:</span>
                <span>{{ $type }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Transaction Type:</span>
                <span>{{ ucfirst($transactionType) }} <span class="status-badge">{{ $status }}</span></span>
            </div>
        </div>

        <p>If you have any questions about this transaction, please contact our support team.</p>

        <p>Thank you for banking with International Linit Bank!</p>

        <div class="footer">
            <p>International Linit Bank Limited is registered in England and Wales with company number 04260907.</p>
            <p>Authorised and regulated by the Financial Conduct Authority under the Electronic Money Regulations 2011.
            </p>
            <div class="copyright">
                © {{ date('Y') }} International Linit Bank Limited. International Linit Bank is a registered trademark
                of ILB Ltd. All rights reserved.
            </div>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>

</html>