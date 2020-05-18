<script>
import { Line } from 'vue-chartjs';

export default {
  extends: Line,
  props: {
    label: String,
    labels: Array,
    graphData: Array,
  },
  data () {
    return {
      data: {
        labels: this.labels,
        datasets: [
          {
            label: this.label,
            data: this.graphData,
            borderColor: 'rgba(255, 99, 132, 0.2)',
            backgroundColor: "rgba(0,0,0,0)",
            lineTension: 0,
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            scaleLabel: {
              display: true,
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 10,
            }
          }]
        }
      }
    }
  },
  mounted () {
    this.renderChart(this.data, this.options)
  }
}
</script>
</script>

<style>

</style>

