<template>
  <div id="app">
    <el-row>
      <el-col :xs="{span: 24, offset: 0}" :md="{span: 18, offset: 3}">
        <el-header>
          <el-menu mode="horizontal" :default-active="$route.path" :router="true">
            <template v-for="route in $router.options.routes" v-if="!route.meta.hidden">
              <el-menu-item :index="route.path" :key="route.path">
                {{ route.meta.name }}
              </el-menu-item>
            </template>
          </el-menu>
        </el-header>
        <el-main>
          <router-view/>
        </el-main>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
