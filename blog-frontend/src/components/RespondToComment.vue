<template>
  <b-modal ref="modal-respond"      
      modal-header="false"
      @mousedown.self="closeModal"
      @close="closeModal"
      @hide="closeModal"
      :hide-header="true"
      :hide-footer="true"
      size="md"
      centered
      content-class="modal-respond"
      ok-only>
      <div class="respond-content">
        <button class="respond-close" @click="closeModal">
          &times;
        </button>
        <b-form-textarea
          id="textarea"  
          v-model="response"        
          placeholder="Comment something..."          
          rows="3"
          max-rows="6"
        ></b-form-textarea>         
        <button class="btn respond-confirm" @click="sendResponse">
            Respond to a comment
        </button>
      </div>      
  </b-modal>  
</template>
<style lang="scss">
  .modal-content {
    &.modal-respond {
      max-width: 400px;
      margin: 0 auto;
      border-radius: 12px;
      .respond-content {
        margin-top: 20px;
        textarea[id=textarea] {
            margin-top: 40px;
        }
        .respond-close {
          position: absolute;
          right: 16px;
          top: 16px;
          padding: 2px 10px;
          font-weight: 900;
          background: #F3F3F3;
          border-radius: 100%;
          border: none;
          color: #727272;
        }
        .respond-logo {
          text-align: center;
          font-size: 140px;
          color: #5e72e4;
        }
        .respond-text {
          font-family: Work Sans;
          font-style: normal;
          font-weight: 500;
          font-size: 18px;
          line-height: 22px;          
          align-items: center;
          text-align: center;
          color: #1E1E1E;
        }
        .respond-confirm {
          margin-top: 20px;
          height: 51.67px;          
          background: #5e72e4;
          border-radius: 8px;
          width: 100%;
          color: #fff;
        }
      }
    }    
  }  
</style>
<script>
import Vue from 'vue';
import { mapGetters } from 'vuex';
import { postService as Post } from '../services'

export default {
  name: 'RespondToComment',
  props: {
    show: Boolean,
    id: Number 
  },
  data() {
    return {
        response: ''
    }
  },
  computed: {
    ...mapGetters({
      getUser: "user/getUser",
    })
  },
  watch: {
    show(val) {
      if(val) {
        this.$refs['modal-respond'].show();
      } else {
        this.$refs['modal-respond'].hide();
      }
    }
  },
  methods: {
    sendResponse() {
        let data = {
            comment_id: this.id,
            response: this.response,
            username_id: this.getUser.id
        }

        Post.respondToComment(data).then(response => {
            this.$emit("responded", response.data)
            alert('You\'ve responded to a comment!')
        })

    },
    closeModal() {
      this.$emit("close");
    }    
  }
}
</script>