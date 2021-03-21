import PostService from './post.service'
import UserService from './user.service'
let postService = new PostService();
let userService = new UserService();
export {
    postService,
    userService
}
