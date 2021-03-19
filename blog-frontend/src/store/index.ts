import Vue from 'vue'
import Vuex from 'vuex'
import post from './posts'
import VuexPersist from 'vuex-persist';

Vue.use(Vuex)

const vuexPersist = new VuexPersist({
  key: 'BLOG',
  storage: localStorage
});

export default new Vuex.Store({
  modules: {
    post,    
  },
  plugins: [vuexPersist.plugin]
});
