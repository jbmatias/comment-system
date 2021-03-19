import BaseService from './base.service'
export default class UserService extends BaseService{

    constructor(){
        super();        
    }

    public save(params: any = {}) {
        let url = this.baseURL + '/api/save/username'
        return super.post(url, params)
    }
}
