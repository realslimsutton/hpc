@props([
    'chartData'
])

<div
    class="relative bg-hpc-red-700  rounded-xl border border-hpc-red-800"
    x-data="{
        chartData: @js($chartData),
        init() {
            Chart.defaults.backgroundColor = '#5A0410';
            Chart.defaults.color = '#FFFFFF';
            Chart.defaults.font.family = 'Poppins';

            new window.Chart($refs.chartContainer, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Net Winnings',
                        data: this.chartData,
                        borderColor: '#FFCD67',
                        backgroundColor: '#FFCD67'
                    }]
                },
                options: {
                    layout: {
                        padding: 16
                    },
                    plugins: {
                        zoom: {
                            zoom: {
                                wheel: {
                                    enabled: true,
                                },
                                pinch: {
                                    enabled: true
                                },
                                drag: {
                                    enabled: true
                                },
                                mode: 'Y',
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(label) {
                                    return `${label.dataset.label}: ${label.parsed.y.toLocaleString('en-US', {style: 'currency', 'currency': 'USD'})}`;
                                }
                            }
                        }
                    }
                }
            })
        }
    }"
>
    <canvas x-ref="chartContainer"></canvas>
</div>
