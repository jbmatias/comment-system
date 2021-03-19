<template>
  <div class="profile">
    <b-form @submit.prevent="onSubmit($event)">
      <b-form-group        
        label="Full name"
        label-for="fullname"
        description="Please set your fullname to enable comment feature"
      >
        <b-form-input
          id="fullname"
          class="fullname"
          v-model="form.name"
          type="text"                    
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" v-if="!getUser" variant="primary">Save and start sending comments now!</b-button>
    </b-form>
  </div>
</template>

<script lang="ts">
import { mapGetters, mapMutations } from 'vuex'
import { Component, Vue } from 'vue-property-decorator';
import { postService as Post, userService as User } from '../services'
@Component({
  computed: {
    ...mapGetters({
      getUser: 'user/getUser'
    })
  },
  methods: {
    ...mapMutations({
      setUser: 'user/setUser'
    })
  }
})
export default class Profile extends Vue {

    public getUser!: any
    public form: any = {
      name: '',
      created_at: '',
      updated_at: ''
    }

    public setUser!: Function
    $router: any;

    mounted() {
      if(this.getUser) {
        this.form.name = this.getUser.name
        this.form.created_at = this.getUser.created_at
        this.form.updated_at = this.getUser.updated_at
      }
    }

    private onSubmit(e: any) {      
      User.save(this.form).then(response => {        
        this.setUser(response.data)
        alert('Username has been successfully saved!')
        this.$router.push('/newsfeed')
      }).catch(err => {
        let errors = err.response.data
        let errorsArr: any = []
        Object.keys(errors).map(function(key, index) {            
          errorsArr.push(errors[key])
        });          
        alert(errorsArr.join(', '))
      })
    }
}
</script>
