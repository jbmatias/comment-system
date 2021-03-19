<template>
  <div class="profile">
    <b-form @submit.prevent="onSubmit">
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
      <b-button type="submit" variant="primary">Save and start sending comments now!</b-button>
    </b-form>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { postService as Post, userService as User } from '../services'
@Component
export default class Profile extends Vue {
    public form: any = {
        name: ''
    }

    private onSubmit() {
        User.save(this.form).then(response => {

        }).catch(err => {
            console.log(err.response)
        })
    }
}
</script>
