export default {
  setPosts(state: { posts: any }, data: any) {
    state.posts = data
  },
  setComment(state: { posts: any }, data: any) {
    state.posts.map((post: any) => {
      if(post.id === data.id) {
        post.comments.push(data.comment)
      }      
    })    
  },
  setCommentResponse(state: { posts: any }, data: any) {
    state.posts.map((post: any) => {
      post.comments.map((comment: any) => {
        if(comment.id === data.comment_id) {
          comment['responses'].push(data)
        }
      })
    })    
  }
}
