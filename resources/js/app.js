/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import VueRouter from 'vue-router'
import Vuex from 'vuex'

Vue.use(VueRouter)
Vue.use(Vuex)

const url = 'http://localhost:8000'

const store = new Vuex.Store({
  state: {
    posts: [],
    selectedCategory: '',
    filterTodayPosts: false
  },
  actions: {
      fetchPosts ({commit}) {
          axios.get(`${url}/posts`)
              .then(response => {
                  commit('setPosts', response.data)
              })
              .catch(err => console.log(err))
      },
      savePost ({commit}, payload) {
        const promise = axios.post(`${url}/posts`, payload)

        promise.then(response => commit('addPost', response.data))
              .catch(err => console.log(err))

        return promise
      }
  },
  mutations: {
    setPosts (state, payload) {
      state.posts = payload
    },
    setSelectedCategory (state, payload) {
        state.selectedCategory = payload
    },
    setFilterTodayPosts (state, payload) {
        state.filterTodayPosts = !state.filterTodayPosts
    },
    addPost (state, payload) {
        state.posts.push(payload)
    }
  },
  getters: {
      categories (state) {
          return _.uniqBy(state.posts.map(post => post.category), 'id')
      },
      categoriesKeyed (state, getters) {
          return _.keyBy(getters.categories, 'id')
      },
      todayPosts (state) {
          return state.posts.filter(
              post => moment(post.created_at).format('YYYY-MM-DD') === moment().format('YYYY-MM-DD')
          ).length
      },
      postsByCategory (state, getters) {
          const countedPosts = _.countBy(state.posts, 'category_id')

          return _.map(countedPosts, (totalPosts, categoryId) =>
              `${getters.categoriesKeyed[categoryId].name}: ${totalPosts}`
          )
      },
      filteredPosts (state) {
          let posts = state.posts

          if (state.selectedCategory) {
              posts = posts.filter(post => post.category_id === parseInt(state.selectedCategory))
          }

          if (state.filterTodayPosts) {
              posts = posts.filter(post => moment(post.created_at).format('YYYY-MM-DD') === moment().format('YYYY-MM-DD'))
          }

          return _.orderBy(posts, ['created_at'], ['desc'])
      }
  }
})

import App from './views/App'
import Home from './views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/app/home',
            name: 'home',
            component: Home
        }
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
