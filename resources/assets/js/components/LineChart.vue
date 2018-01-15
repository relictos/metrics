<template>
  <div>
    <vue-highcharts v-if="this.ready" :Highcharts="hc" :options="options" ref="lineCharts"></vue-highcharts>
  </div>
</template>
<script>
  import VueHighcharts from 'vue2-highcharts'

  import Highstock from 'highcharts/highstock'

  export default {
    name: 'LineChart',
    components: {
      Highstock, VueHighcharts
    },
    data () {
      return {
        hc: false,
        ready: false,
        options:{
          rangeSelector: {
            enabled: false
          },
          xAxis: {
            categories: [],
            type: 'datetime',
            labels: {
              format: '{value:%S.%L}',
            },
          },
          tooltip: {
            crosshairs: [true],
            formatter: function() {
              return '<b>' + this.y + '</b>'
            }
          },
          title: {
            text: ''
          },
          plotOptions: {
            series:{
              tooltip:{
                enabled: false
              }
            }
          },
          series: [{
            name: '',
            data: [],
          }]
        },
      }
    },
    props: ['name', 'info'],
    created: function(){
      this.hc = Highstock;
      this.options.xAxis.categories = this.info.map(rec => Number(rec.mark));
      this.options.series[0].data = this.info.map(rec => Number(rec.val));
      this.options.series[0].name = this.name;
      this.ready = true;
    },
  }
</script>

<style>

</style>