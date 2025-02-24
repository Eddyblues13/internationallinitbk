<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container receipt-container mt-5">
        <div class="card shadow-lg p-4 receipt-card">
            <!-- Receipt Header -->
            <div class="receipt-header mb-4 border-bottom pb-4">
                <div class="row align-items-center">
                    <div class="col-3 text-center p-3"
                        style="background: linear-gradient(135deg, #1a237e, #0d47a1); border-radius: 10px;">
                        <img src="{{ asset('uploads/logo.png') }}" alt="Company Logo" class="img-fluid receipt-logo">
                    </div>

                    <div class="col-6 text-center">
                        <h1 class="company-name">International Linit Bank</h1>

                    </div>
                    <div class="col-3 text-right">
                        <div class="watermark">PAID</div>
                    </div>
                </div>
            </div>

            <!-- Transaction Meta -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <dl class="row meta-info">
                        <dt class="col-sm-5">Issued To:</dt>
                        <dd class="col-sm-7">{{ Auth::user()->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-5">Transaction Date:</dt>
                        <dd class="col-sm-7">{{ now()->format('d M Y, H:i:s') }}</dd>

                        <dt class="col-sm-5">Receipt No:</dt>
                        <dd class="col-sm-7">GF-{{ strtoupper(Str::random(8)) }}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row meta-info">
                        <dt class="col-sm-5">Reference Code:</dt>
                        <dd class="col-sm-7 text-monospace">{{ $transferData['reference'] ?? 'N/A' }}</dd>

                        <dt class="col-sm-5">Authorization Code:</dt>
                        <dd class="col-sm-7 text-monospace">{{ substr(md5(time()), 0, 12) }}</dd>
                    </dl>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="receipt-body mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="section-title">Transaction Summary</h4>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between">
                                <span>Base Amount:</span>
                                <span>{{ Auth::user()->currency }}{{ number_format($transferData['validated']['amount']
                                    ?? 0, 2) }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between">
                                <span>Transfer Fee:</span>
                                <span>{{ Auth::user()->currency }}{{ number_format(($transferData['validated']['amount']
                                    ?? 0) * 0.015, 2)
                                    }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between font-weight-bold">
                                <span>Total Amount:</span>
                                <span>{{ Auth::user()->currency }}{{ number_format(($transferData['validated']['amount']
                                    ?? 0) * 1.015, 2)
                                    }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="section-title">Payment Details</h4>
                        <ul class="list-unstyled payment-details">
                            <li class="mb-2">
                                <i class="fas fa-wallet"></i>
                                {{ ucfirst($transferData['validated']['account'] ?? 'N/A') }} Account
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-coins"></i>
                                {{ $transferData['type'] ?? 'N/A' | upper }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-barcode"></i>
                                {{ $transferData['cot_code'] ?? 'N/A' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="receipt-footer mt-4 border-top pt-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Compliance Information</h5>
                        <dl class="row">
                            <dt class="col-sm-4">Tax Code:</dt>
                            <dd class="col-sm-8">{{ $transferData['details']['tax_code'] ?? 'N/A' }}</dd>

                            <dt class="col-sm-4">COT Class:</dt>
                            <dd class="col-sm-8">A-{{ substr($transferData['cot_code'] ?? '000', 0, 3) }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <div class="security-info">
                            <p class="text-muted small mb-1">SECURITY VERIFICATION</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="verification-badge">
                                    <i class="fas fa-shield-check text-success"></i>
                                    SSL Secured Transaction
                                </div>
                                <div class="signature-box">
                                    <div class="signature-line"></div>
                                    <small class="text-muted">Authorized Signature</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-5">
                <div class="btn-group" role="group">
                    <a href="{{route('home')}}" class="btn btn-outline-primary">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-secondary">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn btn-outline-success" id="downloadPdf">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                </div>
                <p class="text-muted mt-3 small">
                    This receipt is computer generated and requires no signature.<br>
                    Valid without official stamp for amounts under {{ Auth::user()->currency }}10,000.
                </p>
            </div>
        </div>
    </div>

    <style>
        .receipt-card {
            background: #fff;
            max-width: 800px;
            margin: 0 auto;
        }

        .company-name {
            font-family: 'Times New Roman', serif;
            letter-spacing: 1.5px;
        }

        .watermark {
            opacity: 0.1;
            font-size: 3rem;
            transform: rotate(-15deg);
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .section-title {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 150px;
            margin: 5px 0;
        }

        @media print {

            .btn-group,
            .watermark {
                display: none !important;
            }

            .receipt-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>