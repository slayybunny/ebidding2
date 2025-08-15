@extends('layouts.admin.app')

@section('page-title', 'PROFIT REPORTS')

@section('content')
    <style>
        .charts-section {
            padding: 2rem;
            background: #ffffff;
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

        .profit-report-container {
            background: linear-gradient(135deg, #f8f6f0 0%, #f5f2e8 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .report-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(139, 98, 57, 0.1);
            overflow: hidden;
            margin: 0 auto;
            max-width: 1200px;
        }

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

        .table-container {
            padding: 0;
            background: #ffffff;
        }

        .corporate-table {
            margin: 0;
            width: 100%;
            border: none;
            font-size: 1rem;
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

        @media (max-width: 768px) {
            .report-title {
                font-size: 2rem;
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
                        <tbody>
                            <tr>
                                <td class="month-cell">July</td>
                                <td class="year-cell">2025</td>
                                <td class="number-cell">5</td>
                                <td class="profit-cell">850.00</td>
                                <td class="commission-cell">42.50</td>
                            </tr>
                            <tr>
                                <td class="month-cell">June</td>
                                <td class="year-cell">2025</td>
                                <td class="number-cell">3</td>
                                <td class="profit-cell">500.00</td>
                                <td class="commission-cell">25.00</td>
                            </tr>
                            <tr>
                                <td class="month-cell">May</td>
                                <td class="year-cell">2025</td>
                                <td class="number-cell">4</td>
                                <td class="profit-cell">700.00</td>
                                <td class="commission-cell">35.00</td>
                            </tr>
                            <tr>
                                <td class="month-cell">April</td>
                                <td class="year-cell">2025</td>
                                <td class="number-cell">6</td>
                                <td class="profit-cell">920.00</td>
                                <td class="commission-cell">46.00</td>
                            </tr>
                            <tr>
                                <td class="month-cell">March</td>
                                <td class="year-cell">2025</td>
                                <td class="number-cell">2</td>
                                <td class="profit-cell">380.00</td>
                                <td class="commission-cell">19.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="summary-footer">
                    <div class="summary-stats">
                        <div class="stat-item">
                            <div class="stat-value">20</div>
                            <div class="stat-label">Total Auctions</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">RM 3,350.00</div>
                            <div class="stat-label">Total Profit</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">RM 167.50</div>
                            <div class="stat-label">Total Commission</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">RM 670.00</div>
                            <div class="stat-label">Monthly Average</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Data for the charts
        const monthlyData = {
            labels: ['March', 'April', 'May', 'June', 'July'],
            profits: [380, 920, 700, 500, 850],
            commissions: [19, 46, 35, 25, 42.5],
            auctions: [2, 6, 4, 3, 5]
        };

        // Monthly Profit Chart (Landscape)
        const profitCtx = document.getElementById('profitChart').getContext('2d');
        const profitChart = new Chart(profitCtx, {
            type: 'line',
            data: {
                labels: monthlyData.labels,
                datasets: [{
                        label: 'Profit (RM)',
                        data: monthlyData.profits,
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
                    },
                    {
                        label: 'Commission (RM)',
                        data: monthlyData.commissions,
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
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#6d4c2f',
                            font: {
                                size: 14,
                                weight: 600
                            },
                            usePointStyle: true,
                            padding: 25,
                            boxWidth: 15,
                            boxHeight: 15
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(139, 98, 57, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#d4af37',
                        borderWidth: 2,
                        cornerRadius: 10,
                        displayColors: true,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(139, 98, 57, 0.1)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#6d4c2f',
                            font: {
                                size: 12,
                                weight: 500
                            },
                            padding: 10,
                            callback: function(value) {
                                return 'RM ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6d4c2f',
                            font: {
                                size: 13,
                                weight: 600
                            },
                            padding: 10
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBorderWidth: 4
                    }
                },
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20,
                        left: 20,
                        right: 20
                    }
                }
            }
        });

        // Doughnut Chart for Total Auctions
        const auctionCtx = document.getElementById('auctionChart').getContext('2d');
        const auctionChart = new Chart(auctionCtx, {
            type: 'doughnut',
            data: {
                labels: monthlyData.labels,
                datasets: [{
                    data: monthlyData.auctions,
                    backgroundColor: [
                        '#8b6239',
                        '#a67c52',
                        '#d4af37',
                        '#b8941f',
                        '#6d4c2f'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#6d4c2f',
                            font: {
                                size: 12,
                                weight: 500
                            },
                            padding: 15,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(139, 98, 57, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#d4af37',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed * 100) / total).toFixed(1);
                                return context.label + ': ' + context.parsed + ' auctions (' + percentage +
                                '%)';
                            }
                        }
                    }
                },
                cutout: '60%',
                elements: {
                    arc: {
                        borderRadius: 8
                    }
                }
            }
        });

        // Bar Chart for Monthly Performance
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(performanceCtx, {
            type: 'bar',
            data: {
                labels: monthlyData.labels,
                datasets: [{
                    label: 'Average Profit per Auction',
                    data: monthlyData.profits.map((profit, index) =>
                        (profit / monthlyData.auctions[index]).toFixed(2)
                    ),
                    backgroundColor: [
                        'rgba(139, 98, 57, 0.8)',
                        'rgba(166, 124, 82, 0.8)',
                        'rgba(212, 175, 55, 0.8)',
                        'rgba(184, 148, 31, 0.8)',
                        'rgba(109, 76, 47, 0.8)'
                    ],
                    borderColor: [
                        '#8b6239',
                        '#a67c52',
                        '#d4af37',
                        '#b8941f',
                        '#6d4c2f'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(139, 98, 57, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#d4af37',
                        borderWidth: 2,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return 'RM ' + context.parsed.y + ' per auction';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(139, 98, 57, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6d4c2f',
                            font: {
                                size: 11,
                                weight: 500
                            },
                            callback: function(value) {
                                return 'RM ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6d4c2f',
                            font: {
                                size: 11,
                                weight: 600
                            }
                        }
                    }
                }
<<<<<<< HEAD
            }   
        }
    });
=======
            }
        });
>>>>>>> 17d44544444403c83c5c411f29c1e46459bf3468

        // Animation for numbers counting up
        function animateNumbers() {
            const statValues = document.querySelectorAll('.stat-value');
            statValues.forEach((stat, index) => {
                const finalValue = stat.textContent;
                const numericValue = parseFloat(finalValue.replace(/[^\d.]/g, ''));
                const isRM = finalValue.includes('RM');
                let currentValue = 0;
                const increment = numericValue / 50;

                const counter = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= numericValue) {
                        currentValue = numericValue;
                        clearInterval(counter);
                    }

                    if (isRM) {
                        stat.textContent = 'RM ' + currentValue.toFixed(2);
                    } else {
                        stat.textContent = Math.floor(currentValue);
                    }
                }, 30);
            });
        }

        // Run the animation after the page loads
        window.addEventListener('load', () => {
            setTimeout(animateNumbers, 500);
        });
    </script>
@endsection
