<template>
  <div>
    <input type="file" name="file" @change="filesChange($event.target.name, $event.target.files);">
    <button @click="sendForm()">Upload</button>
  </div>
</template>

<script>

  export default{
    name: 'UploadForm',
    data () {
      return {
        formData: []
      }
    },
    methods: {
      filesChange(fieldName, fileList) {
        // handle file changes
        const formData = new FormData();
        if (!fileList.length) return;
        // append the files to FormData
        Array
            .from(Array(fileList.length).keys())
            .map(x => {
              formData.append(fieldName, fileList[x], fileList[x].name);
            });

        console.log(formData.toString());
        this.formData = formData;
      },
      sendForm() {
        this.$http.post('/api/metrics', this.formData).then(function(response){
          this.$router.push({name: 'FilesList'})
        });
      }
    },
    created: function(){
      this.$http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[id="csrf-token"]').content;
    }
  }
</script>

<style>

</style>