@props([
    'chartData'
])

<div
    class="relative bg-hpc-red-700  rounded-xl border border-hpc-red-800"
    x-data="{
        data: @js($chartData['data']),
        filters: {
            location: 'all',
            game_type: 'all',
            stake: 'all',
            date: {
                start: null,
                end: null
            },
        },
        dateFilterInput: null,
        chart: null,
        currencyFormatter: new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }),
        calculateCumulativeSum(data) {
            return data.reduce(function(r, a) {
              r.push((r.length && r[r.length - 1] || 0) + a);
              return r;
            }, []);
        },
        initDateFilter() {
            this.dateFilterInput = new window.Litepicker({
                element: $refs.dateFilter,
                plugins: ['keyboardnav', 'mobilefriendly', 'ranges'],
                format: 'MMM DD, YYYY',
                dropdowns: {minYear: {{ $chartData['minYear'] }}, maxYear:null, months:true, years:true},
                resetButton: true,
                setup: (picker) => {
                    picker.on('selected', (start, end) => {
                        this.filters.date.start = start.dateInstance;
                        this.filters.date.end = end.dateInstance;

                        this.updateChart();
                    });

                    picker.on('clear:selection', () => {
                        this.filters.date = {
                            start: null,
                            end: null
                        };

                        this.updateChart();
                    });
                }
            });
        },
        initChart() {
            Chart.defaults.color = '#FFFFFF';

            const currencyFormatter = this.currencyFormatter;

            const chart = new window.Chart($refs.chartContainer, {
                type: 'line',
                data: {
                    labels: this.data.map(x => x.date),
                    datasets: [{
                        label: 'Cumulative Sum of Net Winnings',
                        data: this.calculateCumulativeSum(this.data.map(x => x.net_winnings)),
                        borderColor: '#FFCD67',
                        borderWidth: 2
                    }]
                },
                options: {
                    layout: {
                        padding: 16
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(label, index, labels) {
                                    return currencyFormatter.format(label);
                                }
                            }
                        },
                        x: {
                            type: 'time'
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                console.log(context);
                                    return `${context.dataset.label}: ${currencyFormatter.format(context.raw)}`;
                                }
                            }
                        }
                    }
                }
            });

            Object.seal(chart);

            this.chart = chart;
        },
        init() {
            this.initDateFilter();
            this.initChart();
        },
        updateChart() {
            const filteredData = this.data.filter(session => this.checkFilters(session));

            this.chart.data.labels = filteredData.map(x => x.date);
            this.chart.data.datasets[0].data = this.calculateCumulativeSum(filteredData.map(x => x.net_winnings));

            this.chart.update();
        },
        checkFilters(session) {
            if(
                this.filters.location !== 'all' &&
                this.filters.location !== session.location
            ) {
                return false;
            }

            if(
                this.filters.game_type !== 'all' &&
                this.filters.game_type !== session.game_type
            ) {
                return false;
            }

            if(
                this.filters.stake !== 'all' &&
                this.filters.stake !== session.stake
            ) {
                return false;
            }

            if(this.filters.date.start !== null && this.filters.date.end !== null) {
                const date = new Date(session.date);

                console.log(date);
                console.log(this.filters.date.start);
                console.log(this.filters.date.end);

                if(this.filters.date.start > date) {
                    return false;
                }

                if(this.filters.date.end < date) {
                    return false;
                }
            }

            return true;
        }
    }"
>
    <div class="grid md:grid-cols-2 p-4 gap-4">
        <div>
            <label class="space-y-2">
                <span
                    class="flex items-center font-medium leading-4 text-white"
                >
                    Location
                </span>

                <select
                    class="block w-full transition duration-75 rounded-lg shadow-sm bg-hpc-red-800 focus:border-hpc-gold focus:ring-1 focus:ring-inset focus:ring-hpc-gold disabled:opacity-70 border-hpc-red-800"
                    x-model="filters.location"
                    x-on:change="updateChart"
                >
                    <option value="all" selected>
                        All
                    </option>

                    @foreach($chartData['locations'] as $location)
                        <option value="{{ $location }}">
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label class="space-y-2">
                <span
                    class="flex items-center font-medium leading-4 text-white"
                >
                    Game played
                </span>

                <select
                    class="block w-full transition duration-75 rounded-lg shadow-sm bg-hpc-red-800 focus:border-hpc-gold focus:ring-1 focus:ring-inset focus:ring-hpc-gold disabled:opacity-70 border-hpc-red-800"
                    x-model="filters.game_type"
                    x-on:change="updateChart"
                >
                    <option value="all" selected>
                        All
                    </option>

                    @foreach($chartData['gameTypes'] as $gameType)
                        <option value="{{ $gameType }}">
                            {{ $gameType }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label class="space-y-2">
                <span
                    class="flex items-center font-medium leading-4 text-white"
                >
                    Stake played
                </span>

                <select
                    class="block w-full transition duration-75 rounded-lg shadow-sm bg-hpc-red-800 focus:border-hpc-gold focus:ring-1 focus:ring-inset focus:ring-hpc-gold disabled:opacity-70 border-hpc-red-800"
                    x-model="filters.stake"
                    x-on:change="updateChart"
                >
                    <option value="all" selected>
                        All
                    </option>

                    @foreach($chartData['stakes'] as $stake)
                        <option value="{{ $stake }}">
                            {{ $stake }}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>

        <div>
            <label class="space-y-2">
                <span
                    class="flex items-center font-medium leading-4 text-white"
                >
                    Date range
                </span>

                <input
                    type="text"
                    class="py-2 px-4 w-full block w-full transition duration-75 rounded-lg shadow-sm bg-hpc-red-800 focus:border-hpc-gold focus:ring-1 focus:ring-inset focus:ring-hpc-gold disabled:opacity-70 border-hpc-red-800"
                    x-ref="dateFilter"
                />
            </label>
        </div>
    </div>

    <canvas x-ref="chartContainer"></canvas>
</div>
