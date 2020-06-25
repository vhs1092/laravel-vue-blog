import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'

import blog from './modules/blog'
import auth from './modules/auth'
import user from './modules/user'
import comment from './modules/comment'
import favourite from './modules/favourite'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        blog,
        auth,
        comment,
        favourite,
        user
    },
    plugins: [createPersistedState()]
})