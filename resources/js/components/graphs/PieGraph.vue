<script>
import { Pie } from 'vue-chartjs';
import backgroundColorList from "../../const/backgroundColorList";

export default {
  extends: Pie,
  props: {
    labels: Array,
    graphData: Array,
  },
  data () {
    return {
      data: {
        labels: this.labels,
        datasets: [
          {
            data: this.graphData,
            backgroundColor: backgroundColorList.slice(0, this.labels.length - 1),
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
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

