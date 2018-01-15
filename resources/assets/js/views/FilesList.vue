<template v-loading="loading">
  <div v-if="loading"><i class="el-icon-loading"></i></div>
  <div v-else>
    <el-table :data="list" empty-text="No files found">
      <el-table-column prop="filename"></el-table-column>
      <el-table-column>
        <template slot-scope="scope">
          <file-item :info="scope.row"></file-item>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
  import FileItem from '../components/FileItem.vue'

  export default {
    name: 'FilesList',
    data () {
      return {
        loading: false,
        list: []
      }
    },
    methods: {
      loadList: function(){
        this.loading = true;
        this.$http.get('/api/metrics', {}).then(function(response) {

          this.list = response.data;
          this.loading = false;
        }, console.log)
      }
    },
    components: {
      'file-item': FileItem
    },
    created: function(){
      this.loadList();
      var that = this;
      var socket = io('http://localhost:3000');
      socket.on("files-channel:files.changed", function(message){
        that.loadList();
      });
    },
  }
</script>

<style scoped>

</style>