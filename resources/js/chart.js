import Chart from 'chart.js/auto';
import 'chartjs-adapter-date-fns';
import ChartjsPluginWatermark from 'chartjs-plugin-watermark'

Chart.register(ChartjsPluginWatermark);

window.Chart = Chart;
