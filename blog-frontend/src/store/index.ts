import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist'
import post from './posts'
import user from './user'

Vue.use(Vuex)

const vuexPersist = new VuexPersist({
  key: 'BLOG',
  storage: localStorage
});

export default new Vuex.Store({
  modules: {
    post,
    user
  },
  plugins: [vuexPersist.plugin]
});
