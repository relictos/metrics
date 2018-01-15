<template>
    <div>
        <router-link :to="{name: 'FileInfo', params: {file: info.filename}}">
            <el-button size="mini">Open</el-button>
        </router-link>
        <el-button size="mini" type="danger" @click.prevent="remove()">Remove</el-button>
    </div>
</template>

<script>
  export default {
    name: 'FileItem',
    data () {
      return {
        loading: false,
      }
    },
    props: ['info'],
    methods: {
      remove() {
        this.$http.delete('/api/metrics/'+ this.info.filename).then(function(response){
          this.$emit('removed')
        });
      }
    }
  }
</script>

<style>

</style>