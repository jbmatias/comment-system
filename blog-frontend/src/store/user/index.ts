import state from './user.state';
import getters from './user.getters';
import mutations from './user.mutations';
import actions from './user.actions';

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}