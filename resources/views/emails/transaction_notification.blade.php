<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>International Linit Bank - Transaction Notification</title>
    <!-- Open Graph Meta for rich previews -->
    <meta property="og:title" content="Transaction Notification - International Linit Bank">
    <style type="text/css">
        /* Reset */
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
            line-height: 100%;
        }

        /* Global */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #2D3748;
            background: #F7FAFC;
        }

        /* Responsive Container */
        .email-wrapper {
            max-width: 680px;
            margin: 0 auto;
            background: #FFFFFF;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .header {
            background: #1A237E;
            padding: 2rem;
            border-bottom: 4px solid #FFC107;
        }

        /* Transaction Card */
        .transaction-card {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            margin: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Interactive Elements */
        .accordion {
            border-top: 1px solid #E2E8F0;
            transition: all 0.3s ease;
        }

        /* Footer Grid */
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            background: #2D3748;
            color: #FFFFFF;
            padding: 2rem;
        }

        @media screen and (max-width: 600px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .transaction-card {
                margin: 1rem;
            }

            .header {
                padding: 1.5rem;
            }
        }
    </style>
    <!-- Progressive Enhancement Script -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "EmailMessage",
        "description": "Transaction notification from International Linit Bank"
    }
    </script>
</head>

<body>
    <div class="email-wrapper">
        <!-- Watermark Background -->
        <div style="position: absolute; opacity: 0.03; z-index: 0; pointer-events: none;">
            <svg width="100%" height="100%">
                <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="120"
                    fill="#1A237E">ILB</text>
            </svg>
        </div>

        <!-- Header -->
        <header class="header">
            <img src="{{asset('uploads/logo.png')}}" alt="ILB" width="160" style="max-width: 100%; height: auto;">
            <div style="color: #FFFFFF; margin-top: 1rem;">
                <h1 style="margin: 0; font-weight: 600;">Transaction Notification</h1>
                <p style="opacity: 0.9; margin: 0.5rem 0 0 0;">Reference: {{ $transactionId }}</p>
            </div>
        </header>

        <!-- Main Content -->
        <main style="position: relative; z-index: 1;">
            <!-- Quick Actions -->
            <div style="background: #F7FAFC; padding: 1rem; border-bottom: 1px solid #E2E8F0;">
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="#details" style="text-decoration: none; color: #1A237E; font-weight: 500;">View Details</a>
                    <a href="{{ $user->dashboard_url }}"
                        style="text-decoration: none; color: #1A237E; font-weight: 500;">Account Overview</a>
                    <a href="#security" style="text-decoration: none; color: #1A237E; font-weight: 500;">Security
                        Info</a>
                </div>
            </div>

            <!-- Transaction Summary -->
            <div class="transaction-card">
                <div style="padding: 2rem;">
                    <div style="display: grid; grid-template-columns: auto 1fr; gap: 2rem; align-items: center;">
                        <div style="background: #E3F2FD; border-radius: 50%; padding: 1rem;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#1A237E">
                                <path
                                    d="M12 2L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-3zm0 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="margin: 0; color: #1A237E;">{{ $transactionType === 'credit' ? 'Funds Received' :
                                'Payment Processed' }}</h2>
                            <p style="margin: 0.5rem 0 0 0; color: #4A5568;">
                                {{ $transactionDate }} (UTC+00:00)
                            </p>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; border-top: 1px solid #E2E8F0; padding-top: 1.5rem;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                            <div>
                                <p style="margin: 0; color: #718096;">Transaction Value</p>
                                <p style="margin: 0.5rem 0 0 0; font-size: 1.5rem; font-weight: 600; color: #1A237E;">
                                    {{ $currency }}{{ number_format($amount, 2) }}
                                </p>
                            </div>
                            <div>
                                <p style="margin: 0; color: #718096;">Account Balance</p>
                                <p style="margin: 0.5rem 0 0 0; font-size: 1.5rem; font-weight: 600; color: #1A237E;">
                                    {{ $currency }}{{ number_format($user->account_balance, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Details -->
            <!-- Interactive Details -->
            <div class="accordion" id="details">
                <div style="padding: 2rem;">
                    <h3 style="color: #1A237E; margin: 0 0 1rem 0;">Transaction Breakdown</h3>
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                        <!-- Transaction Metadata -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Transaction ID</h4>
                            <p style="margin: 0; font-weight: 500; color: #2D3748;">{{ $transactionId }}</p>
                            <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                                <span
                                    style="font-size: 0.8rem; background: #E2E8F0; padding: 0.25rem 0.5rem; border-radius: 4px;">
                                    {{ $transactionType === 'credit' ? 'INBOUND' : 'OUTBOUND' }}
                                </span>
                                <span
                                    style="font-size: 0.8rem; background: #EBF8FF; padding: 0.25rem 0.5rem; border-radius: 4px; color: #3182CE;">
                                    {{ strtoupper($type) }}
                                </span>
                            </div>
                        </div>

                        <!-- Amount Details -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Amount Details</h4>
                            <div style="display: grid; gap: 0.5rem;">
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Principal Amount</span>
                                    <p
                                        style="margin: 0; font-weight: 500; color: {{ $transactionType === 'credit' ? '#38A169' : '#E53E3E' }};">
                                        {{ $currency }}{{ number_format($amount, 2) }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Fees & Charges</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $currency }}{{ number_format($transactionFees ?? 0.00, 2) }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Net Amount</span>
                                    <p style="margin: 0; font-weight: 600; color: #2D3748;">
                                        {{ $currency }}{{ number_format($netAmount ?? $amount, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Account Details</h4>
                            <div style="display: grid; gap: 0.75rem;">
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Account Holder</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Account Number</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        •••• {{ substr($user->account_number, -4) }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Account Type</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $user->account_type ?? 'Multi-Currency Current Account' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Beneficiary Information -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">
                                {{ $transactionType === 'credit' ? 'Originator' : 'Beneficiary' }}
                            </h4>
                            <div style="display: grid; gap: 0.75rem;">
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Name</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $beneficiaryName ?? 'International Linit Bank' }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Account Number</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        •••• {{ $beneficiaryAccount ?? substr($user->account_number, -4) }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Bank Identifier</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $beneficiaryBank ?? 'ILBKUS33' }} (SWIFT)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Timeline -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Processing Timeline
                            </h4>
                            <div style="display: grid; gap: 1rem; position: relative;">
                                <div
                                    style="position: absolute; left: 9px; top: 0; bottom: 0; width: 2px; background: #E2E8F0;">
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 20px; height: 20px; background: #48BB78; border-radius: 50%; flex-shrink: 0;">
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 500; color: #2D3748;">Initiated</p>

                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 20px; height: 20px; background: #4299E1; border-radius: 50%; flex-shrink: 0;">
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 500; color: #2D3748;">Authorized</p>

                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 20px; height: 20px; background: #9F7AEA; border-radius: 50%; flex-shrink: 0;">
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-weight: 500; color: #2D3748;">Processed</p>
                                        <p style="margin: 0; color: #718096; font-size: 0.8rem;">
                                            {{ $transactionDate->format('D, M j, Y H:i') }} UTC
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security & Compliance -->
                        <div style="background: #F7FAFC; padding: 1.5rem; border-radius: 6px;">
                            <h4 style="color: #718096; margin: 0 0 0.5rem 0; font-size: 0.9rem;">Security Details</h4>
                            <div style="display: grid; gap: 0.75rem;">
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Authentication Method</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        <span style="color: #48BB78;">✓</span> Biometric Verification
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Device Fingerprint</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $deviceHash ?? '8f4d3e2a1b...' }}
                                    </p>
                                </div>
                                <div>
                                    <span style="color: #718096; font-size: 0.9rem;">Geo-Location</span>
                                    <p style="margin: 0; font-weight: 500; color: #2D3748;">
                                        {{ $geoLocation ?? 'New York, US (40.7128° N, 74.0060° W)' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Enhanced Footer -->
        <footer class="footer-grid">
            <div>
                <h4 style="color: #FFC107; margin: 0 0 1rem 0;">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#" style="color: #FFFFFF; text-decoration: none;">Security Center</a></li>
                    <li><a href="#" style="color: #FFFFFF; text-decoration: none;">Fee Schedule</a></li>
                    <li><a href="#" style="color: #FFFFFF; text-decoration: none;">Exchange Rates</a></li>
                </ul>
            </div>

            <div>
                <h4 style="color: #FFC107; margin: 0 0 1rem 0;">Global Offices</h4>
                <p style="margin: 0; font-size: 0.9rem;">
                    New York | London | Singapore<br>
                    Tokyo | Zurich | Dubai
                </p>
            </div>

            <div>
                <h4 style="color: #FFC107; margin: 0 0 1rem 0;">Compliance</h4>
                <img src="{{asset('uploads/compliance-badges.jpg')}}" alt="Regulatory Badges" width="160">
            </div>
        </footer>
    </div>

    <!-- Progressive Enhancement JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Accordion functionality
        const accordions = document.querySelectorAll('.accordion');
        accordions.forEach(accordion => {
            accordion.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });

        // Track email open
        window.addEventListener('load', function() {
            if(typeof navigator.doNotTrack === 'undefined' || navigator.doNotTrack !== '1') {
                fetch('https://analytics.intllinitbank.com/track', {
                    method: 'POST',
                    body: JSON.stringify({ event: 'email_open', txnId: '{{ $transactionId }}' })
                });
            }
        });
    });
    </script>
    <noscript>
        <img src="https://analytics.intllinitbank.com/track?txnId={{ $transactionId }}" alt="" width="1" height="1">
    </noscript>
</body>

</html>