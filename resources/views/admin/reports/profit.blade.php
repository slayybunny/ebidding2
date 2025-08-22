@extends('layouts.admin.app')

@section('page-title', 'PROFIT REPORTS')

@section('content')
    <style>
        /* General Styles */
        .profit-report-container {
            background: linear-gradient(135deg, #f8f6f0 0%, #f5f2e8 100%);
            min-height: 100vh;
            padding: 2rem 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #5d4037;
        }

        .report-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(139, 98, 57, 0.1);
            overflow: hidden;
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Header Section */
        .report-header {
            background: linear-gradient(135deg, #8b6239 0%, #d4af37 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .report-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .report-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .report-subtitle {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Form Section */
        .report-form {
            background-color: #fdfaf5;
            padding: 1.5rem 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #f0ebe0;
        }

        .report-form select,
        .report-form button {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 1rem;
        }

        .report-form select {
            border: 1px solid #d4af37;
            background-color: #ffffff;
            color: #5d4037;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23d4af37" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.65rem auto;
        }

        .report-form button {
            background: #8b6239;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .report-form button:hover {
            background: #6d4c2f;
        }

        /* Report Actions */
        .report-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .report-actions button {
            background: #5d4037;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .report-actions button:hover {
            background: #4e342e;
        }

        /* Charts Section */
        .charts-section {
            padding: 2rem;
            background: #fdfaf5;
            border-bottom: 3px solid #f0ebe0;
        }

        .chart-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(139, 98, 57, 0.1);
            border: 1px solid #f0ebe0;
            height: 100%;
        }

        .landscape-chart {
            min-height: 400px;
        }

        .landscape-chart .chart-wrapper {
            height: 320px;
            width: 100%;
        }

        .small-chart {
            min-height: 350px;
        }

        .small-chart .chart-wrapper {
            height: 270px;
            width: 100%;
        }

        .chart-wrapper {
            position: relative;
            margin: 0 auto;
        }

        .chart-title {
            color: #8b6239;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.2rem;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 0.5rem;
        }

        /* Table Section */
        .table-container {
            padding: 0;
            background: #ffffff;
            overflow-x: auto;
        }

        .corporate-table {
            margin: 0;
            width: 100%;
            border: none;
            font-size: 1rem;
            min-width: 700px;
        }

        .corporate-table thead {
            background: linear-gradient(135deg, #6d4c2f 0%, #8b6239 100%);
        }

        .corporate-table thead th {
            color: #ffffff;
            font-weight: 600;
            padding: 1.5rem 1.25rem;
            border: none;
            text-align: center;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
        }

        .corporate-table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #d4af37 50%, transparent 100%);
        }

        .corporate-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0ebe0;
        }

        .corporate-table tbody tr:nth-child(even) {
            background-color: #faf8f3;
        }

        .corporate-table tbody tr:hover {
            background: linear-gradient(135deg, #f9f6f0 0%, #f5f1e6 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 98, 57, 0.1);
        }

        .corporate-table tbody td {
            padding: 1.25rem;
            border: none;
            text-align: center;
            font-weight: 500;
            color: #5d4037;
            vertical-align: middle;
        }

        .month-cell {
            font-weight: 700;
            color: #8b6239;
            font-size: 1.05rem;
        }

        .year-cell {
            color: #6d4c2f;
            font-weight: 600;
        }

        .number-cell {
            font-family: 'Georgia', serif;
            font-weight: 600;
        }

        .profit-cell {
            color: #2e7d32;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .commission-cell {
            color: #d4af37;
            font-weight: 700;
        }

        /* Summary Footer */
        .summary-footer {
            background: linear-gradient(135deg, #f5f2e8 0%, #ede7d3 100%);
            padding: 1.5rem 2rem;
            border-top: 3px solid #d4af37;
        }

        .summary-stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(139, 98, 57, 0.1);
            min-width: 180px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #8b6239;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6d4c2f;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Payment Button */
        .payment-section {
            background-color: #fdfaf5;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 2px solid #f0ebe0;
        }

        .payment-button {
            background: #8b6239;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 15px rgba(139, 98, 57, 0.2);
        }

        .payment-button:hover {
            background: #6d4c2f;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .report-title {
                font-size: 2rem;
            }

            .report-form {
                flex-direction: column;
                align-items: stretch;
            }

            .report-form select,
            .report-form button {
                width: 100%;
            }

            .corporate-table {
                font-size: 0.9rem;
            }

            .corporate-table thead th,
            .corporate-table tbody td {
                padding: 1rem 0.75rem;
            }

            .summary-stats {
                flex-direction: column;
            }
        }
    </style>

    <div class="profit-report-container">
        <div class="container">
            <div class="report-card">
                <div class="report-header">
                    <h1 class="report-title">Monthly Profit Report</h1>
                    <p class="report-subtitle">Company Financial Performance Analysis</p>
                </div>

                {{-- Month & Percentage Selection Form --}}
                <form id="report-form" action="#" method="GET" class="report-form">
                    <div class="d-flex align-items-center me-4">
                        <label for="month-select" class="me-2 text-sm text-gray-700 font-semibold">Month:</label>
                        <select name="month_year" id="month-select">
                            <option value="2025-08">August 2025</option>
                            <option value="2025-07">July 2025</option>
                            <option value="2025-06">June 2025</option>
                            <option value="2025-05">May 2025</option>
                            <option value="2025-04">April 2025</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center me-4">
                        <label for="percentage-select" class="me-2 text-sm text-gray-700 font-semibold">Commission
                            Percentage:</label>
                        <select name="percentage" id="percentage-select">
                            <option value="10">10%</option>
                            <option value="15">15%</option>
                            <option value="20">20%</option>
                            <option value="25">25%</option>
                            <option value="30">30%</option>
                        </select>
                    </div>

                    <button type="submit">View Report</button>

                    {{-- Tambah Butang Tindakan --}}
                    <div class="report-actions">
                        <button type="button" id="print-btn"><i class="fas fa-print me-2"></i> Print</button>
                        <button type="button" id="download-btn"><i class="fas fa-file-pdf me-2"></i> Download PDF</button>
                    </div>
                </form>

                <div class="charts-section">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="chart-card landscape-chart">
                                <h4 class="chart-title">Monthly Profit & Commission Trend</h4>
                                <div class="chart-wrapper">
                                    <canvas id="profitChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="chart-card small-chart">
                                <h4 class="chart-title">Total Auctions</h4>
                                <div class="chart-wrapper">
                                    <canvas id="auctionChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="chart-card small-chart">
                                <h4 class="chart-title">Monthly Performance</h4>
                                <div class="chart-wrapper">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <table class="corporate-table table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Total Completed Auctions</th>
                                <th>Total Profit (RM)</th>
                                <th>Admin Commission (RM)</th>
                            </tr>
                        </thead>
                        <tbody id="report-table-body">
                            {{-- Table data will be generated dynamically by JavaScript --}}
                        </tbody>
                    </table>
                </div>

                <div class="summary-footer">
                    <div class="summary-stats">
                        <div class="stat-item">
                            <div class="stat-value" id="total-auctions">0</div>
                            <div class="stat-label">Total Auctions</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" id="total-profit">RM 0.00</div>
                            <div class="stat-label">Total Profit</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" id="total-commission">RM 0.00</div>
                            <div class="stat-label">Total Commission</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value" id="monthly-average">RM 0.00</div>
                            <div class="stat-label">Monthly Average</div>
                        </div>
                    </div>
                </div>

                {{-- New Payment Section --}}
                <div class="payment-section">
                    <button id="pay-now-btn" class="payment-button">Proceed to Payment Transfer to KBSE</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        // Dummy data only for months April (4) to August (8)
        const allMonthlyData = {
            '2025-08': {
                profits: 1100,
                auctions: 7
            },
            '2025-07': {
                profits: 850,
                auctions: 5
            },
            '2025-06': {
                profits: 500,
                auctions: 3
            },
            '2025-05': {
                profits: 700,
                auctions: 4
            },
            '2025-04': {
                profits: 920,
                auctions: 6
            }
        };

        let profitChart, auctionChart, performanceChart;

        function renderChartsAndTable(selectedMonthYear, commissionPercentage) {
            const monthData = allMonthlyData[selectedMonthYear];

            if (!monthData) {
                alert("Data for the selected month is not available.");
                return;
            }

            // Calculate commission and other data
            const commission = monthData.profits * (commissionPercentage / 100);

            // Update summary card
            document.getElementById('total-auctions').textContent = monthData.auctions;
            document.getElementById('total-profit').textContent = `RM ${monthData.profits.toFixed(2)}`;
            document.getElementById('total-commission').textContent = `RM ${commission.toFixed(2)}`;
            document.getElementById('monthly-average').textContent =
                `RM ${(monthData.profits / monthData.auctions).toFixed(2)}`;

            // Update table data
            const tableBody = document.getElementById('report-table-body');
            tableBody.innerHTML = '';
            const row = document.createElement('tr');
            row.innerHTML = `
            <td class="month-cell">${new Date(selectedMonthYear + '-01').toLocaleString('en-US', { month: 'long' })}</td>
            <td class="year-cell">${new Date(selectedMonthYear + '-01').getFullYear()}</td>
            <td class="number-cell">${monthData.auctions}</td>
            <td class="profit-cell">RM ${monthData.profits.toFixed(2)}</td>
            <td class="commission-cell">RM ${commission.toFixed(2)}</td>
        `;
            tableBody.appendChild(row);

            // Update chart data
            const labels = Object.keys(allMonthlyData).map(key => new Date(key + '-01').toLocaleString('en-US', {
                month: 'short'
            }));
            const profits = Object.values(allMonthlyData).map(data => data.profits);
            const commissions = profits.map(profit => profit * (commissionPercentage / 100));
            const auctions = Object.values(allMonthlyData).map(data => data.auctions);
            const avgProfits = profits.map((p, i) => (p / auctions[i]).toFixed(2));

            // Destroy old chart if exists
            if (profitChart) profitChart.destroy();
            if (auctionChart) auctionChart.destroy();
            if (performanceChart) performanceChart.destroy();

            // Draw new chart
            const profitCtx = document.getElementById('profitChart').getContext('2d');
            profitChart = new Chart(profitCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Profit (RM)',
                        data: profits,
                        borderColor: '#8b6239',
                        backgroundColor: 'rgba(139, 98, 57, 0.1)',
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#d4af37',
                        pointBorderColor: '#8b6239',
                        pointBorderWidth: 3,
                        pointRadius: 8,
                        pointHoverRadius: 12
                    }, {
                        label: 'Commission (RM)',
                        data: commissions,
                        borderColor: '#d4af37',
                        backgroundColor: 'rgba(212, 175, 55, 0.1)',
                        borderWidth: 3,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#d4af37',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const auctionCtx = document.getElementById('auctionChart').getContext('2d');
            auctionChart = new Chart(auctionCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: auctions,
                        backgroundColor: ['#8b6239', '#a67c52', '#d4af37', '#b8941f', '#6d4c2f'],
                        borderColor: '#ffffff',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%'
                }
            });

            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            performanceChart = new Chart(performanceCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Average Profit per Auction',
                        data: avgProfits,
                        backgroundColor: ['rgba(139, 98, 57, 0.8)', 'rgba(166, 124, 82, 0.8)',
                            'rgba(212, 175, 55, 0.8)', 'rgba(184, 148, 31, 0.8)',
                            'rgba(109, 76, 47, 0.8)'
                        ],
                        borderColor: ['#8b6239', '#a67c52', '#d4af37', '#b8941f', '#6d4c2f'],
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        // Dapatkan rujukan borang dan butang
        const reportForm = document.getElementById('report-form');
        const payNowBtn = document.getElementById('pay-now-btn');
        const printBtn = document.getElementById('print-btn');
        const downloadBtn = document.getElementById('download-btn');

        // Tambah event listener untuk borang
        reportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedMonthYear = document.getElementById('month-select').value;
            const selectedPercentage = document.getElementById('percentage-select').value;
            renderChartsAndTable(selectedMonthYear, parseFloat(selectedPercentage));
        });

        // Tambah event listener untuk butang pembayaran
        payNowBtn.addEventListener('click', function() {
            const totalCommissionText = document.getElementById('total-commission').textContent;
            const totalCommission = parseFloat(totalCommissionText.replace('RM', ''));

            if (totalCommission > 0) {
                alert(`Payment of RM ${totalCommission.toFixed(2)} to KBSE is being processed.`);
            } else {
                alert('No commission amount to pay.');
            }
        });

        // Fungsi untuk cetak
        printBtn.addEventListener('click', function() {
            window.print();
        });

        // Fungsi untuk muat turun PDF
        downloadBtn.addEventListener('click', function() {
            const element = document.querySelector('.report-card');
            const month = document.getElementById('month-select').options[document.getElementById('month-select')
                .selectedIndex].text;

            html2canvas(element, {
                scale: 2
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210;
                const pageHeight = 295;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save(`Profit_Report_${month}.pdf`);
            });
        });

        // Muatkan data awal
        window.addEventListener('load', () => {
            const initialMonth = document.getElementById('month-select').value;
            const initialPercentage = document.getElementById('percentage-select').value;
            renderChartsAndTable(initialMonth, parseFloat(initialPercentage));
        });
    </script>
@endsection
