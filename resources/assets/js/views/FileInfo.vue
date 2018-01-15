<template>
  <div>
    <div v-if="loading"><i class="el-icon-loading"></i></div>
    <div v-if="error">{{error.message}}</div>
    <div v-if="ready && content">
      <h2>{{content.info.name}}</h2>
      <line-chart :name="content.info.name" :info="content.body"></line-chart>
    </div>
  </div>
</template>

<script>
  import LineChart from '../components/LineChart.vue'

  export default {
    name: 'FileInfo',
    data () {
      return {
        filename: '',
        loading: false,
        error: false,
        ready: false,
        content: false
      }
    },
    components: {
      'line-chart': LineChart
    },
    methods: {
      loadInfo: function(){
        this.loading = true;
        this.ready = false;
        this.error = false;

        this.$http.get('/api/metrics/'+this.filename, {}).then(function(response) {

          this.content = response.data;
          this.loading = false;
          this.ready = true;
        }, function(response){
          this.error = response.data;
          this.loading = false;
        })
      }
    },
    created: function(){
      this.filename = this.$route.params.file;
      this.loadInfo();
    },
  }
</script>

<style scoped>

</style>