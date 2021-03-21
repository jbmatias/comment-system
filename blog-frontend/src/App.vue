<template>
  <div id="app">
    <b-container>
      <b-row>
        <b-col md="8" class="offset-md-2">
          <b-card class="main-card">
            <navigation-bar></navigation-bar>
            <router-view></router-view>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<style lang="scss">
  @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');
  @import './assets/scss/main.scss';

  html, body {
    font-family: Open Sans,sans-serif !important;
  }
</style>
<script lang="ts">
import NavigationBar from './components/NavigationBar.vue'
import { Component, Vue } from 'vue-property-decorator';

@Component({
  components: {
    NavigationBar
  }
})
export default class App extends Vue {
  
}
</script>