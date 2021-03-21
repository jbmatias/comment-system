import BaseService from './base.service'
export default class PostService extends BaseService{

    constructor(){
        super();        
    }    

    public getPosts() {
        let url = this.baseURL + '/api/posts'
        return super.get(url)
    }

    public postComment(id: number, params: any) {
        let url = this.baseURL + `/api/posts/${id}/comment`
        return super.post(url, params)
    }

    public respondToComment(params: any) {
        let url = this.baseURL + `/api/posts/comment/respond`
        return super.post(url, params)
    }
}
