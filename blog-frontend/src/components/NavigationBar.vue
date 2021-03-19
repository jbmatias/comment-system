<template>
  <div class="navigation-bar">
    <b-nav pills align="left">
      <router-link
        to="/"
        custom
        v-slot="{ href, navigate, isExactActive }"
      >
        <b-nav-item :class="{ 'active': isExactActive }" :href="href" @click="navigate">Profile</b-nav-item>        
      </router-link> 
      <router-link
        to="/newsfeed"
        custom
        v-slot="{ href, navigate, isExactActive }"
      >
        <b-nav-item :class="{ 'active': isExactActive }" :href="href" @click="navigate">Newsfeed</b-nav-item>        
      </router-link>            
    </b-nav>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class NavigationBar extends Vue {
  
}
</script>