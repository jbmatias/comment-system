<template>
  <div class="news-feed">
    <respond-to-comment @close="showModal" 
          :show="showRespondModal" 
          :id="comment_id"
          @responded="appendResponse"></respond-to-comment>
    <div class="card mb-4" v-for="(post, index) in getPosts" :key="index">
      <!---->
      <div class="card-header">
        <div class="card-custom-title">
          <h5 class="h5 mb-0">Activity feed</h5>
        </div>
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center">
            <a href="#"
              ><img src="/images/john snow.jpeg" height="48" class="avatar"
            /></a>
            <div class="mx-3">
              <a href="#" class="text-dark font-weight-600 text-sm">{{
                post.name
              }}</a
              ><small class="d-block text-muted"
                >{{ daysAgo(post.created_at) }} Hours Ago</small
              >
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!----><!---->
        <div>
          <p class="mb-4">
            {{ post.post }}
          </p>
        </div>
        <b-form-textarea
          id="textarea"
          v-model="comment"
          placeholder="Comment something..."
          rows="3"
          max-rows="6"
        ></b-form-textarea>
        <button
          class="btn btn-comment"
          :disabled="!getUser"
          @click="postComment(post)"
        >
          Post comment
        </button>
      </div>
      <!----><!---->
      <div class="mb-1">
        <div
          class="media media media-comment"
          v-for="(comment, index) in post.comments"
          :key="index"
        >
          <img
            src="/images/person-2.jpeg"
            alt="Image placeholder"
            class="avatar avatar-lg media-comment-avatar rounded-circle"
          />
          <div class="media-body media-body">
            <div class="media-comment-text">
              <h6 class="h5 mt-0">{{ comment.username.name }}</h6>
              <p class="text-sm lh-160">
                {{ comment.comment }}                
              </p>
              <div class="icon-actions">
                <a href="javascript:void(0)" @click="showModal(true, comment.id)">
                  <i class="ni ni-curved-next"></i> Reply                  
                </a>
              </div>
            </div>

            <div class="mb-1 mt-2">
              <div
                class="media media media-comment"
                v-for="(response, index) in comment.responses"
                :key="index"
              >
                <img
                  src="/images/person-3.jpeg"
                  alt="Image placeholder"
                  class="avatar avatar-lg media-comment-avatar rounded-circle"
                />
                <div class="media-body media-body">
                  <div class="media-comment-text">
                    <h6 class="h5 mt-0">{{ response.username.name }}</h6>
                    <p class="text-sm lh-160">
                      {{ response.response }}                
                    </p>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
                    

        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { mapGetters, mapMutations } from "vuex";
import { Component, Vue } from "vue-property-decorator";
import { postService as Post, userService as User } from "../services";
import RespondToComment from '../components/RespondToComment.vue'
import moment from "moment";
@Component({
  components: {
    RespondToComment
  },
  computed: {
    ...mapGetters({
      getUser: "user/getUser",
      getPosts: "post/getPosts",
    }),
  },
  methods: {
    ...mapMutations({
      setPosts: "post/setPosts",
      setComment: "post/setComment",
      setCommentResponse: "post/setCommentResponse"
    }),
  },
})
export default class NewsFeed extends Vue {
  public setPosts!: Function;
  public setComment!: Function;
  public setCommentResponse!: Function
  public comment_id: any = null
  public showRespondModal: Boolean = false
  public getPosts: any;
  public getUser: any;
  public $router: any;
  public comment: string = "";

  mounted() {
    this.posts();
  }

  public showModal(show: Boolean = false, id: number) {
    if(show) {
      this.comment_id = id
    } else {
      this.comment_id = null
    }
    this.showRespondModal = show 
  }  

  public postComment(post: any) {
    if (!this.getUser) {
      alert("Set your fullname first!.");
      return this.$router.push({ path: "/" });
    }

    Post.postComment(post.id, {
      comment: this.comment,
      username_id: this.getUser.id,
    })
      .then((response) => {
        let data = {
          id: post.id,
          comment: response.data,
        };
        this.setComment(data);
        this.comment = ''        
      })
      .catch((err) => {
        let errors = err.response.data;
        let errorsArr: any = [];
        Object.keys(errors).map(function (key, index) {
          errorsArr.push(errors[key]);
        });
        alert(errorsArr.join(", "));
      });
  }

  public appendResponse(data: any) {
    this.setCommentResponse(data)
  }

  public daysAgo(datetime: any) {
    let now = moment();
    return now.diff(datetime, "hours");
  }

  public posts() {
    Post.getPosts().then((response) => {
      this.setPosts(response.data.original);
    });
  }
}
</script>
